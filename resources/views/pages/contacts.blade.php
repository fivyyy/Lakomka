@extends('layouts.app')
@section('title', 'Контакты')
@section('content')
<div class="section">
    <div class="section-header"><div><h2 class="section-title">Контакты</h2><p class="section-sub">Будем рады помочь</p></div></div>
    <div class="contacts-grid">
        <div class="contact-cards">
            <div class="contact-card"><div class="contact-icon">📞</div><div><div class="contact-label">Телефон</div><div class="contact-val">+7 (800) 555-35-35</div><div class="contact-note">Бесплатно · Пн–Пт 9:00–20:00</div></div></div>
            <div class="contact-card"><div class="contact-icon">✉️</div><div><div class="contact-label">Email</div><div class="contact-val">info@lakomka.ru</div><div class="contact-note">Ответ в течение 2 часов</div></div></div>
            <div class="contact-card"><div class="contact-icon">📍</div><div><div class="contact-label">Адрес</div><div class="contact-val">Москва, ул. Пушкина, 12</div><div class="contact-note">Самовывоз: Пн–Сб 10:00–19:00</div></div></div>
            <div class="contact-card"><div class="contact-icon">💬</div><div><div class="contact-label">Мессенджеры</div><div class="contact-val">WhatsApp · Telegram</div><div class="contact-note">@lakomka_pets</div></div></div>
        </div>
        <div class="contact-form">
            <div class="form-title">Написать нам</div>
            <form method="POST" action="{{ route('contacts.send') }}">
                @csrf
                <div class="form-group"><label class="form-label">Имя</label><input class="form-input" name="name" placeholder="Ваше имя" required/></div>
                <div class="form-group"><label class="form-label">Email или телефон</label><input class="form-input" name="contact" placeholder="Контакт для связи" required/></div>
                <div class="form-group"><label class="form-label">Сообщение</label><textarea class="form-input" name="message" placeholder="Чем можем помочь?" required></textarea></div>
                <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:13px;font-size:14px">Отправить сообщение</button>
            </form>
        </div>
    </div>
</div>
@endsection
