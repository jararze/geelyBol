@php
    $leadFormId = $data['lead_form_id'] ?? null;
    $leadForm = $leadFormId
        ? \App\Models\LeadForm::where('id', $leadFormId)->where('is_active', true)->first()
        : null;
    $showInCard = $data['show_in_card'] ?? true;
@endphp

@if ($leadForm)
    <section class="bg-gray-50 py-16 md:py-20">
        <div class="max-w-3xl mx-auto px-4">
            @if (!empty($data['title']) || !empty($data['intro']))
                <div class="mb-8 text-center">
                    @if (!empty($data['title']))
                        <h2 class="text-3xl md:text-4xl font-bold mb-3 uppercase tracking-tight text-gray-900">
                            {{ $data['title'] }}
                        </h2>
                    @endif
                    @if (!empty($data['intro']))
                        <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                            {{ $data['intro'] }}
                        </p>
                    @endif
                </div>
            @endif

            <div class="{{ $showInCard ? 'rounded-xl border border-gray-200 bg-white shadow-sm p-2 sm:p-4' : '' }}">
                @livewire('leads.lead-dynamic-form', [
                    'leadForm' => $leadForm,
                    'vehicle' => $vehicle ?? null,
                ], key('lead-form-' . $leadForm->id . '-' . ($vehicle->id ?? 'no-vehicle')))
            </div>
        </div>
    </section>
@endif
