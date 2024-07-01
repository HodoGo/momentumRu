<?php

namespace App\Livewire\User\Profile;

use App\Http\Resources\User\AuthProfileResource;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.base_layout")]
    #[Validate("required")]
    public $current_password;
    #[Validate("required|min:8|confirmed")]
    public $new_password;
    public $new_password_confirmation;
    public function render()
    {
        $auth = (new AuthProfileResource(Auth::guard("student")->user()))->resolve();
        return view('livewire.user.profile.index', [
            "auth" => $auth,
        ])->title("Profile");
    }

    public function changePassword()
    {
        $auth = Auth::guard("student")->user();
        $this->validate();
        if ($this->current_password != $auth->password) {
            $this->reset();
            flash("Password Saat Ini Salah", "danger");
        }
        $auth->update([
            "password" => $this->new_password,
        ]);
        $this->reset();
        flash("Password Berhasil di Ubah", "success");
    }
}
