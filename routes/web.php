<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', App\Livewire\User\Home\Index::class)->name('home');
Route::get('login', App\Livewire\User\Login\Index::class)->name('login');
Route::get('profile', App\Livewire\User\Profile\Index::class)->name('profile');
Route::get('quiz', App\Livewire\User\Quiz\Index::class)->name('quiz.index');
Route::get('quiz/history', App\Livewire\User\QuizHistory\Index::class)->name('quiz.history');
Route::get('quiz/done', App\Livewire\User\Quiz\Done::class)->name('quiz.done');
Route::get('quiz/{quiz}', App\Livewire\User\Quiz\Show::class)->name('quiz.show');
Route::get('quiz/{quiz}/work', App\Livewire\User\Quiz\Work::class)->name('quiz.work');
