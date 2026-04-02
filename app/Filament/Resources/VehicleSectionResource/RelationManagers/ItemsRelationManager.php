<?php

namespace App\Filament\Resources\VehicleSectionResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $title = 'Items de Seccion';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contenido')->schema([
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

            Section::make('Media')->schema([
                FileUpload::make('main_image')
                    ->label('Imagen Principal')
                    ->disk('public')
                    ->directory('vehicle-sections')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 1200x800px'),
                FileUpload::make('thumbnail_image')
                    ->label('Miniatura')
                    ->disk('public')
                    ->directory('vehicle-sections')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 400x300px'),
                TextInput::make('video_url')
                    ->label('URL de Video')
                    ->url(),
                TextInput::make('alt_text')
                    ->label('Texto Alt'),
            ])->columns(2),

            Section::make('Video Info')->schema([
                TextInput::make('duration')
                    ->label('Duracion'),
                TextInput::make('views')
                    ->label('Vistas'),
                TextInput::make('channel')
                    ->label('Canal'),
            ])->columns(3),

            Section::make('Estilo y Posicion')->schema([
                TextInput::make('background_overlay')
                    ->label('Background Overlay'),
                TextInput::make('text_color')
                    ->label('Color de Texto'),
                TextInput::make('column_position')
                    ->label('Posicion Columna'),
                TextInput::make('row_span')
                    ->label('Row Span')
                    ->numeric(),
                Toggle::make('overlay')
                    ->label('Overlay')
                    ->default(false),
            ])->columns(2),

            Section::make('Configuracion')->schema([
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

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('main_image')->label('Imagen')->circular()
                    ->getStateUsing(fn ($record) => \App\Filament\Helpers\ImageHelper::resolveUrl($record?->main_image)),
                TextColumn::make('title')->label('Titulo')->searchable(),
                TextColumn::make('subtitle')->label('Subtitulo')->limit(30),
                TextColumn::make('order')->label('Orden')->sortable(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
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
