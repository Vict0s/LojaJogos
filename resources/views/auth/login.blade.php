<x-guest-layout>
    <div class="auth-form-heading">
        <h2>Iniciar sessão</h2>
        <p>Entra na tua conta para acederes aos teus favoritos e compras.</p>
    </div>

    <x-auth-session-status class="auth-status" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf
        <div class="auth-field-group">
            <label class="auth-label" for="email">Email ou utilizador</label>
            <input class="auth-input" id="email" type="text" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="Email ou utilizador">
            @error('email')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <div class="auth-field-group">
            <label class="auth-label" for="password">Palavra-passe</label>
            <input class="auth-input" id="password" type="password" name="password" required autocomplete="current-password" placeholder="A tua palavra-passe">
            @error('password')<p class="auth-error">{{ $message }}</p>@enderror
        </div>

        <div class="auth-form-options">
            <label class="auth-remember" for="remember_me">
                <input id="remember_me" type="checkbox" name="remember">
                <span>Manter sessão iniciada</span>
            </label>
            @if (Route::has('password.request'))
                <a class="auth-text-link" href="{{ route('password.request') }}">Esqueceste-te?</a>
            @endif
        </div>

        <button class="auth-submit" type="submit">Iniciar sessão</button>
    </form>

    <div class="auth-separator"><span>Primeira vez na Loja Play?</span></div>
    @if (Route::has('register'))
        <a class="auth-create-account" href="{{ route('register') }}">Criar conta de cliente</a>
    @endif
</x-guest-layout>