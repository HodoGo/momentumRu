<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.base_layout")]
    public function render()
    {
        $quizzes = Quiz::where("school_category_id", auth()->guard("student")->user()->school->school_category_id)->get();
        return view('livewire.user.quiz.index', [
            "quizzes" => $quizzes,
        ])->title("Quiz");
    }
}
