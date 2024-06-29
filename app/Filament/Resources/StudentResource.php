<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentResource extends Resource
{
    protected static ?string $label = "Siswa";
    protected static ?string $pluralLabel = "Siswa";
    protected static ?string $navigationLabel = "Siswa";
    protected static ?string $model = Student::class;
    protected static ?string $navigationGroup = "Data";
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make("name")
                        ->label("Nama")
                        ->required(),
                    TextInput::make("username")
                        ->unique(ignoreRecord: true)
                        ->required(),
                    TextInput::make("password")
                        ->password()
                        // ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        // ->dehydrated(fn($state) => filled($state))
                        ->required(fn(string $context): bool => $context === 'create'),
                    TextInput::make("password_confirmation")
                        ->password()
                        ->label("Konfirmasi Password")
                        // ->dehydrated(fn($state) => filled($state))
                        ->same("password")
                        ->required(fn(string $context): bool => $context === 'create'),
                    Select::make("gender")
                        ->label("Jenis Kelamin")
                        ->placeholder("Pilih Jenis Jelamin")
                        ->options([
                            "male" => "Laki-Laki",
                            "female" => "Perempuan"
                        ])
                        ->required(),
                    Select::make("school_id")
                        ->label("Sekolah")
                        ->placeholder("Pilih Sekolah")
                        ->relationship(name: "school", titleAttribute: "name")
                        ->searchable('name')
                        ->preload()
                        ->required()
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")->label("name")->sortable()->searchable(),
                TextColumn::make("username")->label("username")->sortable()->searchable(),
                TextColumn::make("school.name")->label("sekolah")->sortable(),
                TextColumn::make("gender")->label("jenis kelamin")->sortable(),
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
