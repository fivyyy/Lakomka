<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $products = HomeController::getProducts();

        if ($request->category === 'sale') {
            $products = array_filter($products, fn($p) => $p['badge_type'] === 'sale');
        } elseif ($request->category === 'hit') {
            $products = array_filter($products, fn($p) => $p['badge_type'] === 'hit');
        } elseif ($request->category) {
            $products = array_filter($products, fn($p) => $p['category'] === $request->category);
        }

        if ($request->q) {
            $q = mb_strtolower($request->q);
            $products = array_filter($products, fn($p) => str_contains(mb_strtolower($p['name']), $q));
        }

        return view('pages.catalog', ['products' => array_values($products)]);
    }

    public function show($id)
    {
        $products = HomeController::getProducts();
        $product  = collect($products)->firstWhere('id', (int) $id);

        if (!$product) {
            abort(404);
        }

        // Похожие товары (той же категории, кроме текущего)
        $related = collect($products)
            ->filter(fn($p) => $p['category'] === $product['category'] && $p['id'] !== $product['id'])
            ->take(3)
            ->values()
            ->all();

        return view('pages.product', compact('product', 'related'));
    }
}
