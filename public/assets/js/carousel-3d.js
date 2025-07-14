// public/js/carousel-3d.js
class VehicleCarousel3D {
    constructor(element, options = {}) {
        this.element = element;
        this.vehicles = options.vehicles || [];
        this.currentIndex = options.currentIndex || 0;
        this.isTransitioning = false;
        this.radius = options.radius || 300;

        this.init();
    }

    init() {
        this.createStructure();
        this.updateDisplay();
        this.bindEvents();
    }

    createStructure() {
        this.element.innerHTML = `
            <div class="carousel-3d-scene">
                <div class="carousel-3d-stage">
                    <div class="position-left">
                        <div class="vehicle-content" id="left-content"></div>
                    </div>
                    <div class="position-center">
                        <div class="vehicle-content" id="center-content"></div>
                    </div>
                    <div class="position-right">
                        <div class="vehicle-content" id="right-content"></div>
                    </div>
                </div>

                <button class="nav-btn nav-prev">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>

                <button class="nav-btn nav-next">
                    <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        `;

        // Referencias a elementos
        this.leftContent = this.element.querySelector('#left-content');
        this.centerContent = this.element.querySelector('#center-content');
        this.rightContent = this.element.querySelector('#right-content');
        this.prevBtn = this.element.querySelector('.nav-prev');
        this.nextBtn = this.element.querySelector('.nav-next');
    }

    bindEvents() {
        this.prevBtn.addEventListener('click', () => this.prev());
        this.nextBtn.addEventListener('click', () => this.next());

        // Teclado
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prev();
            if (e.key === 'ArrowRight') this.next();
        });
    }

    getVehiclePositions() {
        const total = this.vehicles.length;
        return {
            left: this.vehicles[(this.currentIndex - 1 + total) % total],
            center: this.vehicles[this.currentIndex],
            right: this.vehicles[(this.currentIndex + 1) % total]
        };
    }

    createVehicleHTML(vehicle, position) {
        const isCenter = position === 'center';

        return `
            <div class="vehicle-card ${position}">
                ${isCenter ? `
                    <div class="vehicle-header">
                        <h3 class="vehicle-title">${vehicle.name}</h3>
                        <p class="vehicle-description">${vehicle.description}</p>
                    </div>
                ` : `
                    <h4 class="vehicle-side-title">${vehicle.name}</h4>
                `}

                <div class="vehicle-image-wrapper">
                    ${vehicle.features.show_badge ? `
                        <div class="vehicle-badge ${vehicle.features.badge_color}">
                            ${vehicle.features.badge_text}
                        </div>
                    ` : ''}
                    <img src="${vehicle.image}" alt="${vehicle.name}" class="vehicle-image">
                </div>

                <div class="vehicle-pricing">
                    <div class="price-old">
                        ${vehicle.pricing.from_label}
                        <span class="strikethrough">${vehicle.pricing.currency_before} ${vehicle.pricing.price_before}</span>
                    </div>
                    <div class="price-container ${isCenter ? 'large' : 'small'}">
                        <span class="price-label">${vehicle.pricing.discount_label}</span>
                        <span class="price-current">${vehicle.pricing.currency_now} ${vehicle.pricing.price_now}</span>
                    </div>
                </div>

                ${isCenter && vehicle.button_primary.show ? `
                    <button class="vehicle-button ${vehicle.button_primary.bg_color} ${vehicle.button_primary.text_color}">
                        ${vehicle.button_primary.text}
                    </button>
                ` : ''}
            </div>
        `;
    }

    updateDisplay() {
        if (this.isTransitioning) return;

        const positions = this.getVehiclePositions();

        // Agregar clase de transición
        this.element.classList.add('transitioning');

        // Simular rotación 3D con animaciones
        this.animateRotation(() => {
            // Actualizar contenido después de la animación
            this.leftContent.innerHTML = this.createVehicleHTML(positions.left, 'left');
            this.centerContent.innerHTML = this.createVehicleHTML(positions.center, 'center');
            this.rightContent.innerHTML = this.createVehicleHTML(positions.right, 'right');

            this.element.classList.remove('transitioning');
        });
    }

    animateRotation(callback) {
        this.isTransitioning = true;

        // Animación de rotación visual
        const stage = this.element.querySelector('.carousel-3d-stage');

        // Agregar efecto de rotación
        stage.style.transform = 'rotateY(10deg) scale(0.95)';
        stage.style.opacity = '0.7';

        setTimeout(() => {
            callback();

            // Volver a la posición normal
            stage.style.transform = 'rotateY(0deg) scale(1)';
            stage.style.opacity = '1';

            setTimeout(() => {
                this.isTransitioning = false;
            }, 300);
        }, 250);
    }

    next() {
        if (this.isTransitioning) return;

        this.currentIndex = (this.currentIndex + 1) % this.vehicles.length;
        this.updateDisplay();

        // Disparar evento para Livewire
        if (window.Livewire) {
            window.Livewire.dispatch('carousel-changed', { index: this.currentIndex });
        }
    }

    prev() {
        if (this.isTransitioning) return;

        this.currentIndex = this.currentIndex > 0 ? this.currentIndex - 1 : this.vehicles.length - 1;
        this.updateDisplay();

        // Disparar evento para Livewire
        if (window.Livewire) {
            window.Livewire.dispatch('carousel-changed', { index: this.currentIndex });
        }
    }

    goTo(index) {
        if (this.isTransitioning || index === this.currentIndex) return;

        this.currentIndex = index;
        this.updateDisplay();
    }

    updateVehicles(vehicles, currentIndex = 0) {
        this.vehicles = vehicles;
        this.currentIndex = currentIndex;
        this.updateDisplay();
    }
}
