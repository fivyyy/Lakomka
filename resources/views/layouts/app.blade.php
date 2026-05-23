<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Лакомка') — Магазин лакомств для питомцев</title>
<meta name="description" content="@yield('description', 'Натуральные лакомства для кошек, собак и грызунов с доставкой по всей России')">
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet"/>
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

@include('partials.nav')

<main>
    @if(session('success'))
        <div style="max-width:1200px;margin:16px auto;padding:0 32px">
            <div class="alert alert-success">{{ session('success') }}</div>
        </div>
    @endif
    @if(session('error'))
        <div style="max-width:1200px;margin:16px auto;padding:0 32px">
            <div class="alert alert-error">{{ session('error') }}</div>
        </div>
    @endif

    @yield('content')
</main>

@include('partials.footer')

<script>
// FAQ toggle
document.querySelectorAll('.faq-q').forEach(btn => {
    btn.addEventListener('click', () => btn.closest('.faq-item').classList.toggle('open'));
});

// Filter pills
document.querySelectorAll('.filter-pills').forEach(group => {
    group.addEventListener('click', e => {
        const pill = e.target.closest('a.pill, button.pill');
        if (pill) { group.querySelectorAll('.pill').forEach(p => p.classList.remove('active')); pill.classList.add('active'); }
    });
});
</script>

<script>
function toggleMobileMenu() {
    const nav = document.getElementById('navMenu') || document.querySelector('.nav') || document.querySelector('.nav-menu');
    if (nav) {
        nav.classList.toggle('active');
        // Добавим класс nav-menu для совместимости со стилями, если его там нет
        nav.classList.add('nav-menu');
        if(!nav.id) nav.id = 'navMenu';
    }
    
    const btn = document.querySelector('.mobile-menu-toggle');
    if (btn && nav) {
        if(nav.classList.contains('active')) {
            btn.textContent = '✕';
        } else {
            btn.textContent = '☰';
        }
    }
}
</script>

</body>
</html>