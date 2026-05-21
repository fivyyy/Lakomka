@extends('layouts.app')
@section('title', 'Отзывы')
@section('content')
<div class="section">
    <div class="section-header">
        <div><h2 class="section-title">Отзывы покупателей</h2></div>
        <button class="btn btn-primary" onclick="document.getElementById('reviewModal').classList.add('open')">Написать отзыв</button>
    </div>
    
    <div class="reviews-header-card">
        <div style="text-align:center;flex-shrink:0">
            <div class="rating-big">{{ $avgRating > 0 ? $avgRating : '0.0' }}</div>
            <div class="rating-stars">
                {{ str_repeat('★', round($avgRating)) }}{{ str_repeat('☆', 5 - round($avgRating)) }}
            </div>
            <div class="rating-count">{{ $totalReviews }} отзывов</div>
        </div>
        <div class="rating-bars" style="flex:1">
            @foreach([5, 4, 3, 2, 1] as $star)
            <div class="bar-row">
                <span class="bar-label">{{ $star }}</span>
                <div class="bar-track">
                    <div class="bar-fill" style="width:{{ $ratingPercents[$star] ?? 0 }}%"></div>
                </div>
                <span class="bar-pct">{{ $ratingPercents[$star] ?? 0 }}%</span>
            </div>
            @endforeach
        </div>
        <div style="flex-shrink:0;text-align:center;color:rgba(255,255,255,.8)">
            <div style="font-size:13px;margin-bottom:4px">Рекомендуют</div>
            <div style="font-family:'Playfair Display',serif;font-size:36px">{{ $recommendPercent ?? 0 }}%</div>
            <div style="font-size:12px;opacity:.6">покупателей</div>
        </div>
    </div>

    <div class="reviews-grid">
        @forelse($reviews as $r)
        @php
            // Автоматически достаем первые буквы имени и фамилии (инициалы)
            $words = explode(' ', $r->name);
            $initials = mb_substr($words[0], 0, 1) . (isset($words[1]) ? mb_substr($words[1], 0, 1) : '');
            
            // Набор цветов для аватарок
            $colors = [
                ['bg' => '#e8f5ef', 'color' => '#166534'], // Зеленый
                ['bg' => '#f0eeff', 'color' => '#4338ca'], // Фиолетовый
                ['bg' => '#fdf0e8', 'color' => '#9a3412'], // Оранжевый
                ['bg' => '#e0f2fe', 'color' => '#0369a1'], // Синий
            ];
            // Выбираем цвет на основе ID
            $c = $colors[$r->id % 4];
        @endphp
        <div class="review-card">
            <div class="review-top">
                <div class="reviewer">
                    <div class="avatar" style="background:{{ $c['bg'] }};color:{{ $c['color'] }}">{{ mb_strtoupper($initials) }}</div>
                    <div>
                        <div class="reviewer-name">{{ $r->name }}</div>
                        <div class="reviewer-date">{{ $r->created_at->format('d.m.Y') }}</div>
                    </div>
                </div>
                <div class="review-stars">{{ str_repeat('★', $r->rating) }}{{ str_repeat('☆', 5 - $r->rating) }}</div>
            </div>
            <p class="review-text">{{ $r->text }}</p>
            
            @if($r->product_id)
                @php $product = \App\Models\Product::find($r->product_id); @endphp
                @if($product)
                <div class="review-product">{{ $product->emoji }} {{ $product->name }}</div>
                @endif
            @endif
        </div>
        @empty
        <div style="text-align: center; grid-column: 1 / -1; padding: 40px; color: var(--muted);">
            Пока нет ни одного отзыва. Напишите первый!
        </div>
        @endforelse
    </div>
</div>

{{-- MODAL ДЛЯ ОТЗЫВА --}}
<div id="reviewModal" class="modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
    <div class="modal-box" style="max-width: 500px;">
        <div class="modal-header">
            <div>
                <div class="modal-title">Ваш отзыв</div>
                <div class="modal-sub">Поделитесь впечатлениями</div>
            </div>
            <button class="modal-close" onclick="document.getElementById('reviewModal').classList.remove('open')">×</button>
        </div>
        <form action="{{ route('reviews.store') }}" method="POST" class="modal-form">
            @csrf
            <div class="form-group">
                <label class="form-label">Ваше имя *</label>
                <input type="text" name="name" class="form-input" required value="{{ auth()->user()?->name }}">
            </div>
            <div class="form-group">
                <label class="form-label">Оценка *</label>
                <select name="rating" class="form-input">
                    <option value="5">★★★★★ (Отлично)</option>
                    <option value="4">★★★★☆ (Хорошо)</option>
                    <option value="3">★★★☆☆ (Нормально)</option>
                    <option value="2">★★☆☆☆ (Плохо)</option>
                    <option value="1">★☆☆☆☆ (Ужасно)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Текст отзыва *</label>
                <textarea name="text" class="form-input" style="height:100px" required placeholder="Что вам понравилось?"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" style="width:100%; justify-content:center; padding:12px; margin-top:10px">Отправить на проверку</button>
        </form>
    </div>
</div>
<style>
/* Стили для всплывающего окна (Модалки) */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(28, 28, 28, 0.55);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: flex-start;
    justify-content: center;
    padding: 24px 16px;
    overflow-y: auto;
}
.modal-overlay.open { display: flex; }
.modal-box {
    background: var(--white, #fff);
    border-radius: 24px;
    width: 100%;
    max-width: 500px;
    box-shadow: 0 20px 60px rgba(28, 28, 28, 0.2);
    margin: auto;
}
.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 28px 32px 0;
}
.modal-title { font-family: 'Playfair Display', serif; font-size: 22px; color: var(--text, #1c1c1c); }
.modal-sub { font-size: 13px; color: var(--muted, #888); margin-top: 3px; }
.modal-close {
    width: 36px; height: 36px; border-radius: 10px;
    border: 1.5px solid var(--border, #eaeaea); background: var(--white, #fff);
    font-size: 20px; cursor: pointer; color: var(--muted, #888);
    display: flex; align-items: center; justify-content: center;
    transition: all 0.2s; flex-shrink: 0;
}
.modal-close:hover { border-color: var(--coral, #e11d48); color: var(--coral, #e11d48); }
.modal-form { padding: 20px 32px 32px; }
</style>
@endsection