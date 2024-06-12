<?php

namespace App\Livewire\User\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Work extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public $active_question = 1;
    public function render()
    {
        $show_question = Question::where("quiz_id", $this->quiz->id)
            ->skip($this->active_question - 1)
            ->take(1)
            ->first();
        return view('livewire.user.quiz.work', [
            "show_question" => $show_question,
        ]);
    }

    public function nextQuestion()
    {
        if ($this->active_question !== $this->quiz->questions->count()) {
            $this->active_question++;
        }
    }

    public function previousQuestion()
    {
        if ($this->active_question != 1) {
            $this->active_question--;
        }
    }

    public function setQuestion($number)
    {
        $this->active_question = $number;
    }
}
