<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\QuizRecapResource;
use App\Filament\Resources\QuizResource;
use App\Models\Quiz;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;

class LatestQuizzes extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';
    public static ?int $sort = 4;
    protected static ?string $heading = "Последние тесты";
    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                if (auth()->user()->school_category_id != null) {
                    return QuizRecapResource::getEloquentQuery()->where("school_category_id", auth()->user()->school_category_id)->limit(5);
                }
                return QuizRecapResource::getEloquentQuery()->limit(5);
            })
            ->paginated(false)
            ->defaultPaginationPageOption(2)
            ->defaultSort("created_at", "desc")
            ->columns([
                TextColumn::make("name")
                    ->label("Наименование"),
                TextColumn::make("school_category.name")
                    ->label("Тип школы"),
                TextColumn::make("quiz_type.description")
                    ->label("Тип теста"),
                TextColumn::make("status")
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
            ->actions([
                Tables\Actions\Action::make('detail')
                    ->url(fn(Quiz $record): string => QuizResource::getUrl('edit', ['record' => $record])),
            ]);
    }
}
