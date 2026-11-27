@extends('layouts.app')
@section('content')
<section class="store-promo">
    <div class="promo-stamp">LOJA<br>PLAY</div>
    <div><small>CATÁLOGO GAMING</small><h1>O próximo jogo começa aqui</h1><p>Explora novidades para consola e PC, em formato físico ou digital.</p></div>
    <a href="{{ route('categories.index') }}">Escolher plataforma <span>→</span></a>
</section>
@if($featured)<section class="featured-strip"><span class="eyebrow">DESTAQUE ALEATÓRIO</span><strong>{{ $featured->title }}</strong><span>{{ $featured->platform }} · {{ number_format($featured->price,2,',','.') }} €</span><a href="{{ route('games.show',$featured) }}">Ver jogo →</a></section>@endif
<div class="catalog-heading"><div><p class="eyebrow">ENCONTRA O TEU PRÓXIMO JOGO</p><h2>Todos os jogos</h2></div><span>{{ $games->total() }} resultados</span></div>
<form class="filters catalog-filters" method="get">
    <input name="q" value="{{ request('q') }}" placeholder="Pesquisar jogos">
    <select name="category"><option value="">Todas as plataformas</option>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(request('category')==$category->id)>{{ str_replace('Jogo ','',$category->name) }}</option>@endforeach</select>
    <div class="sort-buttons"><button type="submit" name="order" value="asc" class="{{ request('order')==='asc' ? '' : 'secondary' }}">Nome A–Z</button><button type="submit" name="order" value="desc" class="{{ request('order')==='desc' ? '' : 'secondary' }}">Nome Z–A</button><button type="submit" name="order" value="recent" class="{{ !in_array(request('order'), ['asc','desc'], true) ? '' : 'secondary' }}">Mais recentes</button></div><button type="submit" class="secondary">Pesquisar</button>
</form>
<section class="product-grid">@forelse($games as $game) @include('components.store-product-card',['game'=>$game]) @empty<p>Não encontrámos jogos com esses filtros.</p>@endforelse</section>
{{ $games->links() }}
@endsection
