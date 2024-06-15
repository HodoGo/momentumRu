<?php

namespace App\Livewire\User\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Work extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public StudentQuiz $student_quiz;
    public $active_question = 1;
    public $selected_options = [];
    // public $remaining_time;
    public function mount()
    {
        $this->student_quiz = StudentQuiz::firstOrCreate(
            ["student_id" => auth()->guard("student")->user()->id, "quiz_id" => $this->quiz->id],
            ["start_time" => Carbon::now()],
        );
        foreach ($this->quiz->questions as $index => $question) {
            $has_answer = false;
            foreach ($this->student_quiz->student_quiz_answers as $student_quiz_answer) {
                if ($question->id == $student_quiz_answer->question_id) {
                    $this->selected_options[$index] = $student_quiz_answer->option_id;
                    $has_answer = true;
                    break;
                }
            }
            if (!$has_answer) {
                $this->selected_options[$index] = null;
            }
        }
        // $this->remaining_time = $this->count_remaining_time();
    }
    public function render()
    {
        // dd($this->selected_options);
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
