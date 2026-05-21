<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
{
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('name');             // Название (например: "Рыбные снеки")
        $table->string('sub')->nullable();  // Подпись (например: "Для кошек • 60 г")
        $table->integer('price');           // Текущая цена
        $table->integer('price_old')->nullable(); // Старая цена (если есть скидка)
        $table->string('emoji');            // Эмодзи (🐟, 🦴 и т.д.)
        $table->string('color');            // Цвет фона (blue, orange, green)
        $table->string('badge')->nullable(); // Текст бейджа (Хит, Новинка, -15%)
        $table->string('badge_type')->nullable(); // Цвет бейджа
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
