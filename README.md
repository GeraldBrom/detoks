# Тестовое задание - Клиника плюс

## Структура проекта
```
/
├── assets/
│   ├── css/           # Скомпилированные CSS файлы
│   ├── scss/          # SASS исходники
│   ├── js/            # JavaScript файлы
│   ├── fonts/         # Шрифты (.woff2, .woff, .ttf, .otf)
│   └── images/        # Изображения
│       ├── logo/      # Логотипы
│       ├── hero/      # Главный экран
│       ├── services/  # Услуги и иконки
│       ├── doctors/   # Фото врачей
│       ├── gallery/   # Фото клиники
│       └── icons/     # UI иконки
├── components/        # PHP компоненты
│   ├── header.php     # Шапка
│   ├── hero.php       # Главный экран
│   ├── services.php   # Услуги
│   ├── doctors.php    # Врачи
│   └── footer.php     # Подвал
├── config/            # Конфигурационные файлы
├── src/
│   ├── controllers/   # Контроллеры
│   ├── models/        # Модели
│   └── validators/    # Валидаторы
├── database/          # SQL скрипты
└── index.php          # Главная страница
```

## Установка

### 1. Установка зависимостей
```bash
npm install
```

### 2. Компиляция SASS
```bash
# Однократная компиляция
npm run sass

# Отслеживание изменений
npm run sass:watch
```

### 3. Настройка базы данных
Импортируйте файл `database/schema.sql` в MySQL

## Технологии
- HTML5, SASS, JavaScript
- PHP 8.4, MySQL
- Адаптивная верстка