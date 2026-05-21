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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Имя покупателя
            $table->integer('rating')->default(5); // Оценка от 1 до 5
            $table->text('text'); // Текст отзыва
            $table->foreignId('product_id')->nullable(); // К какому товару относится (ID из таблицы products)
            $table->boolean('is_approved')->default(false); // Одобрен ли админом (по умолчанию нет)
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
        Schema::dropIfExists('reviews');
    }
};
