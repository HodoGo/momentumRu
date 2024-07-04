<?php

namespace App\Livewire\Admin\QuizMonitoring;

use App\Models\Quiz;
use App\Models\Student;
use App\Models\StudentQuizAnswer;
use Livewire\Component;

class Show extends Component
{
    public Quiz $quiz;
    public $students;
    public function mount()
    {
        $this->students = Student::whereHas("school", function ($query) {
            $query->where("school_category_id", $this->quiz->school_category_id);
        })->get();
        $this->students->map(function ($student) {
            $student->status = "offline";
            $student->answer_count = StudentQuizAnswer::whereHas("student_quiz", function ($query) use ($student) {
                $query->where("quiz_id", $this->quiz->id)
                    ->where("student_id", $student->id);
            })->count();
            $student->school_name = $student->school->name;
            $student->time_remaining = "-";
        });
    }
    public function render()
    {
        return view('livewire.admin.quiz-monitoring.show');
    }
}
