<section class="benefits-section" style="{{ $this->getBackgroundStyle() }}">
    <div class="benefits-section__container">
        <div class="benefits-section__content">
            <!-- Texto a la izquierda -->
            <div class="benefits-section__text">
                <h2 class="benefits-section__title">{{ $sectionTitle }}</h2>
                <p class="benefits-section__description">{{ $sectionDescription }}</p>
            </div>

            <!-- Cards a la derecha -->
            <div class="benefits-section__cards">
                <!-- Labels separados -->
                <div class="benefits-section__labels">
                    <span class="benefits-section__label benefits-section__label--warranty">GARANTÍA EXTENDIDA</span>
                    <span class="benefits-section__label benefits-section__label--maintenance">Y MANTENIMIENTOS INCLUIDOS</span>
                </div>

                <!-- Las 4 cards en una fila -->
                <div class="benefits-section__grid">
                    <div class="benefit-card">
                        <div class="benefit-card__number">5</div>
                        <div class="benefit-card__unit">AÑOS</div>
                    </div>

                    <div class="benefit-card__connector">ó</div>

                    <div class="benefit-card">
                        <div class="benefit-card__number">150.000</div>
                        <div class="benefit-card__unit">KM</div>
                    </div>

                    <div class="benefit-card">
                        <div class="benefit-card__number">6</div>
                        <div class="benefit-card__unit">SERVICIOS</div>
                    </div>

                    <div class="benefit-card__connector">EN</div>

                    <div class="benefit-card">
                        <div class="benefit-card__number">3</div>
                        <div class="benefit-card__unit">AÑOS</div>
                    </div>
                </div>

                <div class="benefits-section__footer">
                    <p class="benefits-section__footer-text">{{ $footerText }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
