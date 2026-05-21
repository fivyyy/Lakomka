<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Разрешаем заполнять все поля базы данных массово 
    // (полезно, чтобы не перечислять каждое поле вручную)
    protected $guarded = [];
}