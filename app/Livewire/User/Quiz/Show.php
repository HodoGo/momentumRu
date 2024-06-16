<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use App\Models\StudentQuiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Show extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public function render()
    {
        $has_work = StudentQuiz::select("is_done")->where("quiz_id", $this->quiz->id)
            ->where("student_id", auth()->guard("student")->user()->id)
            ->pluck("is_done")->first();
        return view('livewire.user.quiz.show', [
            "has_work" => $has_work,
        ]);
    }
}
