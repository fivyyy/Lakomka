@extends('layouts.admin')
@section('title', 'Товары')
@section('content')
<div class="admin-card">
    <div style="text-align:center;padding:60px 0;color:var(--muted)">
        <div style="font-size:48px;margin-bottom:12px">🚧</div>
        <div style="font-size:16px;font-weight:500;color:var(--text)">Раздел в разработке</div>
        <p style="margin-top:8px;font-size:13px">Функциональность будет добавлена на следующем этапе</p>
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary" style="margin-top:20px;display:inline-flex">← Вернуться на дашборд</a>
    </div>
</div>
@endsection
