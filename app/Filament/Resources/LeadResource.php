<?php

namespace App\Filament\Resources;

use App\Exports\LeadsExport;
use App\Filament\Resources\LeadResource\Pages\ListLeads;
use App\Filament\Resources\LeadResource\Pages\ViewLead;
use App\Models\Lead;
use App\Models\LeadForm;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Resource;
use Filament\Forms\Components\Placeholder;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class LeadResource extends Resource
{
    protected static ?string $model = Lead::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-inbox-stack';

    protected static string|\UnitEnum|null $navigationGroup = 'Lead Builder';

    protected static ?string $navigationLabel = 'Leads recibidos';

    protected static ?string $modelLabel = 'Lead';

    protected static ?string $pluralModelLabel = 'Leads';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $count = Lead::query()->where('status', Lead::STATUS_NEW)->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Detalle del lead')
                ->columns(2)
                ->schema([
                    TextInput::make('id')->label('ID')->disabled(),
                    TextInput::make('leadForm.name')
                        ->label('Formulario')
                        ->disabled()
                        ->formatStateUsing(fn ($state, ?Lead $record) => $record?->leadForm?->name),
                    TextInput::make('status')->label('Estado')->disabled(),
                    TextInput::make('created_at')
                        ->label('Recibido el')
                        ->disabled()
                        ->formatStateUsing(fn ($state) => $state ? \Carbon\Carbon::parse($state)->format('d/m/Y H:i') : ''),
                    TextInput::make('ip_address')->label('IP')->disabled(),
                    TextInput::make('referer')->label('Referer')->disabled(),
                ]),

            Section::make('Datos enviados por el cliente')
                ->schema([
                    Placeholder::make('data_table')
                        ->label('')
                        ->content(function (?Lead $record) {
                            if (! $record) {
                                return '';
                            }
                            $data = $record->data ?? [];
                            if (empty($data)) {
                                return new HtmlString('<em class="text-gray-500">Sin datos.</em>');
                            }
                            $fieldLabels = $record->leadForm?->fields()->pluck('label', 'name')->toArray() ?? [];
                            $rows = '';
                            foreach ($data as $key => $value) {
                                $label = $fieldLabels[$key] ?? $key;
                                if (is_array($value)) {
                                    $value = implode(', ', array_map(fn ($v) => is_scalar($v) ? (string) $v : json_encode($v), $value));
                                } elseif (is_bool($value)) {
                                    $value = $value ? 'Si' : 'No';
                                }
                                $rows .= '<tr class="border-b border-gray-200 dark:border-gray-700">'
                                    . '<td class="py-2 pr-4 font-medium align-top text-gray-700 dark:text-gray-300 w-1/3">' . e($label) . '</td>'
                                    . '<td class="py-2 text-gray-900 dark:text-gray-100 whitespace-pre-wrap">' . e((string) $value) . '</td>'
                                    . '</tr>';
                            }
                            return new HtmlString('<table class="w-full text-sm">' . $rows . '</table>');
                        }),
                ])
                ->columnSpanFull(),

            Section::make('Gestion interna')
                ->columns(2)
                ->schema([
                    Select::make('status')
                        ->label('Estado')
                        ->options([
                            Lead::STATUS_NEW => 'Nuevo',
                            Lead::STATUS_READ => 'Leido',
                            Lead::STATUS_CONTACTED => 'Contactado',
                            Lead::STATUS_CONVERTED => 'Convertido',
                            Lead::STATUS_ARCHIVED => 'Archivado',
                        ])
                        ->required(),
                    Select::make('handled_by')
                        ->label('Atendido por')
                        ->relationship('handler', 'name'),
                    Textarea::make('notes')
                        ->label('Notas internas')
                        ->rows(4)
                        ->columnSpanFull(),
                ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('id')->label('#')->sortable(),
                TextColumn::make('leadForm.name')
                    ->label('Formulario')
                    ->badge()
                    ->color('primary')
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        Lead::STATUS_NEW => 'warning',
                        Lead::STATUS_READ => 'info',
                        Lead::STATUS_CONTACTED => 'primary',
                        Lead::STATUS_CONVERTED => 'success',
                        Lead::STATUS_ARCHIVED => 'gray',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        Lead::STATUS_NEW => 'Nuevo',
                        Lead::STATUS_READ => 'Leido',
                        Lead::STATUS_CONTACTED => 'Contactado',
                        Lead::STATUS_CONVERTED => 'Convertido',
                        Lead::STATUS_ARCHIVED => 'Archivado',
                        default => $state,
                    }),
                TextColumn::make('preview')
                    ->label('Vista previa')
                    ->state(function (Lead $record) {
                        $data = $record->data ?? [];
                        $candidates = ['nombre_completo', 'nombre', 'first_name', 'name', 'email'];
                        foreach ($candidates as $key) {
                            if (! empty($data[$key])) {
                                return is_array($data[$key])
                                    ? implode(', ', $data[$key])
                                    : (string) $data[$key];
                            }
                        }
                        $first = collect($data)->first();
                        return is_array($first) ? implode(', ', $first) : (string) $first;
                    })
                    ->limit(40)
                    ->wrap(),
                TextColumn::make('vehicle.name')->label('Vehiculo'),
                TextColumn::make('created_at')->label('Recibido')->since()->sortable(),
            ])
            ->filters([
                SelectFilter::make('lead_form_id')
                    ->label('Formulario')
                    ->options(fn () => LeadForm::pluck('name', 'id')->toArray())
                    ->searchable(),
                SelectFilter::make('status')
                    ->label('Estado')
                    ->multiple()
                    ->options([
                        Lead::STATUS_NEW => 'Nuevo',
                        Lead::STATUS_READ => 'Leido',
                        Lead::STATUS_CONTACTED => 'Contactado',
                        Lead::STATUS_CONVERTED => 'Convertido',
                        Lead::STATUS_ARCHIVED => 'Archivado',
                    ]),
                SelectFilter::make('vehicle_id')
                    ->label('Vehiculo')
                    ->relationship('vehicle', 'name')
                    ->searchable(),
                Filter::make('created_at')
                    ->schema([
                        \Filament\Forms\Components\DatePicker::make('from')->label('Desde'),
                        \Filament\Forms\Components\DatePicker::make('until')->label('Hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'] ?? null, fn (Builder $q, $d) => $q->whereDate('created_at', '>=', $d))
                            ->when($data['until'] ?? null, fn (Builder $q, $d) => $q->whereDate('created_at', '<=', $d));
                    }),
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('export_one')
                    ->label('Exportar')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->action(function (Lead $record) {
                        $filename = "lead-{$record->id}-" . now()->format('Ymd-His') . '.xlsx';
                        return Excel::download(new LeadsExport([$record->id]), $filename);
                    }),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('mark_read')
                        ->label('Marcar como leido')
                        ->icon('heroicon-o-envelope-open')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $records->each->update(['status' => Lead::STATUS_READ]);
                            Notification::make()->success()->title('Marcados como leidos')->send();
                        }),
                    BulkAction::make('archive')
                        ->label('Archivar')
                        ->icon('heroicon-o-archive-box')
                        ->color('gray')
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $records->each->update(['status' => Lead::STATUS_ARCHIVED]);
                            Notification::make()->success()->title('Archivados')->send();
                        }),
                    BulkAction::make('export_bulk')
                        ->label('Exportar a Excel')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->deselectRecordsAfterCompletion()
                        ->action(function (\Illuminate\Support\Collection $records) {
                            $ids = $records->pluck('id')->all();
                            $filename = 'leads-' . now()->format('Ymd-His') . '.xlsx';
                            return Excel::download(new LeadsExport($ids), $filename);
                        }),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLeads::route('/'),
            'view' => ViewLead::route('/{record}'),
        ];
    }
}
