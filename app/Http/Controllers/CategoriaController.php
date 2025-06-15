<?php

namespace App\Http\Controllers;
use App\Models\Categoria;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    

    public function index()
    {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function create()
    {
        return view('categoria.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required'
        ]);

        Categoria::create($request->only('nombre_categoria'));

        return redirect()->route('categoria.index')->with('success', 'Categoría creada correctamente');
    }


    public function editar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categoria.form', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);

        $request->validate([
            'nombre_categoria' => 'required'
        ]);

        $categoria->update([
            'nombre_categoria' => $request->nombre_categoria
        ]);

        return redirect()->route('categoria.index')->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();

        return redirect()->route('categoria.index')->with('success', 'Categoría eliminada correctamente');
    }

    
}
