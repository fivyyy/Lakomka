<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>Админ — @yield('title', 'Панель управления') | Лакомка</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body style="margin:0">

<div class="admin-layout" style="min-height:100vh">
    {{-- Сайдбар --}}
    <div class="admin-sidebar">
        <div class="admin-logo">
            <div class="admin-logo-badge">
                <span style="font-size:14px">🐾</span>
                <span class="admin-logo-text">Лакомка</span>
            </div>
            <div class="admin-logo-sub">Панель администратора</div>
        </div>

        <div class="admin-nav-section">Основное</div>
        <a href="{{ route('admin.dashboard') }}" class="admin-nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <span class="admin-nav-icon">📊</span>Дашборд
        </a>
        <a href="{{ route('admin.orders') }}" class="admin-nav-item {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
            <span class="admin-nav-icon">📦</span>Заказы
        </a>
        <a href="{{ route('admin.products') }}" class="admin-nav-item {{ request()->routeIs('admin.products') ? 'active' : '' }}">
            <span class="admin-nav-icon">🛍️</span>Товары
        </a>

        <div class="admin-nav-section">Контент</div>
        <a href="{{ route('admin.articles') }}" class="admin-nav-item {{ request()->routeIs('admin.articles') ? 'active' : '' }}">
            <span class="admin-nav-icon">📝</span>Статьи
        </a>
        <a href="{{ route('admin.promos') }}" class="admin-nav-item {{ request()->routeIs('admin.promos') ? 'active' : '' }}">
            <span class="admin-nav-icon">🎁</span>Акции
        </a>
        <a href="{{ route('admin.reviews') }}" class="admin-nav-item {{ request()->routeIs('admin.reviews') ? 'active' : '' }}">
            <span class="admin-nav-icon">⭐</span>Отзывы
        </a>

        <div class="admin-nav-section">Пользователи</div>
        <a href="{{ route('admin.users') }}" class="admin-nav-item {{ request()->routeIs('admin.users') ? 'active' : '' }}">
            <span class="admin-nav-icon">👥</span>Клиенты
        </a>

        <div style="margin-top:24px;padding-top:12px;border-top:1px solid rgba(255,255,255,.08)">
            <a href="{{ route('home') }}" class="admin-nav-item">
                <span class="admin-nav-icon">←</span>На сайт
            </a>
        </div>
    </div>

    {{-- Основной контент --}}
    <div class="admin-main">
        <div class="admin-topbar">
            <div class="admin-topbar-title">@yield('title', 'Дашборд')</div>
            <div class="admin-topbar-right">
                <span style="font-size:12px;color:var(--muted)">{{ now()->isoFormat('dd, D MMM Y') }}</span>
                <div style="display:flex;align-items:center;gap:8px">
                    <div class="admin-user-avatar">АД</div>
                    <div>
                        <div style="font-size:13px;font-weight:500;color:var(--text)">Администратор</div>
                        <div style="font-size:11px;color:var(--light)">admin@lakomka.ru</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="admin-content">
            @yield('content')
        </div>
    </div>
</div>

</body>
</html>
