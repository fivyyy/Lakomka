<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        return redirect()->route('account.orders');
    }

    public function orders()
    {
        // Пример данных заказов (позже заменить на реальные из БД)
        $orders = [
            ['id' => '#2847', 'date' => '28 апреля 2026', 'items' => 'Мягкие подушечки × 2, Рыбные снеки × 1', 'total' => '847 ₽', 'status' => 'delivery'],
            ['id' => '#2791', 'date' => '15 апреля 2026', 'items' => 'Сушёная говядина × 3',                    'total' => '567 ₽', 'status' => 'done'],
            ['id' => '#2740', 'date' => '2 апреля 2026',  'items' => 'Зерновые палочки × 2, Лосось в желе × 2', 'total' => '1 036 ₽', 'status' => 'done'],
        ];
        return view('pages.account.orders', compact('orders'));
    }

    public function profile()
    {
        return view('pages.account.profile');
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->name  = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;

        if ($request->filled('password')) {
            $request->validate(['password' => 'min:8|confirmed']);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return back()->with('success', 'Профиль успешно обновлён!');
    }

    public function addresses()
    {
        return view('pages.account.addresses');
    }
}

