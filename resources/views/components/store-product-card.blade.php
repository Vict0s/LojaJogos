<article class="product-card">
    @php($isFavorite = auth()->check() && auth()->user()->favoriteGames->contains($game->id))
    <a class="product-art @if($game->platform === 'Steam') product-art--steam @endif" href="{{ route('games.show',$game) }}">
        @if($game->image_url)<img src="{{ $game->image_url }}" alt="Capa {{ $game->title }}">@else<span>🎮</span>@endif
    </a>
    <div class="product-info">
        <small>{{ $game->platform }} · {{ $game->category->name === 'Cartões de recarga e Gift Cards' ? 'Cartão digital' : ($game->format==='fisico'?'Físico':'Digital') }}</small>
        <a href="{{ route('games.show',$game) }}"><h3>{{ $game->title }}</h3></a>
        <strong class="product-price">{{ number_format($game->price,2,',','.') }} €</strong>
        <small class="price-note">Preço de referência; confirma disponibilidade na loja.</small>
        @if($game->source_url)<a class="source-link" href="{{ $game->source_url }}" target="_blank" rel="noopener">Ver na Worten ↗</a>@endif
        @unless(auth()->check() && auth()->user()->is_admin)
            <form method="post" action="{{ route('cart.add',$game) }}">@csrf<button class="add-cart-button">Adicionar ao carrinho</button></form>
        @endunless
        @auth @unless(auth()->user()->is_admin)<form method="post" action="{{ route('favorites.toggle',$game) }}">@csrf<button class="favorite-button {{ $isFavorite ? 'is-favorite' : '' }}" aria-label="{{ $isFavorite ? 'Remover dos favoritos' : 'Adicionar aos favoritos' }}"><span aria-hidden="true">{{ $isFavorite ? '♥' : '♡' }}</span> {{ $isFavorite ? 'Guardado' : 'Guardar' }}</button></form>@endunless @endauth
    </div>
</article>
