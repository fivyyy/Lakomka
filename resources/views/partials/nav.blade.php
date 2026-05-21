<nav>
    <div class="nav-inner">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                    <circle cx="9" cy="7" r="3" fill="#fff"/>
                    <path d="M4 20c0-3.3 2.7-6 5-6s5 2.7 5 6" stroke="#fff" stroke-width="1.5" fill="none"/>
                    <circle cx="16" cy="10" r="2" fill="#fff" opacity=".7"/>
                </svg>
            </div>
            <span class="logo-text">Лакомка</span>
        </a>

        <div class="nav-links">
            <a href="{{ route('home') }}"     class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Главная</a>
            <a href="{{ route('catalog') }}"  class="nav-link {{ request()->routeIs('catalog*') ? 'active' : '' }}">Каталог</a>
            <a href="{{ route('promos') }}"   class="nav-link {{ request()->routeIs('promos') ? 'active' : '' }}">Акции</a>
            <a href="{{ route('articles') }}" class="nav-link {{ request()->routeIs('articles*') ? 'active' : '' }}">Статьи</a>
            <a href="{{ route('reviews') }}"  class="nav-link {{ request()->routeIs('reviews') ? 'active' : '' }}">Отзывы</a>
            <a href="{{ route('faq') }}"      class="nav-link {{ request()->routeIs('faq') ? 'active' : '' }}">FAQ</a>
            <a href="{{ route('contacts') }}" class="nav-link {{ request()->routeIs('contacts') ? 'active' : '' }}">Контакты</a>
            <a href="{{ route('about') }}"    class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}">О нас</a>
            @auth
            <a href="{{ route('account') }}"  class="nav-link {{ request()->routeIs('account*') ? 'active' : '' }}">Кабинет</a>
            @endauth
        </div>

        <div class="nav-actions">
            <a href="{{ route('cart') }}" class="cart-btn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/>
                    <line x1="3" y1="6" x2="21" y2="6" stroke="currentColor" stroke-width="1.5"/>
                    <path d="M16 10a4 4 0 01-8 0" stroke="currentColor" stroke-width="1.5" fill="none"/>
                </svg>
                @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
                @if($cartCount > 0)
                <div class="cart-badge">{{ $cartCount }}</div>
                @endif
            </a>

            @guest
            <a href="{{ route('login') }}" class="btn btn-secondary">Войти</a>
            <a href="{{ route('register') }}" class="btn btn-primary">Регистрация</a>
            @endguest

            @auth
            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-secondary">Выйти</button>
            </form>
            @endauth

            <a href="tel:+78005553535" class="btn btn-call">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none">
                    <path d="M22 16.92v3a2 2 0 01-2.18 2A19.79 19.79 0 013.09 5.18 2 2 0 015.09 3h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L9.09 10.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 16.92z" fill="#fff"/>
                </svg>
                Позвонить
            </a>
        </div>
    </div>
</nav>
