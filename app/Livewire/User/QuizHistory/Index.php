<?php

namespace App\Livewire\User\QuizHistory;

use App\Http\Resources\User\StudentQuizzesResource;
use App\Models\StudentQuiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.base_layout")]
    public function render()
    {
        $student_quizzes = StudentQuiz::where("student_id", auth()->guard("student")->user()->id)->where("is_done", 1)->get();
        return view('livewire.user.quiz-history.index', [
            "student_quizzes" => StudentQuizzesResource::collection($student_quizzes)->resolve(),
        ])->title("History");
    }
}
