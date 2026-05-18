<footer>
    <div class="footer-inner">
        <div>
            <div class="footer-logo">
                <div class="footer-logo-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="9" cy="7" r="3" fill="#fff"/>
                        <path d="M4 20c0-3.3 2.7-6 5-6s5 2.7 5 6" stroke="#fff" stroke-width="1.5" fill="none"/>
                    </svg>
                </div>
                <span class="footer-logo-text">Лакомка</span>
            </div>
            <div class="footer-desc">Натуральные лакомства для кошек, собак и грызунов с доставкой по всей России.</div>
        </div>
        <div>
            <div class="footer-col-title">Магазин</div>
            <a href="{{ route('catalog') }}" class="footer-link">Каталог</a>
            <a href="{{ route('promos') }}"  class="footer-link">Акции</a>
            <a href="{{ route('articles') }}" class="footer-link">Статьи</a>
            <a href="{{ route('about') }}"   class="footer-link">О нас</a>
        </div>
        <div>
            <div class="footer-col-title">Поддержка</div>
            <a href="{{ route('faq') }}"      class="footer-link">FAQ</a>
            <a href="{{ route('contacts') }}" class="footer-link">Контакты</a>
            <span class="footer-link">Доставка и оплата</span>
            <span class="footer-link">Возврат товара</span>
        </div>
        <div>
            <div class="footer-col-title">Контакты</div>
            <a href="tel:+78005553535" class="footer-link">+7 (800) 555-35-35</a>
            <a href="mailto:info@lakomka.ru" class="footer-link">info@lakomka.ru</a>
            <span class="footer-link">Москва, ул. Пушкина, 12</span>
        </div>
    </div>
    <div class="footer-bottom">
        <span class="footer-copy">© {{ date('Y') }} Лакомка. Все права защищены.</span>
        <div style="display:flex;gap:16px;align-items:center">
            <span class="footer-link" style="margin:0">Конфиденциальность</span>
            <span class="footer-link" style="margin:0">Пользовательское соглашение</span>
            <a href="{{ route('admin.dashboard') }}" class="footer-admin-link">⚙ admin</a>
        </div>
    </div>
</footer>
