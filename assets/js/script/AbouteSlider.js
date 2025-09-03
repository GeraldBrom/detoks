// About Image Slider - только для десктопной версии

class AboutSlider {
    constructor() {
        this.slider = document.querySelector('[data-about-slider]');
        this.image = document.querySelector('[data-about-image]');
        this.prevBtn = document.querySelector('[data-about-prev]');
        this.nextBtn = document.querySelector('[data-about-next]');
        
        this.images = [
            'assets/images/about/about.png',
            'assets/images/about/about-2.png',
            'assets/images/about/about-3.png'
        ];
        
        this.currentIndex = 0;
        
        this.init();
    }
    
    init() {
        // Только десктопный слайдер с кнопками
        if (this.slider && this.image && this.prevBtn && this.nextBtn) {
            this.prevBtn.addEventListener('click', () => this.prevImage());
            this.nextBtn.addEventListener('click', () => this.nextImage());
        }
    }
    
    prevImage() {
        this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
        this.updateImage();
    }
    
    nextImage() {
        this.currentIndex = this.currentIndex === this.images.length - 1 ? 0 : this.currentIndex + 1;
        this.updateImage();
    }
    
    updateImage() {
        this.image.style.opacity = '0';
        
        setTimeout(() => {
            this.image.src = this.images[this.currentIndex];
            this.image.style.opacity = '1';
        }, 150);
    }
}

export default AboutSlider;