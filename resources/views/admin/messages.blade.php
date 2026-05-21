@extends('layouts.admin')
@section('title', 'Входящие сообщения')

@section('content')
<div class="admin-card">
    <div class="admin-card-title">Сообщения с формы контактов</div>
    <table class="admin-table">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Имя</th>
                <th>Контакты</th>
                <th>Текст сообщения</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($messages as $m)
            <tr style="{{ !$m->is_read ? 'background: rgba(33, 131, 89, 0.03); font-weight: 500;' : '' }}">
                <td style="white-space: nowrap;">{{ $m->created_at->format('d.m.Y H:i') }}</td>
                <td><strong>{{ $m->name }}</strong></td>
                <td>
                    {{-- Кнопка быстрого ответа: если там email, откроется почта, если телефон — вызов --}}
                    <a href="{{ str_contains($m->contact, '@') ? 'mailto:'.$m->contact : 'tel:'.$m->contact }}" 
                       style="color: #218359; text-decoration: underline; font-size: 13px;">
                        {{ $m->contact }}
                    </a>
                </td>
                <td style="max-width: 400px; font-size: 13px; line-height: 1.4; padding-right: 20px;">
                    {{ $m->message }}
                </td>
                <td>
                    @if($m->is_read)
                        <span class="admin-tag atag-green">Прочитано</span>
                    @else
                        <span class="admin-tag atag-amber">Новое</span>
                    @endif
                </td>
                <td>
                    <div style="display: flex; gap: 8px;">
                        {{-- Кнопка "Прочитано" --}}
                        @if(!$m->is_read)
                            <form action="{{ route('admin.messages.read', $m->id) }}" method="POST">
                                @csrf
                                <button class="admin-btn-sm" style="background: #218359; color: white; border:none; white-space:nowrap;">
                                    ✓ Прочитано
                                </button>
                            </form>
                        @endif
                        
                            <button type="button" onclick="openReplyModal('{{ $m->contact }}', '{{ $m->name }}')" class="admin-btn-sm" style="background: #0369a1; color: white; border:none; cursor:pointer;">
                                Ответить
                            </button>

                        {{-- Удалить --}}
                        <form action="{{ route('admin.messages.delete', $m->id) }}" method="POST" onsubmit="return confirm('Удалить это сообщение?')">
                            @csrf @method('DELETE')
                            <button class="admin-btn-sm" style="background: #be123c; color: white; border:none;">
                                🗑️
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center; padding: 40px; color: var(--muted);">
                    Входящих сообщений пока нет.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{-- MODAL ДЛЯ ОТВЕТА --}}
<div id="replyModal" class="modal-overlay" onclick="if(event.target===this)this.classList.remove('open')">
    <div class="modal-box" style="max-width: 500px; background: white; border-radius: 12px; overflow: hidden;">
        <div style="display: flex; justify-content: space-between; padding: 20px; border-bottom: 1px solid #eee;">
            <div>
                <div style="font-weight: 600; font-size: 18px;">Ответ клиенту</div>
                <div id="replyModalSub" style="font-size: 13px; color: #666; margin-top: 4px;"></div>
            </div>
            <button type="button" onclick="document.getElementById('replyModal').classList.remove('open')" style="border:none; background:none; font-size: 20px; cursor:pointer;">×</button>
        </div>
        <form action="{{ route('admin.messages.reply') }}" method="POST" style="padding: 20px;">
            @csrf
            <input type="hidden" name="contact" id="replyContact">
            
            <div style="margin-bottom: 15px;">
                <label style="display: block; font-size: 13px; font-weight: 500; margin-bottom: 8px;">Текст ответа *</label>
                <textarea name="reply_text" required style="width: 100%; height: 120px; padding: 10px; border: 1px solid #ccc; border-radius: 6px; font-family: inherit; resize: vertical;" placeholder="Здравствуйте..."></textarea>
            </div>
            
            <button type="submit" style="width: 100%; background: #0369a1; color: white; border: none; padding: 12px; border-radius: 6px; font-weight: 500; cursor: pointer;">
                Отправить письмо
            </button>
        </form>
    </div>
</div>

<script>
function openReplyModal(contact, name) {
    document.getElementById('replyContact').value = contact;
    document.getElementById('replyModalSub').innerText = 'Кому: ' + name + ' (' + contact + ')';
    document.getElementById('replyModal').classList.add('open');
}
</script>

<style>
.modal-overlay {
    display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 1000;
    align-items: center; justify-content: center; padding: 20px;
}
.modal-overlay.open { display: flex; }
</style>
@endsection