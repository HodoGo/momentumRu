<?php

namespace App\Livewire\User\Login;

use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Index extends Component
{
    #[Layout("components.layouts.app")]

    #[Validate("required")]
    public $username;

    #[Validate("required|min:8")]
    public $password;
    public $quotes = [
        [ 
            'quote' => 'Обучение - это процесс, который длится всю жизнь и никогда не прекращается. Каждый новый опыт - это возможность расширить свой кругозор и улучшить себя.',
            'name' => 'Альберт Эйнштейн'
        ],
        [
            'quote' => 'Знания - самое ценное сокровище, а обучение - ключ, открывающий дверь к этому богатству. Никогда не прекращайте стремиться к знаниям',
            'name' => 'Нельсон Мандела'
        ],
        [
            'quote' => 'Каждый раз, когда мы узнаем что-то новое, мы добавляем еще один кирпичик в фундамент нашего будущего. Обучение - это лучшая инвестиция, которую мы можем сделать',
            'name' => 'Бенджамин Франклин'
        ],
        [
            'quote' => 'Учиться - это не только понимать учебники, но и понимать мир вокруг нас и то, как мы можем внести в него лучший вклад',
            'name' => 'Малала Юсафзай'
        ],
        [
            'quote' => 'Мудрые люди всегда будут искать возможности учиться, потому что они знают, что знания - это бесценная сила',
            'name' => 'Сократ'
        ],
        [
            'quote' => 'Учеба - это окно в большой и широкий мир. Обучаясь, мы можем видеть дальше и достигать большего',
            'name' => 'Опра Уинфри'
        ],
        [
            'quote' => 'Успех в жизни часто приходит благодаря способности постоянно учиться и приспосабливаться к изменениям. Никогда не прекращайте учиться',
            'name' => 'Чарльз Дарвин'
        ],
        [
            'quote' => 'Каждый вызов, с которым мы сталкиваемся, - это возможность научиться чему-то новому. Не бойтесь потерпеть неудачу, потому что на основе неудач мы учимся добиваться успеха',
            'name' => 'Томас Эдисон'
        ],
        [
            'quote' => 'Обучение - это путешествие без конца. Каждый шаг приближает нас к цели, но и открывает дверь к новым знаниям.',
            'name' => 'Махатма Ганди'
        ],
        [
            'quote' => 'В постоянно меняющемся мире способность учиться и внедрять инновации - это ключ к выживанию и процветанию. Учитесь всю жизнь',
            'name' => 'Стив Джобс'
        ],
    ];

    public function render()
    {
        return view('livewire.user.login.index', [
            "quote" => $this->quotes[rand(0, 9)],
        ])->title("Login");
    }
    public function login()
    {
        $this->validate();
        $student = Student::where("username", $this->username)->first();
        if ($student && $student->password == $this->password) {
            Auth::guard('student')->login($student);
            return $this->redirectRoute("home", navigate: true);
        }
        $this->reset();
        flash("Username / Password Salah", "danger");
    }
}
