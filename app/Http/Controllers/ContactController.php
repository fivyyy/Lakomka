<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ContactController extends Controller {
    public function index() { return view('pages.contacts'); }
    public function send(Request $request) {
        $request->validate(['name' => 'required', 'contact' => 'required', 'message' => 'required']);
        return back()->with('success', 'Сообщение отправлено! Мы ответим в течение 2 часов.');
    }
}
