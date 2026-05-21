<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            // Если админ — перенаправить в админ-панель
            if (Auth::user()->is_admin) {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->intended(route('account'));
        }

        return back()->withErrors(['Неверный email или пароль.'])->withInput();
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name . ($request->last_name ? ' ' . $request->last_name : ''),
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('account')->with('success', 'Добро пожаловать, ' . $user->name . '!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
