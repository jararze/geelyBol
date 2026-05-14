@php($widthClass = function ($w) {
    return match ($w) {
        'half' => 'md:col-span-6',
        'third' => 'md:col-span-4',
        default => 'md:col-span-12',
    };
})

<div class="bg-gray-50 py-10 lg:py-14">
    <div class="mx-auto max-w-6xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ $leadForm->name }}</h1>
            @if ($leadForm->description)
                <p class="mt-2 text-sm text-gray-600 sm:text-base">{{ $leadForm->description }}</p>
            @endif
        </div>

        @if ($submitted && $successMessage)
            <div class="mx-auto max-w-2xl rounded-lg border border-green-200 bg-green-50 p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="mt-3 text-lg font-semibold text-green-900">{{ $successMessage }}</p>
            </div>
        @else
            <form wire:submit.prevent="submit" class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">

                {{-- Columna izquierda: simulador --}}
                <div class="rounded-xl border border-blue-100 bg-white p-6 shadow-sm">
                    <h2 class="mb-4 text-lg font-semibold text-blue-600">Simula tu crédito</h2>

                    @if ($vehicle)
                        <div class="mb-4 flex items-center gap-3 rounded-lg bg-blue-50 p-3">
                            @if ($vehicle->image)
                                <img src="{{ asset('storage/' . $vehicle->image) }}" alt="{{ $vehicle->name }}" class="h-14 w-20 rounded object-cover">
                            @endif
                            <div>
                                <p class="text-sm text-gray-500">Vehículo</p>
                                <p class="font-semibold text-gray-900">{{ $vehicle->name }}</p>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-5">
                        <div>
                            <label class="flex justify-between text-sm font-medium text-gray-700">
                                <span>Precio del vehículo ({{ $this->currency }})</span>
                            </label>
                            <input
                                type="number"
                                wire:model.live.debounce.400ms="vehicle_price"
                                min="{{ $creditSettings->min_amount }}"
                                max="{{ $creditSettings->max_amount }}"
                                step="100"
                                class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                            @error('vehicle_price') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="flex justify-between text-sm font-medium text-gray-700">
                                <span>Cuota inicial ({{ $this->currency }})</span>
                                <span class="text-blue-600 font-semibold">
                                    {{ $vehicle_price > 0 ? number_format(($initial_amount / $vehicle_price) * 100, 1) : 0 }}%
                                </span>
                            </label>
                            <input
                                type="range"
                                wire:model.live="initial_amount"
                                min="{{ $this->minInitialAmount }}"
                                max="{{ max($this->minInitialAmount, (float) $vehicle_price - $this->maxInitialAmount) }}"
                                step="50"
                                class="mt-2 w-full accent-blue-600"
                            >
                            <div class="mt-1 flex items-center justify-between text-xs text-gray-500">
                                <span>Min: {{ $this->currency }} {{ number_format($this->minInitialAmount, 0) }}</span>
                                <span class="font-medium text-gray-900">{{ $this->currency }} {{ number_format((float) $initial_amount, 0) }}</span>
                                <span>Max: {{ $this->currency }} {{ number_format(max($this->minInitialAmount, (float) $vehicle_price - $this->maxInitialAmount), 0) }}</span>
                            </div>
                            @error('initial_amount') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label class="text-sm font-medium text-gray-700">Plazo</label>
                            <select wire:model.live="term_months" class="mt-1 block w-full rounded-md border-gray-300 px-3 py-2 text-sm focus:border-blue-500 focus:ring-blue-500">
                                @foreach ($this->availableTerms as $term)
                                    <option value="{{ $term }}">{{ $term }} meses</option>
                                @endforeach
                            </select>
                            @error('term_months') <p class="mt-1 text-xs text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="rounded-lg bg-gradient-to-br from-blue-600 to-blue-700 p-5 text-center text-white shadow-md">
                            <p class="text-xs uppercase tracking-wide text-blue-100">Cuota mensual estimada</p>
                            <p class="mt-1 text-3xl font-bold">
                                {{ $this->currency }} {{ number_format($this->monthlyPayment, 2) }}
                            </p>
                        </div>

                        <dl class="grid grid-cols-2 gap-3 text-sm">
                            <div class="rounded bg-gray-50 p-3">
                                <dt class="text-xs text-gray-500">Monto a financiar</dt>
                                <dd class="font-semibold text-gray-900">{{ $this->currency }} {{ number_format($this->financedAmount, 2) }}</dd>
                            </div>
                            <div class="rounded bg-gray-50 p-3">
                                <dt class="text-xs text-gray-500">Total a pagar</dt>
                                <dd class="font-semibold text-gray-900">{{ $this->currency }} {{ number_format($this->totalToPay, 2) }}</dd>
                            </div>
                            <div class="rounded bg-gray-50 p-3 col-span-2">
                                <dt class="text-xs text-gray-500">Tasa anual aplicada</dt>
                                <dd class="font-semibold text-gray-900">{{ number_format((float) $creditSettings->interest_rate_annual, 2) }}%</dd>
                            </div>
                        </dl>

                        @if ($creditSettings->legal_disclaimer)
                            <p class="text-[11px] leading-relaxed text-gray-500">{{ $creditSettings->legal_disclaimer }}</p>
                        @endif
                    </div>
                </div>

                {{-- Columna derecha: datos del cliente --}}
                <div class="space-y-6">
                    @foreach ($this->sections as $sectionName => $sectionFields)
                        <div class="rounded-xl border border-gray-200 bg-white p-5 sm:p-6 shadow-sm">
                            @if ($sectionName !== '__default__')
                                <h2 class="mb-4 text-base font-semibold uppercase tracking-wide text-blue-600">{{ $sectionName }}</h2>
                            @endif
                            <div class="grid grid-cols-12 gap-x-4 gap-y-4">
                                @foreach ($sectionFields as $field)
                                    @continue(! $this->isFieldVisible($field))
                                    <div class="col-span-12 {{ $widthClass($field->width) }}">
                                        @includeIf(
                                            'leads.partials.field-' . str_replace('_', '-', $field->type),
                                            ['field' => $field, 'value' => $data[$field->name] ?? null, 'errors' => $errors, 'liveFieldNames' => $this->liveFieldNames]
                                        )
                                        @error('data.' . $field->name)
                                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-60"
                        class="inline-flex w-full items-center justify-center rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed"
                    >
                        <svg wire:loading wire:target="submit" class="-ml-1 mr-2 h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        {{ $leadForm->submit_button_text ?: 'Solicitar crédito' }}
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
