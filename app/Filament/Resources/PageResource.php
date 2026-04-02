<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use App\Filament\Helpers\ImageHelper;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Resources\PageResource\Pages\ListPages;
use App\Filament\Resources\PageResource\Pages\CreatePage;
use App\Filament\Resources\PageResource\Pages\EditPage;
use App\Filament\Resources\PageResource\Pages;
use App\Models\Page;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-text';

    protected static string | \UnitEnum | null $navigationGroup = 'Sitio Web';

    protected static ?string $navigationLabel = 'Paginas';

    protected static ?string $modelLabel = 'Pagina';

    protected static ?string $pluralModelLabel = 'Paginas';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Contenido')->schema([
                TextInput::make('slug')
                    ->label('Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                TextInput::make('title')
                    ->label('Titulo')
                    ->required()
                    ->maxLength(255),
                TextInput::make('subtitle')
                    ->label('Subtitulo')
                    ->maxLength(255),
                RichEditor::make('content')
                    ->label('Contenido')
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('Imagenes')->schema([
                ImageHelper::preview('image', 'Preview Desktop'),
                FileUpload::make('image')
                    ->label('Imagen Desktop - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('pages')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 1200x800px'),
                ImageHelper::preview('image_mobile', 'Preview Mobile'),
                FileUpload::make('image_mobile')
                    ->label('Imagen Mobile - Subir nueva para reemplazar')
                    ->disk('public')
                    ->directory('pages')
                    ->visibility('public')
                    ->image()
                    ->imageEditor()
                    ->imagePreviewHeight('150')
                    ->helperText('Recomendado: 768x1024px'),
            ])->columns(2),

            Section::make('Boton y SEO')->schema([
                TextInput::make('button_text')
                    ->label('Texto Boton'),
                TextInput::make('button_url')
                    ->label('URL Boton'),
                TextInput::make('meta_title')
                    ->label('Meta Titulo'),
                TextInput::make('meta_description')
                    ->label('Meta Descripcion'),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->default(true),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Titulo')->searchable(),
                TextColumn::make('slug')->label('Slug'),
                IconColumn::make('is_active')->label('Activo')->boolean(),
                TextColumn::make('updated_at')->label('Actualizado')->dateTime('d/m/Y H:i'),
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
            'index' => ListPages::route('/'),
            'create' => CreatePage::route('/create'),
            'edit' => EditPage::route('/{record}/edit'),
        ];
    }
}
