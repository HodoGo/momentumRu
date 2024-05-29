<?php

namespace App\Filament\Resources\QuizResource\RelationManagers;

use App\Models\Option;
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
                        return $newQuestion;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->mutateRecordDataUsing(function (array $data): array {
                        $options = Option::where("question_id", $data["id"])->orderBy("id")->get();
                        foreach ($options as $index => $option) {
                            $data["options[$index]"] = $option->option;
                            if ($option->is_correct) {
                                $data["correct_answer"] = $index;
                            }
                        }
                        return $data;
                    })
                    ->using(function (Model $record, array $data): Model {
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
