<?php
namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $games = Auth::user()->favoriteGames()->with('category')->latest('game_user_favorites.created_at')->paginate(12);
        return view('favorites.index', compact('games'));
    }

    public function toggle(Game $game): RedirectResponse
    {
        $user = Auth::user();
        $user->favoriteGames()->toggle($game->id);
        return back()->with('status', $user->favoriteGames()->whereKey($game->id)->exists() ? 'Jogo adicionado aos favoritos.' : 'Jogo removido dos favoritos.');
    }
}
