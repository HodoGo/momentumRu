<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use App\Models\StudentQuiz;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Show extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public $has_work;
    public $has_end;
    public function mount()
    {
        $this->has_work = StudentQuiz::select("is_done")->where("quiz_id", $this->quiz->id)
            ->where("student_id", auth()->guard("student")->user()->id)
            ->pluck("is_done")->first();
        $current_time = Carbon::now();
        $end_time = Carbon::parse($this->quiz->end_time);
        if ($current_time->greaterThan($end_time)) {
            $this->has_end = true;
        }
    }

    public function render()
    {
        return view('livewire.user.quiz.show', [
        ])->title($this->quiz->name);
    }

    // show quiz modal
    public $show_quiz_code_modal = false;
    public function openQuizCodeModal()
    {
        $this->show_quiz_code_modal = true;
    }
    public function closeQuizCodeModal()
    {
        $this->show_quiz_code_modal = false;
        $this->quiz_code = "";
    }
    // quiz validate
    #[Validate("required")]
    public $quiz_code;
    public function checkCode()
    {
        $this->validate();
        if ($this->quiz_code == $this->quiz->code) {
            return $this->redirectRoute("quiz.work", ["quiz" => $this->quiz->id], navigate: true);
        }
        $this->addError("quiz_code", "Code Kuis Salah");
    }

}
