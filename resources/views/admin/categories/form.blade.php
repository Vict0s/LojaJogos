@extends('layouts.app') @section('content')
<div class="account-layout admin-account-layout">
    @include('profile.sidebar')
    <section class="account-content">
<h1>{{ $category->exists?'Editar categoria':'Nova categoria' }}</h1><form class="stack" method="post" action="{{ $category->exists?route('admin.categories.update',$category):route('admin.categories.store') }}">@csrf @if($category->exists)@method('PUT')@endif<label>Nome<input name="name" value="{{ old('name',$category->name) }}" required minlength="2"></label><label>Descrição<textarea name="description" rows="5">{{ old('description',$category->description) }}</textarea></label><button>Guardar</button></form>
    </section>
</div>
@endsection
