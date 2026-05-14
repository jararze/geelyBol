<x-filament-panels::page>
    <form wire:submit="save" class="space-y-6">
        {{ $this->form }}

        <div class="rounded-lg border border-blue-100 bg-blue-50 p-5 dark:border-blue-900 dark:bg-blue-950/40">
            <h3 class="text-base font-semibold text-blue-900 dark:text-blue-200">Simulacion de ejemplo</h3>
            <p class="mt-1 text-sm text-blue-800 dark:text-blue-300">
                Si un cliente financia
                <strong>{{ $this->getCurrency() }} {{ number_format((float) $sample_amount, 2) }}</strong>
                a <strong>{{ (int) $sample_term }} meses</strong> con la configuracion actual,
                la cuota mensual estimada seria:
            </p>
            <div class="mt-4 grid gap-3 md:grid-cols-3">
                <label class="block text-sm">
                    <span class="font-medium text-blue-900 dark:text-blue-200">Monto a simular</span>
                    <input
                        type="number"
                        wire:model.live.debounce.400ms="sample_amount"
                        min="0"
                        step="100"
                        class="mt-1 block w-full rounded border-blue-300 text-sm dark:bg-blue-950/60 dark:text-blue-100 dark:border-blue-800"
                    >
                </label>
                <label class="block text-sm">
                    <span class="font-medium text-blue-900 dark:text-blue-200">Plazo (meses)</span>
                    <input
                        type="number"
                        wire:model.live.debounce.400ms="sample_term"
                        min="1"
                        max="120"
                        class="mt-1 block w-full rounded border-blue-300 text-sm dark:bg-blue-950/60 dark:text-blue-100 dark:border-blue-800"
                    >
                </label>
                <div>
                    <span class="block text-sm font-medium text-blue-900 dark:text-blue-200">Cuota mensual estimada</span>
                    <p class="mt-1 text-2xl font-bold text-blue-900 dark:text-blue-100">
                        {{ $this->getCurrency() }} {{ number_format($this->getSampleMonthlyPayment(), 2) }}
                    </p>
                </div>
            </div>
            <p class="mt-3 text-xs text-blue-700 dark:text-blue-300">
                Simulacion descontando el porcentaje minimo de inicial sobre el monto total.
            </p>
        </div>

        <div class="flex justify-end">
            <x-filament::button type="submit">
                Guardar configuracion
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
