<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Models\School;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SchoolResource extends Resource
{
    protected static ?string $label = "Школу";
    protected static ?string $pluralLabel = "Школы";
    protected static ?string $navigationLabel = "Школы";
    protected static ?string $model = School::class;
    protected static ?string $navigationGroup = "Данные";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label("Название")
                        ->rules(["required"])
                        ->required(),
                    Select::make("school_category_id")
                        ->label("Категория школы")
                        ->relationship(
                            name: 'category',
                            titleAttribute: 'name',
                            modifyQueryUsing: fn($query) => auth()->user()->school_category_id ? $query->where("id", auth()->user()->school_category_id) : $query
                        )
                        ->default(function () {
                            if (auth()->user()->school_category_id != null) {
                                return auth()->user()->school_category_id;
                            }
                        })
                        ->placeholder("Выберите тип школы")
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {

        return $table
            ->modifyQueryUsing(function (Builder $query) {
                if (auth()->user()->school_category_id != null) {
                    return $query->where("school_category_id", auth()->user()->school_category_id);
                }
                return $query;
            })
            ->columns([
                TextColumn::make("name")
                    ->label("Название школы")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("category.name")
                    ->label("Тип школы")
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('school_category_id')
                    ->label("Тип школы")
                    ->options([
                        '1' => 'Младшая средняя школа',
                        '2' => 'Высшая средняя школа',
                    ])
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
            'index' => Pages\ListSchools::route('/'),
        ];
    }
}
