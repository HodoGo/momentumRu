<?php

namespace App\Livewire\User\Home;

use App\Models\Quiz;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.base_layout")]
    public function render()
    {
        $quizzes = Quiz::limit(3)->get();
        return view('livewire.user.home.index', [
            "quizzes" => $quizzes,
        ]);
    }
}
