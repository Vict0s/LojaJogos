@extends('layouts.app')

@section('content')
<div class="account-layout admin-account-layout">
    @include('profile.sidebar')
    <section class="account-content">
        <p class="eyebrow">GEST&Atilde;O DE CLIENTES</p>
        <h1>Redefinir palavra-passe</h1>
        <p>Cliente: <strong>{{ $client->name }}</strong> ({{ $client->email }})</p>
        <p>A palavra-passe atual n&atilde;o pode ser consultada. Define uma nova palavra-passe para esta conta.</p>

        <form class="stack" method="post" action="{{ route('admin.users.password.update', $client) }}">
            @csrf
            @method('PUT')
            <label>Nova palavra-passe
                <input type="password" name="password" required minlength="8" maxlength="255" autocomplete="new-password">
            </label>
            <label>Confirmar nova palavra-passe
                <input type="password" name="password_confirmation" required minlength="8" maxlength="255" autocomplete="new-password">
            </label>
            <div>
                <button type="submit">Guardar nova palavra-passe</button>
                <a class="button secondary" href="{{ route('admin.users.index') }}">Cancelar</a>
            </div>
        </form>
    </section>
</div>
@endsection
