<?php
/**
 * Пример конфигурационного файла
 * Скопируйте этот файл как config.php и настройте параметры
 */

// Настройки базы данных
define('DB_HOST', 'localhost');
define('DB_NAME', 'clinic_plus');
define('DB_USER', 'your_username');
define('DB_PASS', 'your_password');
define('DB_CHARSET', 'utf8mb4');

// Настройки приложения
define('APP_NAME', 'Клиника плюс');
define('APP_VERSION', '1.0.0');
define('APP_DEBUG', false);

// Настройки безопасности
define('CSRF_TOKEN_LIFETIME', 3600); // 1 час
define('DUPLICATE_CHECK_HOURS', 24); // Проверка дубликатов за 24 часа

// Настройки валидации
define('MIN_NAME_LENGTH', 2);
define('MAX_NAME_LENGTH', 50);
define('PHONE_PATTERN', '/^\+7\s?\(?\d{3}\)?\s?\d{3}[-\s]?\d{2}[-\s]?\d{2}$/');

// Настройки email (если нужна отправка уведомлений)
define('SMTP_HOST', 'smtp.example.com');
define('SMTP_PORT', 587);
define('SMTP_USER', 'noreply@clinic-plus.ru');
define('SMTP_PASS', 'your_smtp_password');
define('SMTP_FROM_NAME', 'Клиника плюс');

// Часовой пояс
date_default_timezone_set('Europe/Moscow');

// Настройки отображения ошибок
if (APP_DEBUG) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
?>
