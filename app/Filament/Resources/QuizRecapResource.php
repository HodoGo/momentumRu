<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizRecapResource\Pages;
use App\Filament\Resources\QuizRecapResource\RelationManagers;
use App\Models\Quiz;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\View;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizRecapResource extends Resource
{
    protected static ?string $model = Quiz::class;
    protected static ?string $label = "Quiz Recap";
    protected static ?string $navigationLabel = "Quiz Recap";


    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function canCreate(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Nama")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("school_category.name")
                    ->label("Jenis Sekolah")
                    ->sortable(),
                TextColumn::make("quiz_type.description")
                    ->label("Tipe Quiz")
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageQuizRecaps::route('/'),
            'view' => Pages\ViewQuizRecap::route('{record}')
        ];
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
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
                RepeatableEntry::make("student_quiz")
                    ->schema([
                        Grid::make(8)->schema([
                            TextEntry::make("rank")->label("Peringkat X")->columnSpan(6),
                            TextEntry::make("score")->label("")->columnSpan(2),
                        ]),
                        TextEntry::make("student.name")->label("Nama"),
                        TextEntry::make("student.username")->label("Username"),
                        TextEntry::make("student.school.name")->label("Sekolah"),
                        TextEntry::make("correct")->label("Benar"),
                        TextEntry::make("correct")->label("Salah"),
                        TextEntry::make("correct")->label("Tidak Dijawab"),
                        TextEntry::make("start_time")->dateTime()->label("Waktu Mulai"),
                        TextEntry::make("start_time")->dateTime()->label("Waktu Selesai"),
                        TextEntry::make("duration")->label("Durasi Kerja"),
                    ])->columns(3)->label("Recap Siswa"),
                View::make("infolists.components.table"),
            ]);
    }

}
