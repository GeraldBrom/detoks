// FAQ Accordion functionality
class FaqAccordion {
    constructor() {
        console.log('FaqAccordion initialized');
        this.init();
    }

    init() {
        const faqToggleButtons = document.querySelectorAll('.faq__question-toggle');
        console.log('Found FAQ buttons:', faqToggleButtons.length);
        
        faqToggleButtons.forEach((button, index) => {
            console.log(`Adding listener to button ${index}`);
            button.addEventListener('click', (e) => {
                console.log('Button clicked!');
                this.toggleQuestion(e.currentTarget);
            });
        });
    }

    toggleQuestion(button) {
        console.log('Toggle question called');
        const questionItem = button.closest('.faq__question-item');
        
        if (!questionItem) {
            console.error('Question item not found');
            return;
        }

        const isOpen = questionItem.classList.contains('faq__question-item--open');
        console.log('Is open:', isOpen);
        
        // Переключаем текущий вопрос
        if (isOpen) {
            questionItem.classList.remove('faq__question-item--open');
            console.log('Closed question');
        } else {
            questionItem.classList.add('faq__question-item--open');
            console.log('Opened question');
        }
    }
}

export default FaqAccordion;
