<div>
    {{-- Loader específico para este componente --}}
    <div wire:loading class="fixed inset-0 bg-white bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="loader-spinner mb-4"></div>
            <p class="text-gray-600">Cargando...</p>
        </div>
    </div>

    {{-- Loader específico para diferentes acciones --}}
    <div wire:loading.delay wire:target="testSlowTab" class="fixed inset-0 bg-blue-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center text-white">
            <div class="loader-spinner mb-4 border-white border-t-blue-200"></div>
            <p>Cambiando tab...</p>
        </div>
    </div>

    <div wire:loading.delay wire:target="testSlowColor" class="fixed inset-0 bg-green-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center text-white">
            <div class="loader-spinner mb-4 border-white border-t-green-200"></div>
            <p>Cambiando color...</p>
        </div>
    </div>

    <div wire:loading.delay wire:target="testSlowView" class="fixed inset-0 bg-purple-500 bg-opacity-75 flex items-center justify-center z-50">
        <div class="text-center text-white">
            <div class="loader-spinner mb-4 border-white border-t-purple-200"></div>
            <p>Cambiando vista...</p>
        </div>
    </div>

    <section class="vehicle-versions {{ $versionsData['section_background'] }} {{ $versionsData['section_padding'] }}">
        <div class="container mx-auto px-4">

            {{-- Header --}}
            <div class="text-left mb-12">
                <h2 class="{{ $versionsData['header']['title_size'] }} font-bold text-gray-900 mb-4">
                    {{ $versionsData['header']['title'] }}
                </h2>
                <p class="{{ $versionsData['header']['subtitle_size'] }} text-gray-600">
                    {{ $versionsData['header']['subtitle'] }}
                </p>
            </div>

            {{-- Caja única con gradiente --}}
            <div class="relative rounded-lg overflow-hidden shadow-lg"
                 style="background: linear-gradient(135deg, #e3f2fd 0%, #f8f9fa 70%, rgba(248,249,250,0) 100%);">

                <div class="grid grid-cols-1 lg:grid-cols-3">

                    {{-- Panel Izquierdo: Configuración (1/3) --}}
                    <div class="p-6 lg:p-8">

                        {{-- Selector de Versión --}}
                        <div class="mb-6">
                            <select wire:model.live="selectedVersion"
                                    class="w-full bg-[#194BFF] text-white p-3 pr-10 rounded font-medium text-lg appearance-none"
                                    style="font-family: 'GeelyTitle', sans-serif;">
                                @foreach($versionsData['versions'] as $key => $version)
                                    <option class="bg-white text-black" value="{{ $key }}">{{ $version['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Especificaciones --}}
                        <div class="mb-6">
                            @php $currentVersion = $this->getCurrentVersion(); @endphp
                            @foreach($currentVersion['specs'] ?? [] as $label => $value)
                                <div class="flex justify-between py-2 border-b border-gray-200">
                                    <span class="text-gray-600 text-sm">{{ $label }}</span>
                                    <span class="font-medium text-gray-900 text-sm">{{ $value }}</span>
                                </div>
                            @endforeach
                        </div>

                        {{-- Tabs --}}
                        <div class="mb-6">
                            <div class="flex flex-wrap gap-2">
                                @foreach($versionsData['tabs'] as $key => $tab)
                                    <button wire:click="selectTab('{{ $key }}')"
                                            class="py-2 px-2 text-xs font-small rounded transition-colors {{ $selectedTab === $key ? 'bg-[#194BFF] text-white' : 'bg-white text-gray-600 hover:bg-[#194BFF] hover:text-white border border-gray-300' }}">
                                        {{ $tab['label'] }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        {{-- Contenido dinámico según el tab --}}
                        <div class="mb-6">
                            @if($selectedTab === 'precio')
                                {{-- Información de Precio --}}
                                @php $pricing = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Año Comercial:</span>
                                        <span class="font-medium text-sm">{{ $pricing['year'] ?? 'N/A' }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Precio de lista:</span>
                                        <span class="font-medium text-sm">{{ $pricing['currency'] ?? '$' }}{{ number_format($pricing['list_price'] ?? 0) }}</span>
                                    </div>

                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Descuento:</span>
                                        <span class="font-medium text-green-600 text-sm">{{ $pricing['currency'] ?? '$' }} {{ number_format($pricing['discount'] ?? 0) }}</span>
                                    </div>

                                    <div class="flex justify-between text-lg font-bold border-t pt-2 mt-3">
                                        <span class="text-[#194BFF]">Precio final:</span>
                                        <span class="text-[#194BFF]">{{ $pricing['currency'] ?? '$' }} {{ number_format($pricing['final_price'] ?? 0) }}</span>
                                    </div>
                                </div>

                            @elseif($selectedTab === 'motor')
                                {{-- Información del Motor --}}
                                @php $motor = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Tipo de motor:</span>
                                        <span class="font-medium text-sm">{{ $motor['tipo_motor'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Potencia:</span>
                                        <span class="font-medium text-sm">{{ $motor['potencia'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Torque:</span>
                                        <span class="font-medium text-sm">{{ $motor['torque'] ?? 'N/A' }}</span>
                                    </div>
{{--                                    <div class="flex justify-between">--}}
{{--                                        <span class="text-gray-600 text-sm">Combustible:</span>--}}
{{--                                        <span class="font-medium text-sm">{{ $motor['combustible'] ?? 'N/A' }}</span>--}}
{{--                                    </div>--}}
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Tracción:</span>
                                        <span class="font-medium text-sm">{{ $motor['consumo_ciudad'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Norma de emisiones:</span>
                                        <span class="font-medium text-sm">{{ $motor['consumo_carretera'] ?? 'N/A' }}</span>
                                    </div>
                                </div>

                            @elseif($selectedTab === 'equipamiento')
                                {{-- Información del Equipamiento --}}
                                @php $equipamiento = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Pantalla:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['pantalla'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Asientos:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['asientos'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Climatizador:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['climatizador'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Cámara:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['camara'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Sensores:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['sensores'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Conectividad:</span>
                                        <span class="font-medium text-sm">{{ $equipamiento['conectividad'] ?? 'N/A' }}</span>
                                    </div>
                                </div>

                            @elseif($selectedTab === 'seguridad')
                                {{-- Información de Seguridad --}}
                                @php $seguridad = $this->getCurrentTabContent(); @endphp
                                <div class="space-y-2">
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Airbags:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['airbags'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Sistema ABS:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['abs'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Control estabilidad:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['control_estabilidad'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Asistente frenado:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['asistente_frenado'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Control tracción:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['control_traccion'] ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-600 text-sm">Cinturones:</span>
                                        <span class="font-medium text-sm">{{ $seguridad['cinturones'] ?? 'N/A' }}</span>
                                    </div>
                                </div>
                            @endif
                        </div>


                        {{-- Botones de Acción --}}
                        <div class="space-y-3">
                            <button wire:click="requestQuote"
                                    class="w-full py-3 bg-black text-white rounded font-medium transition-colors hover:bg-gray-800">
                                {{ $versionsData['buttons']['quote']['text'] }}
                            </button>

                            <button wire:click="downloadCatalog"
                                    class="w-full py-2 border border-gray-400 text-gray-700 rounded font-medium transition-colors hover:bg-black hover:text-white text-sm">
                                {{ $versionsData['buttons']['catalog']['text'] }}
                            </button>

                            <button wire:click="scheduleTestDrive"
                                    class="w-full py-2 border border-gray-400 text-gray-700 rounded font-medium transition-colors hover:bg-black hover:text-white text-sm">
                                {{ $versionsData['buttons']['test_drive']['text'] }}
                            </button>
                        </div>
                    </div>

                    {{-- Panel Derecho: Visualización (2/3) --}}
                    <div class="lg:col-span-2 p-6 lg:p-8 flex flex-col">

                        {{-- Toggle Exterior/Interior --}}
                        <div class="flex justify-center mb-6">
                            <div class="flex bg-gray-200 rounded-full p-1">
                                <button wire:click="selectView('exterior')"
                                        class="px-6 py-2 rounded-full font-medium transition-colors {{ $selectedView === 'exterior' ? 'bg-white text-gray-900 shadow' : 'text-gray-600' }}">
                                    Exterior
                                </button>
                                <button wire:click="selectView('interior')"
                                        class="px-6 py-2 rounded-full font-medium transition-colors {{ $selectedView === 'interior' ? 'bg-black text-white shadow' : 'text-gray-600' }}">
                                    Interior
                                </button>
                            </div>
                        </div>

                        {{-- Imagen del Vehículo --}}
                        <div class="flex-1 flex items-center justify-center">
                            <div class="relative w-full max-w-2xl">
                                @if($selectedView === 'interior')
                                    {{-- Canvas 360 para interior --}}
                                    <div id="canvas360-container" class="relative w-full h-96 bg-gray-100 rounded-lg overflow-hidden cursor-grab active:cursor-grabbing">
                                        <canvas id="canvas360" class="w-full h-full"></canvas>
                                        <div class="absolute bottom-4 right-4 bg-black/70 text-white px-3 py-1 rounded text-sm">
                                            Arrastra para rotar 360°
                                        </div>
                                    </div>
                                @else
                                    {{-- Imagen normal para exterior --}}
                                    <img src="{{ asset($this->getCurrentImage()) }}"
                                         alt="Starray exterior"
                                         class="w-full h-96 object-contain transition-opacity duration-300">
                                @endif
                            </div>
                        </div>

                        {{-- Selector de Colores (solo para exterior) --}}
                        @if($selectedView === 'exterior')
                            <div class="flex justify-center space-x-3 mt-6 bg-white rounded-full py-3 px-5 w-fit mx-auto">
                                @foreach($versionsData['colors'] as $colorKey => $color)
                                    <button wire:click="selectColor('{{ $colorKey }}')"
                                            class="relative w-10 h-10 rounded-full transition-all duration-200 {{ $selectedColor === $colorKey ? 'border-gray-800 scale-110' : 'border-gray-300 hover:border-gray-400' }} before:absolute before:inset-0 before:bg-white before:opacity-0 hover:before:opacity-30 before:transition-opacity before:duration-200 before:rounded-full"
                                            style="background-color: {{ $color['hex'] }};"
                                            title="{{ $color['name'] }}">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Mensajes Flash --}}
            @if (session()->has('message'))
                <div class="mt-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </section>

    <style>
        select {
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='white' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6,9 12,15 18,9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 12px center;
            background-size: 26px;
            padding-right: 40px !important;
        }
        #canvas360-container:not(.loaded)::before {
            content: 'Cargando vista 360°...';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #6b7280;
            font-size: 1rem;
            z-index: 5;
            opacity: 1;
        }

        #canvas360-container.loaded::before {
            opacity: 0;
            pointer-events: none;
        }
        #canvas360-container {
            user-select: none;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            touch-action: none;
            position: relative;
            width: 100%;
            height: 384px; /* h-96 */
            background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
            border-radius: 0.5rem;
            overflow: hidden;
        }

        #canvas360 {
            display: block;
            width: 100%;
            height: 100%;
            cursor: grab;
            background: transparent;
        }

        #canvas360:active {
            cursor: grabbing;
        }

        /* Indicador de instrucciones */
        .canvas-instructions {
            position: absolute;
            bottom: 1rem;
            right: 1rem;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 0.25rem;
            font-size: 0.875rem;
            pointer-events: none;
            z-index: 10;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        /* Ocultar instrucciones después de interacción */
        #canvas360-container.interacted .canvas-instructions {
            opacity: 0;
        }

        /* Loading state */
        #canvas360-container::before {
            content: 'Cargando vista 360°...';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #6b7280;
            font-size: 1rem;
            z-index: 5;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        #canvas360-container.loaded::before {
            opacity: 0;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #canvas360-container {
                height: 300px;
            }

            .canvas-instructions {
                font-size: 0.75rem;
                bottom: 0.5rem;
                right: 0.5rem;
                padding: 0.375rem 0.5rem;
            }
        }
    </style>
    @push('scripts')
        <script>
            function initCanvas360() {
                const canvas = document.getElementById('canvas360');
                if (!canvas) return;

                console.log('Inicializando canvas 360');

                const ctx = canvas.getContext('2d');
                const image = new Image();
                let currentFrame = 0;
                const totalFrames = 36;
                let isMouseDown = false;
                let lastMouseX = 0;

                // Configurar canvas con alta resolución
                const rect = canvas.getBoundingClientRect();
                const dpr = window.devicePixelRatio || 1;

                canvas.width = rect.width * dpr;
                canvas.height = rect.height * dpr;

                ctx.scale(dpr, dpr);

                canvas.style.width = rect.width + 'px';
                canvas.style.height = rect.height + 'px';

                @php
                    $currentVersion = $this->getCurrentVersion();
                    $interiorImage = $currentVersion['images']['interior']['default'] ?? '';
                @endphp

                const imagePath = '{{ asset($interiorImage) }}';
                console.log('Cargando imagen:', imagePath);

                image.onload = function() {
                    console.log('=== DEBUG INFO ===');
                    console.log('Imagen total:', image.width, 'x', image.height);
                    console.log('Total frames:', totalFrames);
                    console.log('Altura por frame:', image.height / totalFrames);
                    console.log('Canvas:', canvas.width, 'x', canvas.height);
                    console.log('=================');

                    canvas.parentElement.classList.add('loaded');
                    drawFrame();
                };

                image.onerror = function() {
                    console.error('Error cargando imagen:', imagePath);
                };

                function drawFrame() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    // Calcular qué porción de la imagen panorámica mostrar
                    const totalRotation = image.width;
                    const rotationStep = totalRotation / totalFrames;
                    const sourceX = currentFrame * rotationStep;

                    // Usar un ancho fijo de "ventana" basado en la proporción del canvas
                    const aspectRatio = canvas.width / canvas.height;
                    const sourceWidth = image.height * aspectRatio; // Ancho proporcional

                    // Asegurar que no nos salgamos de los límites de la imagen
                    const actualSourceX = Math.max(0, Math.min(sourceX, image.width - sourceWidth));
                    const actualSourceWidth = Math.min(sourceWidth, image.width - actualSourceX);

                    // Dibujar llenando todo el canvas (sin centrar)
                    ctx.drawImage(
                        image,
                        actualSourceX, 0,              // source: posición X variable, Y=0
                        actualSourceWidth, image.height, // source: ancho calculado, altura completa
                        0, 0,                          // dest: esquina superior izquierda
                        canvas.width, canvas.height    // dest: llenar todo el canvas
                    );

                    console.log('Source X:', actualSourceX, 'Source Width:', actualSourceWidth);
                }

                canvas.addEventListener('mousedown', function(e) {
                    isMouseDown = true;
                    lastMouseX = e.clientX;
                    canvas.style.cursor = 'grabbing';
                });

                canvas.addEventListener('mousemove', function(e) {
                    if (!isMouseDown) return;

                    const deltaX = e.clientX - lastMouseX;

                    // Para imagen panorámica: movimiento más suave y continuo
                    if (Math.abs(deltaX) > 1) { // Sensibilidad más alta
                        // Calcular cuánto mover en la imagen panorámica
                        const sensitivity = 2; // Ajusta este valor para más/menos sensibilidad
                        const movement = deltaX * sensitivity;

                        // Calcular nueva posición en la imagen
                        const rotationStep = image.width / totalFrames;
                        let newPosition = currentFrame * rotationStep - movement;

                        // Hacer que sea circular (cuando llegue al final, volver al inicio)
                        if (newPosition < 0) {
                            newPosition = image.width + newPosition;
                        } else if (newPosition >= image.width) {
                            newPosition = newPosition - image.width;
                        }

                        // Convertir de vuelta a frame
                        currentFrame = Math.round(newPosition / rotationStep) % totalFrames;
                        if (currentFrame < 0) currentFrame = totalFrames - 1;

                        drawFrame();
                        lastMouseX = e.clientX;

                        console.log('Frame:', currentFrame, 'Position:', newPosition);
                    }
                });

                canvas.addEventListener('touchstart', function(e) {
                    e.preventDefault();
                    isMouseDown = true;
                    lastMouseX = e.touches[0].clientX;
                });

                canvas.addEventListener('touchmove', function(e) {
                    e.preventDefault();
                    if (!isMouseDown) return;

                    const deltaX = e.touches[0].clientX - lastMouseX;
                    if (Math.abs(deltaX) > 1) {
                        const sensitivity = 2;
                        const movement = deltaX * sensitivity;
                        const rotationStep = image.width / totalFrames;
                        let newPosition = currentFrame * rotationStep - movement;

                        if (newPosition < 0) {
                            newPosition = image.width + newPosition;
                        } else if (newPosition >= image.width) {
                            newPosition = newPosition - image.width;
                        }

                        currentFrame = Math.round(newPosition / rotationStep) % totalFrames;
                        if (currentFrame < 0) currentFrame = totalFrames - 1;

                        drawFrame();
                        lastMouseX = e.touches[0].clientX;
                    }
                });

                canvas.addEventListener('touchend', function(e) {
                    e.preventDefault();
                    isMouseDown = false;
                });

                canvas.addEventListener('mouseup', function() {
                    isMouseDown = false;
                    canvas.style.cursor = 'grab';
                });

                canvas.addEventListener('mouseleave', function() {
                    isMouseDown = false;
                    canvas.style.cursor = 'grab';
                });

                image.src = imagePath;
            }

            // Usar el evento específico de Livewire para el método selectView
            Livewire.on('viewChanged', function() {
                console.log('Vista cambiada, verificando canvas');
                setTimeout(initCanvas360, 100);
            });

            // También intentar con DOMContentLoaded
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initCanvas360, 500);
            });
        </script>
    @endpush
</div>

