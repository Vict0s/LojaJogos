<?php
namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() { $categories=Category::withCount('games')->orderBy('name')->get(); $featured=Game::inRandomOrder()->first(); return view('categories.index',compact('categories','featured')); }
    public function show(Request $request, Category $category) { $isGiftCardCategory = $category->name === 'Cartões de recarga e Gift Cards'; $format=$request->query('formato'); $query=$category->games(); $physicalCount=(clone $query)->where('format','fisico')->count(); $digitalCount=(clone $query)->where('format','digital')->count(); $games=$category->games()->when(in_array($format,['fisico','digital'],true),fn($q)=>$q->where('format',$format))->latest()->paginate($isGiftCardCategory ? 20 : 12)->withQueryString(); $featured=Game::inRandomOrder()->first(); return view('categories.show',compact('category','games','featured','format','physicalCount','digitalCount','isGiftCardCategory')); }
}
