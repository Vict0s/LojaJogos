<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        $games = Game::with('category')->when($request->filled('q'), fn($q) => $q->where('title', 'like', '%'.$request->string('q').'%'))
            ->when($request->filled('category'), fn($q) => $q->where('category_id', $request->integer('category')))
            ->when(in_array($request->query('order'), ['asc','desc'], true), fn($q) => $q->orderBy('title', $request->query('order')), fn($q) => $q->latest())
            ->paginate(12)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $featured = Game::inRandomOrder()->first();
        return view('games.index', compact('games', 'categories', 'featured'));
    }
    public function show(Game $game)
    {
        $game->load('category');
        $featured = Game::whereKeyNot($game->id)->inRandomOrder()->first() ?? $game;
        return view('games.show', compact('game', 'featured'));
    }
}
