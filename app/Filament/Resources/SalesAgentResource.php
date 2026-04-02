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
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\SalesAgentResource\Pages\ListSalesAgents;
use App\Filament\Resources\SalesAgentResource\Pages\CreateSalesAgent;
use App\Filament\Resources\SalesAgentResource\Pages\EditSalesAgent;
use App\Models\SalesAgent;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SalesAgentResource extends Resource
{
    protected static ?string $model = SalesAgent::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-user-group';

    protected static string | \UnitEnum | null $navigationGroup = 'Configuracion';

    protected static ?string $navigationLabel = 'Agentes de Venta';

    protected static ?string $modelLabel = 'Agente de Venta';

    protected static ?string $pluralModelLabel = 'Agentes de Venta';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informacion del Agente')->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('Telefono')
                    ->tel(),
                Select::make('branch_id')
                    ->label('Sucursal')
                    ->relationship('branch', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Forms\Components\TagsInput::make('served_cities')
                    ->label('Ciudades que atiende')
                    ->placeholder('Agregar ciudad (slug)')
                    ->helperText('Slugs de ciudades: santa-cruz, la-paz, el-alto, cochabamba, oruro, sucre, tarija, trinidad, potosi'),
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
                TextColumn::make('name')->label('Nombre')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('branch.name')->label('Sucursal')->searchable(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
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
            'index' => ListSalesAgents::route('/'),
            'create' => CreateSalesAgent::route('/create'),
            'edit' => EditSalesAgent::route('/{record}/edit'),
        ];
    }
}
