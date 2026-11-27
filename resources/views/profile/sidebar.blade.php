<aside class="account-sidebar">
    <h2>Olá, {{ explode(' ', trim(auth()->user()->name))[0] }}</h2>
    <a class="{{ request()->routeIs('profile.*') ? 'active' : '' }}" href="{{ route('profile.edit') }}">♙ <span>A minha conta</span></a>
    <a class="{{ request()->routeIs('favorites.*') ? 'active' : '' }}" href="{{ route('favorites.index') }}">♡ <span>Favoritos</span></a>
    @unless(auth()->user()->is_admin)<a class="{{ request()->routeIs('purchases.*') ? 'active' : '' }}" href="{{ route('purchases.index') }}">🧾 <span>As minhas compras</span></a>@endunless
    @if(auth()->user()->is_admin)<a class="{{ request()->routeIs('admin.games.*') || request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.games.index') }}">⚙ <span>Gestão da loja</span></a><a class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">♙ <span>Clientes</span></a>@endif
    <form method="post" action="{{ route('logout') }}">@csrf<button class="account-logout">↪ <span>Terminar sessão</span></button></form>
</aside>
