@extends('layouts.app')
@section('content')
<div class="account-layout">
    @include('profile.sidebar')
    <section class="account-content">
        <p class="eyebrow">A MINHA CONTA</p><h1>Favoritos</h1><p class="muted">Jogos que guardaste para veres mais tarde.</p>
        <section class="grid">
            @forelse($games as $game)
                <article class="card"><a href="{{ route('games.show',$game) }}">@if($game->image_url)<img src="{{ $game->image_url }}" alt="Capa {{ $game->title }}">@else<div class="placeholder">🎮</div>@endif<h2>{{ $game->title }}</h2></a><p>{{ $game->category->name }} · {{ $game->platform }}</p><strong>{{ number_format($game->price,2,',','.') }} €</strong><form method="post" action="{{ route('favorites.toggle',$game) }}">@csrf<button class="secondary">Remover dos favoritos</button></form></article>
            @empty
                <p>Ainda não guardaste jogos favoritos. Explora o <a href="{{ route('home') }}">catálogo</a>.</p>
            @endforelse
        </section>{{ $games->links() }}
    </section>
</div>
@endsection
