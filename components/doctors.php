<?php
$doctors = [
    [
        'name' => 'Иванов Иван Иванович',
        'specialization' => 'Врач-Нарколог',
        'experience' => '12 лет',
    ],
    [
        'name' => 'Меринов Артём Вячеславович',
        'specialization' => 'Врач-Уролог',
        'experience' => '15 лет',
    ],
    
    [
        'name' => 'Новикова Елена Петровна',
        'specialization' => 'Терапевт',
        'experience' => '8 лет',
    ], 
    [
        'name' => 'Стрелков Сергей Викторович',
        'specialization' => 'Врач-Невролог',
        'experience' => '20 лет',
    ],
];

$images = [
    'assets/images/doctors/doctor-1.png',
    'assets/images/doctors/doctor-2.png',
    'assets/images/doctors/doctor-3.png',
    'assets/images/doctors/doctor-4.png',
];
?>


<!-- Doctors Section -->
<section class="doctors" data-doctors-slider>
    <div class="container">
        <!-- ДЕСКТОПНАЯ ВЕРСИЯ (оригинал) -->
        <div class="doctors__list">
            <div class="doctors__card">
                <div class="doctors__card__content">
                    <h2 class="doctors__title">Медицинский персонал</h2>
                    <div class="doctors__card__info">
                        <h3 class="doctors__card__name" data-doctor-name><?php echo $doctors[0]['name']; ?></h3>
                        <div class="doctors__card__specialization">
                            <span class="doctors__card__label">Специализация:</span>
                            <span class="doctors__card__value" data-doctor-specialization><?php echo $doctors[0]['specialization']; ?></span>
                        </div>
                        <div class="doctors__card__experience">
                            <span class="doctors__card__label">Опыт работы:</span>
                            <span class="doctors__card__value" data-doctor-experience><?php echo $doctors[0]['experience']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="image-nav-controls image-nav-controls--inline">
                    <button class="image-nav-btn image-nav-btn--prev" type="button" aria-label="Предыдущий врач" data-doctors-prev>
                        <img src="assets/images/about/arrow-left.svg" alt="">
                    </button>
                    <button class="image-nav-btn image-nav-btn--next" type="button" aria-label="Следующий врач" data-doctors-next>
                        <img src="assets/images/about/arrow-right.svg" alt="">
                    </button>
                </div>
            </div>
            <div class="doctors__images">
                <div class="doctors__image doctors__image--main">
                    <img src="<?php echo $images[0]; ?>" alt="<?php echo $doctors[0]['name']; ?>" data-doctor-image>
                </div>
                <div class="doctors__image doctors__image--secondary">
                    <img src="<?php echo $images[1]; ?>" alt="<?php echo $doctors[1]['name']; ?>">
                </div>
                <div class="doctors__image doctors__image--tertiary">
                    <img src="<?php echo $images[2]; ?>" alt="<?php echo $doctors[2]['name']; ?>">
                </div>
                <div class="doctors__image doctors__image--fourth">
                    <img src="<?php echo $images[3]; ?>" alt="<?php echo $doctors[3]['name']; ?>">
                </div>
            </div>

            <!-- МОБИЛЬНАЯ ВЕРСИЯ (слайдер) -->
            <div class="doctors__mobile-section">
                <h2 class="doctors__mobile-title">Медицинский персонал</h2>
                <div class="doctors__mobile-slider">
                    <?php foreach ($doctors as $index => $doctor): ?>
                    <div class="doctors__mobile-card">
                    <div class="doctors__mobile-card__image-container">
                        <img src="<?php echo $images[$index]; ?>" alt="<?php echo $doctor['name']; ?>" class="doctors__mobile-card__image">
                    </div>
                    <div class="doctors__mobile-card__info">
                        <h3 class="doctors__mobile-card__name"><?php echo $doctor['name']; ?></h3>
                        <div class="doctors__mobile-card__specialization">
                            <span class="doctors__mobile-card__label">Специализация:</span>
                            <span class="doctors__mobile-card__value"><?php echo $doctor['specialization']; ?></span>
                        </div>
                        <div class="doctors__mobile-card__experience">
                            <span class="doctors__mobile-card__label">Опыт работы:</span>
                            <span class="doctors__mobile-card__value"><?php echo $doctor['experience']; ?></span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Данные для слайдера -->
    <script type="application/json" id="doctors-data">
        {
            "doctors": <?php echo json_encode($doctors); ?>,
            "images": <?php echo json_encode($images); ?>
        }
    </script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileSlider = document.querySelector('.doctors__mobile-slider');
            if (!mobileSlider) return;
            
            let isDown = false;
            let startX;
            let scrollLeft;
            
            // Простой и плавный drag and drop для мобильного слайдера
            mobileSlider.addEventListener('mousedown', (e) => {
                isDown = true;
                startX = e.pageX - mobileSlider.offsetLeft;
                scrollLeft = mobileSlider.scrollLeft;
            });
            
            mobileSlider.addEventListener('mouseleave', () => {
                isDown = false;
            });
            
            mobileSlider.addEventListener('mouseup', () => {
                isDown = false;
            });
            
            mobileSlider.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - mobileSlider.offsetLeft;
                const walk = x - startX;
                mobileSlider.scrollLeft = scrollLeft - walk;
            });
        });
    </script>
</section>
