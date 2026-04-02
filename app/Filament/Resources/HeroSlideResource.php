<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Helpers\ImageHelper;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\HeroSlideResource\Pages\ListHeroSlides;
use App\Filament\Resources\HeroSlideResource\Pages\CreateHeroSlide;
use App\Filament\Resources\HeroSlideResource\Pages\EditHeroSlide;
use App\Filament\Resources\HeroSlideResource\Pages;
use App\Models\HeroSlide;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class HeroSlideResource extends Resource
{
    protected static ?string $model = HeroSlide::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-photo';

    protected static string | \UnitEnum | null $navigationGroup = 'Sitio Web';

    protected static ?string $navigationLabel = 'Hero Slides';

    protected static ?string $modelLabel = 'Hero Slide';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contenido')->schema([
                TextInput::make('title')
                    ->label('Titulo')
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->label('Subtitulo')
                    ->maxLength(255),
                Select::make('media_type')
                    ->label('Tipo de Media')
                    ->options(['image' => 'Imagen', 'video' => 'Video'])
                    ->default('image')
                    ->required(),
                ImageHelper::preview('media_src', 'Preview Desktop'),
                FileUpload::make('media_src')
                    ->label('Imagen/Video Desktop - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('hero-slides')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 1920x1080px'),
                ImageHelper::preview('media_src_mobile', 'Preview Mobile'),
                FileUpload::make('media_src_mobile')
                    ->label('Imagen/Video Mobile - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('hero-slides')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 768x1024px'),
            ])->columns(2),

            Section::make('Boton')->schema([
                TextInput::make('button_text')
                    ->label('Texto del Boton'),
                TextInput::make('button_action')
                    ->label('Accion (scroll-to, etc.)'),
                TextInput::make('button_url')
                    ->label('URL del Boton')
                    ->url(),
            ])->columns(3),

            Section::make('Estilos')->schema([
                ColorPicker::make('gradient_from')
                    ->label('Gradiente Desde'),
                ColorPicker::make('gradient_to')
                    ->label('Gradiente Hasta'),
                ColorPicker::make('text_color')
                    ->label('Color de Texto')
                    ->default('#ffffff'),
                TextInput::make('overlay_opacity')
                    ->label('Opacidad Overlay')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(1)
                    ->step(0.1)
                    ->default(0),
                TextInput::make('order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ])->columns(3),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('media_src')->label('Imagen')->square()
                    ->getStateUsing(fn ($record) => \App\Filament\Helpers\ImageHelper::resolveUrl($record?->media_src)),
                TextColumn::make('title')->label('Titulo')->searchable(),
                TextColumn::make('media_type')->label('Tipo')->badge(),
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
            'index' => ListHeroSlides::route('/'),
            'create' => CreateHeroSlide::route('/create'),
            'edit' => EditHeroSlide::route('/{record}/edit'),
        ];
    }
}
