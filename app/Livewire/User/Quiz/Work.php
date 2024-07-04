<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use App\Models\QuizSubmission;
use App\Models\StudentQuiz;
use App\Models\StudentQuizAnswer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Work extends Component
{
    use WithFileUploads;
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public StudentQuiz $student_quiz;
    public $active_question = 1;
    public $selected_options = [];
    public $all_answered = false;
    public $answered_count;
    public $essay_answer_file;
    #[On("time-up")]
    public function on_time_up()
    {
        $this->submit_quiz();
    }
    public function mount()
    {
        // get or create student quiz data
        $this->student_quiz = StudentQuiz::firstOrCreate(
            ["student_id" => auth()->guard("student")->user()->id, "quiz_id" => $this->quiz->id],
            ["start_time" => Carbon::now()],
        );
        // check quiz has done or no
        if ($this->student_quiz->is_done) {
            return $this->redirectRoute("quiz.done", navigate: true);
        }
        // load saved answer from db
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
        $this->check_complete_answer();
    }
    public function render()
    {
        return view("livewire.user.quiz.work")->title("Quiz Work");
    }
    public function updateAnswer()
    {
        $this->check_complete_answer();
        $this->save_answer();
    }
    public function setActiveQuestion($type = "set", $number = 0)
    {
        if ($type == "next") {
            if ($this->active_question !== $this->quiz->questions->count()) {
                $this->active_question++;
            }
        } else if ($type == "previous") {
            if ($this->active_question != 1) {
                $this->active_question--;
            }
        } else {
            $this->active_question = $number;
        }
    }

    public function save_answer()
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

    public function check_complete_answer()
    {
        $count = 0;
        $filterItem = array_filter($this->selected_options, function ($item) use(&$count) {
            if (!is_null($item)) {
                $count++;
            }
            return is_null($item);
        });
        $this->answered_count = $count;
        if (count($filterItem) == 0) {
            $this->all_answered = true;
        }
    }

    public function submit_quiz()
    {
        $this->save_answer();
        $start_time = Carbon::createFromFormat("Y-m-d H:i:s", $this->student_quiz->start_time);
        $end_time = Carbon::now();
        $duration = $start_time->diffInSeconds($end_time, false);
        // count score
        $correct_count = 0;
        foreach ($this->student_quiz->student_quiz_answers as $answer) {
            if ($answer->is_correct == true) {
                $correct_count++;
            }
        }
        $score = ($correct_count / $this->quiz->questions->count()) * 100;

        $this->student_quiz->update([
            "is_done" => true,
            "end_time" => $end_time,
            "duration" => $duration,
            "score" => $score,
        ]);
        return $this->redirectRoute("quiz.done", navigate: true);
    }

    public function submit_essay_quiz()
    {
        $validated = Validator::make(
            ["essay_answer_file" => $this->essay_answer_file],
            ["essay_answer_file" => "required|mimes:pdf"],
        )->validate();
        if ($this->essay_answer_file) {
            $validated["essay_answer_file"] = $this->essay_answer_file->storePublicly("essay_answers");
        }
        DB::transaction(function () use ($validated) {
            $start_time = Carbon::createFromFormat("Y-m-d H:i:s", $this->student_quiz->start_time);
            $end_time = Carbon::now();
            $duration = $start_time->diffInSeconds($end_time, false);
            $this->student_quiz->update([
                "is_done" => true,
                "end_time" => $end_time,
                "duration" => $duration,
            ]);
            QuizSubmission::create([
                "student_quiz_id" => $this->student_quiz->id,
                "file" => $validated["essay_answer_file"],
            ]);
        });
        return $this->redirectRoute("quiz.done", navigate: true);
    }
}
