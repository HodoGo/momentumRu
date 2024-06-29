<?php

namespace App\Filament\Resources;

use App\Filament\Resources\QuizMonitoringResource\Pages;
use App\Filament\Resources\QuizMonitoringResource\RelationManagers;
use App\Models\Quiz;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class QuizMonitoringResource extends Resource
{
    protected static ?string $model = Quiz::class;
    protected static ?string $label = "Monitoring";
    protected static ?string $navigationLabel = "Monitoring";
    protected static ?string $navigationGroup = "Quiz";
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

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
                TextColumn::make("status")
                    ->badge()
                    ->getStateUsing(function ($record): string {
                        $current_time = Carbon::now();
                        $start_time = Carbon::parse($record->start_time);
                        $end_time = Carbon::parse($record->end_time);
                        if ($current_time->lessThan($start_time)) {
                            return "Belum Berlansung";
                        }
                        if ($current_time->between($start_time, $end_time)) {
                            return "Sedang Berlansung";
                        }
                        if ($current_time->greaterThan($end_time)) {
                            return "Telah Berakhir";
                        }
                        return "-";
                    })
                    ->colors([
                        "success" => "Sedang Berlansung",
                        "warning" => "Belum Berlansung",
                        "danger" => "Telah Berakhir",
                        "info" => "-",
                    ])
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ManageQuizMonitorings::route('/'),
            'view' => Pages\MonitoringQuiz::route('{record}')
        ];
    }
}
