class FeedbackSlider {
    constructor() {
        this.slider = document.querySelector('[data-feedback-slider]');
        this.prevBtn = document.querySelector('[data-feedback-prev]');
        this.nextBtn = document.querySelector('[data-feedback-next]');
        this.cards = Array.from(this.slider?.querySelectorAll('.faq__feedback-card') || []);
        
        this.currentIndex = 0; 
        this.cardsToShow = 2; 
        this.cardWidth = 590; 
        this.cardGap = 20; 
        this.stepSize = this.cardWidth + this.cardGap;
        
        this.init();
    }

    init() {
        if (!this.slider || !this.prevBtn || !this.nextBtn || this.cards.length === 0) {
            console.warn('Feedback slider elements not found');
            return;
        }

        this.setupSlider();
        this.bindEvents();
        this.updateButtons();
    }

    setupSlider() {

        this.slider.style.transform = 'translateX(0px)';
        this.slider.style.transition = 'transform 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        
        
        this.updateVisibility();
    }

    bindEvents() {
        this.prevBtn.addEventListener('click', () => this.slidePrev());
        this.nextBtn.addEventListener('click', () => this.slideNext());
    }

    slidePrev() {
        if (this.currentIndex > 0) {
            this.currentIndex = Math.max(0, this.currentIndex - this.cardsToShow);
            this.updateSlider();
        }
    }

    slideNext() {
        const maxIndex = Math.max(0, this.cards.length - this.cardsToShow);
        if (this.currentIndex < maxIndex) {
            this.currentIndex = Math.min(maxIndex, this.currentIndex + this.cardsToShow);
            this.updateSlider();
        }
    }

    updateSlider() {
        const offset = -this.currentIndex * this.stepSize;
        this.slider.style.transform = `translateX(${offset}px)`;
        
        this.updateVisibility();
        this.updateButtons();
    }

    updateVisibility() {
        
        const containerWidth = this.cardsToShow * this.stepSize - this.cardGap;
        const container = this.slider.closest('.faq__feedback-container');
        if (container) {
            container.style.width = `${containerWidth}px`;
            container.style.overflow = 'hidden';
        }
    }

    updateButtons() {
        
        if (this.currentIndex <= 0) {
            this.prevBtn.disabled = true;
            this.prevBtn.style.opacity = '0.5';
            this.prevBtn.style.cursor = 'not-allowed';
        } else {
            this.prevBtn.disabled = false;
            this.prevBtn.style.opacity = '1';
            this.prevBtn.style.cursor = 'pointer';
        }

        // Деактивируем кнопку "вперёд" если в конце
        const maxIndex = Math.max(0, this.cards.length - this.cardsToShow);
        if (this.currentIndex >= maxIndex) {
            this.nextBtn.disabled = true;
            this.nextBtn.style.opacity = '0.5';
            this.nextBtn.style.cursor = 'not-allowed';
        } else {
            this.nextBtn.disabled = false;
            this.nextBtn.style.opacity = '1';
            this.nextBtn.style.cursor = 'pointer';
        }
    }
}

export default FeedbackSlider;
