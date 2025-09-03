export default class DoctorsSlider {
    constructor() {
        this.slider = document.querySelector('[data-doctors-slider]');
        if (!this.slider) return;

        this.currentIndex = 0;
        this.data = this.loadData();
        
        if (!this.data || !this.data.doctors || !this.data.images) {
            console.error('Данные врачей не найдены');
            return;
        }

        this.doctors = this.data.doctors;
        this.images = this.data.images;
        
        this.elements = {
            name: this.slider.querySelector('[data-doctor-name]'),
            specialization: this.slider.querySelector('[data-doctor-specialization]'),
            experience: this.slider.querySelector('[data-doctor-experience]'),
            mainImage: this.slider.querySelector('[data-doctor-image]'),
            secondaryImage: this.slider.querySelector('.doctors__image--secondary img'),
            tertiaryImage: this.slider.querySelector('.doctors__image--tertiary img'),
            fourthImage: this.slider.querySelector('.doctors__image--fourth img'),
            mainCard: this.slider.querySelector('.doctors__image--main'),
            secondaryCard: this.slider.querySelector('.doctors__image--secondary'),
            tertiaryCard: this.slider.querySelector('.doctors__image--tertiary'),
            fourthCard: this.slider.querySelector('.doctors__image--fourth'),
            prevBtn: this.slider.querySelector('[data-doctors-prev]'),
            nextBtn: this.slider.querySelector('[data-doctors-next]')
        };

        this.positions = [0, 380, 760, 1140];
        this.isAnimating = false;

        this.init();
    }

    loadData() {
        const dataScript = document.getElementById('doctors-data');
        if (!dataScript) return null;
        
        try {
            return JSON.parse(dataScript.textContent);
        } catch (error) {
            console.error('Ошибка парсинга данных врачей:', error);
            return null;
        }
    }

    init() {
        this.bindEvents();
        this.updateDisplay();
    }

    bindEvents() {
        if (this.elements.prevBtn) {
            this.elements.prevBtn.addEventListener('click', () => this.prev());
        }
        
        if (this.elements.nextBtn) {
            this.elements.nextBtn.addEventListener('click', () => this.next());
        }
    }

    prev() {
        if (this.isAnimating) return;
        
        this.isAnimating = true;
        this.currentIndex = this.currentIndex === 0 
            ? this.doctors.length - 1 
            : this.currentIndex - 1;
        this.updateDisplay();
        
        setTimeout(() => {
            this.isAnimating = false;
        }, 600);
    }

    next() {
        if (this.isAnimating) return;
        
        this.isAnimating = true;
        this.currentIndex = this.currentIndex === this.doctors.length - 1 
            ? 0 
            : this.currentIndex + 1;
        this.updateDisplay();
        
        setTimeout(() => {
            this.isAnimating = false;
        }, 600);
    }

    updateDisplay() {
        const doctor = this.doctors[this.currentIndex];
        
        if (!doctor) return;

        if (this.elements.name) {
            this.elements.name.textContent = doctor.name;
        }
        
        if (this.elements.specialization) {
            this.elements.specialization.textContent = doctor.specialization;
        }
        
        if (this.elements.experience) {
            this.elements.experience.textContent = doctor.experience;
        }

        this.updateImages();
        this.animatePositions();
    }

    updateImages() {
        const mainIndex = this.currentIndex;
        const secondaryIndex = (this.currentIndex + 1) % this.images.length;
        const tertiaryIndex = (this.currentIndex + 2) % this.images.length;
        const fourthIndex = (this.currentIndex + 3) % this.images.length;

        if (this.elements.mainImage && this.images[mainIndex]) {
            this.elements.mainImage.src = this.images[mainIndex];
            this.elements.mainImage.alt = this.doctors[mainIndex].name;
        }

        if (this.elements.secondaryImage && this.images[secondaryIndex]) {
            this.elements.secondaryImage.src = this.images[secondaryIndex];
            this.elements.secondaryImage.alt = this.doctors[secondaryIndex].name;
        }

        if (this.elements.tertiaryImage && this.images[tertiaryIndex]) {
            this.elements.tertiaryImage.src = this.images[tertiaryIndex];
            this.elements.tertiaryImage.alt = this.doctors[tertiaryIndex].name;
        }

        if (this.elements.fourthImage && this.images[fourthIndex]) {
            this.elements.fourthImage.src = this.images[fourthIndex];
            this.elements.fourthImage.alt = this.doctors[fourthIndex].name;
        }
    }

    animatePositions() {
        const cards = [
            this.elements.mainCard,
            this.elements.secondaryCard,
            this.elements.tertiaryCard,
            this.elements.fourthCard
        ];

        cards.forEach((card, index) => {
            if (card) {
                const newPositionIndex = (index - this.currentIndex + this.positions.length) % this.positions.length;
                const newLeft = this.positions[newPositionIndex];
                card.style.left = `${newLeft}px`;
            }
        });
    }
}
