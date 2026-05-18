<?php
namespace App\Http\Controllers;
class PromoController extends Controller {
    public function index() {
        $promos = [
            ['style' => 'green',  'until' => 'До 15 мая',   'name' => 'Скидка 30% на всё для кошек',    'desc' => 'При покупке от 500 ₽. Промокод применится в корзине.',         'btn' => 'Промокод: CAT30', 'value' => '−30%'],
            ['style' => 'amber',  'until' => 'До 20 мая',   'name' => '2+1 на лакомства для собак',      'desc' => 'Три упаковки по цене двух. Скидка применяется автоматически.',  'btn' => 'В каталог',       'value' => '2+1'],
            ['style' => 'purple', 'until' => 'Постоянно',   'name' => 'Бесплатная доставка от 800 ₽',   'desc' => 'По всей России при заказе от 800 рублей без промокода.',         'btn' => null,              'value' => '🚚'],
            ['style' => 'coral',  'until' => 'До 10 мая',   'name' => 'Новинки со скидкой 15%',          'desc' => 'На все товары с пометкой «Новинка» в каталоге.',                 'btn' => 'Смотреть новинки', 'value' => '−15%'],
        ];
        return view('pages.promos', compact('promos'));
    }
}
