@extends('layouts.app')
@section('title', $product['name'])
@section('description', $product['description'])

@section('content')
<div class="section">

    {{-- Breadcrumb --}}
    <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted);margin-bottom:28px">
        <a href="{{ route('home') }}" style="color:var(--muted);text-decoration:none">Главная</a>
        <span>›</span>
        <a href="{{ route('catalog') }}" style="color:var(--muted);text-decoration:none">Каталог</a>
        <span>›</span>
        <span style="color:var(--text)">{{ $product['name'] }}</span>
    </div>

    {{-- Основная карточка товара --}}
    <div style="display:grid;grid-template-columns:420px 1fr;gap:40px;margin-bottom:48px">

        {{-- Фото --}}
        <div>
            <div class="product-img product-img-{{ $product['color'] }}"
                 style="height:360px;border-radius:24px;font-size:120px;position:relative">
                <span class="product-badge badge-{{ $product['badge_type'] }}"
                      style="font-size:13px;padding:6px 14px">{{ $product['badge'] }}</span>
                {{ $product['emoji'] }}
            </div>

            {{-- Характеристики --}}
            <div style="background:var(--white);border-radius:16px;padding:20px;box-shadow:var(--shadow);margin-top:16px">
                <div style="font-size:11px;font-weight:500;text-transform:uppercase;letter-spacing:.06em;color:var(--muted);margin-bottom:12px">Характеристики</div>
                <div style="display:flex;flex-direction:column;gap:8px">
                    <div style="display:flex;justify-content:space-between;font-size:13px;padding-bottom:8px;border-bottom:1px solid var(--border)">
                        <span style="color:var(--muted)">Для животных</span>
                        <span style="font-weight:500">{{ $product['animal'] }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;padding-bottom:8px;border-bottom:1px solid var(--border)">
                        <span style="color:var(--muted)">Вес упаковки</span>
                        <span style="font-weight:500">{{ $product['weight'] }}</span>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:13px">
                        <span style="color:var(--muted)">Возраст</span>
                        <span style="font-weight:500">{{ $product['age'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Информация --}}
        <div>
            <div style="display:flex;gap:8px;margin-bottom:12px">
                <span class="product-badge badge-{{ $product['badge_type'] }}" style="position:static;font-size:12px;padding:5px 12px">
                    {{ $product['badge'] }}
                </span>
                <span style="font-size:12px;color:var(--muted);padding:5px 0">{{ $product['sub'] }}</span>
            </div>

            <h1 style="font-family:'Playfair Display',serif;font-size:32px;color:var(--text);margin-bottom:16px;line-height:1.2">
                {{ $product['name'] }}
            </h1>

            {{-- Цена --}}
            <div style="display:flex;align-items:baseline;gap:12px;margin-bottom:20px">
                @if($product['price_old'])
                <span style="font-size:20px;color:var(--light);text-decoration:line-through">{{ $product['price_old'] }} ₽</span>
                @endif
                <span style="font-family:'Playfair Display',serif;font-size:40px;color:{{ $product['price_old'] ? 'var(--coral)' : 'var(--text)' }}">
                    {{ $product['price'] }} ₽
                </span>
                @if($product['price_old'])
                <span style="background:var(--coral);color:#fff;font-size:12px;padding:4px 10px;border-radius:20px;font-weight:500">
                    Скидка {{ round((1 - $product['price'] / $product['price_old']) * 100) }}%
                </span>
                @endif
            </div>

            {{-- Описание --}}
            <p style="font-size:15px;color:var(--muted);line-height:1.75;margin-bottom:24px">
                {{ $product['description'] }}
            </p>

            {{-- Преимущества --}}
                        @if(!empty($product->features))
                        <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:28px">
                            @foreach($product->features as $feature)
                            <span style="background:var(--green-pale);color:var(--green);font-size:12px;padding:6px 14px;border-radius:20px;font-weight:500">
                                ✓ {{ $feature }}
                            </span>
                            @endforeach
                        </div>
                        @endif

            {{-- Количество и кнопка --}}
            <div style="display:flex;gap:12px;align-items:center;margin-bottom:20px">
                <div style="display:flex;align-items:center;gap:0;border:1.5px solid var(--border);border-radius:12px;overflow:hidden">
                    <button onclick="changeQty(-1)"
                            style="width:44px;height:48px;border:none;background:var(--white);font-size:20px;cursor:pointer;color:var(--text)">−</button>
                    <span id="qtyVal" style="min-width:44px;text-align:center;font-size:16px;font-weight:500">1</span>
                    <button onclick="changeQty(1)"
                            style="width:44px;height:48px;border:none;background:var(--white);font-size:20px;cursor:pointer;color:var(--text)">+</button>
                </div>

                <form method="POST" action="{{ route('cart.add') }}" id="addToCartForm" style="flex:1">
                    @csrf
                    <input type="hidden" name="id"    value="{{ $product['id'] }}">
                    <input type="hidden" name="name"  value="{{ $product['name'] }}">
                    <input type="hidden" name="price" value="{{ $product['price'] }}">
                    <input type="hidden" name="emoji" value="{{ $product['emoji'] }}">
                    <input type="hidden" name="color" value="{{ $product['color'] }}">
                    <input type="hidden" name="sub"   value="{{ $product['sub'] }}">
                    <input type="hidden" name="qty"   id="qtyInput" value="1">
                    <button type="submit" class="btn btn-primary"
                            style="width:100%;justify-content:center;padding:14px;font-size:15px">
                        🛒 Добавить в корзину
                    </button>
                </form>
            </div>

            {{-- Доставка --}}
            <div style="background:var(--warm);border-radius:14px;padding:14px 16px;display:flex;gap:16px">
                <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted)">
                    <span>🚚</span> Доставка 1–7 дней
                </div>
                <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--green);font-weight:500">
                    <span>✓</span> Бесплатно от 800 ₽
                </div>
                <div style="display:flex;align-items:center;gap:8px;font-size:13px;color:var(--muted)">
                    <span>🔄</span> Возврат 14 дней
                </div>
            </div>
        </div>
    </div>

    {{-- Состав --}}
    <div style="background:var(--white);border-radius:20px;padding:28px;box-shadow:var(--shadow);margin-bottom:32px">
        <div style="font-size:18px;font-weight:500;font-family:'Playfair Display',serif;margin-bottom:12px">Состав</div>
        <p style="font-size:14px;color:var(--muted);line-height:1.7">{{ $product['composition'] }}</p>
    </div>

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
            @foreach($related as $p)
            <div class="product-card" onclick="window.location='{{ route('catalog.show', $p['id']) }}'" style="cursor:pointer">
                <div class="product-img product-img-{{ $p['color'] }}">
                    <span class="product-badge badge-{{ $p['badge_type'] }}">{{ $p['badge'] }}</span>
                    {{ $p['emoji'] }}
                </div>
                <div class="product-body">
                    <div class="product-name">{{ $p['name'] }}</div>
                    <div class="product-sub">{{ $p['sub'] }}</div>
                    <div class="product-footer">
                        <div>
                            @if($p['price_old'])
                            <span class="price-old">{{ $p['price_old'] }} ₽</span>
                            @endif
                            <span class="price {{ $p['price_old'] ? 'price-sale' : '' }}">{{ $p['price'] }} ₽</span>
                        </div>
                        <form method="POST" action="{{ route('cart.add') }}" onclick="event.stopPropagation()">
                            @csrf
                            <input type="hidden" name="id"    value="{{ $p['id'] }}">
                            <input type="hidden" name="name"  value="{{ $p['name'] }}">
                            <input type="hidden" name="price" value="{{ $p['price'] }}">
                            <input type="hidden" name="emoji" value="{{ $p['emoji'] }}">
                            <input type="hidden" name="color" value="{{ $p['color'] }}">
                            <input type="hidden" name="sub"   value="{{ $p['sub'] }}">
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
