@extends('layouts.app')
@section('content')
<div class="account-layout">
    @include('profile.sidebar')
    <section class="account-content">
        <p class="eyebrow">A MINHA CONTA</p><h1>Dados da conta</h1>
        @if(session('status') === 'profile-updated')<p class="notice">Dados guardados com sucesso.</p>@endif
        <form method="post" action="{{ route('profile.update') }}" class="account-form">@csrf @method('patch')
            <label>Nome<input name="name" value="{{ old('name',auth()->user()->name) }}" required minlength="2" autocomplete="name"></label>
            <label>Email<input type="email" name="email" value="{{ old('email',auth()->user()->email) }}" required autocomplete="email"></label>
            <button>Guardar alterações</button>
        </form>
        <div class="account-divider"></div>
        <h2>Palavra-passe</h2><p class="muted">Atualiza a palavra-passe da tua conta.</p>
        <form method="post" action="{{ route('password.update') }}" class="account-form">@csrf @method('put')
            <label>Palavra-passe atual<input type="password" name="current_password" required autocomplete="current-password"></label>
            <label>Nova palavra-passe<input type="password" name="password" required minlength="8" autocomplete="new-password"></label>
            <label>Confirmar nova palavra-passe<input type="password" name="password_confirmation" required autocomplete="new-password"></label>
            <button>Alterar palavra-passe</button>
        </form>
    </section>
</div>
@endsection
