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
    protected static ?string $label = "Проверка";
    protected static ?string $navigationLabel = "Проверка";
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
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->school_category_id != null) {
                    return $query->where("school_category_id", auth()->user()->school_category_id);
                }
                return $query;
            })
            ->columns([
                TextColumn::make("name")
                    ->label("Название")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("school_category.name")
                    ->label("Тип школы")
                    ->sortable(),
                TextColumn::make("quiz_type.description")
                    ->label("Тип теста")
                    ->sortable(),
                TextColumn::make("status")
                    ->label("Статус")
                    ->badge()
                    ->getStateUsing(function ($record): string {
                        $current_time = Carbon::now();
                        $start_time = Carbon::parse($record->start_time);
                        $end_time = Carbon::parse($record->end_time);
                        if ($current_time->lessThan($start_time)) {
                            return "Еще не начато";
                        }
                        if ($current_time->between($start_time, $end_time)) {
                            return "Выполняется";
                        }
                        if ($current_time->greaterThan($end_time)) {
                            return "Закончено";
                        }
                        return "-";
                    })
                    ->colors([
                        "success" => "Выполняется",
                        "warning" => "Еще не начато",
                        "danger" => "Закончено",
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
