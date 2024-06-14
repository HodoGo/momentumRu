<?php

namespace App\Livewire\User\Home;

use App\Http\Resources\User\AuthProfileResource;
use App\Http\Resources\User\StudentQuizzesResource;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.base_layout")]
    public function render()
    {
        $auth = (new AuthProfileResource(Auth::guard("student")->user()))->resolve();
        $quizzes = Quiz::where("school_category_id", auth()->guard("student")->user()->school->school_category_id)->limit(3)->get();
        $student_quizzes = StudentQuiz::where("student_id", auth()->guard("student")->user()->id)->limit(5)->get();
        return view('livewire.user.home.index', [
            "quizzes" => $quizzes,
            "auth" => $auth,
            "student_quizzes" => StudentQuizzesResource::collection($student_quizzes)->resolve(),
        ]);
    }
}
