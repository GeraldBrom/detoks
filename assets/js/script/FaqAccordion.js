class FaqAccordion {
    constructor() {
        this.init();
    }

    init() {
        const faqToggleButtons = document.querySelectorAll('.faq__question-toggle');
        
        faqToggleButtons.forEach((button, index) => {
            button.addEventListener('click', (e) => {
                this.toggleQuestion(e.currentTarget);
            });
        });
    }

    toggleQuestion(button) {
        const questionItem = button.closest('.faq__question-item');
        
        if (!questionItem) {
            return;
        }

        const isOpen = questionItem.classList.contains('faq__question-item--open');
        

        if (isOpen) {
            questionItem.classList.remove('faq__question-item--open');
        } else {
            questionItem.classList.add('faq__question-item--open');
        }
    }
}

export default FaqAccordion;
