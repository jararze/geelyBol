<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\KeyValue;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\VehicleSectionResource\Pages\ListVehicleSections;
use App\Filament\Resources\VehicleSectionResource\Pages\CreateVehicleSection;
use App\Filament\Resources\VehicleSectionResource\Pages\EditVehicleSection;
use App\Filament\Resources\VehicleSectionResource\RelationManagers\ItemsRelationManager;
use App\Models\VehicleSection;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleSectionResource extends Resource
{
    protected static ?string $model = VehicleSection::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-squares-2x2';

    protected static string | \UnitEnum | null $navigationGroup = 'Vehiculos';

    protected static ?string $navigationLabel = 'Secciones de Vehiculo';

    protected static ?string $modelLabel = 'Seccion de Vehiculo';

    protected static ?string $pluralModelLabel = 'Secciones de Vehiculo';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Informacion General')->schema([
                Select::make('vehicle_id')
                    ->label('Vehiculo')
                    ->relationship('vehicle', 'name')
                    ->required()
                    ->searchable()
                    ->preload(),
                Select::make('section_type')
                    ->label('Tipo de Seccion')
                    ->options([
                        'feature_slider' => 'Feature Slider',
                        'test_drive' => 'Test Drive',
                        'gallery' => 'Galeria',
                        'video_review' => 'Video Review',
                        'section_breaker' => 'Section Breaker',
                        'sub_navigation' => 'Sub Navigation',
                    ])
                    ->required(),
                TextInput::make('title')
                    ->label('Titulo')
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->label('Subtitulo')
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripcion')
                    ->rows(3)
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Configuracion')->schema([
                KeyValue::make('config')
                    ->label('Configuracion (JSON)')
                    ->columnSpanFull(),
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
                TextColumn::make('vehicle.name')->label('Vehiculo')->searchable(),
                TextColumn::make('section_type')->label('Tipo')->badge(),
                TextColumn::make('title')->label('Titulo')->searchable(),
                TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items'),
                TextColumn::make('order')->label('Orden')->sortable(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVehicleSections::route('/'),
            'create' => CreateVehicleSection::route('/create'),
            'edit' => EditVehicleSection::route('/{record}/edit'),
        ];
    }
}
