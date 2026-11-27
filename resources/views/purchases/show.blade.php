@extends('layouts.app')
@section('content')
<p><a href="{{ route('purchases.index') }}">← As minhas compras</a></p>
<div class="catalog-heading"><div><p class="eyebrow">COMPRA REGISTADA</p><h1>Compra #{{ $purchase->id }}</h1></div><strong>{{ $purchase->created_at->format('d/m/Y H:i') }}</strong></div>
<section class="purchase-detail">@foreach($purchase->items as $item)<div class="purchase-line"><span>{{ $item->title }} <small>× {{ $item->quantity }}</small></span><strong>{{ number_format((float)$item->unit_price*$item->quantity,2,',','.') }} €</strong></div>@endforeach<div class="cart-total"><span>Total</span><strong>{{ number_format($purchase->total,2,',','.') }} €</strong></div><p class="price-note">Compra registada para demonstração do projeto. Nenhum pagamento foi processado.</p></section>
@endsection
