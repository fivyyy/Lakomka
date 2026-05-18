<?php
namespace App\Http\Controllers;
class ArticleController extends Controller {
    public function index() {
        $articles = [
            ['title' => 'Как правильно выбрать лакомства для кошки', 'category' => 'Питание', 'desc' => 'Разбираем состав, норму выдачи и популярные ошибки владельцев.', 'date' => '01 мая 2026', 'read' => 5, 'emoji' => '🐱', 'bg' => 'linear-gradient(135deg,#e8f5ef,#c3e8d7)'],
            ['title' => 'Аллергия у собак: признаки и диета', 'category' => 'Здоровье', 'desc' => 'Какие продукты исключить и чем заменить привычные лакомства при аллергии.', 'date' => '28 апр. 2026', 'read' => 7, 'emoji' => '🐶', 'bg' => 'linear-gradient(135deg,#fdf0e8,#f8ddc8)'],
            ['title' => 'Что можно и нельзя давать хомяку', 'category' => 'Грызуны', 'desc' => 'Полный список разрешённых и запрещённых продуктов для хомяков, мышей и крыс.', 'date' => '25 апр. 2026', 'read' => 4, 'emoji' => '🐹', 'bg' => 'linear-gradient(135deg,#f0eeff,#e0dbff)'],
            ['title' => '5 натуральных лакомств, которые любят все кошки', 'category' => 'Советы', 'desc' => 'Простые рецепты из обычных продуктов для вашего питомца.', 'date' => '20 апр. 2026', 'read' => 3, 'emoji' => '🌿', 'bg' => 'linear-gradient(135deg,#fef6e8,#fdeac8)'],
        ];
        return view('pages.articles', compact('articles'));
    }
    public function show($article) { return redirect()->route('articles'); }
}
