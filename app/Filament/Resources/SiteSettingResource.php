<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\SiteSettingResource\Pages\ListSiteSettings;
use App\Filament\Resources\SiteSettingResource\Pages\CreateSiteSetting;
use App\Filament\Resources\SiteSettingResource\Pages\EditSiteSetting;
use App\Filament\Resources\SiteSettingResource\Pages;
use App\Models\SiteSetting;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiteSettingResource extends Resource
{
    protected static ?string $model = SiteSetting::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string | \UnitEnum | null $navigationGroup = 'Configuracion';

    protected static ?string $navigationLabel = 'Ajustes del Sitio';

    protected static ?string $modelLabel = 'Ajuste';

    protected static ?string $pluralModelLabel = 'Ajustes del Sitio';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Select::make('group')
                ->label('Grupo')
                ->options([
                    'general' => 'General',
                    'contact' => 'Contacto',
                    'social' => 'Redes Sociales',
                    'tracking' => 'Tracking/Analytics',
                    'benefits' => 'Beneficios',
                ])
                ->required(),
            TextInput::make('key')
                ->label('Clave')
                ->required(),
            Textarea::make('value')
                ->label('Valor')
                ->rows(3),
            Select::make('type')
                ->label('Tipo')
                ->options([
                    'text' => 'Texto',
                    'image' => 'Imagen',
                    'json' => 'JSON',
                    'boolean' => 'Boolean',
                    'url' => 'URL',
                ])
                ->default('text'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('group')->label('Grupo')->badge()->sortable(),
                TextColumn::make('key')->label('Clave')->searchable(),
                TextColumn::make('value')->label('Valor')->limit(50),
                TextColumn::make('type')->label('Tipo'),
            ])
            ->defaultSort('group')
            ->filters([
                SelectFilter::make('group')
                    ->label('Grupo')
                    ->options([
                        'general' => 'General',
                        'contact' => 'Contacto',
                        'social' => 'Redes Sociales',
                        'tracking' => 'Tracking/Analytics',
                        'benefits' => 'Beneficios',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
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
            'index' => ListSiteSettings::route('/'),
            'create' => CreateSiteSetting::route('/create'),
            'edit' => EditSiteSetting::route('/{record}/edit'),
        ];
    }
}
