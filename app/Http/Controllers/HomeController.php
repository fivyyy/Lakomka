<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $products = $this->getProducts();

        return view('pages.home', compact('products'));
    }

    public static function getProducts(): array
    {
        return [
            ['id' => 1, 'name' => 'Мягкие подушечки с лососем',   'sub' => 'Для кошек · 100 г',    'price' => 249,  'price_old' => null,  'badge' => 'Хит',     'badge_type' => 'hit',  'emoji' => '🐾', 'color' => 'green',  'category' => 'cats'],
            ['id' => 2, 'name' => 'Сушёная говядина полосками',    'sub' => 'Для собак · 80 г',     'price' => 189,  'price_old' => null,  'badge' => 'Новинка', 'badge_type' => 'new',  'emoji' => '🦴', 'color' => 'warm',   'category' => 'dogs'],
            ['id' => 3, 'name' => 'Зерновые палочки',              'sub' => 'Для грызунов · 50 г',  'price' => 239,  'price_old' => 299,   'badge' => '−20%',    'badge_type' => 'sale', 'emoji' => '🌾', 'color' => 'purple', 'category' => 'rodents'],
            ['id' => 4, 'name' => 'Рыбные снеки',                  'sub' => 'Для кошек · 60 г',     'price' => 349,  'price_old' => null,  'badge' => 'Хит',     'badge_type' => 'hit',  'emoji' => '🐟', 'color' => 'amber',  'category' => 'cats'],
            ['id' => 5, 'name' => 'Лосось в желе',                 'sub' => 'Для кошек · 85 г',     'price' => 279,  'price_old' => null,  'badge' => 'Новинка', 'badge_type' => 'new',  'emoji' => '🐠', 'color' => 'green',  'category' => 'cats'],
            ['id' => 6, 'name' => 'Кусочки курицы',                'sub' => 'Для собак · 90 г',     'price' => 186,  'price_old' => 219,   'badge' => '−15%',    'badge_type' => 'sale', 'emoji' => '🍗', 'color' => 'coral',  'category' => 'dogs'],
        ];
    }
}
