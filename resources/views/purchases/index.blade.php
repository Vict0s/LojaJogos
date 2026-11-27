@extends('layouts.app')
@section('content')
<div class="catalog-heading"><div><p class="eyebrow">A TUA CONTA</p><h1>As minhas compras</h1></div><a href="{{ route('cart.index') }}">Voltar ao carrinho</a></div>
@forelse($purchases as $purchase)
    <a class="purchase-row" href="{{ route('purchases.show',$purchase) }}"><span><strong>Compra #{{ $purchase->id }}</strong><small>{{ $purchase->created_at->format('d/m/Y H:i') }} · {{ $purchase->status==='concluida'?'Registada':'Pendente' }}</small></span><strong>{{ number_format($purchase->total,2,',','.') }} €</strong><span>Ver detalhes →</span></a>
@empty
    <div class="empty-products"><span>🧾</span><h2>Ainda não tens compras</h2><p>As compras de demonstração aparecerão aqui.</p><a class="button" href="{{ route('games.index') }}">Explorar jogos</a></div>
@endforelse
{{ $purchases->links() }}
@endsection
