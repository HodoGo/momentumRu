<?php

namespace App\Livewire\User\Components;

use App\Http\Resources\User\StudentQuizzesResource;
use App\Models\StudentQuiz;
use Livewire\Component;

class QuizHistoryRow extends Component
{
    public $student_quiz;
    public $isOpen = false;
    public function mount($student_quiz)
    {
        $this->student_quiz = $student_quiz;
    }
    public function render()
    {
        return view('livewire.user.components.quiz-history-row');
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }
}
