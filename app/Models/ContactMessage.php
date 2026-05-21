<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    // Разрешаем сохранять эти данные из формы
    protected $fillable = ['name', 'contact', 'message', 'is_read'];
}