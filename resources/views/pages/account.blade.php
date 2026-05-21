@extends('layouts.app')
@section('title', 'Личный кабинет')
@section('content')
<div class="section">
    <div class="section-header"><div><h2 class="section-title">Личный кабинет</h2></div></div>
    <div class="account-grid">
        <div class="account-sidebar">
            <div class="account-profile">
                <div class="account-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 2)) }}</div>
                <div class="account-name">{{ auth()->user()->name }}</div>
                <div class="account-email">{{ auth()->user()->email }}</div>
            </div>
            <a href="{{ route('account.orders') }}"   class="account-menu-btn {{ request()->routeIs('account.orders') ? 'active' : '' }}">📦 История заказов</a>
            <a href="{{ route('account.profile') }}"  class="account-menu-btn {{ request()->routeIs('account.profile') ? 'active' : '' }}">👤 Мои данные</a>
            <a href="{{ route('account.addresses') }}" class="account-menu-btn {{ request()->routeIs('account.addresses') ? 'active' : '' }}">📍 Адреса доставки</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="account-menu-btn" style="width:100%;color:var(--coral);border-color:var(--coral)">Выйти</button>
            </form>
        </div>
        <div class="orders-list">
            <div style="font-size:14px;font-weight:500;margin-bottom:16px">История заказов</div>
            <div class="order-card"><div class="order-head"><div><div class="order-id">Заказ #2847</div><div class="order-date">28 апреля 2026</div></div><span class="order-status status-delivery">В доставке</span></div><div class="order-items-text">Мягкие подушечки × 2, Рыбные снеки × 1</div><div class="order-total">847 ₽</div></div>
            <div class="order-card"><div class="order-head"><div><div class="order-id">Заказ #2791</div><div class="order-date">15 апреля 2026</div></div><span class="order-status status-done">Доставлен</span></div><div class="order-items-text">Сушёная говядина × 3</div><div class="order-total">567 ₽</div></div>
        </div>
    </div>
</div>
@endsection
