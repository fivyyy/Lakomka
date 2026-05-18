@extends('layouts.app')
@section('title', 'Статьи')
@section('content')
<div class="section">
    <div class="section-header"><div><h2 class="section-title">Полезные статьи</h2><p class="section-sub">Советы по уходу за питомцами</p></div></div>
    <div class="articles-grid">
        @foreach($articles as $a)
        <a href="#" class="article-card">
            <div class="article-img" style="background:{{ $a['bg'] }}">{{ $a['emoji'] }}</div>
            <div class="article-body">
                <div class="article-cat">{{ $a['category'] }}</div>
                <h3 class="article-title">{{ $a['title'] }}</h3>
                <p class="article-desc">{{ $a['desc'] }}</p>
                <div class="article-meta">{{ $a['date'] }} · {{ $a['read'] }} мин</div>
            </div>
        </a>
        @endforeach
    </div>
</div>
@endsection
