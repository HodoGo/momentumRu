<?php

namespace App\Livewire\User\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Work extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public $active_question = 1;
    // public $remaining_time;
    public function mount()
    {
        // $this->remaining_time = $this->count_remaining_time();
    }
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

    // public function count_remaining_time()
    // {
    //     $allsecond = Carbon::now()->diffInSeconds($this->quiz->end_time);
    //     $minutes = floor(($allsecond % 360) / 60);
    //     $seconds = $allsecond % 60;

    //     return "$minutes:$seconds";
    // }

    // public function refresh_time_remaining()
    // {
    //     $this->remaining_time = $this->count_remaining_time();
    // }
}
