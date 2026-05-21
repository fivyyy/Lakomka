@extends('layouts.admin')
@section('title', 'Пользователи')

@section('content')
<div class="admin-card">
    <div class="admin-card-title">
        Все пользователи
        <span style="font-size:12px;color:var(--muted);font-weight:400">Всего: {{ $users->count() }}</span>
    </div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Email</th>
                <th>Телефон</th>
                <th>Роль</th>
                <th>Дата регистрации</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td style="color:var(--light)">#{{ $user->id }}</td>
                <td>
                    <div style="display:flex;align-items:center;gap:10px">
                        <div style="width:32px;height:32px;border-radius:50%;background:{{ $user->is_admin ? '#e8f5ef' : '#f5efe6' }};display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:500;color:{{ $user->is_admin ? '#1A7A5E' : '#6B6560' }};flex-shrink:0">
                            {{ strtoupper(substr($user->name, 0, 2)) }}
                        </div>
                        {{ $user->name }}
                    </div>
                </td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone ?? '—' }}</td>
                <td>
                    @if($user->is_admin)
                        <span class="admin-tag atag-green">👑 Админ</span>
                    @else
                        <span class="admin-tag atag-amber">👤 Пользователь</span>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align:center;padding:40px 0;color:var(--muted)">
                    Пользователей пока нет
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
