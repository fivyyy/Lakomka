@extends('layouts.app')
@section('title', 'О нас')
@section('content')
<div class="section">
    <div class="about-hero">
        <div>
            <h2>Лакомка — с заботой<br>о питомцах с 2018 года</h2>
            <p>Мы помогаем владельцам кошек, собак и грызунов выбирать только лучшие натуральные лакомства. Наша миссия — здоровье и счастье каждого животного.</p>
        </div>
        <div class="about-emoji">🐾</div>
    </div>
    <div class="about-stats">
        <div class="about-stat"><div class="about-stat-num">12 000+</div><div class="about-stat-label">Довольных клиентов</div></div>
        <div class="about-stat"><div class="about-stat-num">200+</div><div class="about-stat-label">Товаров в каталоге</div></div>
        <div class="about-stat"><div class="about-stat-num">7 лет</div><div class="about-stat-label">На рынке</div></div>
    </div>
    <div class="about-cards">
        <div class="about-card"><div class="about-card-icon">🌿</div><div class="about-card-title">Только натуральные составы</div><div class="about-card-text">Тщательно отбираем производителей. Никаких искусственных добавок, красителей и консервантов.</div></div>
        <div class="about-card"><div class="about-card-icon">🏥</div><div class="about-card-title">Ветеринарный контроль</div><div class="about-card-text">Все товары сертифицированы и проверены ветеринарными специалистами.</div></div>
        <div class="about-card"><div class="about-card-icon">🚚</div><div class="about-card-title">Быстрая доставка</div><div class="about-card-text">По Москве — 1–2 дня, по России — 3–7 дней. Бесплатно от 800 ₽.</div></div>
        <div class="about-card"><div class="about-card-icon">💚</div><div class="about-card-title">Забота о природе</div><div class="about-card-text">Экологичная упаковка и поддержка приютов для животных.</div></div>
    </div>
</div>
@endsection
