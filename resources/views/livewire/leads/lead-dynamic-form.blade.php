@php($widthClass = function ($w) {
    return match ($w) {
        'half' => 'md:col-span-6',
        'third' => 'md:col-span-4',
        default => 'md:col-span-12',
    };
})

<div class="bg-white py-10 lg:py-14">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">

        <div class="mb-8 text-center">
            <h1 class="text-2xl font-bold text-gray-900 sm:text-3xl">{{ $leadForm->name }}</h1>
            @if ($leadForm->description)
                <p class="mt-2 text-sm text-gray-600 sm:text-base">{{ $leadForm->description }}</p>
            @endif
        </div>

        @if ($submitted && $successMessage)
            <div class="rounded-lg border border-green-200 bg-green-50 p-6 text-center">
                <svg class="mx-auto h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                <p class="mt-3 text-lg font-semibold text-green-900">{{ $successMessage }}</p>
            </div>
        @else
            <form wire:submit.prevent="submit" class="space-y-8">

                @foreach ($this->sections as $sectionName => $sectionFields)
                    <div class="rounded-lg border border-gray-200 bg-gray-50 p-5 sm:p-6">
                        @if ($sectionName !== '__default__')
                            <h2 class="mb-4 text-base font-semibold uppercase tracking-wide text-blue-600">
                                {{ $sectionName }}
                            </h2>
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

                <div class="flex justify-end">
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:loading.class="opacity-60"
                        class="inline-flex items-center rounded-md bg-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:cursor-not-allowed"
                    >
                        <svg wire:loading wire:target="submit" class="-ml-1 mr-2 h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                        </svg>
                        {{ $leadForm->submit_button_text ?: 'Enviar' }}
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>
