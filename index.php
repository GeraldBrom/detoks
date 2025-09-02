<?php
// Главная страница лендинга "Клиника плюс"
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Клиника плюс - Медицинские услуги высокого качества</title>
    <meta name="description" content="Клиника плюс - современная медицинская клиника с опытными врачами и новейшим оборудованием. Запись на прием онлайн.">
    <link rel="stylesheet" href="assets/css/main.css">
</head>
<body>
    <?php include 'components/header.php'; ?>

    <!-- Main Content -->
    <main class="main">
        <?php include 'components/hero.php'; ?>
        <?php include 'components/about.php'; ?>
        <?php include 'components/services.php'; ?>
        <?php include 'components/doctors.php'; ?>
        <?php include 'components/advantages.php'; ?>
        <?php include 'components/testimonials.php'; ?>
        <?php include 'components/appointment-form.php'; ?>
        <?php include 'components/contact.php'; ?>
    </main>

    <?php include 'components/footer.php'; ?>

    <script src="assets/js/main.js"></script>
</body>
</html>