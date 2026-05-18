@extends('layouts.app')
@section('content')
<div class="section">
    <div class="section-header">
        <div><h2 class="section-title">Личный кабинет</h2></div>
        @if(auth()->user()->is_admin)
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
            ⚙ Панель администратора
        </a>
        @endif
    </div>

    <div class="account-grid">
        {{-- Сайдбар --}}
        <div class="account-sidebar">
            <div class="account-profile">
                <div class="account-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <div class="account-name">{{ auth()->user()->name }}</div>
                <div class="account-email">{{ auth()->user()->email }}</div>
                @if(auth()->user()->is_admin)
                <div style="margin-top:8px">
                    <span style="background:var(--green-pale);color:var(--green);font-size:11px;padding:3px 10px;border-radius:20px;font-weight:500">👑 Администратор</span>
                </div>
                @endif
            </div>

            <a href="{{ route('account.orders') }}"
               class="account-menu-btn {{ request()->routeIs('account.orders') ? 'active' : '' }}">
                📦 История заказов
            </a>
            <a href="{{ route('account.profile') }}"
               class="account-menu-btn {{ request()->routeIs('account.profile') ? 'active' : '' }}">
                👤 Мои данные
            </a>
            <a href="{{ route('account.addresses') }}"
               class="account-menu-btn {{ request()->routeIs('account.addresses') ? 'active' : '' }}">
                📍 Адреса доставки
            </a>

            @if(auth()->user()->is_admin)
            <a href="{{ route('admin.dashboard') }}" class="account-menu-btn"
               style="color:var(--green);border-color:var(--green-soft);background:var(--green-pale)">
                ⚙ Админ-панель
            </a>
            @endif

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="account-menu-btn"
                        style="width:100%;color:var(--coral);border-color:var(--coral)">
                    Выйти из аккаунта
                </button>
            </form>
        </div>

        {{-- Контент страницы --}}
        <div>
            @if(session('success'))
            <div class="alert alert-success" style="margin-bottom:16px">{{ session('success') }}</div>
            @endif
            @if($errors->any())
            <div class="alert alert-error" style="margin-bottom:16px">{{ $errors->first() }}</div>
            @endif

            @yield('account-content')
        </div>
    </div>
</div>
@endsection
