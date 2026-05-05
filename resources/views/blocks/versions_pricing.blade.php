@php
    $title = $data['title'] ?? 'Versiones y precios';
    $showTabs = (bool) ($data['show_exterior_interior_tabs'] ?? true);
    $versionsCollection = $versions ?? collect();
    $defaultVersion = $versionsCollection->first();
@endphp

<section id="versiones" class="bg-white py-16 md:py-24"
         x-data="{
            currentVersion: '{{ $defaultVersion?->code ?? '' }}',
            currentTab: 'exterior'
         }">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl md:text-5xl font-bold text-gray-900 mb-10 text-center md:text-left uppercase tracking-tight">
            {{ $title }}
        </h2>

        @if ($versionsCollection->isEmpty())
            <p class="text-center text-gray-500 py-10">
                No hay versiones cargadas todavia. Agregalas desde el panel admin.
            </p>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                <div>
                    <label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Selecciona version</label>
                    <select x-model="currentVersion"
                            class="w-full mb-6 border border-gray-300 rounded-md px-4 py-3 text-base bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        @foreach ($versionsCollection as $v)
                            <option value="{{ $v->code }}">{{ $v->name }}</option>
                        @endforeach
                    </select>

                    @foreach ($versionsCollection as $v)
                        <div x-show="currentVersion === '{{ $v->code }}'" x-cloak>
                            @php
                                $displacement = trim((string) ($v->engine_displacement ?? ''));
                                $turboLabel = $v->turbo ? 'TURBO' : '';
                                $hp = trim((string) ($v->horsepower ?? ''));
                                $engineFull = trim($displacement.' '.$turboLabel.($hp ? ' con '.$hp : ''));
                            @endphp

                            <dl class="divide-y divide-gray-100 mb-8">
                                @if ($engineFull !== '')
                                    <div class="grid grid-cols-2 py-3">
                                        <dt class="text-sm uppercase tracking-wider text-gray-500">Cilindrada</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $engineFull }}</dd>
                                    </div>
                                @endif
                                @if (!empty($v->transmission))
                                    <div class="grid grid-cols-2 py-3">
                                        <dt class="text-sm uppercase tracking-wider text-gray-500">Transmision</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $v->transmission }}</dd>
                                    </div>
                                @endif
                                @if (!empty($v->drivetrain))
                                    <div class="grid grid-cols-2 py-3">
                                        <dt class="text-sm uppercase tracking-wider text-gray-500">Traccion</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $v->drivetrain }}</dd>
                                    </div>
                                @endif
                                @if (!empty($v->platform))
                                    <div class="grid grid-cols-2 py-3">
                                        <dt class="text-sm uppercase tracking-wider text-gray-500">Plataforma</dt>
                                        <dd class="text-sm font-medium text-gray-900">{{ $v->platform }}</dd>
                                    </div>
                                @endif
                            </dl>

                            <div class="bg-gray-50 rounded-lg p-6 mb-6">
                                <div class="text-xs uppercase tracking-widest text-gray-500 mb-1">Precio {{ $v->year }}</div>
                                <div class="flex items-baseline gap-3">
                                    <span class="text-3xl md:text-4xl font-bold text-gray-900">
                                        {{ $v->currency }} {{ number_format((float) $v->final_price, 0, ',', '.') }}
                                    </span>
                                    @if ((float) $v->discount > 0)
                                        <span class="text-sm text-gray-500 line-through">
                                            {{ $v->currency }} {{ number_format((float) $v->list_price, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <a href="/cotizar?version={{ $v->code }}"
                                   class="bg-blue-600 hover:bg-blue-700 text-white text-center px-4 py-3 rounded-md text-sm font-medium uppercase tracking-wide transition">
                                    Cotizar
                                </a>
                                @if (!empty($v->catalog_pdf_url))
                                    <a href="{{ \App\Filament\Helpers\ImageHelper::resolveUrl($v->catalog_pdf_url) }}"
                                       target="_blank" rel="noopener"
                                       class="bg-gray-900 hover:bg-black text-white text-center px-4 py-3 rounded-md text-sm font-medium uppercase tracking-wide transition">
                                        Catalogo
                                    </a>
                                @endif
                                <a href="/test-drive?version={{ $v->code }}"
                                   class="border border-gray-300 hover:border-gray-900 text-gray-900 text-center px-4 py-3 rounded-md text-sm font-medium uppercase tracking-wide transition">
                                    Test Drive
                                </a>
                                <a href="https://wa.me/591"
                                   target="_blank" rel="noopener noreferrer"
                                   class="border border-gray-300 hover:border-gray-900 text-gray-900 text-center px-4 py-3 rounded-md text-sm font-medium uppercase tracking-wide transition">
                                    WhatsApp
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div>
                    @if ($showTabs)
                        <div class="flex gap-2 border-b border-gray-200 mb-6">
                            <button type="button"
                                    @click="currentTab = 'exterior'"
                                    :class="currentTab === 'exterior' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-900'"
                                    class="px-4 py-2 text-sm font-medium uppercase tracking-wide border-b-2 transition">
                                Exterior
                            </button>
                            <button type="button"
                                    @click="currentTab = 'interior'"
                                    :class="currentTab === 'interior' ? 'border-blue-600 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-900'"
                                    class="px-4 py-2 text-sm font-medium uppercase tracking-wide border-b-2 transition">
                                Interior
                            </button>
                        </div>
                    @endif

                    @foreach ($versionsCollection as $v)
                        @php
                            $exterior = \App\Filament\Helpers\ImageHelper::resolveUrl($v->exterior_image ?? null) ?: \App\Filament\Helpers\ImageHelper::resolveUrl($vehicle->image ?? null);
                            $interior = \App\Filament\Helpers\ImageHelper::resolveUrl($v->interior_image ?? null);
                        @endphp

                        <div x-show="currentVersion === '{{ $v->code }}'" x-cloak>
                            @if ($showTabs)
                                <div x-show="currentTab === 'exterior'" x-cloak>
                                    @if ($exterior)
                                        <img src="{{ $exterior }}" alt="{{ $v->name }} exterior"
                                             class="w-full h-auto rounded-lg shadow-md object-cover">
                                    @endif
                                </div>
                                <div x-show="currentTab === 'interior'" x-cloak>
                                    @if ($interior)
                                        <img src="{{ $interior }}" alt="{{ $v->name }} interior"
                                             class="w-full h-auto rounded-lg shadow-md object-cover">
                                    @else
                                        <div class="bg-gray-100 rounded-lg p-12 text-center text-gray-500">
                                            Imagen interior no disponible
                                        </div>
                                    @endif
                                </div>
                            @else
                                @if ($exterior)
                                    <img src="{{ $exterior }}" alt="{{ $v->name }}"
                                         class="w-full h-auto rounded-lg shadow-md object-cover">
                                @endif
                            @endif
                        </div>
                    @endforeach
                </div>

            </div>
        @endif
    </div>
</section>
