<?php

namespace App\Filament\Resources\VehicleResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use App\Filament\Helpers\ImageHelper;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Repeater;
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

class HeroConfigRelationManager extends RelationManager
{
    protected static string $relationship = 'heroConfig';

    protected static ?string $title = 'Configuracion Hero';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Imagenes')->schema([
                ImageHelper::preview('background_image', 'Preview Fondo Desktop'),
                FileUpload::make('background_image')
                    ->label('Imagen Fondo Desktop - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('vehicles/heroes')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 1920x1080px'),
                ImageHelper::preview('background_image_mobile', 'Preview Fondo Mobile'),
                FileUpload::make('background_image_mobile')
                    ->label('Imagen Fondo Mobile - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('vehicles/heroes')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 768x1366px'),
                ImageHelper::preview('title_image', 'Preview Logo'),
                FileUpload::make('title_image')
                    ->label('Imagen Titulo/Logo - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('vehicles/heroes')
                    ->visibility('public')
                    ->image()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: PNG con fondo transparente'),
            ])->columns(3),

            Section::make('Textos')->schema([
                TextInput::make('title')
                    ->label('Titulo'),
                TextInput::make('subtitle')
                    ->label('Subtitulo'),
                ColorPicker::make('text_color')
                    ->label('Color Texto')
                    ->default('#ffffff'),
                ColorPicker::make('overlay_color')
                    ->label('Color Overlay'),
            ])->columns(2),

            Section::make('Specs Destacados')->schema([
                Repeater::make('selected_specs')
                    ->label('Especificaciones')
                    ->schema([
                        TextInput::make('key')
                            ->label('Clave')
                            ->required(),
                        TextInput::make('value')
                            ->label('Valor')
                            ->required(),
                        TextInput::make('unit')
                            ->label('Unidad'),
                    ])
                    ->columns(3)
                    ->defaultItems(4)
                    ->maxItems(6),
            ]),

            Toggle::make('is_active')
                ->label('Activo')
                ->default(true),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('background_image')->label('Fondo')
                    ->getStateUsing(fn ($record) => \App\Filament\Helpers\ImageHelper::resolveUrl($record?->background_image)),
                TextColumn::make('title')->label('Titulo'),
                TextColumn::make('subtitle')->label('Subtitulo'),
                IconColumn::make('is_active')->label('Activo')->boolean(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
