<?php

use App\Http\Controllers\Admin\QuizRecapController;
use App\Http\Controllers\User\QuizWorkController;
use Illuminate\Support\Facades\Route;
use App\Livewire\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get("login", User\Login\Index::class)->name("login")->middleware(["studentguest"]);
Route::middleware(["student"])->group(function () {
  Route::get("/", User\Home\Index::class)->name("home");
  Route::get("profile", User\Profile\Index::class)->name("profile");
  Route::prefix("quiz")->name("quiz.")->group(function () {
    Route::get("", User\Quiz\Index::class)->name("index");
    Route::get("history", User\QuizHistory\Index::class)->name("history");
    Route::get("done", User\Quiz\Done::class)->name("done");
    Route::get("{quiz}", User\Quiz\Show::class)->name("show");
    Route::get("{quiz}/work", User\Quiz\Work::class)->name("work");
  });
});
Route::get("admin/quiz/{quiz}/print", [QuizRecapController::class, "print"])->name("admin.quiz.recap");
Route::post("student/online", [QuizWorkController::class, "updateOnlineStatus"])->name("student.online");
