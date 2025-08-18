<div>
    <div x-data="vehicleSubNav()"
         x-init="init()"
         class="vehicle-sub-nav sticky top-16 lg:top-20 z-40 bg-black shadow-lg">

        <div class="container mx-auto px-4">
            <nav class="flex justify-center">
                <ul class="flex space-x-0">
                    @foreach($menuItems as $index => $item)
                        <li class="relative">
                            <a href="{{ $item['anchor'] }}"
                               @click="scrollToSection('{{ $item['id'] }}', '{{ $item['anchor'] }}', $event)"
                               :class="activeSection === '{{ $item['id'] }}' ? 'text-white' : 'text-gray-400'"
                               class="nav-item block px-6 lg:px-8 py-4 text-sm lg:text-base font-medium transition-colors duration-300 hover:text-white relative">

                                {{-- Texto del menú --}}
                                {{ $item['label'] }}

                                {{-- Border activo (sección actual) --}}
                                <div :class="activeSection === '{{ $item['id'] }}' ? 'w-full opacity-100' : 'w-0 opacity-0'"
                                     class="absolute bottom-0 left-0 h-0.5 bg-white transition-all duration-300 ease-out"></div>

                                {{-- Border hover --}}
                                <div class="absolute bottom-0 left-0 h-0.5 bg-white w-0 group-hover:w-full transition-all duration-300 ease-out hover-border"></div>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </nav>
        </div>
    </div>

    @push('scripts')
        <script>
            function vehicleSubNav() {
                return {
                    activeSection: @entangle('activeSection'),

                    init() {
                        this.setupIntersectionObserver();
                        this.setupSmoothScroll();
                    },

                    scrollToSection(sectionId, anchor, event) {
                        event.preventDefault();

                        const target = document.querySelector(anchor);
                        if (target) {
                            const navHeight = document.querySelector('.vehicle-sub-nav').offsetHeight;
                            const mainNavHeight = document.querySelector('header').offsetHeight;
                            const offset = navHeight + mainNavHeight + 20;

                            const targetPosition = target.offsetTop - offset;

                            window.scrollTo({
                                top: targetPosition,
                                behavior: 'smooth'
                            });

                            this.activeSection = sectionId;
                        }
                    },

                    setupIntersectionObserver() {
                        const sections = document.querySelectorAll('[data-section]');

                        const observer = new IntersectionObserver((entries) => {
                            entries.forEach(entry => {
                                if (entry.isIntersecting) {
                                    const sectionId = entry.target.getAttribute('data-section');
                                    this.activeSection = sectionId;
                                }
                            });
                        }, {
                            rootMargin: '-20% 0px -60% 0px',
                            threshold: 0.1
                        });

                        sections.forEach(section => observer.observe(section));
                    },

                    setupSmoothScroll() {
                        document.documentElement.style.scrollBehavior = 'smooth';
                    }
                }
            }
        </script>
    @endpush

    <style>
        .vehicle-sub-nav {
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Hover effect solo para el border */
        .nav-item:hover .hover-border {
            width: 100% !important;
        }

        /* Animación de entrada del menú */
        .vehicle-sub-nav {
            animation: slideDown 0.3s ease-out;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Asegurar que solo el texto cambie de color en hover */
        .nav-item {
            background: transparent !important;
        }

        .nav-item:hover {
            background: transparent !important;
        }
    </style>
</div>
