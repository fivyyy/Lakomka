@extends('pages.account.layout')
@section('title', 'Мои данные')

@section('account-content')
<div style="font-size:16px;font-weight:500;color:var(--text);margin-bottom:20px">Мои данные</div>

<form method="POST" action="{{ route('account.profile.update') }}">
    @csrf

    <div style="background:var(--white);border-radius:20px;padding:28px;box-shadow:var(--shadow)">

        <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:16px">
            Личная информация
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px">
            <div class="form-group">
                <label class="form-label">Имя *</label>
                <input class="form-input" type="text" name="name"
                       value="{{ old('name', auth()->user()->name) }}"
                       placeholder="Ваше имя" required/>
            </div>
            <div class="form-group">
                <label class="form-label">Телефон</label>
                <input class="form-input" type="tel" name="phone"
                       value="{{ old('phone', auth()->user()->phone) }}"
                       placeholder="+7 (___) ___-__-__"/>
            </div>
        </div>

        <div class="form-group" style="margin-bottom:24px">
            <label class="form-label">Email *</label>
            <input class="form-input" type="email" name="email"
                   value="{{ old('email', auth()->user()->email) }}"
                   placeholder="your@email.ru" required/>
        </div>

        <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:16px">
            Сменить пароль <span style="font-weight:400;text-transform:none;letter-spacing:0">(оставьте пустым если не хотите менять)</span>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:24px">
            <div class="form-group">
                <label class="form-label">Новый пароль</label>
                <input class="form-input" type="password" name="password"
                       placeholder="Минимум 8 символов"/>
            </div>
            <div class="form-group">
                <label class="form-label">Повторите пароль</label>
                <input class="form-input" type="password" name="password_confirmation"
                       placeholder="Повторите пароль"/>
            </div>
        </div>

        <div style="display:flex;gap:12px;align-items:center">
            <button type="submit" class="btn btn-primary" style="padding:11px 24px">
                Сохранить изменения
            </button>
            <span style="font-size:12px;color:var(--light)">
                Зарегистрирован: {{ auth()->user()->created_at->format('d.m.Y') }}
            </span>
        </div>
    </div>
</form>
@endsection
