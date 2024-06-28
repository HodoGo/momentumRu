<?php

namespace App\Livewire\Admin\QuizMonitoring;

use App\Models\Quiz;
use App\Models\Student;
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
            $student->answer_count = 0;
        });
    }
    public function render()
    {
        return view('livewire.admin.quiz-monitoring.show');
    }
}
