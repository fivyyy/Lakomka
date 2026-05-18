@extends('layouts.app')
@section('title', 'Регистрация')
@section('content')
<div class="auth-wrap">
    <div class="auth-card">
        <div class="auth-card-top">
            <div class="auth-emoji">🌿</div>
            <div class="auth-title">Создать аккаунт</div>
            <div class="auth-subtitle">Регистрация займёт меньше минуты</div>
        </div>
        <div class="auth-body">
            @if($errors->any())
            <div class="auth-error">{{ $errors->first() }}</div>
            @endif
            <form method="POST" action="{{ route('register.post') }}">
                @csrf
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
                    <div class="auth-field">
                        <label class="auth-label">Имя</label>
                        <input class="auth-input" type="text" name="name" value="{{ old('name') }}" placeholder="Иван" required/>
                    </div>
                    <div class="auth-field">
                        <label class="auth-label">Фамилия</label>
                        <input class="auth-input" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Иванов"/>
                    </div>
                </div>
                <div class="auth-field">
                    <label class="auth-label">Email</label>
                    <input class="auth-input" type="email" name="email" value="{{ old('email') }}" placeholder="your@email.ru" required/>
                </div>
                <div class="auth-field">
                    <label class="auth-label">Телефон</label>
                    <input class="auth-input" type="tel" name="phone" value="{{ old('phone') }}" placeholder="+7 (___) ___-__-__"/>
                </div>
                <div class="auth-field">
                    <label class="auth-label">Пароль</label>
                    <input class="auth-input" type="password" name="password" placeholder="Минимум 8 символов" required/>
                </div>
                <div class="auth-field">
                    <label class="auth-label">Повторите пароль</label>
                    <input class="auth-input" type="password" name="password_confirmation" placeholder="Повторите пароль" required/>
                </div>
                <div class="auth-checkbox">
                    <input type="checkbox" id="agreeTerms" name="agree" required/>
                    <label for="agreeTerms">Я принимаю <a href="#">условия соглашения</a> и <a href="#">политику конфиденциальности</a></label>
                </div>
                <div class="auth-checkbox">
                    <input type="checkbox" id="agreePromo" name="subscribe" checked/>
                    <label for="agreePromo">Хочу получать новости об акциях и скидках</label>
                </div>
                <button type="submit" class="auth-btn">Создать аккаунт</button>
            </form>
            <div class="auth-footer-text">
                Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
            </div>
        </div>
    </div>
</div>
@endsection
