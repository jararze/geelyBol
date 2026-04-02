<?php

namespace App\Filament\Resources;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Actions\ViewAction;
use App\Filament\Resources\FormSubmissionResource\Pages\ListFormSubmissions;
use App\Filament\Resources\FormSubmissionResource\Pages\ViewFormSubmission;
use App\Filament\Resources\FormSubmissionResource\Pages;
use App\Models\FormSubmission;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FormSubmissionResource extends Resource
{
    protected static ?string $model = FormSubmission::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-inbox';

    protected static string | \UnitEnum | null $navigationGroup = 'Formularios';

    protected static ?string $navigationLabel = 'Solicitudes';

    protected static ?string $modelLabel = 'Solicitud';

    protected static ?string $pluralModelLabel = 'Solicitudes';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Datos del Contacto')->schema([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email')
                    ->disabled(),
                TextInput::make('telefono')
                    ->label('Telefono')
                    ->disabled(),
                TextInput::make('codigo_pais')
                    ->label('Codigo Pais')
                    ->disabled(),
                TextInput::make('ciudad')
                    ->label('Ciudad')
                    ->disabled(),
                TextInput::make('tipo_formulario')
                    ->label('Tipo')
                    ->disabled(),
                TextInput::make('vehiculo')
                    ->label('Vehiculo')
                    ->disabled(),
                Textarea::make('mensaje')
                    ->label('Mensaje')
                    ->disabled()
                    ->columnSpanFull(),
            ])->columns(2),

            Section::make('CRM')->schema([
                TextInput::make('status')
                    ->label('Estado'),
                TextInput::make('agent_assigned')
                    ->label('Agente Asignado'),
                TextInput::make('tecnom_id')
                    ->label('Tecnom ID')
                    ->disabled(),
                Textarea::make('tecnom_response')
                    ->label('Respuesta Tecnom')
                    ->disabled(),
            ])->columns(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')->label('Nombre')->searchable(),
                TextColumn::make('email')->label('Email')->searchable(),
                TextColumn::make('telefono')->label('Telefono'),
                TextColumn::make('tipo_formulario')->label('Tipo')->badge(),
                TextColumn::make('vehiculo')->label('Vehiculo'),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'sent' => 'success',
                        'error' => 'danger',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                SelectFilter::make('tipo_formulario')
                    ->label('Tipo')
                    ->options([
                        'test-drive' => 'Test Drive',
                        'cotizacion' => 'Cotizacion',
                        'consulta' => 'Consulta',
                    ]),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'pending' => 'Pendiente',
                        'sent' => 'Enviado',
                        'error' => 'Error',
                    ]),
            ])
            ->recordActions([
                ViewAction::make(),
            ])
            ->toolbarActions([]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListFormSubmissions::route('/'),
            'view' => ViewFormSubmission::route('/{record}'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }
}
