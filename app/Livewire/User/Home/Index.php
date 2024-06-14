<?php

namespace App\Livewire\User\Home;

use App\Http\Resources\User\AuthProfileResource;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.base_layout")]
    public function render()
    {
        $quizzes = Quiz::limit(3)->get();
        $auth = (new AuthProfileResource(Auth::guard("student")->user()))->resolve();
        return view('livewire.user.home.index', [
            "quizzes" => $quizzes,
            "auth" => $auth,
        ]);
    }
}
