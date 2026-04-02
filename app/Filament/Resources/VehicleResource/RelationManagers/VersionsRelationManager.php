<?php

namespace App\Filament\Resources\VehicleResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class VersionsRelationManager extends RelationManager
{
    protected static string $relationship = 'versions';

    protected static ?string $title = 'Versiones';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Version')->tabs([
                Tab::make('General')->schema([
                    TextInput::make('name')->label('Nombre')->required(),
                    TextInput::make('code')->label('Codigo'),
                    TextInput::make('year')->label('Ano'),
                    TextInput::make('list_price')->label('Precio Lista')->numeric(),
                    TextInput::make('discount')->label('Descuento')->numeric(),
                    TextInput::make('final_price')->label('Precio Final')->numeric(),
                    TextInput::make('currency')->label('Moneda')->default('$us.'),
                    TextInput::make('order')->label('Orden')->numeric()->default(0),
                    Toggle::make('is_active')->label('Activo')->default(true),
                ])->columns(3),

                Tab::make('Motor')->schema([
                    TextInput::make('motor_type')->label('Tipo Motor'),
                    TextInput::make('engine_displacement')->label('Cilindrada'),
                    TextInput::make('horsepower')->label('Potencia (hp)'),
                    TextInput::make('torque')->label('Torque'),
                    TextInput::make('fuel_type')->label('Combustible'),
                    TextInput::make('transmission')->label('Transmision'),
                    TextInput::make('drivetrain')->label('Traccion'),
                    TextInput::make('platform')->label('Plataforma'),
                    TextInput::make('city_consumption')->label('Consumo Ciudad'),
                    TextInput::make('highway_consumption')->label('Consumo Carretera'),
                    TextInput::make('emission_standard')->label('Norma Emision'),
                    TextInput::make('traccion')->label('Traccion Detalle'),
                ])->columns(3),

                Tab::make('Equipamiento')->schema([
                    TextInput::make('screen')->label('Pantalla'),
                    TextInput::make('screen_detail')->label('Detalle Pantalla'),
                    TextInput::make('seats')->label('Asientos'),
                    TextInput::make('climate_control')->label('Clima'),
                    TextInput::make('camera')->label('Camara'),
                    TextInput::make('sensors')->label('Sensores'),
                    TextInput::make('connectivity')->label('Conectividad'),
                ])->columns(2),

                Tab::make('Seguridad')->schema([
                    TextInput::make('airbags')->label('Airbags'),
                    TextInput::make('abs')->label('ABS'),
                    TextInput::make('stability_control')->label('Control Estabilidad'),
                    TextInput::make('brake_assist')->label('Asistencia Frenos'),
                    TextInput::make('traction_control')->label('Control Traccion'),
                    TextInput::make('seatbelts')->label('Cinturones'),
                ])->columns(2),

                Tab::make('Imagen')->schema([
                    FileUpload::make('interior_image')
                        ->label('Imagen Interior')
                        ->disk('public')
                        ->directory('vehicles/interiors')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150')
                        ->helperText('Recomendado: 1200x800px'),
                ]),
            ])->columnSpanFull(),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Nombre'),
                TextColumn::make('code')->label('Codigo'),
                TextColumn::make('final_price')->label('Precio Final'),
                TextColumn::make('horsepower')->label('HP'),
                TextColumn::make('transmission')->label('Transmision'),
                TextColumn::make('colors_count')->label('Colores')->counts('colors'),
                IconColumn::make('is_active')->label('Activo')->boolean(),
            ])
            ->defaultSort('order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
