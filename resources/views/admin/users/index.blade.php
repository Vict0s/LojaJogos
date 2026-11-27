@extends('layouts.app')

@section('content')
<div class="account-layout admin-account-layout">
    @include('profile.sidebar')
    <section class="account-content">

    <h1>Clientes registados</h1>
    <p>Contas de cliente criadas na Loja Play.</p>

    @if ($users->isEmpty())
        <p class="notice">Ainda não há clientes registados.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Data de registo</th>
                    <th>Palavra-passe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td>{{ $user->created_at?->format('d/m/Y H:i') ?? '—' }}</td>
                        <td><span aria-label="Palavra-passe protegida">********</span> <a class="button secondary" href="{{ route('admin.users.password.edit', $user) }}">Redefinir</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $users->links() }}
    @endif

    </section>
</div>
@endsection
