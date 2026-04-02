<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\MenuItemResource\Pages\ListMenuItems;
use App\Filament\Resources\MenuItemResource\Pages\CreateMenuItem;
use App\Filament\Resources\MenuItemResource\Pages\EditMenuItem;
use App\Filament\Resources\MenuItemResource\Pages;
use App\Models\MenuItem;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class MenuItemResource extends Resource
{
    protected static ?string $model = MenuItem::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-bars-3';

    protected static string | \UnitEnum | null $navigationGroup = 'Configuracion';

    protected static ?string $navigationLabel = 'Menu';

    protected static ?string $modelLabel = 'Item de Menu';

    protected static ?string $pluralModelLabel = 'Items de Menu';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Menu Item')->schema([
                TextInput::make('label')
                    ->label('Etiqueta')
                    ->required()
                    ->maxLength(255),
                TextInput::make('url')
                    ->label('URL'),
                TextInput::make('route_name')
                    ->label('Nombre de Ruta'),
                Select::make('parent_id')
                    ->label('Padre')
                    ->relationship('parent', 'label')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Select::make('location')
                    ->label('Ubicacion')
                    ->options([
                        'header' => 'Header',
                        'footer' => 'Footer',
                        'mobile' => 'Mobile',
                    ])
                    ->default('header')
                    ->required(),
                Select::make('target')
                    ->label('Target')
                    ->options([
                        '_self' => 'Misma ventana',
                        '_blank' => 'Nueva ventana',
                    ])
                    ->default('_self'),
                TextInput::make('icon')
                    ->label('Icono'),
                TextInput::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')->label('Etiqueta')->searchable(),
                TextColumn::make('parent.label')->label('Padre'),
                TextColumn::make('url')->label('URL')->limit(30),
                TextColumn::make('location')->label('Ubicacion')->badge(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
                TextColumn::make('order')->label('Orden')->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMenuItems::route('/'),
            'create' => CreateMenuItem::route('/create'),
            'edit' => EditMenuItem::route('/{record}/edit'),
        ];
    }
}
