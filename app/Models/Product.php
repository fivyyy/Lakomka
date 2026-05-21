<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Указываем точное имя таблицы в базе данных Beget
    protected $table = 'products';

    // Разрешаем массовое заполнение полей
    protected $guarded = [];
}