<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $usersTotal = \App\Models\User::count();
        $adminsTotal = \App\Models\User::where('is_admin', true)->count();

        $stats = [
            ['label' => 'Выручка за месяц', 'value' => '184 320 ₽', 'change' => '+12%', 'up' => true,  'icon' => '💰'],
            ['label' => 'Заказов за месяц',  'value' => '347',        'change' => '+8%',  'up' => true,  'icon' => '📦'],
            ['label' => 'Пользователей',     'value' => $usersTotal,  'change' => 'в БД', 'up' => true,  'icon' => '👥'],
            ['label' => 'Новых отзывов',     'value' => '23',         'change' => '−2',   'up' => false, 'icon' => '⭐'],
        ];

        $orders = [
            ['id' => '#2851', 'client' => 'Ирина Соколова',   'items' => 'Подушечки × 2, Снеки × 1',    'total' => '847 ₽',   'status' => 'Новый',      'tag' => 'atag-blue',  'date' => '08.05.2026'],
            ['id' => '#2850', 'client' => 'Алексей Иванов',   'items' => 'Говядина × 3',                 'total' => '567 ₽',   'status' => 'В доставке', 'tag' => 'atag-amber', 'date' => '07.05.2026'],
            ['id' => '#2849', 'client' => 'Мария Козлова',    'items' => 'Лосось × 2, Палочки × 1',     'total' => '797 ₽',   'status' => 'Доставлен',  'tag' => 'atag-green', 'date' => '06.05.2026'],
            ['id' => '#2848', 'client' => 'Дмитрий Романов',  'items' => 'Снеки × 4',                   'total' => '1 396 ₽', 'status' => 'Доставлен',  'tag' => 'atag-green', 'date' => '05.05.2026'],
            ['id' => '#2847', 'client' => 'Ольга Тихонова',   'items' => 'Подушечки × 1',               'total' => '249 ₽',   'status' => 'Отменён',    'tag' => 'atag-coral', 'date' => '04.05.2026'],
        ];

        $topProducts = [
            ['emoji' => '🐾', 'name' => 'Мягкие подушечки',    'sales' => 142, 'revenue' => '35 358 ₽'],
            ['emoji' => '🦴', 'name' => 'Говядина полосками',   'sales' => 118, 'revenue' => '22 302 ₽'],
            ['emoji' => '🐟', 'name' => 'Рыбные снеки',         'sales' => 97,  'revenue' => '33 853 ₽'],
            ['emoji' => '🌾', 'name' => 'Зерновые палочки',     'sales' => 84,  'revenue' => '20 076 ₽'],
        ];

        return view('admin.dashboard', compact('stats', 'orders', 'topProducts'));
    }

    public function orders()   { return view('admin.orders'); }
    public function products() { return view('admin.products'); }
    public function users()
    {
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }
    public function reviews()  { return view('admin.reviews'); }
    public function articles() { return view('admin.articles'); }
    public function promos()   { return view('admin.promos'); }
}
