# Лакомка — Laravel 11

## Быстрый старт

### 1. Создать новый Laravel проект
```bash
composer create-project laravel/laravel lakomka
cd lakomka
```

### 2. Скопировать файлы из этого архива
Скопируй все папки поверх свежего проекта:
- `routes/web.php`
- `app/Http/Controllers/` (все файлы)
- `app/Models/User.php`
- `resources/views/` (все файлы)
- `public/css/app.css`
- `database/migrations/` (все файлы)

### 3. Настроить .env
```
APP_NAME=Лакомка
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# или для MySQL (XAMPP):
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=lakomka
# DB_USERNAME=root
# DB_PASSWORD=
```

### 4. Настроить сессии в config/session.php
```php
'driver' => 'database',   // или 'file' — проще для старта
```

Или прямо в .env:
```
SESSION_DRIVER=file
```

### 5. Выполнить команды
```bash
# Сгенерировать APP_KEY
php artisan key:generate

# Запустить миграции
php artisan migrate

# Запустить сервер
php artisan serve
```

### 6. Открыть сайт
```
http://localhost:8000
```

Админ-панель: http://localhost:8000/admin
(ссылка ⚙ admin есть в футере)

---

## Структура страниц

| URL               | Страница          |
|-------------------|-------------------|
| /                 | Главная           |
| /catalog          | Каталог           |
| /cart             | Корзина           |
| /articles         | Статьи            |
| /promos           | Акции             |
| /reviews          | Отзывы            |
| /faq              | FAQ               |
| /contacts         | Контакты          |
| /about            | О нас             |
| /login            | Вход              |
| /register         | Регистрация       |
| /account          | Личный кабинет    |
| /admin            | Админ-панель      |

---

## Структура файлов

```
app/
  Http/Controllers/
    Admin/
      AdminController.php
    HomeController.php        ← данные о товарах (static)
    CatalogController.php     ← фильтрация и поиск
    CartController.php        ← сессионная корзина
    AuthController.php        ← вход / регистрация / выход
    ReviewController.php
    ArticleController.php
    PromoController.php
    FaqController.php
    ContactController.php
    AboutController.php
    AccountController.php
  Models/
    User.php

resources/views/
  layouts/
    app.blade.php             ← основной layout
    admin.blade.php           ← layout для админки
  partials/
    nav.blade.php             ← навигация
    footer.blade.php          ← футер
  pages/                      ← публичные страницы
  auth/                       ← вход и регистрация
  admin/                      ← панель администратора

public/css/
  app.css                     ← весь CSS дизайна

routes/
  web.php                     ← все маршруты
```

---

## Следующие шаги (по ТЗ)

- [ ] Подключить реальную БД (миграции для товаров, заказов, отзывов)
- [ ] Наполнить CRUD в AdminController
- [ ] Добавить middleware `is_admin` для защиты /admin
- [ ] Подключить оплату (заглушка на форме)
- [ ] SEO: мета-теги через переменные из контроллера
- [ ] Sitemap и robots.txt
