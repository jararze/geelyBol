<?php

namespace App\Filament\Resources\VehicleResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class SectionsRelationManager extends RelationManager
{
    protected static string $relationship = 'sections';

    protected static ?string $title = 'Secciones';

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('section_type')
                ->label('Tipo de Seccion')
                ->options([
                    'feature_slider' => 'Slider de Caracteristicas',
                    'test_drive' => 'Test Drive',
                    'gallery' => 'Galeria',
                    'video_review' => 'Video Review',
                    'section_breaker' => 'Separador de Seccion',
                    'sub_navigation' => 'Sub Navegacion',
                ])
                ->required(),
            TextInput::make('title')
                ->label('Titulo'),
            TextInput::make('subtitle')
                ->label('Subtitulo'),
            Textarea::make('description')
                ->label('Descripcion')
                ->rows(3)
                ->columnSpanFull(),
            KeyValue::make('config')
                ->label('Configuracion Extra')
                ->columnSpanFull(),
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
                TextColumn::make('section_type')
                    ->label('Tipo')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'feature_slider' => 'primary',
                        'test_drive' => 'success',
                        'gallery' => 'warning',
                        'video_review' => 'danger',
                        'section_breaker' => 'gray',
                        'sub_navigation' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('title')->label('Titulo'),
                TextColumn::make('items_count')->label('Items')->counts('items'),
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
