@extends('pages.account.layout')
@section('title', 'Адреса доставки')

@section('account-content')
<div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px">
    <div style="font-size:16px;font-weight:500;color:var(--text)">Адреса доставки</div>
    <button onclick="document.getElementById('addAddressForm').classList.toggle('hidden')"
            class="btn btn-primary" style="font-size:13px;padding:8px 16px">
        + Добавить адрес
    </button>
</div>

{{-- Форма добавления адреса --}}
<div id="addAddressForm" class="hidden" style="background:var(--white);border-radius:20px;padding:24px;box-shadow:var(--shadow);margin-bottom:20px">
    <div style="font-size:14px;font-weight:500;margin-bottom:16px">Новый адрес</div>
    <form method="POST" action="#">
        @csrf
        <div class="form-group">
            <label class="form-label">Название адреса</label>
            <input class="form-input" name="label" placeholder='Например: "Дом" или "Работа"'/>
        </div>
        <div class="form-group">
            <label class="form-label">Город *</label>
            <input class="form-input" name="city" placeholder="Москва" required/>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div class="form-group">
                <label class="form-label">Улица *</label>
                <input class="form-input" name="street" placeholder="ул. Ленина" required/>
            </div>
            <div class="form-group">
                <label class="form-label">Дом / корп.</label>
                <input class="form-input" name="house" placeholder="12, корп. 1"/>
            </div>
        </div>
        <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:12px;margin-bottom:16px">
            <div class="form-group">
                <label class="form-label">Квартира</label>
                <input class="form-input" name="flat" placeholder="45"/>
            </div>
            <div class="form-group">
                <label class="form-label">Подъезд</label>
                <input class="form-input" name="entrance" placeholder="2"/>
            </div>
            <div class="form-group">
                <label class="form-label">Индекс</label>
                <input class="form-input" name="zip" placeholder="123456"/>
            </div>
        </div>
        <div style="display:flex;gap:10px">
            <button type="submit" class="btn btn-primary">Сохранить адрес</button>
            <button type="button" onclick="document.getElementById('addAddressForm').classList.add('hidden')"
                    class="btn btn-secondary">Отмена</button>
        </div>
    </form>
</div>

{{-- Список адресов --}}
<div style="display:flex;flex-direction:column;gap:12px">
    {{-- Пример сохранённого адреса --}}
    <div style="background:var(--white);border-radius:16px;padding:20px 22px;box-shadow:var(--shadow);display:flex;justify-content:space-between;align-items:flex-start">
        <div style="display:flex;gap:14px;align-items:flex-start">
            <div style="width:44px;height:44px;background:var(--green-pale);border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0">🏠</div>
            <div>
                <div style="font-weight:500;font-size:14px;margin-bottom:3px">Дом
                    <span style="background:var(--green-pale);color:var(--green);font-size:10px;padding:2px 8px;border-radius:20px;font-weight:500;margin-left:6px">Основной</span>
                </div>
                <div style="font-size:13px;color:var(--muted)">Москва, ул. Пушкина, д. 12, кв. 45</div>
                <div style="font-size:12px;color:var(--light);margin-top:2px">Подъезд 2 · Индекс 123456</div>
            </div>
        </div>
        <div style="display:flex;gap:8px">
            <button class="btn btn-secondary" style="font-size:12px;padding:6px 12px">Изменить</button>
            <button class="btn" style="font-size:12px;padding:6px 12px;background:var(--warm);color:var(--muted);border:none">Удалить</button>
        </div>
    </div>

    {{-- Заглушка если нет адресов --}}
    <div style="background:var(--warm);border-radius:16px;padding:32px;text-align:center">
        <div style="font-size:32px;margin-bottom:8px">📍</div>
        <div style="font-size:14px;color:var(--muted)">Добавьте адрес доставки, чтобы оформлять заказы быстрее</div>
    </div>
</div>

<style>
.hidden { display: none !important; }
</style>
@endsection
