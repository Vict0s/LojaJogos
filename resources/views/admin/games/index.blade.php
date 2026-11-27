@extends('layouts.app') @section('content')
<div class="account-layout admin-account-layout">
    @include('profile.sidebar')
    <section class="account-content">
<h1>Gestão de jogos</h1><p><a class="button" href="{{ route('admin.games.create') }}">Adicionar jogo</a> <a class="button secondary" href="{{ route('admin.categories.index') }}">Gerir categorias</a></p><table><thead><tr><th>Jogo</th><th>Categoria</th><th>Preço</th><th>Ações</th></tr></thead><tbody>@foreach($games as $game)<tr><td>{{ $game->title }}</td><td>{{ $game->category->name }}</td><td>{{ number_format($game->price,2,',','.') }} €</td><td><a href="{{ route('admin.games.edit',$game) }}">Editar</a><form method="post" action="{{ route('admin.games.destroy',$game) }}" class="inline">@csrf @method('DELETE')<button class="link">Eliminar</button></form></td></tr>@endforeach</tbody></table>{{ $games->links() }}
    </section>
</div>
@endsection
