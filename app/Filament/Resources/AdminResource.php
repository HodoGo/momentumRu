<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdminResource\Pages;
use App\Filament\Resources\AdminResource\RelationManagers;
use App\Models\User;
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

class AdminResource extends Resource
{
    public static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->school_category_id == null;
    }
    protected static ?string $label = "Пользователи";
    protected static ?string $pluralLabel = "Пользователи";
    protected static ?string $navigationLabel = "Пользователи";
    protected static ?string $model = User::class;
    protected static ?string $navigationGroup = "Данные";
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make("name")
                        ->label("Наименование")
                        ->required(),
                    TextInput::make("username")
                        ->unique(ignoreRecord: true)
                        ->required(),
                    TextInput::make("email")
                        ->unique(ignoreRecord: true)
                        ->required(),
                    Select::make("school_category_id")
                        ->label("Тип школы")
                        // ->rules(["required|exists:school_categories,id"])
                        ->relationship(name: 'school_category', titleAttribute: 'name')
                        ->placeholder("Выберите тип школы")
                        ->required(),
                    TextInput::make("password")
                        ->password()
                        ->dehydrateStateUsing(fn($state) => Hash::make($state))
                        ->dehydrated(fn($state) => filled($state))
                        ->required(fn(string $context): bool => $context === 'create'),
                    TextInput::make("password_confirmation")
                        ->password()
                        ->label("Подтвердите пароль")
                        ->dehydrated(fn($state) => filled($state))
                        ->same("password")
                        ->required(fn(string $context): bool => $context === 'create'),
                ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->modifyQueryUsing(
                function ($query) {
                    $query->where("school_category_id", "!=", null);
                }
            )
            ->columns([
                TextColumn::make("name")
                    ->label("Наименование")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("username")
                    ->label("Username")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("email")
                    ->label("Email")
                    ->sortable()
                    ->searchable(),
                TextColumn::make("school_category.name")
                    ->label("Тип школы")
                    ->sortable(),
            ])
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
            'index' => Pages\ListAdmins::route('/'),
            'create' => Pages\CreateAdmin::route('/create'),
            'edit' => Pages\EditAdmin::route('/{record}/edit'),
        ];
    }
}
