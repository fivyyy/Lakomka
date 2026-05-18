@extends('layouts.app')
@section('title', 'Вход')
@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-card-top">
            <div class="auth-emoji">🐾</div>
            <div class="auth-title">Добро пожаловать</div>
            <div class="auth-subtitle">Войдите, чтобы управлять заказами и получать бонусы</div>
        </div>
        <div class="auth-body">
            @if($errors->any())
            <div class="auth-error">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('login.post') }}">
                @csrf
                <div class="auth-field">
                    <label class="auth-label">Email</label>
                    <input class="auth-input" type="email" name="email" value="{{ old('email') }}" placeholder="your@email.ru" required/>
                </div>
                <div class="auth-field">
                    <label class="auth-label">Пароль</label>
                    <input class="auth-input" type="password" name="password" placeholder="Введите пароль" required/>
                </div>
                <div style="display:flex;justify-content:flex-end;margin-bottom:20px;margin-top:-8px">
                    <span style="font-size:12px;color:var(--green);cursor:pointer;font-weight:500">Забыли пароль?</span>
                </div>
                <button type="submit" class="auth-btn">Войти в аккаунт</button>
            </form>
            <div class="auth-divider"><span>или войдите через</span></div>
            <div class="auth-social">
                <button class="auth-social-btn">
                    <svg width="16" height="16" viewBox="0 0 24 24"><path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/><path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/><path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/><path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/></svg>
                    Google
                </button>
                <button class="auth-social-btn">ВКонтакте</button>
            </div>
            <div class="auth-footer-text">
                Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
            </div>
        </div>
    </div>
</div>
@endsection
