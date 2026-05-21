<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        // Фильтры
        if ($request->category === 'sale') {
            $query->where('badge_type', 'sale');
        } elseif ($request->category === 'hit') {
            $query->where('badge_type', 'hit');
        } elseif ($request->category) {
            $query->where('category', $request->category);
        }

        // Поиск
        if ($request->q) {
            $searchTerm = mb_strtolower($request->q);
            $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $products = $query->get();

        return view('pages.catalog', compact('products')); 
    }

    // Добавление метода для отображения страницы одного товара
    public function show($id)
    {
        // Ищем товар в базе данных по его ID. 
        $product = Product::findOrFail($id);

        // Отдаем данные в шаблон страницы товара. 

        return view('pages.product', compact('product'));
    }
}