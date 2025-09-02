<?php
// Массив с данными этапов лечения
$treatment_steps = [
    [
        'number' => '01',
        'icon' => 'doctor.svg',
        'title' => 'Диагностика состояния',
    ],
    [
        'number' => '02', 
        'icon' => 'table.svg',
        'title' => 'Составление плана лечения',
    ],
    [
        'number' => '03',
        'icon' => 'ambulance.svg', 
        'title' => 'Снятие симптомов',
        'description' => 'Быстрое устранение болезненных проявлений интоксикации'
    ],
    [
        'number' => '04',
        'icon' => 'pocket.svg',
        'title' => 'Восстановление организма', 
    ],
    [
        'number' => '05',
        'icon' => 'Call.svg',
        'title' => 'Бесплатные консультации',
    ]
];
?>

<!-- Treatment Steps Section -->
<section class="treatment" id="treatment">
    <div class="container">
        <h2 class="treatment__title">Этапы лечения</h2>
        <div class="treatment__steps">
            <?php foreach ($treatment_steps as $step): ?>
            <div class="treatment__step">
                <div class="treatment__step__number"><?php echo htmlspecialchars($step['number']); ?></div>
                <div class="treatment__step__content">
                    <div class="treatment__step__icon">
                        <img src="assets/images/treatment/<?php echo htmlspecialchars($step['icon']); ?>" 
                             alt="<?php echo htmlspecialchars($step['title']); ?>">
                    </div>
                    <h3 class="treatment__step__title"><?php echo htmlspecialchars($step['title']); ?></h3>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
