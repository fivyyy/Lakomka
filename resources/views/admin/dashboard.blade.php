@extends('layouts.admin')
@section('title', 'Дашборд')

@section('content')
<div class="admin-stats-grid">
    @foreach($stats as $s)
    <div class="admin-stat-card">
        <div class="admin-stat-icon">{{ $s['icon'] }}</div>
        <div class="admin-stat-label">{{ $s['label'] }}</div>
        <div class="admin-stat-num">{{ $s['value'] }}</div>
        <div class="admin-stat-change {{ $s['up'] ? 'change-up' : 'change-down' }}">
            {{ $s['up'] ? '↑' : '↓' }} {{ $s['change'] }} к прошлому
        </div>
    </div>
    @endforeach
</div>

<div class="admin-grid-2">
    <div class="admin-card">
        <div class="admin-card-title">
            Выручка по неделям
            <a href="#" class="admin-card-link">Подробнее</a>
        </div>
        <div class="chart-bar-wrap">
            @foreach([['h'=>45,'v'=>'38к','l'=>'Нед 1'],['h'=>60,'v'=>'51к','l'=>'Нед 2'],['h'=>52,'v'=>'44к','l'=>'Нед 3'],['h'=>80,'v'=>'51к','l'=>'Нед 4']] as $bar)
            <div class="chart-bar-col">
                <div class="chart-bar" style="height:{{ $bar['h'] }}%;position:relative">
                    <span style="position:absolute;top:-18px;left:50%;transform:translateX(-50%);font-size:10px;color:var(--muted);white-space:nowrap">{{ $bar['v'] }}</span>
                </div>
                <div class="chart-bar-label">{{ $bar['l'] }}</div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="admin-card">
        <div class="admin-card-title">
            Популярные товары
            <a href="{{ route('admin.products') }}" class="admin-card-link">Все товары</a>
        </div>
        <table class="admin-table">
            <thead><tr><th>Товар</th><th>Продаж</th><th>Сумма</th></tr></thead>
            <tbody>
                @foreach($topProducts as $p)
                <tr>
                    <td>{{ $p['emoji'] }} {{ $p['name'] }}</td>
                    <td>{{ $p['sales'] }}</td>
                    <td>{{ $p['revenue'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="admin-card">
    <div class="admin-card-title">
        Последние заказы
        <a href="{{ route('admin.orders') }}" class="admin-card-link">Все заказы</a>
    </div>
    <table class="admin-table">
        <thead>
            <tr><th>№</th><th>Клиент</th><th>Состав</th><th>Сумма</th><th>Статус</th><th>Дата</th><th></th></tr>
        </thead>
        <tbody>
            @foreach($orders as $o)
            <tr>
                <td>{{ $o['id'] }}</td>
                <td>{{ $o['client'] }}</td>
                <td>{{ $o['items'] }}</td>
                <td style="font-weight: 500;">{{ $o['total'] }}</td>
                
                {{-- БЛОК СО СТАТУСОМ И КНОПКОЙ "ВЫПОЛНИТЬ" --}}
                <td>
                    @if($o['status'] === 'Новый')
                        <div style="display: flex; flex-direction: column; gap: 6px; align-items: flex-start;">
                            <span class="admin-tag {{ $o['tag'] }}">Новый</span>
                            <form action="{{ route('admin.orders.complete', $o['raw_id']) }}" method="POST" onsubmit="return confirm('Вы подтверждаете выполнение заказа? Сумма {{ $o['total'] }} перейдет в выручку.');">
                                @csrf
                                <button type="submit" style="background: #218359; color: white; border: none; padding: 4px 10px; border-radius: 4px; font-size: 11px; font-weight: 500; cursor: pointer; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.9'" onmouseout="this.style.opacity='1'">
                                    ✓ Выполнить
                                </button>
                            </form>
                        </div>
                    @elseif($o['status'] === 'Выполнен')
                        <span class="admin-tag {{ $o['tag'] }}">Выполнен</span>
                    @else
                        <span class="admin-tag {{ $o['tag'] }}">{{ $o['status'] }}</span>
                    @endif
                </td>

                <td>{{ $o['date'] }}</td>
                <td><a href="#" class="admin-btn-sm">Просмотр</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection