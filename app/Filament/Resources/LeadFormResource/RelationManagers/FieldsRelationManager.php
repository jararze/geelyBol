<?php

namespace App\Filament\Resources\LeadFormResource\RelationManagers;

use App\Models\LeadFormField;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class FieldsRelationManager extends RelationManager
{
    protected static string $relationship = 'fields';

    protected static ?string $title = 'Campos del formulario';

    protected static ?string $modelLabel = 'Campo';

    protected static ?string $pluralModelLabel = 'Campos';

    public function form(Schema $schema): Schema
    {
        $optionTypes = ['select', 'multi_select', 'radio', 'checkbox_group'];
        $inputTypes = ['text', 'email', 'tel', 'number', 'url', 'textarea'];

        return $schema->components([
            Select::make('type')
                ->label('Tipo de campo')
                ->required()
                ->live()
                ->options([
                    'text' => 'Texto',
                    'email' => 'Email',
                    'tel' => 'Telefono',
                    'number' => 'Numero',
                    'url' => 'URL',
                    'textarea' => 'Texto largo',
                    'select' => 'Select (uno)',
                    'multi_select' => 'Select (multiple)',
                    'radio' => 'Radio buttons',
                    'checkbox_group' => 'Checkbox group',
                    'checkbox' => 'Checkbox unico',
                    'date' => 'Fecha',
                    'datetime' => 'Fecha y hora',
                    'file' => 'Archivo',
                    'hidden' => 'Oculto',
                    'heading' => 'Encabezado (presentacional)',
                    'paragraph' => 'Parrafo (presentacional)',
                    'divider' => 'Divisor (presentacional)',
                ]),
            TextInput::make('name')
                ->label('Nombre interno (slug)')
                ->required()
                ->helperText('Identificador unico. Solo letras minusculas, numeros, guiones bajos.')
                ->live(onBlur: true)
                ->afterStateUpdated(fn ($state, callable $set) => $set('name', Str::slug((string) $state, '_'))),
            TextInput::make('label')
                ->label('Etiqueta visible')
                ->required(),
            TextInput::make('placeholder')
                ->label('Placeholder')
                ->visible(fn (callable $get) => in_array($get('type'), $inputTypes, true)),
            Textarea::make('help_text')
                ->label('Texto de ayuda')
                ->rows(2)
                ->columnSpanFull(),
            Toggle::make('is_required')
                ->label('Obligatorio')
                ->default(false)
                ->visible(fn (callable $get) => ! in_array($get('type'), ['heading', 'paragraph', 'divider', 'hidden'], true)),
            Select::make('width')
                ->label('Ancho en el formulario')
                ->options(['full' => 'Ancho completo', 'half' => 'Mitad', 'third' => 'Tercio'])
                ->default('full')
                ->required(),
            TextInput::make('section')
                ->label('Seccion (agrupa campos)')
                ->helperText('Campos con la misma seccion se renderizan juntos bajo un titulo.'),
            TextInput::make('default_value')
                ->label('Valor por defecto')
                ->visible(fn (callable $get) => ! in_array($get('type'), ['heading', 'paragraph', 'divider', 'file'], true)),
            Repeater::make('options')
                ->label('Opciones (label/value)')
                ->schema([
                    TextInput::make('label')->label('Etiqueta')->required(),
                    TextInput::make('value')->label('Valor')->required(),
                ])
                ->columns(2)
                ->visible(fn (callable $get) => in_array($get('type'), $optionTypes, true))
                ->columnSpanFull()
                ->defaultItems(0),
            TagsInput::make('validation_rules')
                ->label('Reglas extra de validacion')
                ->helperText('Reglas estilo Laravel: min:3, max:100, etc.')
                ->placeholder('min:3'),
            Fieldset::make('Logica condicional')
                ->schema([
                    TextInput::make('conditional_logic.field')->label('Mostrar si el campo'),
                    Select::make('conditional_logic.operator')
                        ->label('Operador')
                        ->options([
                            '=' => 'es igual a',
                            '!=' => 'no es igual a',
                            'in' => 'esta en (lista)',
                            'contains' => 'contiene',
                            'filled' => 'tiene valor',
                            'empty' => 'esta vacio',
                        ]),
                    TextInput::make('conditional_logic.value')->label('Valor esperado'),
                ])
                ->columns(3)
                ->columnSpanFull(),
            TextInput::make('order')->label('Orden')->numeric()->default(0),
        ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('label')
            ->reorderable('order')
            ->defaultSort('order')
            ->columns([
                TextColumn::make('order')->label('#')->sortable(),
                TextColumn::make('type')->label('Tipo')->badge(),
                TextColumn::make('name')->label('Nombre interno')->searchable(),
                TextColumn::make('label')->label('Etiqueta')->limit(40),
                TextColumn::make('section')->label('Seccion')->badge()->color('gray'),
                IconColumn::make('is_required')->label('Req')->boolean(),
                TextColumn::make('width')->label('Ancho')->badge()->color('gray'),
            ])
            ->headerActions([
                CreateAction::make()
                    ->mutateDataUsing(function (array $data) {
                        $data['order'] ??= ($this->getOwnerRecord()->fields()->max('order') ?? 0) + 1;
                        return $data;
                    }),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ]);
    }
}
