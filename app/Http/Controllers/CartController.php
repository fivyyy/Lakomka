<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart  = session('cart', []);
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['qty']);

        return view('pages.cart', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $cart = session('cart', []);
        $id   = $request->id;

        if (isset($cart[$id])) {
            $cart[$id]['qty']++;
        } else {
            $cart[$id] = [
                'name'  => $request->name,
                'price' => (int) $request->price,
                'emoji' => $request->emoji,
                'color' => $request->color,
                'sub'   => $request->sub,
                'qty'   => 1,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', '«' . $request->name . '» добавлен в корзину');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);
        $id   = $request->id;
        $qty  = (int) $request->qty;

        if ($qty <= 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['qty'] = $qty;
        }

        session(['cart' => $cart]);

        return back();
    }

    public function remove(Request $request)
    {
        $cart = session('cart', []);
        unset($cart[$request->id]);
        session(['cart' => $cart]);

        return back();
    }
}
