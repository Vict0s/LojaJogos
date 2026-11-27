@extends('layouts.app')

@section('content')
<div class="account-layout admin-account-layout">
    @include('profile.sidebar')
    <section class="account-content">
        <h1>{{ $game->exists ? 'Editar jogo' : 'Adicionar jogo' }}</h1>
        <form class="stack" method="post" enctype="multipart/form-data" action="{{ $game->exists ? route('admin.games.update', $game) : route('admin.games.store') }}">
            @csrf
            @if($game->exists)@method('PUT')@endif
            <label>Título<input name="title" value="{{ old('title', $game->title) }}" required minlength="2" maxlength="160"></label>
            <label>Plataforma / categoria<select name="category_id" required>@foreach($categories as $category)<option value="{{ $category->id }}" @selected(old('category_id', $game->category_id) == $category->id)>{{ $category->name }}</option>@endforeach</select></label>
            <label>Tipo de produto<select name="format" required><option value="digital" @selected(old('format', $game->format ?? 'digital') === 'digital')>Jogo digital</option><option value="fisico" @selected(old('format', $game->format) === 'fisico')>Jogo físico</option></select></label>
            <label>Plataforma<input name="platform" value="{{ old('platform', $game->platform) }}" required maxlength="80" placeholder="Ex.: PlayStation 5"></label>
            <label>Preço (€)<input type="number" step="0.01" min="0" max="999999.99" name="price" value="{{ old('price', $game->price) }}" required></label>
            <label>URL da capa (opcional)<input type="text" name="image_url" value="{{ old('image_url', $game->image_url) }}" placeholder="https://... ou /images/..."></label>
            <label>Ou carregar capa (JPG, PNG ou WebP; máximo 2 MB)<input type="file" name="image_file" accept="image/jpeg,image/png,image/webp"></label>
            @if($game->image_url)<div><small>Capa atual</small><br><img class="admin-image-preview" src="{{ $game->image_url }}" alt="Capa atual de {{ $game->title }}"></div>@endif
            <label>Link da loja (opcional)<input type="url" name="source_url" value="{{ old('source_url', $game->source_url) }}" placeholder="https://www.worten.pt/produtos/..."></label>
            <label>Data de lançamento<input type="date" name="release_date" value="{{ old('release_date', $game->release_date?->format('Y-m-d')) }}"></label>
            <label>Descrição<textarea name="description" rows="6" minlength="20" maxlength="5000" required>{{ old('description', $game->description) }}</textarea></label>
            <button type="submit">Guardar jogo</button>
        </form>
    </section>
</div>
@endsection
