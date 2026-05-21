<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Разрешаем массовое заполнение этих колонок
    protected $fillable = [
        'name',
        'rating',
        'text',
        'product_id',
        'is_approved',
    ];
}