@extends('pages.account.layout')
@section('title', 'История заказов')

@section('account-content')
<div style="font-size:16px;font-weight:500;color:var(--text);margin-bottom:20px">История заказов</div>

@if(empty($orders))
<div style="text-align:center;padding:60px 0">
    <div style="font-size:48px;margin-bottom:12px">📦</div>
    <div style="font-size:16px;font-weight:500;color:var(--text);margin-bottom:8px">Заказов пока нет</div>
    <p style="color:var(--muted);margin-bottom:20px">Перейдите в каталог и сделайте первый заказ</p>
    <a href="{{ route('catalog') }}" class="btn btn-primary">Перейти в каталог</a>
</div>
@else
<div class="orders-list">
    @foreach($orders as $order)
    <div class="order-card">
        <div class="order-head">
            <div>
                <div class="order-id">Заказ {{ $order['id'] }}</div>
                <div class="order-date">{{ $order['date'] }}</div>
            </div>
            <span class="order-status {{ $order['status'] === 'delivery' ? 'status-delivery' : 'status-done' }}">
                {{ $order['status'] === 'delivery' ? 'В доставке' : 'Доставлен' }}
            </span>
        </div>
        <div class="order-items-text">{{ $order['items'] }}</div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-top:8px">
            <div class="order-total">{{ $order['total'] }}</div>
            <button class="btn btn-secondary" style="font-size:12px;padding:6px 14px">Повторить заказ</button>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
