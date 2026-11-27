@extends('layouts.app')

@section('content')
<section class="contact-page">
    <p class="eyebrow">APOIO AO CLIENTE</p>
    <h1>Contactos</h1>
    <p>Precisas de ajuda com jogos ou encomendas? Usa os dados de contacto ou envia-nos uma mensagem.</p>

    <div class="contact-details">
        <div><strong>Email</strong><a href="mailto:apoio@lojaplay.test">apoio@lojaplay.test</a><small>Contacto demonstrativo do projeto académico</small></div>
        <div><strong>Atendimento</strong><span>Online, através do formulário</span><small>O formulário é demonstrativo e ainda não envia emails.</small></div>
    </div>

    <form method="post" action="{{ route('contact.send') }}" class="stack contact-form">
        @csrf
        <h2>Envia-nos uma mensagem</h2>
        <label>Nome<input name="name" value="{{ old('name') }}" required minlength="2" maxlength="100"></label>
        <label>Email<input type="email" name="email" value="{{ old('email') }}" required maxlength="255"></label>
        <label>Mensagem<textarea name="message" rows="6" required minlength="10" maxlength="3000">{{ old('message') }}</textarea></label>
        <button type="submit">Registar mensagem</button>
    </form>
</section>
@endsection
