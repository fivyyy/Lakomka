<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function index()
    {
        // 1. Берем из базы только одобренные отзывы, сортируем от новых к старым
        $reviews = Review::where('is_approved', true)->orderBy('created_at', 'desc')->get();
        
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

        // 5. Передаем ВСЕ переменные в шаблон
        return view('pages.reviews', compact('reviews', 'totalReviews', 'avgRating', 'ratingPercents', 'recommendPercent'));
    }
}