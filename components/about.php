<?php

$documents = [
    [
        'image' => 'documents-1.png',
    ],
    [
        'image' => 'documents-2.png',
    ],
    [
        'image' => 'documents-3.png',
    ],
    [
        'image' => 'documents-4.png',
    ]
];
?>

<section class="about">
    <div class="container">
        <div class="about__content">
            <!-- Мобильные изображения -->
            <div class="about__mobile-images">
                <img src="assets/images/about/about.png" alt="О клинике" class="about__mobile-image">
                <img src="assets/images/about/about-2.png" alt="О клинике" class="about__mobile-image">
                <img src="assets/images/about/about-3.png" alt="О клинике" class="about__mobile-image">
                <img src="assets/images/about/about.png" alt="О клинике" class="about__mobile-image">
            </div>
            
            <div class="about__text">
                <h2 class="about__title">О Клинике</h2>
                <p class="about__description">Наши квалифицированные врачи и наркологи предлагают широкий спектр наркологических услуг, 
                        включая стационарное лечение, кодирование, и многие другие виды лечения. Мы заботимся о каждом пациенте и гарантируем высокое качество нашей работы. 
                        Не стесняйтесь обращаться к нам в любое время, мы всегда готовы оказать наркологическую помощь.</p>
                <ul class="about__features">
                    <li class="about__feature">
                        <div class="about__feature-icon">
                            <img src="assets/images/about/docAbout.svg" alt="" aria-hidden="true">
                        </div>
                        <p class="about__feature-text">Квалифицированные врачи-наркологи</p>
                    </li>
                    <li class="about__feature">
                        <div class="about__feature-icon">
                            <img src="assets/images/about/healthAbout.svg" alt="" aria-hidden="true">
                        </div>
                        <p class="about__feature-text">Находим решение даже в сложных ситуациях</p>
                    </li>
                    <li class="about__feature">
                        <div class="about__feature-icon">
                            <img src="assets/images/about/tableAbout.svg" alt="" aria-hidden="true">
                        </div>
                        <p class="about__feature-text">Используем импортные проверенные препараты</p>
                    </li>
                    <li class="about__feature">
                        <div class="about__feature-icon">
                            <img src="assets/images/about/sertificateAbout.svg" alt="" aria-hidden="true">
                        </div>
                        <p class="about__feature-text">Лицензия Л041-01177-91/00561129</p>
                    </li>
                </ul>
            </div>
            <div class="about__image">
                <div class="about__image-wrapper" data-about-slider>
                    <img src="assets/images/about/about.png" alt="О Клинике" data-about-image>
                    <div class="image-nav-controls">
                        <button class="image-nav-btn image-nav-btn--prev" type="button" aria-label="Предыдущее изображение" data-about-prev>
                            <img src="assets/images/about/arrow-left.svg" alt="">
                        </button>
                        <button class="image-nav-btn image-nav-btn--next" type="button" aria-label="Следующее изображение" data-about-next>
                            <img src="assets/images/about/arrow-right.svg" alt="">
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="about__documents">
            <h3 class="documents__title">Имеем все необходимые документы для предоставления медицинских услуг:</h3>
            <div class="documents__items">
                <?php foreach ($documents as $document): ?>
                <div class="documents__items__item">
                        <img src="assets/images/documents/<?php echo $document['image']; ?>" alt="">
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
</section>

<!-- JavaScript для drag and drop функционала -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Drag and drop для мобильных изображений
        const mobileImages = document.querySelector('.about__mobile-images');
        if (mobileImages) {
            let isDown = false;
            let startX;
            let scrollLeft;
            
            mobileImages.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - mobileImages.offsetLeft;
                scrollLeft = mobileImages.scrollLeft;
            });
            
            mobileImages.addEventListener('mouseleave', () => {
                isDown = false;
            });
            
            mobileImages.addEventListener('mouseup', () => {
                isDown = false;
            });
            
            mobileImages.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - mobileImages.offsetLeft;
                const walk = x - startX;
                mobileImages.scrollLeft = scrollLeft - walk;
            });
        }
        
        // Drag and drop для документов
        const documentsItems = document.querySelector('.documents__items');
        if (documentsItems) {
            let isDown = false;
            let startX;
            let scrollLeft;
            
            documentsItems.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - documentsItems.offsetLeft;
                scrollLeft = documentsItems.scrollLeft;
            });
            
            documentsItems.addEventListener('mouseleave', () => {
                isDown = false;
            });
            
            documentsItems.addEventListener('mouseup', () => {
                isDown = false;
            });
            
            documentsItems.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - documentsItems.offsetLeft;
                const walk = x - startX;
                documentsItems.scrollLeft = scrollLeft - walk;
            });
        }
    });
</script>