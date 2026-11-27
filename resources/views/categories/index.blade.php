@extends('layouts.app')
@section('content')
<section class="store-promo"><div class="promo-stamp">GAMING</div><div><small>LOJA PLAY · CATÁLOGO</small><h1>Escolhe a tua plataforma</h1><p>Jogos físicos e digitais para PlayStation, Xbox, Nintendo e PC.</p></div><a href="{{ route('games.index') }}">Explorar jogos <span>→</span></a></section>
@if($featured)<section class="featured-strip"><span class="eyebrow">DESTAQUE ALEATÓRIO</span><strong>{{ $featured->title }}</strong><span>{{ $featured->platform }} · {{ number_format($featured->price,2,',','.') }} €</span><a href="{{ route('games.show',$featured) }}">Ver jogo →</a></section>@endif
<div class="catalog-heading"><div><p class="eyebrow">ENCONTRA O TEU PRÓXIMO JOGO</p><h2>Comprar por plataforma ou tipo</h2></div></div>
<section class="platform-grid">@foreach($categories as $category)<a class="platform-card" href="{{ route('categories.show',$category) }}">@include('components.platform-icon', ['name'=>$category->name])<h2>{{ str_replace('Jogo ','',$category->name) }}</h2><p>{{ $category->description }}</p><strong>{{ $category->games_count }} produtos</strong><span class="platform-arrow">Ver categoria →</span></a>@endforeach</section>
<section class="info-strip"><b>Jogos e cartões digitais</b><span>Escolhe uma plataforma para ver jogos físicos, jogos digitais ou cartões de recarga.</span></section>
@endsection
