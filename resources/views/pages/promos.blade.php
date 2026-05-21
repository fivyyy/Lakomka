@extends('layouts.app')
@section('title', 'Акции')
@section('content')
<div class="section">
    <div class="section-header"><div><h2 class="section-title">Акции и спецпредложения</h2><p class="section-sub">Актуальные скидки и выгодные предложения</p></div></div>
    <div class="promos-grid">
        @foreach($promos as $p)
        <div class="promo-card promo-{{ $p['style'] }}">
            <div>
                <div class="promo-badge-pill">{{ $p['until'] }}</div>
                <div class="promo-name">{{ $p['name'] }}</div>
                <div class="promo-desc">{{ $p['desc'] }}</div>
                @if($p['btn'])
                <a href="{{ route('catalog') }}" class="btn" style="background:rgba(255,255,255,.2);color:#fff;border:none">{{ $p['btn'] }}</a>
                @endif
            </div>
            <div class="promo-big">{{ $p['value'] }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
