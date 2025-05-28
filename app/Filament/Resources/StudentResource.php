<?php

namespace App\Filament\Resources;

use App\Enums\Gender;
use App\Filament\Resources\StudentResource\Pages;
use App\Models\Student;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class StudentResource extends Resource
{
   protected static ?string $label = "Студента";
    protected static ?string $pluralLabel = "Студенты";
    protected static ?string $navigationLabel = "Студенты";
    protected static ?string $model = Student::class;
    protected static ?string $navigationGroup = "Данные";
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make("name")
                        ->label("Имя")
                        ->required(),
                    TextInput::make("username")
                        ->unique(ignoreRecord: true)
                        ->required(),
                    TextInput::make("password")
                        ->password()
                        ->required(fn(string $context): bool => $context === 'create'),
                    TextInput::make("password_confirmation")
                        ->password()
                        ->label("Подтвердите пароль")
                        ->same("password")
                        ->required(fn(string $context): bool => $context === 'create'),
                    Select::make("gender")
                        ->label("Пол")
                        ->placeholder("Выберите пол")
                        ->options(Gender::class)
                        ->required(),
                    Select::make("school_id")
                        ->label("Школа")
                        ->placeholder("Выберите школу")
                        ->relationship(
                            name: "school",
                            titleAttribute: "name",
                            modifyQueryUsing: fn($query) => auth()->user()->school_category_id ? $query->where("school_category_id", auth()->user()->school_category_id) : $query
                        )
                        ->searchable('name')
                        ->preload()
                        ->required()
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->school_category_id != null) {
                    return $query->whereHas("school", function ($query) {
                        $query->where("school_category_id", auth()->user()->school_category_id);
                    });
                }
                return $query;
            })
            ->columns([
                TextColumn::make("name")->label("имя")->sortable()->searchable(),
                TextColumn::make("username")->label("username")->sortable()->searchable(),
                TextColumn::make("school.name")->label("школа")->sortable(),
                TextColumn::make("gender")->label("пол")->sortable(),
            ])
            ->defaultSort("created_at", "desc")
            ->filters([
                //
            ])
            ->actions([
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
