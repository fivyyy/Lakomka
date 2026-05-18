<?php

namespace App\Http\Controllers;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = [
            ['initials' => 'МК', 'name' => 'Мария Козлова',   'date' => '2 мая 2026',      'stars' => 5, 'text' => 'Кот в полном восторге от подушечек! Заказываем уже третий раз. Состав полностью натуральный, ест с удовольствием.', 'product' => '🐱 Мягкие подушечки', 'bg' => '#e8f5ef', 'color' => '#1A7A5E'],
            ['initials' => 'ДР', 'name' => 'Дмитрий Романов', 'date' => '29 апр. 2026',    'stars' => 4, 'text' => 'Очень быстрая доставка, качественная упаковка. Собака в восторге от говядины. Буду заказывать снова!', 'product' => '🦴 Сушёная говядина', 'bg' => '#fdf0e8', 'color' => '#F0A030'],
            ['initials' => 'ОТ', 'name' => 'Ольга Тихонова',  'date' => '27 апр. 2026',    'stars' => 5, 'text' => 'Хомячок просто обожает палочки! Натуральный состав, хорошая цена. Спасибо магазину!', 'product' => '🌾 Зерновые палочки', 'bg' => '#f0eeff', 'color' => '#6E57E0'],
            ['initials' => 'АН', 'name' => 'Алина Никонова',  'date' => '24 апр. 2026',    'stars' => 5, 'text' => 'Отличный магазин! Заказывала рыбные снеки — кошка в восторге. Очень быстрая доставка по Москве.', 'product' => '🐟 Рыбные снеки', 'bg' => '#fef0ee', 'color' => '#E8634A'],
        ];

        return view('pages.reviews', compact('reviews'));
    }

    public function store(\Illuminate\Http\Request $request)
    {
        return back()->with('success', 'Ваш отзыв отправлен на модерацию. Спасибо!');
    }
}
