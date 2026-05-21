@extends('layouts.admin')
@section('title', 'Управление отзывами')

@section('content')
<div class="admin-card">
    <div class="admin-card-title">Отзывы покупателей</div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Клиент</th>
                <th>Текст</th>
                <th>Оценка</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $r)
            <tr>
                <td>{{ $r->created_at->format('d.m.Y') }}</td>
                <td><strong>{{ $r->name }}</strong></td>
                <td style="max-width: 300px; font-size: 13px;">{{ $r->text }}</td>
                <td style="color: #f59e0b;">{{ str_repeat('★', $r->rating) }}</td>
                <td>
                    @if($r->is_approved)
                        <span class="admin-tag atag-green">Опубликован</span>
                    @else
                        <span class="admin-tag atag-amber">Ждет проверки</span>
                    @endif
                </td>
                <td style="display: flex; gap: 8px;">
                    @if(!$r->is_approved)
                        <form action="{{ route('admin.reviews.approve', $r->id) }}" method="POST">
                            @csrf
                            <button class="admin-btn-sm" style="background: #218359; color: white; border:none;">Одобрить</button>
                        </form>
                    @endif
                    <form action="{{ route('admin.reviews.delete', $r->id) }}" method="POST" onsubmit="return confirm('Удалить отзыв?')">
                        @csrf @method('DELETE')
                        <button class="admin-btn-sm" style="background: #be123c; color: white; border:none;">Удалить</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection