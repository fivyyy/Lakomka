<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Берем все товары для главной страницы
        $products = Product::all();
        return view('pages.home', compact('products'));
    }
    public function makeOrder(\Illuminate\Http\Request $request)
    {
        // 1. Собираем имя клиента из формы (Имя + Фамилия + Телефон)
        $clientName = $request->first_name . ' ' . $request->last_name . ' (' . $request->phone . ')';

        // 2. Создаем заказ в базе данных
        // (пока пишем заглушку для товаров и цены, так как корзина у вас скорее всего работает на JavaScript)
        \App\Models\Order::create([
            'client_name' => $clientName,
            'items' => 'Товары из корзины (Адрес: ' . $request->city . ', ' . $request->street . ')', 
            'total_price' => 999, // В будущем сюда будем передавать реальную сумму
            'status' => 'new'
        ]);

        // 3. Перенаправляем пользователя на главную страницу с сообщением об успехе
        // (Позже можно сделать красивую отдельную страницу "Спасибо за заказ")
        return redirect('/')->with('success', 'Спасибо! Ваш заказ успешно оформлен.');
    }
        public function storeReview(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'text' => 'required|string|min:5',
            'product_id' => 'nullable|exists:products,id'
        ]);
    
        \App\Models\Review::create($data); // Сохраняется с is_approved = false
    
        return redirect()->back()->with('success', 'Спасибо! Отзыв отправлен на проверку.');
    }
    public function reviews()
    {
        // 1. Берем из базы только одобренные отзывы, сортируем от новых к старым
        $reviews = \App\Models\Review::where('is_approved', true)->orderBy('created_at', 'desc')->get();
        
        // 2. Считаем общее количество и средний балл
        $totalReviews = $reviews->count();
        $avgRating = $totalReviews > 0 ? round($reviews->avg('rating'), 1) : 0;

        // 3. Считаем проценты для каждой оценки (для красивых полосок прогресса)
        $ratingPercents = [5 => 0, 4 => 0, 3 => 0, 2 => 0, 1 => 0];
        if ($totalReviews > 0) {
            foreach (range(5, 1) as $stars) {
                $count = $reviews->where('rating', $stars)->count();
                $ratingPercents[$stars] = round(($count / $totalReviews) * 100);
            }
        }

        // 4. Процент людей, поставивших 4 и 5 (те, кто рекомендуют)
        $recommendPercent = $totalReviews > 0 ? $ratingPercents[5] + $ratingPercents[4] : 0;

        // 5. Передаем ВСЕ эти переменные в шаблон, чтобы он не ругался!
        return view('pages.reviews', compact('reviews', 'totalReviews', 'avgRating', 'ratingPercents', 'recommendPercent'));
    }
    public function sendMessage(\Illuminate\Http\Request $request)
    {
        // 1. Проверяем, чтобы поля не были пустыми
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        // 2. Сохраняем в базу
        \App\Models\ContactMessage::create($data);

        // 3. Возвращаем обратно с сообщением об успехе
        return redirect()->back()->with('success', 'Спасибо! Ваше сообщение отправлено, мы скоро с вами свяжемся.');
    }
}