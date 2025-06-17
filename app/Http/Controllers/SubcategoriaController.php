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

    public function create(Request $request)
    {
        $categorias = Categoria::all();
        $codigo_categoria = $request->get('codigo_categoria');
        $origen = $request->get('origen', 'general');

        return view('subcategoria.form', compact('categorias', 'codigo_categoria', 'origen'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_subcategoria' => 'required',
            'codigo_categoria' => 'required|exists:categoria,codigo_categoria',
        ]);

        $sub = Subcategoria::create($data);
        $origen = $request->input('origen');

        return redirect()
            ->route($origen === 'general' ? 'subcategoria.index' : 'subcategoria.filtrar', $origen !== 'general' ? $origen : [])
            ->with('success', 'Subcategoría creada correctamente');
    }

    public function edit($id, Request $request)
    {
        $subcategoria = Subcategoria::findOrFail($id);
        $categorias = Categoria::all();
        $codigo_categoria = $request->get('codigo_categoria');
        $origen = $request->get('origen', 'general');

        return view('subcategoria.form', compact('subcategoria', 'categorias', 'codigo_categoria', 'origen'));
    }

    public function update(Request $request, $id)
    {
        $subcategoria = Subcategoria::findOrFail($id);

        $data = $request->validate([
            'nombre_subcategoria' => 'required',
            'codigo_categoria' => 'required|exists:categoria,codigo_categoria',
        ]);

        $subcategoria->update($data);
        $origen = $request->input('origen');

        return redirect()
            ->route($origen === 'general' ? 'subcategoria.index' : 'subcategoria.filtrar', $origen !== 'general' ? $origen : [])
            ->with('success', 'Subcategoría actualizada correctamente');
    }

    public function destroy(Request $request, $id)
    {
        $sub = Subcategoria::findOrFail($id);
        $origen = $request->query('origen', 'general');

        $sub->delete();

        return redirect()
            ->route($origen === 'general' ? 'subcategoria.index' : 'subcategoria.filtrar', $origen !== 'general' ? $origen : [])
            ->with('success', 'Subcategoría eliminada correctamente');
    }
}
