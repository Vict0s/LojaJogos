@extends('layouts.app')
@section('content')
<p><a href="{{ route('home') }}">← Início</a></p>
<article class="detail">
    @if($game->image_url)<img src="{{ $game->image_url }}" alt="Capa de {{ $game->title }}">@else<div class="placeholder">🎮</div>@endif
    <div>
        <small>{{ $game->category->name }} · {{ $game->platform }} · {{ $game->category->name === 'Cartões de recarga e Gift Cards' ? 'Cartão digital' : ($game->format==='fisico'?'Jogo físico':'Jogo digital') }}</small>
        <h1>{{ $game->title }}</h1><p>{{ $game->description }}</p>
        <h2>{{ number_format($game->price,2,',','.') }} €</h2><p class="price-note">Preço de referência; confirma valor e disponibilidade na loja.</p>
        @if($game->source_url)<p><a class="source-link" href="{{ $game->source_url }}" target="_blank" rel="noopener">Consultar na Worten ↗</a></p>@endif
        @if($game->release_date)<p>Lançamento: {{ $game->release_date->format('d/m/Y') }}</p>@endif
        @unless(auth()->check() && auth()->user()->is_admin)<form method="post" action="{{ route('cart.add',$game) }}">@csrf<button class="add-cart-button">Adicionar ao carrinho</button></form>@endunless
        @auth @unless(auth()->user()->is_admin)<form method="post" action="{{ route('favorites.toggle',$game) }}">@csrf@php($isFavorite = auth()->user()->favoriteGames->contains($game->id))<button class="favorite-button {{ $isFavorite ? 'is-favorite' : '' }}"><span aria-hidden="true">{{ $isFavorite ? '♥' : '♡' }}</span> {{ $isFavorite ? 'Guardado nos favoritos' : 'Guardar nos favoritos' }}</button></form>@endunless @endauth
    </div>
</article>
<aside class="notice">Destaque aleatório: <a href="{{ route('games.show',$featured) }}">{{ $featured->title }}</a></aside>
@endsection
