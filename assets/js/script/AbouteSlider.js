// Основной JavaScript файл

// About Image Slider
class AboutSlider {
    constructor() {
        this.slider = document.querySelector('[data-about-slider]');
        this.image = document.querySelector('[data-about-image]');
        this.prevBtn = document.querySelector('[data-about-prev]');
        this.nextBtn = document.querySelector('[data-about-next]');
        
        // Мобильные изображения
        this.mobileSlider = document.querySelector('.about__mobile-images');
        this.mobileImages = document.querySelectorAll('.about__mobile-image');
        
        this.images = [
            'assets/images/about/about.png',
            'assets/images/about/about-2.png',
            'assets/images/about/about-3.png'
        ];
        
        this.currentIndex = 0;
        this.startX = 0;
        this.currentX = 0;
        this.isDragging = false;
        this.translateX = 0;
        
        this.init();
    }
    
    init() {
        // Десктопный слайдер
        if (this.slider && this.image && this.prevBtn && this.nextBtn) {
            this.prevBtn.addEventListener('click', () => this.prevImage());
            this.nextBtn.addEventListener('click', () => this.nextImage());
        }
        
        // Мобильный touch слайдер
        if (this.mobileSlider && this.mobileImages.length > 0) {
            this.initMobileSlider();
        }
    }
    
    initMobileSlider() {
        // Touch события
        this.mobileSlider.addEventListener('touchstart', (e) => this.handleTouchStart(e), { passive: true });
        this.mobileSlider.addEventListener('touchmove', (e) => this.handleTouchMove(e), { passive: false });
        this.mobileSlider.addEventListener('touchend', (e) => this.handleTouchEnd(e), { passive: true });
        
        // Mouse события для тестирования на десктопе
        this.mobileSlider.addEventListener('mousedown', (e) => this.handleMouseStart(e));
        this.mobileSlider.addEventListener('mousemove', (e) => this.handleMouseMove(e));
        this.mobileSlider.addEventListener('mouseup', (e) => this.handleMouseEnd(e));
        this.mobileSlider.addEventListener('mouseleave', (e) => this.handleMouseEnd(e));
    }
    
    handleTouchStart(e) {
        this.startX = e.touches[0].clientX;
        this.isDragging = true;
        this.mobileSlider.style.cursor = 'grabbing';
    }
    
    handleTouchMove(e) {
        if (!this.isDragging) return;
        e.preventDefault();
        
        this.currentX = e.touches[0].clientX;
        const deltaX = this.currentX - this.startX;
        const newTranslateX = this.translateX + deltaX;
        
        this.updateMobileImagePositions(newTranslateX);
    }
    
    handleTouchEnd(e) {
        if (!this.isDragging) return;
        this.isDragging = false;
        this.mobileSlider.style.cursor = 'grab';
        
        const deltaX = this.currentX - this.startX;
        const threshold = 50; // минимальное расстояние для смены слайда
        
        if (Math.abs(deltaX) > threshold) {
            if (deltaX > 0 && this.currentIndex > 0) {
                this.currentIndex--;
            } else if (deltaX < 0 && this.currentIndex < this.mobileImages.length - 2) {
                this.currentIndex++;
            }
        }
        
        this.translateX = -this.currentIndex * 265; // 260px + 5px gap
        this.updateMobileImagePositions(this.translateX);
    }
    
    // Mouse события (для тестирования)
    handleMouseStart(e) {
        this.startX = e.clientX;
        this.isDragging = true;
        this.mobileSlider.style.cursor = 'grabbing';
    }
    
    handleMouseMove(e) {
        if (!this.isDragging) return;
        
        this.currentX = e.clientX;
        const deltaX = this.currentX - this.startX;
        const newTranslateX = this.translateX + deltaX;
        
        this.updateMobileImagePositions(newTranslateX);
    }
    
    handleMouseEnd(e) {
        if (!this.isDragging) return;
        this.isDragging = false;
        this.mobileSlider.style.cursor = 'grab';
        
        const deltaX = this.currentX - this.startX;
        const threshold = 50;
        
        if (Math.abs(deltaX) > threshold) {
            if (deltaX > 0 && this.currentIndex > 0) {
                this.currentIndex--;
            } else if (deltaX < 0 && this.currentIndex < this.mobileImages.length - 2) {
                this.currentIndex++;
            }
        }
        
        this.translateX = -this.currentIndex * 265;
        this.updateMobileImagePositions(this.translateX);
    }
    
    updateMobileImagePositions(translateX) {
        this.mobileImages.forEach((img, index) => {
            const baseLeft = index * 265; // 260px + 5px gap
            img.style.left = `${baseLeft + translateX}px`;
        });
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