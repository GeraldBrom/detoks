<?php
$faqData = [
    [
        'question' => 'Когда нужно обращаться в наркологическую клинику?',
        'answer' => 'Наши квалифицированные врачи и наркологи предлагают широкий спектр наркологических услуг, включая стационарное лечение, кодирование, и многие другие виды лечения. Мы заботимся о каждом пациенте и гарантируем высокое качество нашей работы. Не стесняйтесь обращаться к нам в любое время, мы всегда готовы оказать наркологическую.'
    ],
    [
        'question' => 'Сколько ждать приезда врача?',
        'answer' => 'Обращаться следует при первых признаках зависимости: невозможность контролировать употребление, абстинентный синдром, изменения в поведении и социальных связях.'
    ],
    [
        'question' => 'Какие методики используются для лечения?',
        'answer' => 'Мы предоставляем комплексные наркологические услуги: детоксикация, кодирование, психотерапия, реабилитация, консультации специалистов.'
    ],
    [
        'question' => 'Как сохранить анонимность при обращении?',
        'answer' => 'Да, мы гарантируем полную конфиденциальность. Все данные пациентов защищены медицинской тайной.'
    ],
    [
        'question' => 'Как сохранить анонимность при обращении?',
        'answer' => 'Да, мы гарантируем полную конфиденциальность. Все данные пациентов защищены медицинской тайной.'
    ],
];

$feedbackData = [
    [
        'name' => 'ИННА',
        'text' => 'Моему сыну 28 лет, но он начал злоупотреблять алкоголем, связался с компанией таких же неприятных ребят, бросил работу. Пришлось выводить его из запоя и отправлять на лечение, реабилитацию. Сотрудники центра сделали для нашей семьи очень многое, они вылечили моего ребенка от зависимости и помогли мне пережить этот сложный период.',
        'date' => '28.04.2023',
        'is_long' => true
    ],
    [
        'name' => 'АЛИНА', 
        'text' => 'Добрый день! В клинику обращались по поводу вывода из запоя, хочу выразить свою благодарность Михаилу и Артуру за профессиональный подход и поддержку, спасибо вам за помощь.',
        'date' => '28.04.2023',
        'is_long' => false
    ],
    [
        'name' => 'ДМИТРИЙ',
        'text' => 'Обратился в клинику для лечения алкогольной зависимости. Очень доволен результатом и отношением персонала. Квалифицированные врачи, современное оборудование, комфортные условия.',
        'date' => '15.03.2023',
        'is_long' => false
    ],
    [
        'name' => 'МАРИЯ',
        'text' => 'Огромная благодарность всем сотрудникам клиники! Помогли справиться с зависимостью моего мужа. Индивидуальный подход, круглосуточная поддержка, эффективное лечение.',
        'date' => '22.02.2023',
        'is_long' => false
    ]
];

?>

<section class="faq">
    <div class="container">
        <h2 class="faq__title">Частые вопросы и ответы</h2>
        <div class="faq__content">
            <div class="faq__questions">
                <?php foreach ($faqData as $item) : ?>
                    <details class="faq__question-item">
                        <summary class="faq__question-title">
                            <?= htmlspecialchars($item['question']) ?>
                            <span class="faq__question-icon">
                                <img src="assets/images/faq/plus-faq.svg" alt="Открыть" class="faq__question-icon--plus">
                                <img src="assets/images/faq/minus-faq.svg" alt="Закрыть" class="faq__question-icon--minus">
                            </span>
                        </summary>
                        <div class="faq__question-content">
                            <p class="faq__question-answer">
                                <?= htmlspecialchars($item['answer']) ?>
                            </p>
                        </div>
                    </details>
                <?php endforeach; ?>
            </div>
            <div class="faq__form">
                <h3 class="faq__form-title">Задайте вопрос специалисту</h3>
                <input type="tel" placeholder="+7 999-999-99-99" class="faq__form-input">
                <textarea placeholder="Ваш вопрос" class="faq__form-input faq__form-textarea"></textarea>
                <button type="submit" class="faq__form-button">Отправить</button>
                <p class="faq__form-privacy">Нажимая кнопку «Отправить», вы соглашаетесь с <a href="#" class="faq__form-link">политикой конфиденциальности</a></p>
            </div>
        </div>
        <div class="faq__feedback">
            <div class="faq__feedback-header">
                <h3 class="faq__feedback-title">Отзывы пациентов</h3>
                <div class="image-nav-controls image-nav-controls--inline image-nav-controls--desktop">
                    <button class="image-nav-btn image-nav-btn--prev" type="button" aria-label="Предыдущий отзыв" data-feedback-prev>
                        <img src="assets/images/about/arrow-left.svg" alt="">
                    </button>
                    <button class="image-nav-btn image-nav-btn--next" type="button" aria-label="Следующий отзыв" data-feedback-next>
                        <img src="assets/images/about/arrow-right.svg" alt="">
                    </button>
                </div>
            </div>
            
            <div class="faq__feedback-container">
                <div class="faq__feedback-slider" data-feedback-slider>
                <?php foreach ($feedbackData as $index => $feedback) : ?>
                    <div class="faq__feedback-card <?= $feedback['is_long'] ? 'faq__feedback-card--long' : 'faq__feedback-card--short' ?>">
                        <div class="faq__feedback-card__arrow"></div>
                        <h4 class="faq__feedback-card__name"><?= htmlspecialchars($feedback['name']) ?></h4>
                        <p class="faq__feedback-card__text"><?= htmlspecialchars($feedback['text']) ?></p>
                        <?php if ($feedback['is_long']) : ?>
                            <button class="faq__feedback-card__read-more" type="button">Читать полностью</button>
                        <?php endif; ?>
                        <div class="faq__feedback-card__date"><?= htmlspecialchars($feedback['date']) ?></div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
        
        <!-- Мобильные кнопки навигации -->
        <div class="faq-mobile-nav">
            <button class="faq-mobile-nav__btn faq-mobile-nav__btn--prev" type="button" aria-label="Предыдущий отзыв" data-feedback-prev>
                <img src="assets/images/about/arrow-left.svg" alt="">
            </button>
            <button class="faq-mobile-nav__btn faq-mobile-nav__btn--next" type="button" aria-label="Следующий отзыв" data-feedback-next>
                <img src="assets/images/about/arrow-right.svg" alt="">
            </button>
        </div>
    </div>
</section>