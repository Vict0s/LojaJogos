@extends('layouts.app')
@section('content')
<div class="catalog-heading"><div><p class="eyebrow">A TUA LOJA</p><h1>Carrinho</h1></div><a href="{{ route('games.index') }}">Continuar a explorar</a></div>
@if($games->isEmpty())
    <div class="empty-products"><span>🛒</span><h2>O carrinho está vazio</h2><p>Escolhe um jogo no catálogo para começar.</p><a class="button" href="{{ route('games.index') }}">Ver jogos</a></div>
@else
    <div class="cart-layout">
        <section class="cart-items">
            @foreach($games as $game)
                <article class="cart-row">
                    <div class="cart-game-icon">🎮</div>
                    <div class="cart-game"><a href="{{ route('games.show',$game) }}"><strong>{{ $game->title }}</strong></a><small>{{ $game->platform }} · {{ $game->format==='fisico'?'Físico':'Digital' }}</small><strong class="product-price">{{ number_format($game->price,2,',','.') }} €</strong></div>
                    <form method="post" action="{{ route('cart.update') }}" class="cart-quantity-form">@csrf @method('patch')<label class="quantity-field">Qtd.<input type="number" name="quantities[{{ $game->id }}]" min="1" max="10" value="{{ $quantities[$game->id] }}"></label><button class="secondary">Atualizar</button></form>
                    <form method="post" action="{{ route('cart.remove',$game) }}">@csrf @method('delete')<button class="link">Remover</button></form>
                </article>
            @endforeach
        </section>
        <aside class="cart-summary"><h2>Resumo</h2><p>{{ array_sum($quantities) }} artigo(s)</p><div class="cart-total"><span>Total</span><strong>{{ number_format($total,2,',','.') }} €</strong></div><p class="price-note">Valor de demonstração. Não é efetuado qualquer pagamento.</p>
            @auth<form method="post" action="{{ route('cart.checkout') }}">@csrf<button class="checkout-button">Registar compra de demonstração</button></form>
            @else<div class="cart-auth-actions"><p>O carrinho funciona sem conta. Para registar a compra, inicia sessão ou cria uma conta de cliente.</p><a class="checkout-button" href="{{ route('login') }}">Iniciar sessão para finalizar</a><a class="register-button" href="{{ route('register') }}">Criar conta de cliente</a></div>@endauth
        </aside>
    </div>
@endif
@endsection
