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
    protected static ?string $label = "Обзор";
    protected static ?string $navigationLabel = "Обзор";
    protected static ?string $pluralLabel = "Обзоры";
    protected static ?string $navigationGroup = "Тесты";
    protected static ?int $navigationSort = 2;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
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
            // 'view' => Pages\RecapQuizPage::route('{record}')
            'view' => Pages\ViewQuizRecap::route('{record}')
        ];
    }

}
