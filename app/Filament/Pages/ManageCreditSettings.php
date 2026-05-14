<?php

namespace App\Filament\Pages;

use App\Models\CreditSetting;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ManageCreditSettings extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-calculator';

    protected static string|\UnitEnum|null $navigationGroup = 'Configuracion';

    protected static ?string $navigationLabel = 'Tasas de credito';

    protected static ?string $title = 'Configuracion de credito';

    protected static ?int $navigationSort = 50;

    protected string $view = 'filament.pages.manage-credit-settings';

    public ?array $data = [];

    public ?float $sample_amount = 20000.0;

    public ?int $sample_term = 36;

    public function mount(): void
    {
        $settings = CreditSetting::current();
        $this->form->fill($settings->toArray());
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Tasa y porcentajes')
                    ->columns(3)
                    ->schema([
                        TextInput::make('interest_rate_annual')
                            ->label('Tasa anual (%)')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01)
                            ->suffix('%')
                            ->live(onBlur: true),
                        TextInput::make('min_initial_percentage')
                            ->label('Inicial minima (%)')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01)
                            ->suffix('%'),
                        TextInput::make('max_finance_percentage')
                            ->label('Maximo financiable (%)')
                            ->numeric()
                            ->required()
                            ->minValue(0)
                            ->maxValue(100)
                            ->step(0.01)
                            ->suffix('%'),
                    ]),

                Section::make('Montos y plazos')
                    ->columns(3)
                    ->schema([
                        TextInput::make('min_amount')
                            ->label('Monto minimo')
                            ->numeric()
                            ->required()
                            ->minValue(0),
                        TextInput::make('max_amount')
                            ->label('Monto maximo')
                            ->numeric()
                            ->required()
                            ->gt('min_amount'),
                        Select::make('currency')
                            ->label('Moneda')
                            ->options([
                                'USD' => 'USD',
                                'BOB' => 'BOB',
                            ])
                            ->default('USD')
                            ->required(),
                        Repeater::make('available_terms')
                            ->label('Plazos disponibles (meses)')
                            ->schema([
                                TextInput::make('months')
                                    ->label('Meses')
                                    ->numeric()
                                    ->minValue(1)
                                    ->maxValue(120)
                                    ->required(),
                            ])
                            ->columnSpanFull()
                            ->minItems(1)
                            ->grid(6)
                            ->reorderable(false)
                            ->addActionLabel('Agregar plazo')
                            ->afterStateHydrated(function (Repeater $component, $state) {
                                if (is_array($state) && ! empty($state) && is_int(($state[0] ?? null))) {
                                    $component->state(array_map(fn ($m) => ['months' => $m], $state));
                                } elseif (empty($state)) {
                                    $component->state([['months' => 12], ['months' => 24], ['months' => 36], ['months' => 48], ['months' => 60]]);
                                }
                            })
                            ->dehydrateStateUsing(function ($state) {
                                if (! is_array($state)) {
                                    return [];
                                }
                                return collect($state)
                                    ->pluck('months')
                                    ->filter()
                                    ->map(fn ($m) => (int) $m)
                                    ->unique()
                                    ->sort()
                                    ->values()
                                    ->all();
                            }),
                    ]),

                Section::make('Disclaimer legal')
                    ->schema([
                        Textarea::make('legal_disclaimer')
                            ->label('Texto legal mostrado al cliente')
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data')
            ->model(CreditSetting::class);
    }

    public function save(): void
    {
        $data = $this->form->getState();
        CreditSetting::current()->update($data);

        Notification::make()
            ->success()
            ->title('Configuracion de credito guardada')
            ->send();
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label('Guardar')
                ->submit('save'),
        ];
    }

    public function getSampleMonthlyPayment(): float
    {
        $settings = new CreditSetting($this->data + (CreditSetting::current()->toArray()));
        $amount = (float) ($this->sample_amount ?? 20000);
        $term = (int) ($this->sample_term ?? 36);

        if ($amount <= 0 || $term <= 0) {
            return 0.0;
        }

        $minInitialPct = (float) ($this->data['min_initial_percentage'] ?? $settings->min_initial_percentage);
        $principal = $amount * (1 - $minInitialPct / 100);

        $tempSettings = new CreditSetting();
        $tempSettings->interest_rate_annual = (float) ($this->data['interest_rate_annual'] ?? $settings->interest_rate_annual);

        return $tempSettings->calculateMonthlyPayment($principal, $term);
    }

    public function getCurrency(): string
    {
        return $this->data['currency'] ?? 'USD';
    }
}
