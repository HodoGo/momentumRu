<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SchoolResource\Pages;
use App\Filament\Resources\SchoolResource\RelationManagers;
use App\Models\School;
use Filament\Forms;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SchoolResource extends Resource
{
    protected static ?string $label = "Sekolah";
    protected static ?string $pluralLabel = "Sekolah";
    protected static ?string $navigationLabel = "Sekolah";
    protected static ?string $model = School::class;
    protected static ?string $navigationGroup = "Data";
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    public static function form(Form $form): Form
    {
        // $categories = 
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label("Nama")
                        ->rules(["required"])
                        ->required(),
                    Select::make("school_category_id")
                        ->label("Kategori Sekolah")
                        ->rules(["required|exists:school_categories,id"])
                        ->relationship(name: 'category', titleAttribute: 'name')
                        ->placeholder("Pilih Jenis Sekolah")
                        ->required(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label("Nama Sekolah")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("category.name")
                    ->label("Jenis")
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('school_category_id')
                    ->label("Jenis Sekolah")
                    ->options([
                        '1' => 'SMP',
                        '2' => 'SMA',
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
            'create' => Pages\CreateSchool::route('/create'),
            'edit' => Pages\EditSchool::route('/{record}/edit'),
        ];
    }
}
