<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use App\Filament\Helpers\ImageHelper;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\PromotionResource\Pages\ListPromotions;
use App\Filament\Resources\PromotionResource\Pages\CreatePromotion;
use App\Filament\Resources\PromotionResource\Pages\EditPromotion;
use App\Filament\Resources\PromotionResource\Pages;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-megaphone';

    protected static string | \UnitEnum | null $navigationGroup = 'Sitio Web';

    protected static ?string $navigationLabel = 'Promociones';

    protected static ?string $modelLabel = 'Promocion';

    protected static ?string $pluralModelLabel = 'Promociones';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Promocion')->schema([
                Select::make('vehicle_id')
                    ->label('Vehiculo')
                    ->relationship('vehicle', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                TextInput::make('title')
                    ->label('Titulo')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripcion')
                    ->rows(3),
                TextInput::make('discount_amount')
                    ->label('Monto Descuento')
                    ->numeric()
                    ->prefix('$us.'),
                TextInput::make('discount_currency')
                    ->label('Moneda')
                    ->default('$us.'),
                ImageHelper::preview('image', 'Preview Desktop'),
                FileUpload::make('image')
                    ->label('Imagen Desktop - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('promotions')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 800x600px'),
                ImageHelper::preview('image_mobile', 'Preview Mobile'),
                FileUpload::make('image_mobile')
                    ->label('Imagen Mobile - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('promotions')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 400x500px'),
            ])->columns(2),

            Section::make('Boton y Vigencia')->schema([
                TextInput::make('button_text')
                    ->label('Texto Boton'),
                TextInput::make('button_url')
                    ->label('URL Boton'),
                DatePicker::make('start_date')
                    ->label('Fecha Inicio'),
                DatePicker::make('end_date')
                    ->label('Fecha Fin'),
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
                TextColumn::make('title')->label('Titulo')->searchable(),
                TextColumn::make('vehicle.name')->label('Vehiculo'),
                TextColumn::make('discount_amount')
                    ->label('Descuento')
                    ->money('USD'),
                TextColumn::make('end_date')->label('Vence')->date(),
                IconColumn::make('is_active')->label('Activo')->boolean(),
            ])
            ->defaultSort('order')
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
            'index' => ListPromotions::route('/'),
            'create' => CreatePromotion::route('/create'),
            'edit' => EditPromotion::route('/{record}/edit'),
        ];
    }
}
