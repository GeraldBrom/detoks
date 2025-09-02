-- Создание базы данных для тестового задания "Клиника плюс"
-- MySQL 8.0+

-- Создание базы данных (если не существует)
CREATE DATABASE IF NOT EXISTS clinic_plus 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE clinic_plus;

-- Таблица для записей на прием
CREATE TABLE IF NOT EXISTS appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL COMMENT 'Имя пациента',
    email VARCHAR(255) NOT NULL COMMENT 'Email пациента',
    phone VARCHAR(20) NOT NULL COMMENT 'Телефон пациента',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время создания записи',
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата и время обновления записи',
    ip_address VARCHAR(45) NULL COMMENT 'IP адрес пользователя',
    user_agent TEXT NULL COMMENT 'User Agent браузера',
    status ENUM('active', 'cancelled', 'completed') DEFAULT 'active' COMMENT 'Статус записи',
    
    -- Индексы для оптимизации
    INDEX idx_email (email),
    INDEX idx_phone (phone),
    INDEX idx_created_at (created_at),
    INDEX idx_status (status),
    
    -- Составной индекс для проверки дубликатов
    INDEX idx_duplicate_check (email, phone, created_at)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Таблица записей на прием к врачу';

-- Таблица для логирования попыток отправки формы
CREATE TABLE IF NOT EXISTS form_submissions_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NULL COMMENT 'Email отправителя',
    phone VARCHAR(20) NULL COMMENT 'Телефон отправителя',
    ip_address VARCHAR(45) NOT NULL COMMENT 'IP адрес',
    user_agent TEXT NULL COMMENT 'User Agent браузера',
    success BOOLEAN NOT NULL DEFAULT FALSE COMMENT 'Успешная отправка',
    error_message TEXT NULL COMMENT 'Сообщение об ошибке',
    form_data JSON NULL COMMENT 'Данные формы в JSON формате',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время попытки',
    
    -- Индексы
    INDEX idx_ip_address (ip_address),
    INDEX idx_created_at (created_at),
    INDEX idx_success (success),
    INDEX idx_email_phone (email, phone)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Лог всех попыток отправки формы';

-- Таблица для хранения настроек приложения
CREATE TABLE IF NOT EXISTS app_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    setting_key VARCHAR(100) NOT NULL UNIQUE COMMENT 'Ключ настройки',
    setting_value TEXT NOT NULL COMMENT 'Значение настройки',
    description TEXT NULL COMMENT 'Описание настройки',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    INDEX idx_setting_key (setting_key)
) ENGINE=InnoDB 
  DEFAULT CHARSET=utf8mb4 
  COLLATE=utf8mb4_unicode_ci
  COMMENT='Настройки приложения';

-- Вставка базовых настроек
INSERT INTO app_settings (setting_key, setting_value, description) VALUES
('duplicate_check_hours', '24', 'Количество часов для проверки дубликатов записей'),
('max_submissions_per_ip_per_hour', '10', 'Максимальное количество отправок с одного IP в час'),
('maintenance_mode', '0', 'Режим обслуживания (0 - выключен, 1 - включен)'),
('form_enabled', '1', 'Включена ли форма записи (0 - выключена, 1 - включена)')
ON DUPLICATE KEY UPDATE 
    setting_value = VALUES(setting_value),
    updated_at = CURRENT_TIMESTAMP;

-- Создание представления для активных записей
CREATE OR REPLACE VIEW active_appointments AS
SELECT 
    id,
    name,
    email,
    phone,
    created_at,
    ip_address
FROM appointments 
WHERE status = 'active'
ORDER BY created_at DESC;

-- Создание представления для статистики по дням
CREATE OR REPLACE VIEW daily_appointments_stats AS
SELECT 
    DATE(created_at) as appointment_date,
    COUNT(*) as total_appointments,
    COUNT(DISTINCT email) as unique_emails,
    COUNT(DISTINCT phone) as unique_phones,
    COUNT(DISTINCT ip_address) as unique_ips
FROM appointments 
WHERE status = 'active'
GROUP BY DATE(created_at)
ORDER BY appointment_date DESC;

-- Процедура для очистки старых логов (старше 30 дней)
DELIMITER //
CREATE PROCEDURE CleanOldLogs()
BEGIN
    DELETE FROM form_submissions_log 
    WHERE created_at < DATE_SUB(NOW(), INTERVAL 30 DAY);
    
    SELECT ROW_COUNT() as deleted_rows;
END //
DELIMITER ;

-- Функция для проверки дубликатов
DELIMITER //
CREATE FUNCTION CheckDuplicate(
    p_email VARCHAR(255),
    p_phone VARCHAR(20),
    p_hours INT
) RETURNS BOOLEAN
READS SQL DATA
DETERMINISTIC
BEGIN
    DECLARE duplicate_count INT DEFAULT 0;
    
    SELECT COUNT(*) INTO duplicate_count
    FROM appointments
    WHERE (email = p_email OR phone = p_phone)
      AND status = 'active'
      AND created_at > DATE_SUB(NOW(), INTERVAL p_hours HOUR);
    
    RETURN duplicate_count > 0;
END //
DELIMITER ;

-- Триггер для автоматического логирования
DELIMITER //
CREATE TRIGGER after_appointment_insert
AFTER INSERT ON appointments
FOR EACH ROW
BEGIN
    INSERT INTO form_submissions_log (
        email, 
        phone, 
        ip_address, 
        user_agent, 
        success, 
        form_data
    ) VALUES (
        NEW.email,
        NEW.phone,
        NEW.ip_address,
        NEW.user_agent,
        TRUE,
        JSON_OBJECT(
            'name', NEW.name,
            'email', NEW.email,
            'phone', NEW.phone,
            'status', NEW.status
        )
    );
END //
DELIMITER ;

-- Создание пользователя для приложения (опционально)
-- CREATE USER IF NOT EXISTS 'clinic_app'@'localhost' IDENTIFIED BY 'secure_password_here';
-- GRANT SELECT, INSERT, UPDATE ON clinic_plus.* TO 'clinic_app'@'localhost';
-- FLUSH PRIVILEGES;

-- Вставка тестовых данных для разработки
INSERT INTO appointments (name, email, phone, ip_address, user_agent) VALUES
('Иван Петров', 'ivan.petrov@example.com', '+7 (999) 123-45-67', '127.0.0.1', 'Test User Agent'),
('Мария Сидорова', 'maria.sidorova@example.com', '+7 (999) 234-56-78', '127.0.0.1', 'Test User Agent'),
('Алексей Иванов', 'alexey.ivanov@example.com', '+7 (999) 345-67-89', '127.0.0.1', 'Test User Agent');

-- Показать структуру созданных таблиц
SHOW TABLES;
DESCRIBE appointments;
DESCRIBE form_submissions_log;
DESCRIBE app_settings;
