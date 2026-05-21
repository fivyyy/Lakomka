@extends('layouts.app')
@section('title', 'FAQ')
@section('content')
<div class="section" style="max-width:760px">
    <div class="section-header"><div><h2 class="section-title">Часто задаваемые вопросы</h2></div></div>
    <div class="faq-list">
        @foreach($faqs as $faq)
        <div class="faq-item">
            <button class="faq-q">{{ $faq['q'] }}<div class="faq-arrow">▾</div></button>
            <div class="faq-a">{{ $faq['a'] }}</div>
        </div>
        @endforeach
    </div>
</div>
@endsection
