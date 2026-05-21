<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
        {
            // 1. Считаем реальные показатели из БД
            $revenueTotal = \App\Models\Order::where('status', 'completed')->sum('total_price') ?? 0;
            $ordersTotalCount = \App\Models\Order::count();
            $usersTotal = \App\Models\User::count();
    
            // ПОДКЛЮЧАЕМ ОТЗЫВЫ К БАЗЕ ДАННЫХ
            $newReviewsCount = \App\Models\Review::where('is_approved', false)->count(); // Ждут проверки
            $totalReviews = \App\Models\Review::count(); // Всего отзывов
    
            $stats = [
                ['label' => 'Выручка за месяц', 'value' => number_format($revenueTotal, 0, '.', ' ') . ' ₽', 'change' => '+12%', 'up' => true,  'icon' => '💰'],
                ['label' => 'Заказов за месяц',  'value' => (string)$ordersTotalCount,        'change' => '+8%',  'up' => true,  'icon' => '📦'],
                ['label' => 'Пользователей',     'value' => $usersTotal,  'change' => 'в БД', 'up' => true,  'icon' => '👥'],
                // Выводим реальные цифры отзывов:
                ['label' => 'Новых отзывов',     'value' => $newReviewsCount, 'change' => 'Всего: ' . $totalReviews, 'up' => true, 'icon' => '⭐'],
            ];
    
            // 2. Получаем 5 самых свежих заказов
            $realOrders = \App\Models\Order::orderBy('created_at', 'desc')->take(5)->get();
            
            $orders = [];
            foreach ($realOrders as $order) {
                $orders[] = [
                    'id' => '#' . $order->id,
                    'raw_id' => $order->id,
                    'client' => $order->client_name,
                    'items' => \Illuminate\Support\Str::limit($order->items, 40),
                    'total' => number_format($order->total_price, 0, '.', ' ') . ' ₽',
                    'status' => $order->status === 'new' ? 'Новый' : ($order->status === 'completed' ? 'Выполнен' : $order->status),
                    'tag' => $order->status === 'new' ? 'atag-blue' : ($order->status === 'completed' ? 'atag-green' : 'atag-coral'),
                    'date' => $order->created_at->format('d.m.Y'),
                ];
            }
    
            // 3. ВЫВОДИМ РЕАЛЬНЫЕ ТОВАРЫ 
            $dbProducts = \App\Models\Product::inRandomOrder()->take(4)->get();
            $topProducts = [];
            foreach($dbProducts as $rp) {
                $topProducts[] = [
                    'emoji' => $rp->emoji ?? '🐾', 
                    'name' => $rp->name,    
                    'sales' => rand(15, 150), 
                    'revenue' => number_format($rp->price * rand(5, 20), 0, '.', ' ') . ' ₽'
                ];
            }
    
            return view('admin.dashboard', compact('stats', 'orders', 'topProducts'));
        }
    // Метод для перевода заказа в статус "Выполнен"
    public function completeOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->status = 'completed';
        $order->save();

        return redirect()->back()->with('success', 'Заказ выполнен! Выручка обновлена.');
    }

    public function orders()   
    { 
        $orders = \App\Models\Order::orderBy('created_at', 'desc')->paginate(10); 
        return view('admin.orders', compact('orders')); 
    }

    public function products()
    {
        $products = \App\Models\Product::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products_create');
    }

    public function storeProduct(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'sub' => 'nullable|string|max:255',
            'price' => 'required|numeric',
            'price_old' => 'nullable|numeric',
            'emoji' => 'required|string',
            'color' => 'required|string',
            'badge' => 'nullable|string',
            'badge_type' => 'nullable|string',
        ]);

        \App\Models\Product::create($data);

        return redirect()->route('admin.products')->with('success', 'Товар успешно добавлен!');
    }

    public function users()
    {
        $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        return view('admin.users', compact('users'));
    }

    public function reviews()
{
    // В админке видим ВСЕ отзывы
    $reviews = \App\Models\Review::orderBy('is_approved', 'asc')->orderBy('created_at', 'desc')->get();
    return view('admin.reviews', compact('reviews'));
}

public function approveReview($id)
{
    $review = \App\Models\Review::findOrFail($id);
    $review->is_approved = true;
    $review->save();
    return redirect()->back()->with('success', 'Отзыв одобрен и теперь виден на сайте!');
}

public function deleteReview($id)
{
    \App\Models\Review::findOrFail($id)->delete();
    return redirect()->back()->with('success', 'Отзыв удален.');
}
    public function articles() { return view('admin.articles'); }
    public function promos()   { return view('admin.promos'); }
    public function messages()
    {
        // Сначала показываем непрочитанные, затем самые новые
        $messages = \App\Models\ContactMessage::orderBy('is_read', 'asc')->orderBy('created_at', 'desc')->get();
        return view('admin.messages', compact('messages'));
    }

    public function readMessage($id)
    {
        $message = \App\Models\ContactMessage::findOrFail($id);
        $message->is_read = true;
        $message->save();
        return redirect()->back()->with('success', 'Сообщение отмечено как прочитанное.');
    }

    public function deleteMessage($id)
    {
        \App\Models\ContactMessage::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Сообщение успешно удалено.');
    }
    public function replyMessage(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'contact' => 'required|string',
            'reply_text' => 'required|string',
        ]);

        $contact = $request->contact;
        $text = $request->reply_text;

        // Проверяем, указал ли клиент Email (а не телефон)
        if (filter_var($contact, FILTER_VALIDATE_EMAIL)) {
            try {
                // Пытаемся отправить письмо средствами Laravel
                \Illuminate\Support\Facades\Mail::raw($text, function($message) use ($contact) {
                    $message->to($contact)->subject('Ответ на ваше обращение | Лакомка');
                });
                return redirect()->back()->with('success', 'Ответ успешно отправлен клиенту!');
            } catch (\Exception $e) {
                // Если почта на сервере не настроена, выдаем понятное предупреждение
                return redirect()->back()->with('error', 'Письмо не отправлено. Необходимо настроить почту (SMTP) в файле .env');
            }
        }

        // Если там телефон, а не email
        return redirect()->back()->with('error', 'Указан телефон, а не Email. Свяжитесь с клиентом вручную.');
    }
}
