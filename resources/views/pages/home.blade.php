@extends('layouts.app')
@section('title', 'Главная')

@section('content')
{{-- HERO --}}
<div class="hero">
    <div>
        <div class="hero-eyebrow"><span></span>Натуральные ингредиенты</div>
        <h1>Вкусно<br>и <em>полезно</em><br>для питомцев</h1>
        <p class="hero-desc">Лакомства для кошек, собак и грызунов без искусственных добавок. Только проверенные составы и производители.</p>
        <div style="display:flex;gap:12px">
            <a href="{{ route('catalog') }}" class="btn btn-primary">Перейти в каталог</a>
            <a href="{{ route('promos') }}"  class="btn btn-secondary">Посмотреть акции</a>
        </div>
        <div class="hero-stats">
            <div><div class="stat-num">12K+</div><div class="stat-label">Довольных клиентов</div></div>
            <div><div class="stat-num">200+</div><div class="stat-label">Товаров в каталоге</div></div>
            <div><div class="stat-num">4.8★</div><div class="stat-label">Средняя оценка</div></div>
        </div>
    </div>
    <div class="hero-visual">
        <div class="hero-card-main">
            <div class="hero-pet">🐱</div>
            <div class="hero-tags">
                <span class="hero-tag">🌿 Без консервантов</span>
                <span class="hero-tag">✓ Ветконтроль</span>
                <span class="hero-tag">🚚 Быстро</span>
            </div>
        </div>
        <div class="hero-badge">Скидки до 30% →</div>
    </div>
</div>

{{-- TRUST STRIP --}}
<div class="trust-strip">
    <div class="trust-inner">
        <div class="trust-item"><span>🚚</span> Бесплатная доставка от 800 ₽</div>
        <div style="color:rgba(255,255,255,.3)">·</div>
        <div class="trust-item"><span>🔄</span> Возврат за 14 дней</div>
        <div style="color:rgba(255,255,255,.3)">·</div>
        <div class="trust-item"><span>🌿</span> Только натуральный состав</div>
        <div style="color:rgba(255,255,255,.3)">·</div>
        <div class="trust-item"><span>⭐</span> 4.8 из 5 — рейтинг покупателей</div>
    </div>
</div>

{{-- POPULAR PRODUCTS --}}
<div class="section">
    <div class="section-header">
        <div>
            <h2 class="section-title">Популярные товары</h2>
            <p class="section-sub">Хиты продаж этого месяца</p>
        </div>
        <a href="{{ route('catalog') }}" class="section-link">Весь каталог →</a>
    </div>
    <div class="products-grid">
        @foreach($products as $product)
        <div class="product-card" onclick="window.location='{{ route('catalog.show', $product['id']) }}'" style="cursor:pointer">
            <div class="product-img product-img-{{ $product['color'] }}">
                <span class="product-badge badge-{{ $product['badge_type'] }}">{{ $product['badge'] }}</span>
                {{ $product['emoji'] }}
            </div>
            <div class="product-body">
                <div class="product-name">{{ $product['name'] }}</div>
                <div class="product-sub">{{ $product['sub'] }}</div>
                <div class="product-footer">
                    <div>
                        @if($product['price_old'])
                        <span class="price-old">{{ $product['price_old'] }} ₽</span>
                        @endif
                        <span class="price {{ $product['price_old'] ? 'price-sale' : '' }}">{{ $product['price'] }} ₽</span>
                    </div>
                    <form method="POST" action="{{ route('cart.add') }}" onclick="event.stopPropagation()">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product['id'] }}">
                        <input type="hidden" name="name" value="{{ $product['name'] }}">
                        <input type="hidden" name="price" value="{{ $product['price'] }}">
                        <input type="hidden" name="emoji" value="{{ $product['emoji'] }}">
                        <input type="hidden" name="color" value="{{ $product['color'] }}">
                        <input type="hidden" name="sub" value="{{ $product['sub'] }}">
                        <button type="submit" class="add-btn">+</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
