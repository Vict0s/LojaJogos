@extends('layouts.app') @section('content')
<div class="account-layout admin-account-layout">
    @include('profile.sidebar')
    <section class="account-content">
<h1>Gestão de categorias</h1><p><a class="button" href="{{ route('admin.categories.create') }}">Nova categoria</a></p><table><thead><tr><th>Categoria</th><th>Jogos</th><th>Ações</th></tr></thead><tbody>@foreach($categories as $category)<tr><td>{{ $category->name }}</td><td>{{ $category->games_count }}</td><td><a href="{{ route('admin.categories.edit',$category) }}">Editar</a><form method="post" action="{{ route('admin.categories.destroy',$category) }}" class="inline">@csrf @method('DELETE')<button class="link">Eliminar</button></form></td></tr>@endforeach</tbody></table>{{ $categories->links() }}
    </section>
</div>
@endsection
