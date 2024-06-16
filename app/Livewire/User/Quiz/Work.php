<?php

namespace App\Livewire\User\Quiz;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\StudentQuiz;
use App\Models\StudentQuizAnswer;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Work extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public StudentQuiz $student_quiz;
    public $active_question = 1;
    public $selected_options = [];
    #[On("time-up")]
    public function on_time_up()
    {
        // dd("waktu habis");
        $this->save_temp_answer();
        $start_time = Carbon::createFromFormat("Y-m-d H:i:s", $this->student_quiz->start_time);
        $end_time = Carbon::now();
        $duration = $start_time->diffInSeconds($end_time, false);
        // dd($duration);
        $this->student_quiz->update([
            "is_done" => true,
            "end_time" => Carbon::now(),
            "duration" => $duration,
        ]);
        return $this->redirectRoute("quiz.done", navigate: true);
    }
    // public $remaining_time;
    public function mount()
    {
        $this->student_quiz = StudentQuiz::firstOrCreate(
            ["student_id" => auth()->guard("student")->user()->id, "quiz_id" => $this->quiz->id],
            ["start_time" => Carbon::now()],
        );
        if ($this->student_quiz->is_done) {
            return $this->redirectRoute("quiz.done", navigate: true);
        }
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

    public function save_temp_answer()
    {
        $upsert = [];
        foreach ($this->quiz->questions as $index => $question) {
            if ($this->selected_options[$index] != null) {
                $upsert[] = [
                    "student_quiz_id" => $this->student_quiz->id,
                    "question_id" => $question->id,
                    "option_id" => $this->selected_options[$index],
                    "is_correct" => $this->selected_options[$index] == $question->correct_answer_id,
                ];
            }
        }

        StudentQuizAnswer::upsert(
            $upsert,
            ["student_quiz_id", "question_id"],
            ["option_id", "is_correct"]
        );
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
