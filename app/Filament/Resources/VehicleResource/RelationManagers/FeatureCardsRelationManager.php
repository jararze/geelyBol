<?php

namespace App\Filament\Resources\VehicleResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class FeatureCardsRelationManager extends RelationManager
{
    protected static string $relationship = 'featureCards';

    protected static ?string $title = 'Tarjetas de Caracteristicas';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('title')
                ->label('Titulo')
                ->maxLength(255),
            TextInput::make('subtitle')
                ->label('Subtitulo')
                ->maxLength(255),
            FileUpload::make('image')
                ->label('Imagen')
                ->disk('public')
                ->directory('vehicles/feature-cards')
                ->visibility('public')
                ->image()
                ->imageEditor()
                ->imagePreviewHeight('150')
                ->helperText('Recomendado: 800x600px'),
            Select::make('text_position')
                ->label('Posicion Texto')
                ->options([
                    'top-left' => 'Arriba Izquierda',
                    'top-right' => 'Arriba Derecha',
                    'bottom-left' => 'Abajo Izquierda',
                    'bottom-right' => 'Abajo Derecha',
                    'center' => 'Centro',
                ]),
            ColorPicker::make('text_color')
                ->label('Color Texto'),
            Toggle::make('overlay')
                ->label('Overlay'),
            Toggle::make('hover_effect')
                ->label('Efecto Hover'),
            TextInput::make('order')
                ->label('Orden')
                ->numeric()
                ->default(0),
            Toggle::make('is_active')
                ->label('Activo')
                ->default(true),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Imagen')->square()
                    ->getStateUsing(fn ($record) => \App\Filament\Helpers\ImageHelper::resolveUrl($record?->image)),
                TextColumn::make('title')->label('Titulo'),
                TextColumn::make('subtitle')->label('Subtitulo'),
                IconColumn::make('is_active')->label('Activo')->boolean(),
                TextColumn::make('order')->label('Orden')->sortable(),
            ])
            ->defaultSort('order')
            ->reorderable('order')
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
