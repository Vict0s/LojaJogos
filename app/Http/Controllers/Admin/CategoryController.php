<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() { $categories=Category::withCount('games')->orderBy('name')->paginate(20); return view('admin.categories.index',compact('categories')); }
    public function create() { $category=new Category(); return view('admin.categories.form',compact('category')); }
    public function store(Request $request) { Category::create($request->validate(['name'=>'required|string|min:2|max:100|unique:categories,name','description'=>'nullable|string|max:2000'],['name.required'=>'O nome da categoria é obrigatório.','name.min'=>'O nome deve ter pelo menos 2 caracteres.','name.unique'=>'Já existe uma categoria com esse nome.'])); return redirect()->route('admin.categories.index')->with('status','Categoria criada.'); }
    public function edit(Category $categoria) { $category=$categoria; return view('admin.categories.form',compact('category')); }
    public function update(Request $request, Category $categoria) { $categoria->update($request->validate(['name'=>'required|string|min:2|max:100|unique:categories,name,'.$categoria->id,'description'=>'nullable|string|max:2000'],['name.required'=>'O nome da categoria é obrigatório.','name.min'=>'O nome deve ter pelo menos 2 caracteres.','name.unique'=>'Já existe uma categoria com esse nome.'])); return redirect()->route('admin.categories.index')->with('status','Categoria atualizada.'); }
    public function destroy(Category $categoria) { if($categoria->games()->exists()) return back()->withErrors(['category'=>'Não podes eliminar uma categoria que ainda tem jogos.']); $categoria->delete(); return back()->with('status','Categoria eliminada.'); }
}
