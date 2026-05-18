@extends('layouts.app')
@section('title', 'Корзина')

@section('content')
<div class="section">
    <div class="section-header">
        <div><h2 class="section-title">Корзина</h2></div>
    </div>

    @if(empty($cart))
    <div style="text-align:center;padding:80px 0">
        <div style="font-size:64px;margin-bottom:16px">🛒</div>
        <div style="font-size:20px;font-weight:500;color:var(--text);margin-bottom:8px">Корзина пуста</div>
        <p style="color:var(--muted);margin-bottom:24px">Добавьте лакомства для вашего питомца</p>
        <a href="{{ route('catalog') }}" class="btn btn-primary">Перейти в каталог</a>
    </div>
    @else
    <div class="cart-layout">
        <div class="cart-items">
            @foreach($cart as $id => $item)
            <div class="cart-item">
                <div class="cart-item-emoji" style="background:{{ $item['color'] === 'green' ? '#e8f5ef' : ($item['color'] === 'warm' ? '#fdf0e8' : ($item['color'] === 'purple' ? '#f0eeff' : '#fef6e8')) }}">
                    {{ $item['emoji'] }}
                </div>
                <div class="cart-item-info">
                    <div class="cart-item-name">{{ $item['name'] }}</div>
                    <div class="cart-item-sub">{{ $item['sub'] }}</div>
                </div>
                <div class="qty-ctrl">
                    <form method="POST" action="{{ route('cart.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="qty" value="{{ $item['qty'] - 1 }}">
                        <button type="submit" class="qty-btn">−</button>
                    </form>
                    <span class="qty-num">{{ $item['qty'] }}</span>
                    <form method="POST" action="{{ route('cart.update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $id }}">
                        <input type="hidden" name="qty" value="{{ $item['qty'] + 1 }}">
                        <button type="submit" class="qty-btn">+</button>
                    </form>
                </div>
                <div class="item-price">{{ number_format($item['price'] * $item['qty'], 0, '.', ' ') }} ₽</div>
                <form method="POST" action="{{ route('cart.remove') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <button type="submit" class="remove-btn">×</button>
                </form>
            </div>
            @endforeach
        </div>

        <div class="cart-summary">
            <div class="summary-title">Ваш заказ</div>
            <div class="summary-row">
                <span>Товары ({{ collect($cart)->sum('qty') }}):</span>
                <span>{{ number_format($total, 0, '.', ' ') }} ₽</span>
            </div>
            <div class="summary-row">
                <span>Доставка:</span>
                <span style="color:var(--green);font-weight:500">{{ $total >= 800 ? 'Бесплатно' : '300 ₽' }}</span>
            </div>
            <div class="summary-row total">
                <span>К оплате:</span>
                <span style="color:var(--green)">{{ number_format($total >= 800 ? $total : $total + 300, 0, '.', ' ') }} ₽</span>
            </div>
            <div class="promo-input">
                <input placeholder="Промокод"/>
                <button class="btn btn-primary" style="flex-shrink:0;padding:9px 16px;font-size:13px">Ок</button>
            </div>
            <button onclick="document.getElementById('orderModal').classList.add('open')"
                    class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:15px">
                Оформить заказ
            </button>
        </div>
    </div>
    @endif
</div>

{{-- MODAL --}}
<div id="orderModal" class="modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
    <div class="modal-box">
        <div class="modal-header">
            <div>
                <div class="modal-title">Оформление заказа</div>
                <div class="modal-sub">Заполните данные для доставки</div>
            </div>
            <button class="modal-close" onclick="document.getElementById('orderModal').classList.remove('open')">×</button>
        </div>

        <form method="POST" action="#" class="modal-form">
            @csrf

            {{-- Контактные данные --}}
            <div class="modal-section-title">Контактные данные</div>
            <div class="modal-row-2">
                <div class="form-group">
                    <label class="form-label">Имя *</label>
                    <input class="form-input" name="first_name" placeholder="Иван" required
                           value="{{ auth()->user()?->name ?? '' }}"/>
                </div>
                <div class="form-group">
                    <label class="form-label">Фамилия</label>
                    <input class="form-input" name="last_name" placeholder="Иванов"/>
                </div>
            </div>
            <div class="modal-row-2">
                <div class="form-group">
                    <label class="form-label">Телефон *</label>
                    <input class="form-input" name="phone" type="tel" placeholder="+7 (___) ___-__-__" required/>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input class="form-input" name="email" type="email" placeholder="your@email.ru"
                           value="{{ auth()->user()?->email ?? '' }}"/>
                </div>
            </div>

            {{-- Способ доставки --}}
            <div class="modal-section-title" style="margin-top:20px">Способ доставки</div>
            <div class="delivery-options">
                <label class="delivery-option">
                    <input type="radio" name="delivery" value="courier" checked onchange="toggleAddress(this)"/>
                    <div class="delivery-option-body">
                        <div class="delivery-option-icon">🚚</div>
                        <div>
                            <div class="delivery-option-name">Курьером</div>
                            <div class="delivery-option-desc">1–2 дня · {{ $total >= 800 ? 'Бесплатно' : '300 ₽' }}</div>
                        </div>
                    </div>
                </label>
                <label class="delivery-option">
                    <input type="radio" name="delivery" value="pickup" onchange="toggleAddress(this)"/>
                    <div class="delivery-option-body">
                        <div class="delivery-option-icon">🏪</div>
                        <div>
                            <div class="delivery-option-name">Самовывоз</div>
                            <div class="delivery-option-desc">Москва, ул. Пушкина, 12 · Бесплатно</div>
                        </div>
                    </div>
                </label>
                <label class="delivery-option">
                    <input type="radio" name="delivery" value="post" onchange="toggleAddress(this)"/>
                    <div class="delivery-option-body">
                        <div class="delivery-option-icon">📦</div>
                        <div>
                            <div class="delivery-option-name">Почта России</div>
                            <div class="delivery-option-desc">3–7 дней · от 250 ₽</div>
                        </div>
                    </div>
                </label>
            </div>

            {{-- Адрес доставки --}}
            <div id="addressBlock">
                <div class="modal-section-title" style="margin-top:20px">Адрес доставки</div>
                <div class="form-group">
                    <label class="form-label">Город *</label>
                    <input class="form-input" name="city" placeholder="Москва" required/>
                </div>
                <div class="modal-row-2">
                    <div class="form-group">
                        <label class="form-label">Улица *</label>
                        <input class="form-input" name="street" placeholder="ул. Ленина" required/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Дом / корп.</label>
                        <input class="form-input" name="house" placeholder="12, корп. 1"/>
                    </div>
                </div>
                <div class="modal-row-3">
                    <div class="form-group">
                        <label class="form-label">Квартира</label>
                        <input class="form-input" name="flat" placeholder="45"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Подъезд</label>
                        <input class="form-input" name="entrance" placeholder="2"/>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Этаж</label>
                        <input class="form-input" name="floor" placeholder="7"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Индекс</label>
                    <input class="form-input" name="zip" placeholder="123456"/>
                </div>
            </div>

            {{-- Способ оплаты --}}
            <div class="modal-section-title" style="margin-top:20px">Способ оплаты</div>
            <div class="delivery-options">
                <label class="delivery-option">
                    <input type="radio" name="payment" value="card" checked/>
                    <div class="delivery-option-body">
                        <div class="delivery-option-icon">💳</div>
                        <div>
                            <div class="delivery-option-name">Картой онлайн</div>
                            <div class="delivery-option-desc">Visa, MasterCard, МИР</div>
                        </div>
                    </div>
                </label>
                <label class="delivery-option">
                    <input type="radio" name="payment" value="cash"/>
                    <div class="delivery-option-body">
                        <div class="delivery-option-icon">💵</div>
                        <div>
                            <div class="delivery-option-name">Наличными</div>
                            <div class="delivery-option-desc">При получении курьеру</div>
                        </div>
                    </div>
                </label>
            </div>

            {{-- Комментарий --}}
            <div class="modal-section-title" style="margin-top:20px">Дополнительно</div>
            <div class="form-group">
                <label class="form-label">Комментарий к заказу</label>
                <textarea class="form-input" name="comment" placeholder="Например: домофон не работает, позвонить заранее..."></textarea>
            </div>

            {{-- Итог --}}
            <div class="modal-total">
                <div style="display:flex;justify-content:space-between;font-size:14px;color:var(--muted);margin-bottom:6px">
                    <span>Товары:</span><span>{{ number_format($total, 0, '.', ' ') }} ₽</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:14px;color:var(--muted);margin-bottom:10px">
                    <span>Доставка:</span><span style="color:var(--green)">{{ $total >= 800 ? 'Бесплатно' : '300 ₽' }}</span>
                </div>
                <div style="display:flex;justify-content:space-between;font-size:17px;font-weight:500;color:var(--text)">
                    <span>Итого:</span>
                    <span style="color:var(--green);font-family:'Playfair Display',serif">
                        {{ number_format($total >= 800 ? $total : $total + 300, 0, '.', ' ') }} ₽
                    </span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary" style="width:100%;justify-content:center;padding:14px;font-size:15px;margin-top:16px">
                Подтвердить заказ
            </button>
        </form>
    </div>
</div>

<style>
/* MODAL */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(28,28,28,.55);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: flex-start;
    justify-content: center;
    padding: 24px 16px;
    overflow-y: auto;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: var(--white);
    border-radius: 24px;
    width: 100%;
    max-width: 600px;
    box-shadow: 0 20px 60px rgba(28,28,28,.2);
    margin: auto;
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 28px 32px 0;
}
.modal-title { font-family: 'Playfair Display', serif; font-size: 22px; color: var(--text); }
.modal-sub { font-size: 13px; color: var(--muted); margin-top: 3px; }
.modal-close {
    width: 36px; height: 36px; border-radius: 10px;
    border: 1.5px solid var(--border); background: var(--white);
    font-size: 20px; cursor: pointer; color: var(--muted);
    display: flex; align-items: center; justify-content: center;
    transition: all .2s; flex-shrink: 0;
}
.modal-close:hover { border-color: var(--coral); color: var(--coral); }
.modal-form { padding: 20px 32px 32px; }
.modal-section-title {
    font-size: 11px; font-weight: 500; text-transform: uppercase;
    letter-spacing: .07em; color: var(--muted); margin-bottom: 12px;
}
.modal-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
.modal-row-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; }
.delivery-options { display: flex; flex-direction: column; gap: 8px; }
.delivery-option { cursor: pointer; }
.delivery-option input[type=radio] { display: none; }
.delivery-option-body {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; border-radius: 12px;
    border: 1.5px solid var(--border); background: var(--white);
    transition: all .2s;
}
.delivery-option input:checked + .delivery-option-body {
    border-color: var(--green); background: var(--green-pale);
}
.delivery-option-icon { font-size: 22px; flex-shrink: 0; }
.delivery-option-name { font-size: 13px; font-weight: 500; color: var(--text); }
.delivery-option-desc { font-size: 11px; color: var(--muted); margin-top: 1px; }
.modal-total {
    background: var(--cream); border-radius: 12px;
    padding: 16px; margin-top: 20px;
}
</style>

<script>
function toggleAddress(radio) {
    const block = document.getElementById('addressBlock');
    block.style.display = radio.value === 'pickup' ? 'none' : 'block';
    block.querySelectorAll('input[required]').forEach(i => {
        i.required = radio.value !== 'pickup';
    });
}
</script>
@endsection

