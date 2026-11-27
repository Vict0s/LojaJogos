<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $this->ensureCanShop($request);
        $quantities = $request->session()->get('cart', []);
        $games = Game::whereIn('id', array_keys($quantities))->orderBy('title')->get();
        $total = $games->sum(fn (Game $game) => (float) $game->price * (int) $quantities[$game->id]);

        return view('cart.index', compact('games', 'quantities', 'total'));
    }

    public function add(Request $request, Game $game)
    {
        $this->ensureCanShop($request);
        $cart = $request->session()->get('cart', []);
        $cart[$game->id] = min(10, (int) ($cart[$game->id] ?? 0) + 1);
        $request->session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('status', 'Jogo adicionado ao carrinho.');
    }

    public function update(Request $request)
    {
        $this->ensureCanShop($request);
        $data = $request->validate(['quantities' => 'required|array', 'quantities.*' => 'required|integer|min:1|max:10']);
        $cart = $request->session()->get('cart', []);
        foreach ($data['quantities'] as $id => $quantity) {
            if (array_key_exists($id, $cart) && Game::whereKey($id)->exists()) $cart[$id] = $quantity;
        }
        $request->session()->put('cart', $cart);

        return back()->with('status', 'Carrinho atualizado.');
    }

    public function remove(Request $request, Game $game)
    {
        $this->ensureCanShop($request);
        $cart = $request->session()->get('cart', []);
        unset($cart[$game->id]);
        $request->session()->put('cart', $cart);

        return back()->with('status', 'Jogo removido do carrinho.');
    }

    public function checkout(Request $request)
    {
        $this->ensureCustomer($request);
        $quantities = $request->session()->get('cart', []);
        $games = Game::whereIn('id', array_keys($quantities))->get();
        abort_if($games->isEmpty(), 422, 'O carrinho está vazio.');
        abort_if($games->count() !== count($quantities), 422, 'Um jogo já não está disponível. Atualiza o carrinho.');

        $purchase = DB::transaction(function () use ($request, $games, $quantities) {
            $total = $games->sum(fn (Game $game) => (float) $game->price * (int) $quantities[$game->id]);
            $purchase = Purchase::create(['user_id' => $request->user()->id, 'total' => $total, 'status' => 'concluida']);
            foreach ($games as $game) {
                $purchase->items()->create([
                    'game_id' => $game->id,
                    'title' => $game->title,
                    'unit_price' => $game->price,
                    'quantity' => $quantities[$game->id],
                ]);
            }
            return $purchase;
        });

        $request->session()->forget('cart');
        return redirect()->route('purchases.show', $purchase)->with('status', 'Compra de demonstração registada com sucesso.');
    }

    public function purchases(Request $request)
    {
        $this->ensureCustomer($request);
        $purchases = $request->user()->purchases()->latest()->paginate(10);
        return view('purchases.index', compact('purchases'));
    }

    public function purchase(Request $request, Purchase $purchase)
    {
        $this->ensureCustomer($request);
        abort_unless($purchase->user_id === $request->user()->id, 404);
        $purchase->load('items');
        return view('purchases.show', compact('purchase'));
    }

    private function ensureCanShop(Request $request): void
    {
        abort_if($request->user()?->is_admin, 403, 'A conta de administrador não pode usar o carrinho.');
    }

    private function ensureCustomer(Request $request): void
    {
        abort_unless($request->user() && ! $request->user()->is_admin, 403, 'Esta área está disponível apenas para clientes.');
    }
}
