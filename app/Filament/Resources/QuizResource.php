<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizResource\Pages;
use App\Filament\Resources\QuizResource\RelationManagers;
use App\Filament\Resources\QuizResource\RelationManagers\QuestionsRelationManager;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizResource extends Resource
{
    protected static ?string $label = "Тесты";
    protected static ?string $pluralLabel = "Тесты";
    protected static ?string $navigationLabel = "Тесты";
    protected static ?string $model = Quiz::class;
    protected static ?string $navigationGroup = "Quiz";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make("name")->label("Наименование")
                        ->required(),
                    TextInput::make("code")->label("Код теста")
                        ->required()
                        ->unique(table: Quiz::class, column: "code", ignoreRecord: true),
                    Select::make("school_category_id")
                        ->label("Тип школы")
                        // ->rules(["required|exists:school_categories,id"])
                        ->relationship(name: 'school_category', titleAttribute: 'name', modifyQueryUsing: fn($query) => auth()->user()->school_category_id ? $query->where("id", auth()->user()->school_category_id) : $query)
                        ->default(function () {
                            if (auth()->user()->school_category_id != null) {
                                return auth()->user()->school_category_id;
                            }
                        })
                        // ->default("1")
                        // ->disabled(
                        //     auth()->user()->school_category_id != null ? true : false
                        // )
                        ->placeholder("Выберите тип школы")
                        ->required(),
                    Select::make("quiz_type_id")
                        ->label("Тип теста")
                        // ->rules(["required|exists:quiz_types,id"])
                        ->relationship(name: 'quiz_type', titleAttribute: 'description')
                        ->placeholder("Выберите тип теста")
                        ->required()
                        ->disabledOn("edit"),
                    Fieldset::make("Waktu Ujian")->schema([
                        DateTimePicker::make("start_time")
                            ->label("Время начала")
                            ->required()
                            ->before("end_time"),
                        DateTimePicker::make("end_time")
                            ->label("Время окончания")
                            ->required()
                            ->after("start_time"),
                        TextInput::make("duration")
                            ->label("Продолжительность (минуты)")
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                    ])->columns(3),
                    Select::make("is_active")
                        ->label("Показать тест")
                        ->options([
                            "0" => "Скрыть",
                            "1" => "Показать",
                        ])
                        ->default("0"),
                    Select::make("show_score")
                        ->label("Показать оценку")
                        ->options([
                            "0" => "Скрыть",
                            "1" => "Показать",
                        ])
                        ->default("0")
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->school_category_id != null) {
                    return $query->where("school_category_id", auth()->user()->school_category_id);
                }
                return $query;
            })
            ->columns([
                TextColumn::make("name")
                    ->label("Наименование")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("code")
                    ->label("Код")
                    ->searchable(),
                TextColumn::make("school_category.name")
                    ->label("Тип школы")
                    ->sortable(),
                TextColumn::make("quiz_type.description")
                    ->label("Тип теста")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            QuestionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListQuizzes::route('/'),
            'create' => Pages\CreateQuiz::route('/create'),
            'edit' => Pages\EditQuiz::route('/{record}/edit'),
        ];
    }
}
