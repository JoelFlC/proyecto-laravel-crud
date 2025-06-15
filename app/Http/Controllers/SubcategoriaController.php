<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategoria;
use App\Models\Categoria;

class SubcategoriaController extends Controller
{
    public function index($codigo_categoria = null)
    {
        if ($codigo_categoria) {
            $subcategorias = Subcategoria::with('categoria')
                ->where('codigo_categoria', $codigo_categoria)
                ->get();
            $categoria = Categoria::find($codigo_categoria);
        } else {
            $subcategorias = Subcategoria::with('categoria')->get();
            $categoria = null;
        }

        return view('subcategoria.index', compact('subcategorias', 'categoria'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('subcategoria.form', compact('categorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_subcategoria' => 'required',
            'codigo_categoria'    => 'required|exists:categoria,codigo_categoria',
        ]);

        $sub = Subcategoria::create($data);

        // Redirige al listado de subcategorías de esa misma categoría:
        return redirect()
            ->route('subcategoria.filtrar', $sub->codigo_categoria)
            ->with('success', 'Subcategoría creada correctamente');
    }

    public function edit($id)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias   = Categoria::all();
        return view('subcategoria.form', compact('subcategoria', 'categorias'));
    }

    public function update(Request $request, $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $data = $request->validate([
            'nombre_subcategoria' => 'required',
            'codigo_categoria'    => 'required|exists:categoria,codigo_categoria',
        ]);

        $subcategoria->update($data);

        // Redirige al listado filtrado
        return redirect()
            ->route('subcategoria.filtrar', $subcategoria->codigo_categoria)
            ->with('success', 'Subcategoría actualizada correctamente');
    }

    public function destroy($id)
    {
        Subcategoria::destroy($id);
        return redirect()->route('subcategoria.index')
                         ->with('success', 'Subcategoría eliminada correctamente');
    }
}
