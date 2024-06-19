<?php

namespace App\Livewire\Admin\QuizRecap;

use App\Models\Quiz;
use App\Models\StudentQuiz;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Concerns\InteractsWithInfolists;
use Filament\Infolists\Contracts\HasInfolists;
use Filament\Infolists\Infolist;
use Livewire\Component;

class Show extends Component implements HasForms, HasInfolists
{
    use InteractsWithInfolists;
    use InteractsWithForms;
    public Quiz $quiz;
    public $open_detail_modal = false;
    public StudentQuiz $activeStudentQuiz;
    public $activeRanking;
    public $correct_answer_count;
    public $wrong_answer_count;
    public $not_answer_count;
    public function render()
    {
        $student_quizzes = StudentQuiz::where("quiz_id", $this->quiz->id)->orderBy("score", "desc")->get();
        return view('livewire.admin.quiz-recap.show', [
            "student_quizzes" => $student_quizzes,
        ]);
    }
    public function productInfolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->record($this->quiz)
            ->schema([
                Section::make()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                Group::make([
                                    TextEntry::make("name"),
                                    TextEntry::make("school_category.name"),
                                    TextEntry::make("start_time"),
                                    TextEntry::make("duration"),
                                ]),
                                Group::make([
                                    TextEntry::make("code"),
                                    TextEntry::make("quiz_type.description"),
                                    TextEntry::make("end_time"),
                                    TextEntry::make("show_score"),
                                ])
                            ])
                    ]),
            ]);
    }

    public function openModal(StudentQuiz $studentQuiz, $ranking)
    {
        $this->activeStudentQuiz = $studentQuiz;
        $this->activeRanking = $ranking;
        $this->correct_answer_count = $studentQuiz->student_quiz_answers->where("is_correct", 1)->count();
        $this->wrong_answer_count = $studentQuiz->student_quiz_answers->where("is_correct", 0)->count();
        $this->not_answer_count = $studentQuiz->quiz->questions->count() - $studentQuiz->student_quiz_answers->count();
        $this->open_detail_modal = true;
    }
    public function closeModal()
    {
        $this->open_detail_modal = false;
    }
}
