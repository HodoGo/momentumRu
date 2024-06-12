<?php

namespace App\Livewire\User\Quiz;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Work extends Component
{
    #[Layout("components.layouts.base_layout")]
    public Quiz $quiz;
    public function render()
    {
        return view('livewire.user.quiz.work');
    }
}
