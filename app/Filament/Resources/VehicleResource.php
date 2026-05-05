<?php

namespace App\Filament\Resources;

use App\Filament\Helpers\ImageHelper;
use App\Filament\Resources\VehicleResource\Pages\CreateVehicle;
use App\Filament\Resources\VehicleResource\Pages\EditVehicle;
use App\Filament\Resources\VehicleResource\Pages\ListVehicles;
use App\Filament\Resources\VehicleResource\RelationManagers\FeatureCardsRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\FeaturesRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\HeroConfigRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\SectionsRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\SpecificationsRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\VersionsRelationManager;
use App\Models\Vehicle;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Builder;
use Filament\Forms\Components\Builder\Block;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-truck';

    protected static string|\UnitEnum|null $navigationGroup = 'Vehiculos';

    protected static ?string $navigationLabel = 'Vehiculos';

    protected static ?string $modelLabel = 'Vehiculo';

    protected static ?string $pluralModelLabel = 'Vehiculos';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Vehiculo')->tabs([

                Tab::make('Informacion basica')->schema([
                    TextInput::make('name')
                        ->label('Nombre')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug((string) $state)))
                        ->maxLength(255),
                    TextInput::make('slug')
                        ->label('Slug')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->maxLength(255),
                    Select::make('vehicle_category_id')
                        ->label('Categoria')
                        ->relationship('category', 'name')
                        ->required()
                        ->searchable()
                        ->preload(),
                    TextInput::make('price_before')
                        ->label('Precio desde')
                        ->placeholder('600000'),
                    TextInput::make('price_now')
                        ->label('Precio actual')
                        ->placeholder('550000'),
                    TextInput::make('badge_text')
                        ->label('Badge')
                        ->placeholder('NUEVO'),
                    Toggle::make('is_published')
                        ->label('Publicado')
                        ->default(false)
                        ->helperText('Solo los vehiculos publicados se muestran en el frontend.'),
                    Textarea::make('description')
                        ->label('Descripcion corta')
                        ->rows(2)
                        ->columnSpanFull(),
                ])->columns(2),

                Tab::make('Imagenes')->schema([
                    ImageHelper::preview('image', 'Preview Desktop'),
                    FileUpload::make('image')
                        ->label('Imagen principal (Desktop)')
                        ->disk('public')
                        ->directory('vehicles')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150')
                        ->helperText('Recomendado: 1200x800px'),
                    ImageHelper::preview('image_mobile', 'Preview Mobile'),
                    FileUpload::make('image_mobile')
                        ->label('Imagen principal (Mobile)')
                        ->disk('public')
                        ->directory('vehicles')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150')
                        ->helperText('Recomendado: 600x800px'),
                    FileUpload::make('gallery')
                        ->label('Galeria')
                        ->disk('public')
                        ->directory('vehicles/gallery')
                        ->visibility('public')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->imagePreviewHeight('150')
                        ->columnSpanFull()
                        ->helperText('Recomendado: 1200x800px. Arrastra para reordenar.'),
                ])->columns(2),

                Tab::make('Contenido de la pagina')->schema([
                    Builder::make('page_blocks')
                        ->label('Bloques de la pagina')
                        ->blocks([
                            Block::make('hero')
                                ->label('Hero')
                                ->icon('heroicon-o-photo')
                                ->schema([
                                    TextInput::make('title')->label('Titulo'),
                                    TextInput::make('subtitle')->label('Subtitulo'),
                                    Textarea::make('description')->label('Descripcion')->rows(3),
                                    FileUpload::make('background')
                                        ->label('Imagen de fondo')
                                        ->disk('public')
                                        ->directory('vehicles/blocks')
                                        ->visibility('public')
                                        ->image()
                                        ->imageEditor(),
                                    TextInput::make('cta_text')->label('Texto del boton'),
                                    TextInput::make('cta_link')->label('Link del boton'),
                                ]),

                            Block::make('gallery')
                                ->label('Galeria')
                                ->icon('heroicon-o-photo')
                                ->schema([
                                    TextInput::make('title')->label('Titulo'),
                                    FileUpload::make('images')
                                        ->label('Imagenes')
                                        ->disk('public')
                                        ->directory('vehicles/blocks/gallery')
                                        ->visibility('public')
                                        ->image()
                                        ->multiple()
                                        ->reorderable()
                                        ->columnSpanFull(),
                                ]),

                            Block::make('specs_table')
                                ->label('Tabla de especificaciones')
                                ->icon('heroicon-o-table-cells')
                                ->schema([
                                    TextInput::make('title')->label('Titulo'),
                                    Repeater::make('rows')
                                        ->label('Filas')
                                        ->schema([
                                            TextInput::make('label')->label('Etiqueta')->required(),
                                            TextInput::make('value')->label('Valor')->required(),
                                        ])
                                        ->columns(2)
                                        ->reorderable()
                                        ->collapsible(),
                                ]),

                            Block::make('quick_specs')
                                ->label('Specs destacadas')
                                ->icon('heroicon-o-bolt')
                                ->schema([
                                    Repeater::make('items')
                                        ->label('Items')
                                        ->schema([
                                            TextInput::make('label')->label('Etiqueta')->required(),
                                            TextInput::make('value')->label('Valor')->required(),
                                            TextInput::make('suffix')->label('Sufijo')->placeholder('Turbo, hp, Velocidades'),
                                        ])
                                        ->columns(3)
                                        ->reorderable()
                                        ->collapsible()
                                        ->defaultItems(4),
                                ]),

                            Block::make('anchor_nav')
                                ->label('Navegacion por anclas')
                                ->icon('heroicon-o-link')
                                ->schema([
                                    Repeater::make('links')
                                        ->label('Links')
                                        ->schema([
                                            TextInput::make('label')->label('Texto')->required(),
                                            TextInput::make('anchor')->label('Ancla')->placeholder('#versiones')->required(),
                                        ])
                                        ->columns(2)
                                        ->reorderable()
                                        ->collapsible(),
                                ]),

                            Block::make('three_reasons')
                                ->label('Tres razones')
                                ->icon('heroicon-o-trophy')
                                ->schema([
                                    TextInput::make('title')->label('Titulo')->default('El SUV ultra moderno'),
                                    Textarea::make('subtitle')->label('Subtitulo')->rows(2),
                                    Repeater::make('reasons')
                                        ->label('Razones')
                                        ->schema([
                                            TextInput::make('title')->label('Titulo')->required(),
                                            Textarea::make('subtitle')->label('Subtitulo')->rows(2),
                                            FileUpload::make('image')
                                                ->label('Imagen')
                                                ->disk('public')
                                                ->directory('vehicles/blocks/reasons')
                                                ->visibility('public')
                                                ->image()
                                                ->imageEditor(),
                                        ])
                                        ->columns(1)
                                        ->reorderable()
                                        ->collapsible()
                                        ->defaultItems(3),
                                ]),

                            Block::make('versions_pricing')
                                ->label('Versiones y precios')
                                ->icon('heroicon-o-currency-dollar')
                                ->schema([
                                    TextInput::make('title')->label('Titulo')->default('Versiones y precios'),
                                    Toggle::make('show_exterior_interior_tabs')
                                        ->label('Mostrar tabs Exterior / Interior')
                                        ->default(true),
                                    Placeholder::make('versions_help')
                                        ->label('')
                                        ->content('Las versiones se administran en el RelationManager "Versiones" debajo del formulario.'),
                                ]),

                            Block::make('quick_actions')
                                ->label('Acciones rapidas')
                                ->icon('heroicon-o-rectangle-stack')
                                ->schema([
                                    Repeater::make('actions')
                                        ->label('Acciones')
                                        ->schema([
                                            TextInput::make('label')->label('Etiqueta')->required(),
                                            Select::make('icon')
                                                ->label('Icono')
                                                ->options([
                                                    'whatsapp' => 'WhatsApp',
                                                    'phone' => 'Telefono',
                                                    'map' => 'Mapa',
                                                    'headset' => 'Headset (contacto)',
                                                    'mail' => 'Mail',
                                                    'drive' => 'Drive (test drive / cotizar)',
                                                ])
                                                ->required(),
                                            TextInput::make('link')->label('Link')->required(),
                                            Select::make('type')
                                                ->label('Tipo')
                                                ->options([
                                                    'external' => 'Externo (nueva pestana)',
                                                    'internal' => 'Interno',
                                                    'modal' => 'Modal',
                                                ])
                                                ->default('external'),
                                        ])
                                        ->columns(2)
                                        ->reorderable()
                                        ->collapsible()
                                        ->defaultItems(4),
                                ]),

                            Block::make('features')
                                ->label('Banner de caracteristicas (Geely Obtienes Mas)')
                                ->icon('heroicon-o-sparkles')
                                ->schema([
                                    TextInput::make('title')->label('Titulo')->default('Con Geely Obtienes Mas'),
                                    Textarea::make('description')->label('Descripcion')->rows(3),
                                    Repeater::make('highlights')
                                        ->label('Destacados')
                                        ->schema([
                                            TextInput::make('number')->label('Numero')->placeholder('5')->required(),
                                            TextInput::make('unit')->label('Unidad')->placeholder('ANOS'),
                                            TextInput::make('separator')->label('Separador')->placeholder('o, EN'),
                                            TextInput::make('description')->label('Descripcion')->placeholder('Garantia Extendida'),
                                        ])
                                        ->columns(2)
                                        ->reorderable()
                                        ->collapsible(),
                                ]),

                            Block::make('feature_carousel')
                                ->label('Carruseles de caracteristicas')
                                ->icon('heroicon-o-rectangle-group')
                                ->schema([
                                    Repeater::make('sections')
                                        ->label('Secciones')
                                        ->schema([
                                            TextInput::make('title')->label('Titulo de la seccion')->required(),
                                            Repeater::make('slides')
                                                ->label('Slides')
                                                ->schema([
                                                    TextInput::make('title')->label('Titulo')->required(),
                                                    Textarea::make('description')->label('Descripcion')->rows(2),
                                                    TextInput::make('label')->label('Etiqueta sobre la imagen'),
                                                    FileUpload::make('image')
                                                        ->label('Imagen')
                                                        ->disk('public')
                                                        ->directory('vehicles/blocks/carousel')
                                                        ->visibility('public')
                                                        ->image()
                                                        ->imageEditor(),
                                                ])
                                                ->columns(1)
                                                ->reorderable()
                                                ->collapsible(),
                                        ])
                                        ->columns(1)
                                        ->reorderable()
                                        ->collapsible(),
                                ]),

                            Block::make('cta')
                                ->label('Llamado a la accion (CTA)')
                                ->icon('heroicon-o-megaphone')
                                ->schema([
                                    TextInput::make('title')->label('Titulo'),
                                    Textarea::make('description')->label('Descripcion')->rows(2),
                                    TextInput::make('button_text')->label('Texto del boton'),
                                    TextInput::make('button_link')->label('Link del boton'),
                                ]),

                            Block::make('text_image')
                                ->label('Texto + Imagen')
                                ->icon('heroicon-o-document-text')
                                ->schema([
                                    TextInput::make('title')->label('Titulo'),
                                    RichEditor::make('content')
                                        ->label('Contenido')
                                        ->columnSpanFull(),
                                    FileUpload::make('image')
                                        ->label('Imagen')
                                        ->disk('public')
                                        ->directory('vehicles/blocks/text-image')
                                        ->visibility('public')
                                        ->image()
                                        ->imageEditor(),
                                    Select::make('image_position')
                                        ->label('Posicion de la imagen')
                                        ->options([
                                            'left' => 'Izquierda',
                                            'right' => 'Derecha',
                                        ])
                                        ->default('right'),
                                ]),

                            Block::make('video')
                                ->label('Video')
                                ->icon('heroicon-o-play')
                                ->schema([
                                    TextInput::make('title')->label('Titulo')->default('Videos y Resenas'),
                                    Textarea::make('subtitle')->label('Subtitulo')->rows(2),
                                    TextInput::make('youtube_url')
                                        ->label('URL de YouTube')
                                        ->url()
                                        ->placeholder('https://www.youtube.com/watch?v=...'),
                                ]),
                        ])
                        ->collapsible()
                        ->cloneable()
                        ->reorderable()
                        ->columnSpanFull()
                        ->addActionLabel('Agregar bloque'),
                ]),

                Tab::make('SEO')->schema([
                    TextInput::make('seo_title')
                        ->label('Titulo SEO')
                        ->maxLength(255)
                        ->helperText('Aparece en el title del navegador y resultados de busqueda.'),
                    Textarea::make('seo_description')
                        ->label('Descripcion SEO')
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Aparece como descripcion en resultados de busqueda (recomendado: 150-160 caracteres).'),
                ]),

            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Imagen')->square()
                    ->getStateUsing(fn ($record) => ImageHelper::resolveUrl($record?->image)),
                TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug'),
                TextColumn::make('category.name')->label('Categoria'),
                TextColumn::make('price_now')->label('Precio'),
                IconColumn::make('is_published')->label('Publicado')->boolean(),
                IconColumn::make('featured')->label('Destacado')->boolean(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
                TextColumn::make('order')->label('Orden')->sortable(),
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
            VersionsRelationManager::class,
            SpecificationsRelationManager::class,
            FeaturesRelationManager::class,
            FeatureCardsRelationManager::class,
            HeroConfigRelationManager::class,
            SectionsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListVehicles::route('/'),
            'create' => CreateVehicle::route('/create'),
            'edit' => EditVehicle::route('/{record}/edit'),
        ];
    }
}
