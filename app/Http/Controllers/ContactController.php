<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function send(Request $request): RedirectResponse
    {
        $request->validate(['name'=>'required|string|min:2|max:100','email'=>'required|email|max:255','message'=>'required|string|min:10|max:3000']);
        return back()->with('status', 'Formulário demonstrativo: o envio de email ainda não está configurado.');
    }
}
