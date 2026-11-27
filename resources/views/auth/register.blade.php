<x-guest-layout>
    <div class="auth-form-heading">
        <h2>Criar conta</h2>
        <p>Regista-te para guardares favoritos e acompanhares as tuas compras.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf
        <div class="auth-field-group">
            <label class="auth-label" for="name">Nome</label>
            <input class="auth-input" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="O teu nome">
            @error('name')<p class="auth-error">{{ $message }}</p>@enderror
        </div>
        <div class="auth-field-group">
            <label class="auth-label" for="email">Email</label>
            <input class="auth-input" id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="nome@exemplo.pt">
            @error('email')<p class="auth-error">{{ $message }}</p>@enderror
        </div>
        <div class="auth-field-group">
            <label class="auth-label" for="password">Palavra-passe</label>
            <input class="auth-input" id="password" type="password" name="password" required autocomplete="new-password" placeholder="Cria uma palavra-passe">
            @error('password')<p class="auth-error">{{ $message }}</p>@enderror
        </div>
        <div class="auth-field-group">
            <label class="auth-label" for="password_confirmation">Confirmar palavra-passe</label>
            <input class="auth-input" id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Repete a palavra-passe">
            @error('password_confirmation')<p class="auth-error">{{ $message }}</p>@enderror
        </div>
        <button class="auth-submit" type="submit">Criar conta</button>
    </form>

    <div class="auth-separator"><span>Já tens conta?</span></div>
    <a class="auth-create-account" href="{{ route('login') }}">Iniciar sessão</a>
</x-guest-layout>