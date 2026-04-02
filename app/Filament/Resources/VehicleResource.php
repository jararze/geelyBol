<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use App\Filament\Helpers\ImageHelper;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\VehicleResource\RelationManagers\VersionsRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\SpecificationsRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\FeaturesRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\FeatureCardsRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\HeroConfigRelationManager;
use App\Filament\Resources\VehicleResource\RelationManagers\SectionsRelationManager;
use App\Filament\Resources\VehicleResource\Pages\ListVehicles;
use App\Filament\Resources\VehicleResource\Pages\CreateVehicle;
use App\Filament\Resources\VehicleResource\Pages\EditVehicle;
use App\Filament\Resources\VehicleResource\Pages;
use App\Filament\Resources\VehicleResource\RelationManagers;
use App\Models\Vehicle;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-truck';

    protected static string | \UnitEnum | null $navigationGroup = 'Vehiculos';

    protected static ?string $navigationLabel = 'Vehiculos';

    protected static ?string $modelLabel = 'Vehiculo';

    protected static ?string $pluralModelLabel = 'Vehiculos';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Tabs::make('Vehiculo')->tabs([

                Tab::make('General')->schema([
                    TextInput::make('name')
                        ->label('Nombre')
                        ->required()
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
                    Textarea::make('description')
                        ->label('Descripcion Corta')
                        ->rows(2),
                    RichEditor::make('long_description')
                        ->label('Descripcion Larga')
                        ->columnSpanFull(),
                    ImageHelper::preview('image', 'Preview Desktop'),
                    FileUpload::make('image')
                        ->label('Imagen Principal (Desktop) - Subir nueva para reemplazar')
                        ->disk('public')
                        ->directory('vehicles')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150')
                        ->helperText('Recomendado: 800x600px, fondo transparente PNG'),
                    ImageHelper::preview('image_mobile', 'Preview Mobile'),
                    FileUpload::make('image_mobile')
                        ->label('Imagen Principal (Mobile) - Subir nueva para reemplazar')
                        ->disk('public')
                        ->directory('vehicles')
                        ->visibility('public')
                        ->image()
                        ->imageEditor()
                        ->imagePreviewHeight('150')
                        ->helperText('Recomendado: 400x600px, fondo transparente PNG'),
                    FileUpload::make('gallery')
                        ->label('Galeria')
                        ->disk('public')
                        ->directory('vehicles/gallery')
                        ->visibility('public')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->imagePreviewHeight('150')
                        ->helperText('Recomendado: 1200x800px'),
                    TextInput::make('order')
                        ->label('Orden')
                        ->numeric()
                        ->default(0),
                    Toggle::make('featured')
                        ->label('Destacado'),
                    Toggle::make('is_active')
                        ->label('Activo')
                        ->default(true),
                ])->columns(2),

                Tab::make('Precios')->schema([
                    TextInput::make('currency_before')
                        ->label('Moneda Antes')
                        ->placeholder('$us.'),
                    TextInput::make('price_before')
                        ->label('Precio Antes'),
                    ColorPicker::make('price_before_color')
                        ->label('Color Precio Antes'),
                    TextInput::make('price_before_decoration')
                        ->label('Decoracion Precio Antes')
                        ->placeholder('line-through'),
                    TextInput::make('currency_now')
                        ->label('Moneda Actual')
                        ->placeholder('$us.'),
                    TextInput::make('price_now')
                        ->label('Precio Actual'),
                    ColorPicker::make('price_now_color')
                        ->label('Color Precio Actual'),
                    TextInput::make('price_now_size')
                        ->label('Tamano Precio'),
                    TextInput::make('price_now_weight')
                        ->label('Peso Fuente Precio'),
                    TextInput::make('discount_label')
                        ->label('Etiqueta Descuento'),
                    ColorPicker::make('discount_label_color')
                        ->label('Color Etiqueta Descuento'),
                    Toggle::make('show_from_label')
                        ->label('Mostrar "Desde"'),
                    TextInput::make('from_label')
                        ->label('Texto "Desde"'),
                ])->columns(2),

                Tab::make('Estilo Boton')->schema([
                    ColorPicker::make('button_bg_color')
                        ->label('Color Fondo Boton'),
                    ColorPicker::make('button_text_color')
                        ->label('Color Texto Boton'),
                    ColorPicker::make('button_hover_bg')
                        ->label('Color Hover Boton'),
                ])->columns(3),

                Tab::make('Badge')->schema([
                    Toggle::make('show_badge')
                        ->label('Mostrar Badge'),
                    TextInput::make('badge_text')
                        ->label('Texto Badge'),
                    ColorPicker::make('badge_color')
                        ->label('Color Badge'),
                    Select::make('badge_position')
                        ->label('Posicion Badge')
                        ->options([
                            'top-left' => 'Arriba Izquierda',
                            'top-right' => 'Arriba Derecha',
                            'bottom-left' => 'Abajo Izquierda',
                            'bottom-right' => 'Abajo Derecha',
                        ]),
                ])->columns(2),

                Tab::make('Catalogo PDF')->schema([
                    FileUpload::make('catalog_pdf_path')
                        ->label('Archivo PDF')
                        ->disk('public')
                        ->directory('catalogs')
                        ->visibility('public')
                        ->acceptedFileTypes(['application/pdf'])
                        ->helperText('Archivo PDF del catalogo del vehiculo'),
                    TextInput::make('catalog_file_name')
                        ->label('Nombre del Archivo'),
                ]),

            ])->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')->label('Imagen')->square()
                    ->getStateUsing(fn ($record) => \App\Filament\Helpers\ImageHelper::resolveUrl($record?->image)),
                TextColumn::make('name')->label('Nombre')->searchable()->sortable(),
                TextColumn::make('slug')->label('Slug'),
                TextColumn::make('category.name')->label('Categoria'),
                TextColumn::make('price_now')->label('Precio'),
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
