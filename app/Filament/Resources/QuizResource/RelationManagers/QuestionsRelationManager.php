<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\Option;
use App\Models\Question;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Radio;
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

    public function form(Form $form): Form
    {
        // dd($this->getOwnerRecord()->name);
        if ($this->getOwnerRecord()->quiz_type_id == 1) {
            return $form
                ->columns(1)
                ->schema([
                    MarkdownEditor::make('question')
                        ->label("Pertanyaan")
                        ->rules(["required"]),
                    Fieldset::make("Pilihan")->schema([
                        MarkdownEditor::make('options[0]')
                            ->label("Pilihan A")
                            ->rules(["required"]),
                        MarkdownEditor::make('options[1]')
                            ->label("Pilihan B")
                            ->rules(["required"]),
                        MarkdownEditor::make('options[2]')
                            ->label("Pilihan C")
                            ->rules(["required"]),
                        MarkdownEditor::make('options[3]')
                            ->label("Pilihan D")
                            ->rules(["required"]),
                    ])->columns(1),
                    Radio::make("correct_answer")
                        ->label("Jawaban Benar")
                        ->options([
                            "0" => "A",
                            "1" => "B",
                            "2" => "C",
                            "3" => "D",
                        ])
                        ->inline()
                        ->inlineLabel(false)
                        ->rules(["required"]),
                ]);
        } else if ($this->getOwnerRecord()->quiz_type_id == 2) {
            return $form->columns(1)->schema([
                MarkdownEditor::make('question')
                    ->label("Pertanyaan")
                    ->rules(["required"]),
                Radio::make("is_correct")
                    ->label("Jawaban")
                    ->options([
                        "1" => "Benar",
                        "0" => "Salah",
                    ])
                    ->inline()
                    ->inlineLabel(false)
                    ->rule(["required"]),
            ]);
        } else {
            return $form->columns(1)->schema([
                MarkdownEditor::make('question')
                    ->label("Pertanyaan")
                    ->rules(["required"]),
            ]);
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('question')
            ->columns([
                Tables\Columns\TextColumn::make('question')->searchable(),
            ])
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
                                for ($i = 0; $i < 4; $i++) {
                                    $newOption = Option::create([
                                        "question_id" => $newQuestion->id,
                                        "option" => $data["options[$i]"],
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
                                // for ($i = 0; $i < 2; $i++) {
                                $newOption = Option::create([
                                    "question_id" => $newQuestion->id,
                                    "option" => $data["is_correct"] == 0 ? "Salah" : "Benar",
                                    "is_correct" => $data["is_correct"],
                                ]);
                                // if ($i == $data["is_correct"]) {
                                $newQuestion->update([
                                    "correct_answer_id" => $newOption->id,
                                ]);
                                // }
                                // }
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
                                $data["options[$index]"] = $option->option;
                                if ($option->is_correct) {
                                    $data["correct_answer"] = $index;
                                }
                            }
                        } else if ($this->getOwnerRecord()->quiz_type_id == 2) {
                            $option = Option::where("question_id", $data["id"])->orderBy("id")->get()[0];
                            $data["is_correct"] = $option->is_correct;
                        }
                        return $data;
                    })
                    ->using(function (Model $record, array $data): Model {
                        if ($this->getOwnerRecord()->quiz_type_id == 1) {
                            DB::transaction(function () use ($record, $data) {
                                // dd($data);
                                // dd($record);
                                $record->update([
                                    "question" => $data["question"],
                                    "correct_answer_id" => null,
                                ]);
                                Option::where("question_id", $record->id)->delete();
                                for ($i = 0; $i < 4; $i++) {
                                    $newOption = Option::create([
                                        "question_id" => $record->id,
                                        "option" => $data["options[$i]"],
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
                                $record->update();
                                $record->options[0]->update([
                                    "option" => $data["is_correct"] == 0 ? "Salah" : "Benar",
                                    "is_correct" => $data["is_correct"],
                                ]);
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
