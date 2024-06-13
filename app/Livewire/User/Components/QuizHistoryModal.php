<?php

namespace App\Livewire\User\Components;

use Livewire\Component;

class QuizHistoryModal extends Component
{
    public $isOpen = false;
    public function render()
    {
        return view('livewire.user.components.quiz-history-modal');
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
