<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GameController extends Controller
{
    public function index(): View
    {
        $games = Game::with('category')->latest()->paginate(20);
        return view('admin.games.index', compact('games'));
    }

    public function create(): View
    {
        $game = new Game();
        $categories = Category::orderBy('name')->get();
        return view('admin.games.form', compact('game', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        if ($request->hasFile('image_file')) {
            $data['image_url'] = $this->storeImage($request->file('image_file'));
        }
        unset($data['image_file']);
        $data['slug'] = Str::slug($data['title']).'-'.Str::lower(Str::random(5));
        Game::create($data);
        return redirect()->route('admin.games.index')->with('status', 'Jogo criado.');
    }

    public function edit(Game $jogo): View
    {
        $game = $jogo;
        $categories = Category::orderBy('name')->get();
        return view('admin.games.form', compact('game', 'categories'));
    }

    public function update(Request $request, Game $jogo): RedirectResponse
    {
        $data = $this->validated($request);
        $oldImage = $jogo->image_url;
        if ($request->hasFile('image_file')) {
            $data['image_url'] = $this->storeImage($request->file('image_file'));
        }
        unset($data['image_file']);
        $data['slug'] = Str::slug($data['title']).'-'.$jogo->id;
        $jogo->update($data);
        if ($request->hasFile('image_file')) {
            $this->deleteUploadedImage($oldImage);
        }
        return redirect()->route('admin.games.index')->with('status', 'Jogo atualizado.');
    }

    public function destroy(Game $jogo): RedirectResponse
    {
        $this->deleteUploadedImage($jogo->image_url);
        $jogo->delete();
        return back()->with('status', 'Jogo eliminado.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'category_id' => ['required', 'exists:categories,id'],
            'title' => ['required', 'string', 'min:2', 'max:160'],
            'description' => ['required', 'string', 'min:20', 'max:5000'],
            'platform' => ['required', 'string', 'max:80'],
            'format' => ['required', 'in:fisico,digital'],
            'price' => ['required', 'numeric', 'min:0', 'max:999999.99'],
            'image_url' => ['nullable', 'string', 'max:2048', function ($attribute, $value, $fail) {
                if ($value === null || $value === '') return;
                $scheme = parse_url($value, PHP_URL_SCHEME);
                $remoteUrl = filter_var($value, FILTER_VALIDATE_URL) && in_array(strtolower((string) $scheme), ['http', 'https'], true);
                $localImage = str_starts_with($value, '/images/') && !str_contains($value, '..');
                if (!$remoteUrl && !$localImage) $fail('Indica um URL http(s) válido ou um caminho local em /images/.');
            }],
            'image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'source_url' => ['nullable', 'url', 'max:2048'],
            'release_date' => ['nullable', 'date'],
        ], [
            'category_id.required' => 'Escolhe uma categoria.',
            'title.required' => 'O título do jogo é obrigatório.',
            'title.min' => 'O título deve ter pelo menos 2 caracteres.',
            'description.required' => 'A descrição é obrigatória.',
            'description.min' => 'A descrição deve ter pelo menos 20 caracteres.',
            'format.required' => 'Escolhe se o jogo é físico ou digital.',
            'price.required' => 'Indica o preço.',
            'price.numeric' => 'O preço deve ser um número.',
            'image_url.*' => 'A imagem deve ser um URL http(s) ou um caminho local válido.',
            'image_file.image' => 'O ficheiro selecionado tem de ser uma imagem válida.',
            'image_file.mimes' => 'A capa deve estar em JPG, PNG ou WebP.',
            'image_file.max' => 'A capa não pode ultrapassar 2 MB.',
            'source_url.url' => 'O link da loja deve ser válido.',
        ]);
    }

    private function storeImage(UploadedFile $file): string
    {
        $directory = public_path('images/uploads');
        if (!is_dir($directory) && !mkdir($directory, 0755, true) && !is_dir($directory)) {
            throw new \RuntimeException('Não foi possível criar a pasta das imagens.');
        }
        $filename = (string) Str::uuid().'.'.$file->extension();
        $file->move($directory, $filename);
        return '/images/uploads/'.$filename;
    }

    private function deleteUploadedImage(?string $imageUrl): void
    {
        if (!$imageUrl) return;
        $path = parse_url($imageUrl, PHP_URL_PATH);
        if (!is_string($path) || !str_starts_with($path, '/images/uploads/')) return;
        $filename = basename($path);
        if ($filename !== '' && $filename !== '.' && $filename !== '..') {
            $file = public_path('images/uploads/'.$filename);
            if (is_file($file)) unlink($file);
        }
    }
}
