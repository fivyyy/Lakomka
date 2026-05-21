@extends('layouts.admin')
@section('title', 'Товары')

@section('content')
<style>
    .admin-table-wrapper { overflow-x: auto; margin-top: 16px; }
    .admin-table { width: 100%; border-collapse: collapse; text-align: left; }
    .admin-table th { padding: 12px 16px; font-size: 12px; font-weight: 600; color: var(--muted, #64748b); text-transform: uppercase; border-bottom: 2px solid #f1f5f9; }
    .admin-table td { padding: 16px; font-size: 14px; color: var(--text, #333); border-bottom: 1px solid #f1f5f9; transition: background 0.2s; }
    .admin-table tr:hover td { background-color: #f8fafc; }
    
    .product-icon-box { width: 40px; height: 40px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .bg-blue { background-color: #e0f2fe; }
    .bg-orange { background-color: #ffedd5; }
    .bg-green { background-color: #dcfce7; }
    .bg-default { background-color: #f1f5f9; }
    
    .badge { display: inline-block; padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: 600; }
    .badge-sale { background-color: #fee2e2; color: #b91c1c; }
    .badge-hit { background-color: #e0f2fe; color: #0369a1; }
    
    .btn-primary { background: #218359; color: white; padding: 10px 16px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: 500; display: inline-flex; align-items: center; gap: 8px; border: none; cursor: pointer; transition: opacity 0.2s; }
    .btn-primary:hover { opacity: 0.9; }
    .action-link { color: var(--muted, #64748b); text-decoration: none; font-size: 13px; margin-right: 12px; font-weight: 500; }
    .action-link:hover { color: #218359; }
    .action-delete { color: #b91c1c; text-decoration: none; font-size: 13px; font-weight: 500; }
    .action-delete:hover { text-decoration: underline; }
</style>

<div class="admin-card">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <div>
            <h2 style="margin: 0; font-size: 20px; font-weight: 600; color: var(--text)">Каталог товаров</h2>
            <span style="font-size: 13px; color: var(--muted)">Всего позиций: {{ $products->total() }}</span>
        </div>
            <a href="{{ route('admin.products.create') }}" class="btn-primary">
                <span>+</span> Добавить товар
            </a>
    </div>

    <div class="admin-table-wrapper">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Товар</th>
                    <th>Категория</th>
                    <th>Цена</th>
                    <th>Метка</th>
                    <th style="text-align: right;">Действия</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td style="display: flex; align-items: center; gap: 12px; border-bottom: none;">
                        @php
                            $bgClass = match($product->color) { 'blue' => 'bg-blue', 'orange' => 'bg-orange', 'green' => 'bg-green', default => 'bg-default' };
                        @endphp
                        <div class="product-icon-box {{ $bgClass }}">
                            {{ $product->emoji }}
                        </div>
                        <div style="font-weight: 600;">
                            {{ $product->name }}
                        </div>
                    </td>
                    <td>{{ $product->sub ?? '—' }}</td>
                    <td>
                        <div style="font-weight: 600;">{{ $product->price }} ₽</div>
                        @if($product->price_old)
                            <div style="font-size: 12px; color: var(--muted); text-decoration: line-through;">{{ $product->price_old }} ₽</div>
                        @endif
                    </td>
                    <td>
                        @if($product->badge)
                            <span class="badge {{ $product->badge_type == 'sale' ? 'badge-sale' : 'badge-hit' }}">
                                {{ $product->badge }}
                            </span>
                        @else
                            <span style="color: var(--muted);">—</span>
                        @endif
                    </td>
                    <td style="text-align: right;">
                        <a href="#" class="action-link">Ред.</a>
                        <a href="#" class="action-delete">Удалить</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 48px 0; color: var(--muted);">
                        <div style="font-size: 32px; margin-bottom: 8px;">🛍️</div>
                        <div style="font-size: 14px;">Каталог пуст. Добавьте первый товар!</div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($products->hasPages())
    <div style="margin-top: 24px; display: flex; justify-content: center;">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection