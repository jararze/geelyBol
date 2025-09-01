<div>
    <div class="min-h-screen bg-gray-50">

        {{-- Sección 1: Formulario con Tabs --}}
        <section class="bg-gray-100 py-16">
            <div class="container mx-auto px-4">

                {{-- Header --}}
                <div class="text-left mb-8">
                    <h1 class="text-4xl font-bold text-gray-900 mb-4">
                        {{ $pageData['title'] }}
                    </h1>
                    <p class="text-lg text-gray-600">
                        {{ $pageData['description'] }}
                    </p>
                </div>

                {{-- Tabs --}}
                <div class="max-w-6xl mx-auto">
                    <div class="flex border-b border-gray-200 mb-8">
                        @foreach($pageData['tabs'] as $key => $tab)
                            <button wire:click="setActiveTab('{{ $key }}')"
                                    class="flex-1 py-4 px-6 text-center font-medium transition-colors duration-200
                                       {{ $activeTab === $key ? 'text-blue-600 border-b-2 border-blue-600 bg-blue-50' : 'text-gray-500 hover:text-gray-700' }}">
                                {{ $tab['title'] }}
                            </button>
                        @endforeach
                    </div>

                    {{-- Contenido del formulario --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">

                        {{-- Imagen del interior --}}
                        <div class="order-2 lg:order-1">
                            <img src="{{ asset('frontend/images/form1.png') }}"
                                 alt="Interior Geely"
                                 class="w-full rounded-2xl shadow-lg">
                        </div>

                        {{-- Formulario --}}
                        <div class="order-1 lg:order-2">
                            <div class="bg-white rounded-xl shadow-lg p-8">

                                {{-- Descripción del tab activo --}}
                                <div class="mb-6">
                                    <h3 class="text-xl font-bold text-blue-600 mb-2">
                                        {{ $pageData['tabs'][$activeTab]['title'] }}
                                    </h3>
                                    <p class="text-gray-600">
                                        {{ $pageData['tabs'][$activeTab]['description'] }}
                                    </p>
                                </div>

                                {{-- Mostrar vehículo pre-seleccionado --}}
                                @if($selectedVehicle)
                                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                                        <p class="text-sm text-blue-700">
                                            <strong>Vehículo seleccionado:</strong> {{ $selectedVehicle['name'] }}
                                        </p>
                                    </div>
                                @endif

                                {{-- Formulario --}}
                                <form wire:submit="submitForm" class="space-y-6">

                                    {{-- Nombre --}}
                                    <div>
                                        <input type="text"
                                               wire:model="formData.nombre"
                                               placeholder="Nombre y Apellido"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @error('formData.nombre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <input type="email"
                                               wire:model="formData.email"
                                               placeholder="ejemplo@email.com"
                                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                        @error('formData.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Teléfono --}}
                                    <div class="flex">
                                        <div class="flex items-center bg-gray-100 px-3 border border-r-0 border-gray-300 rounded-l-lg">
                                            <img src="{{ asset('frontend/images/flag-bolivia.png') }}" alt="Bolivia" class="w-6 h-4 mr-2">
                                            <span class="text-sm text-gray-600">+591</span>
                                        </div>
                                        <input type="tel"
                                               wire:model="formData.telefono"
                                               placeholder="70677777"
                                               class="flex-1 px-4 py-3 border border-gray-300 rounded-r-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    </div>
                                    @error('formData.telefono') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                                    {{-- Ciudad --}}
                                    <div>
                                        <select wire:model="formData.ciudad"
                                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                            <option value="">Selecciona tu ciudad</option>
                                            <option value="santa-cruz">Santa Cruz</option>
                                            <option value="la-paz">La Paz</option>
                                            <option value="cochabamba">Cochabamba</option>
                                            <option value="el-alto">El Alto</option>
                                            <option value="sucre">Sucre</option>
                                            <option value="tarija">Tarija</option>
                                            <option value="oruro">Oruro</option>
                                            <option value="potosi">Potosí</option>
                                            <option value="trinidad">Trinidad</option>
                                        </select>
                                        @error('formData.ciudad') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                    </div>

                                    {{-- Selector de vehículo (solo si no viene pre-seleccionado) --}}
                                    @if(!$selectedVehicle)
                                        <div>
                                            <select wire:model="formData.vehiculo"
                                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="">Selecciona el vehículo de tu interés</option>
                                                @foreach($this->getAllVehicles() as $vehicle)
                                                    <option value="{{ $vehicle['value'] }}">{{ $vehicle['label'] }}</option>
                                                @endforeach
                                            </select>
                                            @error('formData.vehiculo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        </div>
                                    @endif

                                    {{-- Checkbox --}}
                                    <div class="flex items-start">
                                        <input type="checkbox"
                                               wire:model="formData.receive_offers"
                                               id="receive_offers"
                                               class="mt-1 h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                                        <label for="receive_offers" class="ml-2 text-sm text-gray-600">
                                            Deseo recibir ofertas y promociones especiales de Geely por WhatsApp / Email
                                        </label>
                                    </div>

                                    {{-- Botón enviar --}}
                                    <button type="submit"
                                            class="w-full bg-gray-400 hover:bg-gray-500 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200">
                                        Enviar
                                    </button>
                                </form>

                                {{-- Mensaje de éxito --}}
                                @if (session()->has('message'))
                                    <div class="mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Sección 2: Sucursales --}}
        <section class="bg-white py-16">
            <div class="container mx-auto px-4">
                <h2 class="text-4xl font-bold text-gray-900 mb-6">
                    {{ $pageData['sucursales']['title'] }}
                </h2>
                <div class="max-w-6xl mx-auto">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

                        {{-- Información de sucursales --}}
                        <div>


                            <p class="text-gray-600 mb-6">
                                {{ $pageData['sucursales']['description'] }}
                            </p>

                            <p class="text-gray-600 mb-6">
                                {{ $pageData['sucursales']['info'] }}
                            </p>

                            <ul class="space-y-2 mb-6">
                                @foreach($pageData['sucursales']['locations'] as $location)
                                    <li class="text-lg font-medium text-gray-900">
                                        {{ $location }}
                                    </li>
                                @endforeach
                            </ul>

                            <p class="text-gray-600">
                                {{ $pageData['sucursales']['additional_info'] }}
                            </p>
                        </div>

                        {{-- Imagen de sucursal --}}
                        <div>
                            <img src="{{ asset($pageData['sucursales']['image']) }}"
                                 alt="Sucursal Geely"
                                 class="w-full h-[30vh] rounded-2xl shadow-lg">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
