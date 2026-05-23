HTML
@php
    // Упрощённая и безопасная проверка типа данных без сложных конструкций
    $isObj = is_object($product);
    
    // Если контроллер по ошибке передал коллекцию (массив массивов) вместо одного товара
    if (!$isObj && isset($product[0])) {
        $reqId = request()->route('id') ?: request()->id;
        foreach ($product as $item) {
            if (is_array($item) && isset($item['id']) && $item['id'] == $reqId) {
                $product = $item;
                break;
            } elseif (is_object($item) && isset($item->id) && $item->id == $reqId) {
                $product = $item;
                $isObj = true;
                break;
            }
        }
    }

    // Финально определяем переменные, чтобы Blade не ругался на Property/Key not exist
    $pName        = $isObj ? ($product->name ?? '') : ($product['name'] ?? '');
    $pDesc        = $isObj ? ($product->description ?? '') : ($product['description'] ?? '');
    $pColor       = $isObj ? ($product->color ?? 'green') : ($product['color'] ?? 'green');
    $pBadge       = $isObj ? ($product->badge ?? '') : ($product['badge'] ?? '');
    $pBadgeType   = $isObj ? ($product->badge_type ?? 'hit') : ($product['badge_type'] ?? 'hit');
    $pEmoji       = $isObj ? ($product->emoji ?? '🐾') : ($product['emoji'] ?? '🐾');
    $pSub         = $isObj ? ($product->sub ?? '') : ($product['sub'] ?? '');
    $pPrice       = $isObj ? ($product->price ?? 0) : ($product['price'] ?? 0);
    $pPriceOld    = $isObj ? ($product->price_old ?? null) : ($product['price_old'] ?? null);
    $pAnimal      = $isObj ? ($product->animal ?? '—') : ($product['animal'] ?? '—');
    $pWeight      = $isObj ? ($product->weight ?? null) : ($product['weight'] ?? null);
    $pAge         = $isObj ? ($product->age ?? 'Любой') : ($product['age'] ?? 'Любой');
    $pFeatures    = $isObj ? ($product->features ?? []) : ($product['features'] ?? []);
    $pId          = $isObj ? ($product->id ?? 0) : ($product['id'] ?? 0);
    $pComp        = $isObj ? ($product->composition ?? '') : ($product['composition'] ?? '');
@endphp

@extends('layouts.app')
@section('title', $pName)
@section('description', $pDesc)

@section('content')
<div class="section">

    {{-- Breadcrumb --}}
    <div class="product-breadcrumb">
        <a href="{{ route('home') }}">Главная</a>
        <span>›</span>
        <a href="{{ route('catalog') }}">Каталог</a>
        <span>›</span>
        <span>{{ $pName }}</span>
    </div>

    {{-- Основная карточка товара --}}
    <div class="product-single-grid">

        {{-- Левая колонка: Фото и Характеристики --}}
        <div class="product-media-column">
            <div class="product-img product-img-{{ $pColor }} product-main-img">
                @if($pBadge)
                <span class="product-badge badge-{{ $pBadgeType }} product-badge-large">
                    {{ $pBadge }}
                </span>
                @endif
                {{ $pEmoji }}
            </div>

            {{-- Характеристики --}}
            <div class="product-specs-card">
                <div class="product-specs-title">Характеристики</div>
                <div class="product-specs-list">
                    <div class="product-spec-item">
                        <span class="spec-label">Для животных</span>
                        <span class="spec-value">{{ $pAnimal }}</span>
                    </div>
                    <div class="product-spec-item">
                        <span class="spec-label">Вес упаковки</span>
                        <span class="spec-value">{{ $pWeight ?: ($pSub ?: '—') }}</span>
                    </div>
                    <div class="product-spec-item border-none">
                        <span class="spec-label">Возраст</span>
                        <span class="spec-value">{{ $pAge }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Правая колонка: Информация о товаре --}}
        <div class="product-info-column">
            <div class="product-meta-badges">
                @if($pBadge)
                <span class="product-badge badge-{{ $pBadgeType }} static-badge">
                    {{ $pBadge }}
                </span>
                @endif
                <span class="product-subtext">{{ $pSub }}</span>
            </div>

            <h1 class="product-title-heading">
                {{ $pName }}
            </h1>

            {{-- Цена --}}
            <div class="product-price-row">
                @if($pPriceOld)
                <span class="product-price-old">{{ $pPriceOld }} ₽</span>
                @endif
                <span class="product-price-current {{ $pPriceOld ? 'has-sale' : '' }}">
                    {{ $pPrice }} ₽
                </span>
                @if($pPriceOld && $pPriceOld > 0)
                <span class="product-sale-badge">
                    Скидка {{ round((1 - $pPrice / $pPriceOld) * 100) }}%
                </span>
                @endif
            </div>

            {{-- Описание --}}
            <p class="product-description-text">
                {{ $pDesc }}
            </p>

            {{-- Преимущества --}}
            @if(!empty($pFeatures) && is_array($pFeatures))
            <div class="product-features-wrap">
                @foreach($pFeatures as $feature)
                <span class="product-feature-tag">
                    ✓ {{ $feature }}
                </span>
                @endforeach
            </div>
            @endif

            {{-- Количество и кнопка --}}
            <div class="product-purchase-row">
                <div class="qty-counter">
                    <button onclick="changeQty(-1)" class="qty-counter-btn">−</button>
                    <span id="qtyVal" class="qty-counter-val">1</span>
                    <button onclick="changeQty(1)" class="qty-counter-btn">+</button>
                </div>

                <form method="POST" action="{{ route('cart.add') }}" id="addToCartForm" class="cart-form-submit">
                    @csrf
                    <input type="hidden" name="id"    value="{{ $pId }}">
                    <input type="hidden" name="name"  value="{{ $pName }}">
                    <input type="hidden" name="price" value="{{ $pPrice }}">
                    <input type="hidden" name="emoji" value="{{ $pEmoji }}">
                    <input type="hidden" name="color" value="{{ $pColor }}">
                    <input type="hidden" name="sub"   value="{{ $pSub }}">
                    <input type="hidden" name="qty"   id="qtyInput" value="1">
                    <button type="submit" class="btn btn-primary product-submit-btn">
                        🛒 Добавить в корзину
                    </button>
                </form>
            </div>

            {{-- Доставка --}}
            <div class="product-delivery-info">
                <div class="delivery-info-item">
                    <span>🚚</span> Доставка 1–7 дней
                </div>
                <div class="delivery-info-item text-green">
                    <span>✓</span> Бесплатно от 800 ₽
                </div>
                <div class="delivery-info-item">
                    <span>🔄</span> Возврат 14 дней
                </div>
            </div>
        </div>
    </div>

    {{-- Состав --}}
    @if($pComp)
    <div class="product-composition-box">
        <div class="composition-title">Состав</div>
        <p class="composition-text">{{ $pComp }}</p>
    </div>
    @endif

    {{-- Похожие товары --}}
    @if(!empty($related))
    <div>
        <div class="section-header">
            <div>
                <h2 class="section-title">Похожие товары</h2>
                <p class="section-sub">Вам также может понравиться</p>
            </div>
            <a href="{{ route('catalog') }}" class="section-link">Весь каталог →</a>
        </div>
        
        <div class="products-grid">
            @foreach($related as $r)
            @php 
                $rObj = is_object($r);
                $rId = $rObj ? ($r->id ?? 0) : ($r['id'] ?? 0);
            @endphp
            <div class="product-card" onclick="window.location='{{ route('catalog.show', $rId) }}'">
                <div class="product-img product-img-{{ $rObj ? ($r->color ?? 'green') : ($r['color'] ?? 'green') }}">
                    <span class="product-badge badge-{{ $rObj ? ($r->badge_type ?? 'hit') : ($r['badge_type'] ?? 'hit') }}">
                        {{ $rObj ? ($r->badge ?? '') : ($r['badge'] ?? '') }}
                    </span>
                    {{ $rObj ? ($r->emoji ?? '🐾') : ($r['emoji'] ?? '🐾') }}
                </div>
                <div class="product-body">
                    <div class="product-name">{{ $rObj ? ($r->name ?? '') : ($r['name'] ?? '') }}</div>
                    <div class="product-sub">{{ $rObj ? ($r->sub ?? '') : ($r['sub'] ?? '') }}</div>
                    <div class="product-footer">
                        <div>
                            @if($rObj ? ($r->price_old ?? null) : ($r['price_old'] ?? null))
                            <span class="price-old">{{ $rObj ? $r->price_old : $r['price_old'] }} ₽</span>
                            @endif
                            <span class="price {{ ($rObj ? ($r->price_old ?? null) : ($r['price_old'] ?? null)) ? 'price-sale' : '' }}">
                                {{ $rObj ? ($r->price ?? 0) : ($r['price'] ?? 0) }} ₽
                            </span>
                        </div>
                        <form method="POST" action="{{ route('cart.add') }}" onclick="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="id"    value="{{ $rId }}">
                            <input type="hidden" name="name"  value="{{ $rObj ? ($r->name ?? '') : ($r['name'] ?? '') }}">
                            <input type="hidden" name="price" value="{{ $rObj ? ($r->price ?? 0) : ($r['price'] ?? 0) }}">
                            <input type="hidden" name="emoji" value="{{ $rObj ? ($r->emoji ?? '🐾') : ($r['emoji'] ?? '🐾') }}">
                            <input type="hidden" name="color" value="{{ $rObj ? ($r->color ?? 'green') : ($r['color'] ?? 'green') }}">
                            <input type="hidden" name="sub"   value="{{ $rObj ? ($r->sub ?? '') : ($r['sub'] ?? '') }}">
                            <button type="submit" class="add-btn">+</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<script>
let qty = 1;
function changeQty(d) {
    qty = Math.max(1, qty + d);
    document.getElementById('qtyVal').textContent = qty;
    document.getElementById('qtyInput').value = qty;
}
</script>
@endsection