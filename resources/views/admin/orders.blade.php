@extends('layouts.admin')
@section('title', 'Заказы')

@section('content')
<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
        <h2 style="margin: 0; font-size: 20px; font-weight: 600; color: var(--text)">Все заказы</h2>
        <span style="font-size: 13px; color: var(--muted)">Всего заказов в базе: {{ $orders->total() }}</span>
    </div>

    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 2px solid #f1f5f9;">
                    <th style="padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase;">ID</th>
                    <th style="padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase;">Дата</th>
                    <th style="padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase;">Клиент</th>
                    <th style="padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase;">Состав заказа</th>
                    <th style="padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase;">Сумма</th>
                    <th style="padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted); text-transform: uppercase;">Статус</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: background 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 16px; font-size: 14px; font-weight: 600; color: var(--text)">
                        #{{ $order->id }}
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--muted)">
                        {{ $order->created_at->format('d.m.Y') }}
                    </td>
                    <td style="padding: 16px; font-size: 14px; color: var(--text)">
                        {{ $order->client_name }}
                    </td>
                    <td style="padding: 16px; font-size: 13px; color: var(--text); max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                        {{ $order->items }}
                    </td>
                    <td style="padding: 16px; font-size: 14px; font-weight: 600; color: var(--text)">
                        {{ number_format($order->total_price, 0, '', ' ') }} ₽
                    </td>
                    <td style="padding: 16px;">
                        {{-- Динамическое назначение ваших классов админки в зависимости от статуса в БД --}}
                        @if($order->status == 'new')
                            <span class="admin-tag atag-blue">Новый</span>
                        @elseif($order->status == 'shipping')
                            <span class="admin-tag atag-amber">В доставке</span>
                        @elseif($order->status == 'completed')
                            <span class="admin-tag atag-green">Доставлен</span>
                        @elseif($order->status == 'cancelled')
                            <span class="admin-tag atag-coral">Отменён</span>
                        @else
                            <span class="admin-tag">{{ $order->status }}</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 48px 0; color: var(--muted);">
                        <div style="font-size: 32px; margin-bottom: 8px;">📦</div>
                        <div style="font-size: 14px;">Заказов пока не поступало</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Блок пагинации (переключения страниц) в стиле Laravel --}}
    @if($orders->hasPages())
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection