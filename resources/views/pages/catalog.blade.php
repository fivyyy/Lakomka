@extends('layouts.app')
@section('title', 'Каталог')

@section('content')
<div class="section">
    <div class="section-header">
        <div>
            <h2 class="section-title">Каталог</h2>
            <p class="section-sub">200+ натуральных лакомств</p>
        </div>
    </div>

    <div class="catalog-filters">
        <div class="filter-pills">
            <a href="{{ route('catalog') }}"              class="pill {{ !request('category') ? 'active' : '' }}">Все</a>
            <a href="{{ route('catalog', ['category'=>'cats']) }}"    class="pill {{ request('category')=='cats' ? 'active' : '' }}">🐱 Кошки</a>
            <a href="{{ route('catalog', ['category'=>'dogs']) }}"    class="pill {{ request('category')=='dogs' ? 'active' : '' }}">🐶 Собаки</a>
            <a href="{{ route('catalog', ['category'=>'rodents']) }}" class="pill {{ request('category')=='rodents' ? 'active' : '' }}">🐹 Грызуны</a>
            <a href="{{ route('catalog', ['category'=>'sale']) }}"    class="pill {{ request('category')=='sale' ? 'active' : '' }}">🔥 Акции</a>
            <a href="{{ route('catalog', ['category'=>'hit']) }}"     class="pill {{ request('category')=='hit' ? 'active' : '' }}">⭐ Хиты</a>
        </div>
        <div class="search-box">
            <span class="search-icon">🔍</span>
            <form method="GET" action="{{ route('catalog') }}">
                <input name="q" value="{{ request('q') }}" placeholder="Поиск по каталогу..."/>
            </form>
        </div>
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
