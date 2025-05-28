<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Models\Option;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class QuestionsRelationManager extends RelationManager
{
    protected static string $relationship = 'questions';
    protected static ?string $title = "Вопросы";
    protected static ?string $modelLabel = "Вопросы";

    public function form(Form $form): Form
    {
        // dd($this->getOwnerRecord()->name);
        if ($this->getOwnerRecord()->quiz_type_id == 1) {
            return $form
                ->columns(1)
                ->schema([
                    Section::make("Question")->schema([
                        TinyEditor::make("question")
                            ->label("Вопрос")
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('questions')
                            ->profile('custom1')
                            ->required()
                    ])->collapsed(),
                    Section::make("Варианты ответов")->schema([
                        TinyEditor::make("options.0")
                            ->label("Вариант A")
                            ->minHeight(60)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('options')
                            ->profile('custom1')
                            ->required(),
                        TinyEditor::make("options.1")
                            ->label("Вариант B")
                            ->minHeight(60)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('options')
                            ->profile('custom1')
                            ->required(),
                        TinyEditor::make("options.2")
                            ->label("Вариант C")
                            ->minHeight(60)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('options')
                            ->profile('custom1')
                            ->required(),
                        TinyEditor::make("options.3")
                            ->label("Вариант D")
                            ->minHeight(60)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('options')
                            ->profile('custom1')
                            ->required(),
                        TinyEditor::make("options.4")
                            ->label("Вариант E")
                            ->minHeight(60)
                            ->fileAttachmentsDisk('public')
                            ->fileAttachmentsVisibility('public')
                            ->fileAttachmentsDirectory('options')
                            ->profile('custom1')
                            ->required(),
                    ])->columns(1)->collapsed(),
                    Radio::make("correct_answer")
                        ->label("Правильный ответ")
                        ->options([
                            "0" => "A",
                            "1" => "B",
                            "2" => "C",
                            "3" => "D",
                            "4" => "E",
                        ])
                        ->inline()
                        ->inlineLabel(false)
                        ->rules(["required"]),
                ]);
        } else if ($this->getOwnerRecord()->quiz_type_id == 2) {
            return $form->columns(1)->schema([
                TinyEditor::make("question")
                    ->label("Вопрос")
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('questions')
                    ->profile('custom1')
                    ->required(),
                Radio::make("is_correct")
                    ->label("Ответ")
                    ->options([
                        "0" => "Ложь",
                        "1" => "Правда",
                    ])
                    ->inline()
                    ->inlineLabel(false)
                    ->rule(["required"]),
            ]);
        } else {
            return $form->columns(1)->schema([
                TinyEditor::make("question")
                    ->label("Вопрос")
                    ->fileAttachmentsDisk('public')
                    ->fileAttachmentsVisibility('public')
                    ->fileAttachmentsDirectory('questions')
                    ->profile('custom1')
                    ->required()
            ]);
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('Soal')
            ->columns([
                Tables\Columns\TextColumn::make('question')
                    ->getStateUsing(function ($record) {
                        return "Soal Quiz";
                    })
                    ->label("Вопрос")
                    ->searchable(),
            ])
            ->defaultSort("created_at", "desc")
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->using(function (array $data, string $model): Model {
                        // dd($this->getOwnerRecord()->name);
                        // dd($data);
                        $newQuestion = null;
                        if ($this->getOwnerRecord()->quiz_type_id == 1) {
                            DB::transaction(function () use ($model, $data, &$newQuestion) {
                                $newQuestion = $model::create([
                                    "quiz_id" => $this->getOwnerRecord()->id,
                                    "question" => $data["question"],
                                ]);
                                for ($i = 0; $i < 5; $i++) {
                                    $newOption = Option::create([
                                        "question_id" => $newQuestion->id,
                                        "option" => $data["options"][$i],
                                        "is_correct" => $data["correct_answer"] == $i,
                                    ]);
                                    if ($i == $data["correct_answer"]) {
                                        $newQuestion->update([
                                            "correct_answer_id" => $newOption->id,
                                        ]);
                                    }
                                }
                            });
                        } else if ($this->getOwnerRecord()->quiz_type_id == 2) {
                            DB::transaction(function () use ($model, $data, &$newQuestion) {
                                $newQuestion = $model::create([
                                    "quiz_id" => $this->getOwnerRecord()->id,
                                    "question" => $data["question"],
                                ]);
                                for ($i = 0; $i < 2; $i++) {
                                    $newOption = Option::create([
                                        "question_id" => $newQuestion->id,
                                        "option" => $i == 0 ? "Salah" : "Benar",
                                        "is_correct" => $i == $data["is_correct"],
                                    ]);
                                    if ($i == $data["is_correct"]) {
                                        $newQuestion->update([
                                            "correct_answer_id" => $newOption->id,
                                        ]);
                                    }
                                }
                            });
                        } else {
                            $newQuestion = Question::create([
                                "quiz_id" => $this->getOwnerRecord()->id,
                                "question" => $data["question"],
                            ]);
                        }
                        return $newQuestion;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        if ($this->getOwnerRecord()->quiz_type_id == 1) {
                            $options = Option::where("question_id", $data["id"])->orderBy("id")->get();
                            foreach ($options as $index => $option) {
                                $data["options"][$index] = $option->option;
                                if ($option->is_correct) {
                                    $data["correct_answer"] = $index;
                                }
                            }
                        } else if ($this->getOwnerRecord()->quiz_type_id == 2) {
                            $option = Option::where("question_id", $data["id"])
                                ->where("is_correct", "1")
                                ->first();
                            $data["is_correct"] = $option->option == "Benar" ? 1 : 0;
                        }
                        return $data;
                    })
                    ->using(function (Model $record, array $data): Model {
                        if ($this->getOwnerRecord()->quiz_type_id == 1) {
                            DB::transaction(function () use ($record, $data) {
                                $record->update([
                                    "question" => $data["question"],
                                    "correct_answer_id" => null,
                                ]);
                                Option::where("question_id", $record->id)->delete();
                                for ($i = 0; $i < 5; $i++) {
                                    $newOption = Option::create([
                                        "question_id" => $record->id,
                                        "option" => $data["options"][$i],
                                        "is_correct" => $data["correct_answer"] == $i,
                                    ]);
                                    if ($i == $data["correct_answer"]) {
                                        $record->update([
                                            "correct_answer_id" => $newOption->id,
                                        ]);
                                    }
                                }
                            });
                        } else if ($this->getOwnerRecord()->quiz_type_id == 2) {
                            DB::transaction(function () use ($record, $data) {
                                $record->update([
                                    "question" => $data["question"],
                                    "correct_answer_id" => null,
                                ]);
                                foreach ($record->options as $index => $option) {
                                    $record->options[$index]->update([
                                        "is_correct" => $index == $data["is_correct"],
                                    ]);
                                    if ($index == $data["is_correct"]) {
                                        $record->update([
                                            "correct_answer_id" => $record->options[$index]->id,
                                        ]);
                                    }

                                }
                            });
                        } else {
                            $record->update([
                                "question" => $data["question"],
                            ]);
                        }
                        return $record;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
