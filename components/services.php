<?php
// Массив с данными всех услуг
$services = [
    [
        'image' => 'service-1.png',
        'title' => 'Стандартная терапия',
        'description' => 'Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении',
        'price' => 'от 2400 ₽'
    ],
    [
        'image' => 'service-2.png',
        'title' => 'Усиленная терапия',
        'description' => 'Рекомендуется для облегчения похмелья и прерывания запоев длительностью до недели',
        'price' => 'от 5800 ₽'
    ],
    [
        'image' => 'service-3.png',
        'title' => 'Восстановление+',
        'description' => 'Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении',
        'price' => 'от 15 800 ₽'
    ],
    [
        'image' => 'service-4.png',
        'title' => 'Максимальная терапия',
        'description' => 'Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении',
        'price' => 'от 18 800 ₽'
    ],
    [
        'image' => 'service-5.png',
        'title' => 'Кодирование+',
        'description' => 'Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении',
        'price' => 'от 3200 ₽'
    ],
    [
        'image' => 'service-6.png',
        'title' => 'Выезд нарколога на дом',
        'description' => 'Для облегчения похмельного синдрома и прерывания запоя. А также при алкогольном отравлении',
        'price' => 'от 3500 ₽'
    ]
];
?>

<!-- Services Section -->
<section class="services">
    <div class="container">
        <h2 class="services__title">Наши Услуги</h2>
        <ul class="services__list">
            <?php foreach ($services as $service): ?>
            <li class="services__item">
                <img src="assets/images/services/<?php echo $service['image']; ?>" alt="<?php echo htmlspecialchars($service['title']); ?>" class="services__item__image">
                <div class="services__item__content">
                    <h3 class="services__item__title"><?php echo htmlspecialchars($service['title']); ?></h3>
                    <p class="services__item__description"><?php echo htmlspecialchars($service['description']); ?></p>
                </div>
                <div class="services__item__button">
                    <span class="services__item__button__price"><?php echo htmlspecialchars($service['price']); ?></span>
                    <button class="button button--primary">Начать лечение</button>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
