@extends('layouts.app')
@section('title', 'Отзывы')
@section('content')
<div class="section">
    <div class="section-header">
        <div><h2 class="section-title">Отзывы покупателей</h2></div>
        <button class="btn btn-primary">Написать отзыв</button>
    </div>
    <div class="reviews-header-card">
        <div style="text-align:center;flex-shrink:0">
            <div class="rating-big">4.8</div>
            <div class="rating-stars">★★★★★</div>
            <div class="rating-count">148 отзывов</div>
        </div>
        <div class="rating-bars" style="flex:1">
            <div class="bar-row"><span class="bar-label">5</span><div class="bar-track"><div class="bar-fill" style="width:78%"></div></div><span class="bar-pct">78%</span></div>
            <div class="bar-row"><span class="bar-label">4</span><div class="bar-track"><div class="bar-fill" style="width:15%"></div></div><span class="bar-pct">15%</span></div>
            <div class="bar-row"><span class="bar-label">3</span><div class="bar-track"><div class="bar-fill" style="width:5%"></div></div><span class="bar-pct">5%</span></div>
            <div class="bar-row"><span class="bar-label">2</span><div class="bar-track"><div class="bar-fill" style="width:2%"></div></div><span class="bar-pct">2%</span></div>
        </div>
        <div style="flex-shrink:0;text-align:center;color:rgba(255,255,255,.8)">
            <div style="font-size:13px;margin-bottom:4px">Рекомендуют</div>
            <div style="font-family:'Playfair Display',serif;font-size:36px">93%</div>
            <div style="font-size:12px;opacity:.6">покупателей</div>
        </div>
    </div>
    <div class="reviews-grid">
        @foreach($reviews as $r)
        <div class="review-card">
            <div class="review-top">
                <div class="reviewer">
                    <div class="avatar" style="background:{{ $r['bg'] }};color:{{ $r['color'] }}">{{ $r['initials'] }}</div>
                    <div>
                        <div class="reviewer-name">{{ $r['name'] }}</div>
                        <div class="reviewer-date">{{ $r['date'] }}</div>
                    </div>
                </div>
                <div class="review-stars">{{ str_repeat('★', $r['stars']) }}{{ str_repeat('☆', 5 - $r['stars']) }}</div>
            </div>
            <p class="review-text">{{ $r['text'] }}</p>
            <div class="review-product">{{ $r['product'] }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
