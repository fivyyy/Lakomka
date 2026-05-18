<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Администратор
        User::updateOrCreate(
            ['email' => 'admin@lakomka.ru'],
            [
                'name'     => 'Администратор',
                'email'    => 'admin@lakomka.ru',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // Обычный пользователь для тестов
        User::updateOrCreate(
            ['email' => 'user@lakomka.ru'],
            [
                'name'     => 'Тестовый Пользователь',
                'email'    => 'user@lakomka.ru',
                'password' => Hash::make('user123'),
                'is_admin' => false,
            ]
        );

        $this->command->info('✓ Создан администратор: admin@lakomka.ru / admin123');
        $this->command->info('✓ Создан пользователь:  user@lakomka.ru  / user123');
    }
}
