@extends('layouts.admin')
@section('title', 'Добавить товар')

@section('content')
<style>
    /* Красивые стили для нашей формы */
    .form-card { background: white; border-radius: 12px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); }
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-size: 14px; font-weight: 600; margin-bottom: 8px; color: var(--text); }
    .form-control { width: 100%; padding: 12px 16px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; transition: all 0.2s; box-sizing: border-box; background: #f8fafc; }
    .form-control:focus { border-color: #218359; background: white; outline: none; box-shadow: 0 0 0 3px rgba(33, 131, 89, 0.1); }
    
    /* Зона загрузки файла */
    .file-upload-zone { border: 2px dashed #cbd5e1; border-radius: 12px; padding: 40px 20px; text-align: center; cursor: pointer; transition: all 0.2s; background: #f8fafc; display: block; }
    .file-upload-zone:hover { border-color: #218359; background: #f1f5f9; }
    .file-upload-zone input[type="file"] { display: none; }
    
    .btn-submit { background: #218359; color: white; padding: 16px; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: background 0.2s; width: 100%; margin-top: 10px; }
    .btn-submit:hover { background: #186b48; }
</style>

<div style="max-width: 800px; margin: 0 auto; padding-bottom: 40px;">
    <div style="margin-bottom: 24px;">
        <a href="{{ route('admin.products') }}" style="text-decoration: none; color: var(--muted); font-size: 14px; font-weight: 500;">← Назад к списку</a>
        <h2 style="margin: 12px 0 0; font-size: 24px; font-weight: 600;">Новый товар</h2>
    </div>

    <div class="form-card">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                
                <div style="grid-column: span 2; margin-bottom: 10px;">
                    <label class="form-label">Фотография товара</label>
                    <label class="file-upload-zone">
                        <input type="file" name="image" accept="image/png, image/jpeg, image/webp">
                        <div style="font-size: 32px; margin-bottom: 8px;">📸</div>
                        <div style="font-size: 14px; font-weight: 600; color: #475569;">Нажмите, чтобы выбрать картинку</div>
                        <div style="font-size: 12px; color: var(--muted); margin-top: 6px;">PNG, JPG, WEBP до 2 МБ</div>
                    </label>
                </div>

                <div style="grid-column: span 2;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Название товара</label>
                        <input type="text" name="name" class="form-control" required placeholder="Например: Хрустящие подушечки с лососем">
                    </div>
                </div>

                <div style="grid-column: span 2;">
                    <div class="form-group" style="margin-bottom: 0;">
                        <label class="form-label">Описание (кратко)</label>
                        <input type="text" name="sub" class="form-control" placeholder="Например: Для кошек • 100 г">
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Цена (₽)</label>
                    <input type="number" name="price" class="form-control" required placeholder="249">
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Старая цена (₽)</label>
                    <input type="number" name="price_old" class="form-control" placeholder="299 (необязательно)">
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Эмодзи</label>
                    <select name="emoji" class="form-control" required>
                        <option value="🐾">🐾 Лапки</option>
                        <option value="🐟">🐟 Рыба</option>
                        <option value="🦴">🦴 Кость</option>
                        <option value="🌾">🌾 Зерно</option>
                        <option value="🍗">🍗 Окорочок</option>
                        <option value="🥩">🥩 Мясо</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Цвет карточки</label>
                    <select name="color" class="form-control" required>
                        <option value="blue">Голубой</option>
                        <option value="orange">Оранжевый</option>
                        <option value="green">Зеленый</option>
                        <option value="gray">Серый</option>
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Текст бейджа</label>
                    <input type="text" name="badge" class="form-control" placeholder="Хит">
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label class="form-label">Тип бейджа</label>
                    <select name="badge_type" class="form-control">
                        <option value="hit">Хит (синий)</option>
                        <option value="sale">Скидка (красный)</option>
                    </select>
                </div>

            </div>

            <button type="submit" class="btn-submit">Сохранить товар</button>
        </form>
    </div>
</div>
@endsection