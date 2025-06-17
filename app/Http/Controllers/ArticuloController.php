<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ArticuloController extends Controller
{
    public function index()
    {
        $articulos = Articulo::with(['categoria', 'subcategoria'])->get();
        return view('articulo.index', compact('articulos'));
    }

    public function filtrarPorCategoria($codigo_categoria)
    {
        $articulos = Articulo::with(['categoria', 'subcategoria'])
                             ->where('codigo_categoria', $codigo_categoria)
                             ->get();
        $categoria = Categoria::findOrFail($codigo_categoria);
        return view('articulo.index', compact('articulos', 'categoria'));
    }

    public function filtrarPorSubcategoria($codigo_subcategoria)
    {
        $articulos = Articulo::with(['categoria', 'subcategoria'])
                             ->where('codigo_subcategoria', $codigo_subcategoria)
                             ->get();
        $subcategoria = Subcategoria::findOrFail($codigo_subcategoria);
        $categoria = Categoria::findOrFail($subcategoria->codigo_categoria);

        return view('articulo.index', compact('articulos', 'categoria', 'subcategoria'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('articulo.form', compact('categorias', 'subcategorias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_articulo' => 'required|string|max:255',
            'codigo_categoria' => 'required|exists:categoria,codigo_categoria',
            'codigo_subcategoria' => 'required|exists:subcategoria,codigo_subcategoria',
        ]);

        Articulo::create($request->all());

        $redirect = $request->input('redirect_to');
        return redirect($redirect ?? route('articulo.index'))
            ->with('success', 'Artículo creado correctamente');
    }

    public function edit($id)
    {
        $articulo = Articulo::findOrFail($id);
        $categorias = Categoria::all();
        $subcategorias = Subcategoria::where('codigo_categoria', $articulo->codigo_categoria)->get();

        return view('articulo.form', compact('articulo', 'categorias', 'subcategorias'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_articulo' => 'required|string|max:255',
            'codigo_categoria' => 'required|exists:categoria,codigo_categoria',
            'codigo_subcategoria' => 'required|exists:subcategoria,codigo_subcategoria',
        ]);

        $articulo = Articulo::findOrFail($id);
        $articulo->update($request->all());

        $redirect = $request->input('redirect_to');
        return redirect($redirect ?? route('articulo.index'))
            ->with('success', 'Artículo actualizado correctamente');
    }

    public function destroy($id)
    {
        $articulo = Articulo::findOrFail($id);
        $articulo->delete();

        $redirect = request()->input('redirect_to') ?? url()->previous();
        return redirect($redirect)
            ->with('success', 'Artículo eliminado correctamente');
    }
}
