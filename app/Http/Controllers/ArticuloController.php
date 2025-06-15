<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Articulo;
use App\Models\Categoria;
use App\Models\Subcategoria;

class ArticuloController extends Controller
{
    // Muestra todos o filtrados
    public function index()
    {
        $articulos = Articulo::with(['categoria','subcategoria'])->get();
        return view('articulo.index', compact('articulos'));
    }

    public function filtrarPorCategoria($codigo_categoria)
    {
        $articulos  = Articulo::with(['categoria','subcategoria'])
                              ->where('codigo_categoria', $codigo_categoria)
                              ->get();
        $categoria  = Categoria::findOrFail($codigo_categoria);
        return view('articulo.index', compact('articulos','categoria'));
    }

    public function filtrarPorSubcategoria($codigo_subcategoria)
    {
        $articulos    = Articulo::with(['categoria','subcategoria'])
                                ->where('codigo_subcategoria', $codigo_subcategoria)
                                ->get();
        $subcategoria = Subcategoria::findOrFail($codigo_subcategoria);
        return view('articulo.index', compact('articulos','subcategoria'));
    }

    public function create()
    {
        $categorias    = Categoria::all();
        $subcategorias = Subcategoria::all();
        return view('articulo.form', compact('categorias','subcategorias'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_articulo'    => 'required',
            'codigo_categoria'   => 'required|exists:categoria,codigo_categoria',
            'codigo_subcategoria'=> 'required|exists:subcategoria,codigo_subcategoria',
        ]);

        $art = Articulo::create($data);

        // Redirige al listado de la categoría por defecto
        return redirect()
            ->route('articulo.filtrar.categoria', $art->codigo_categoria)
            ->with('success','Artículo creado correctamente');
    }

    public function edit($id)
    {
        $articulo      = Articulo::findOrFail($id);
        $categorias    = Categoria::all();
        $subcategorias = Subcategoria::where('codigo_categoria',$articulo->codigo_categoria)->get();

        return view('articulo.form', compact('articulo','categorias','subcategorias'));
    }

    public function update(Request $request, $id)
    {
        $articulo = Articulo::findOrFail($id);

        $data = $request->validate([
            'nombre_articulo'    => 'required',
            'codigo_categoria'   => 'required|exists:categoria,codigo_categoria',
            'codigo_subcategoria'=> 'required|exists:subcategoria,codigo_subcategoria',
        ]);

        $articulo->update($data);

        return redirect()
            ->route('articulo.filtrar.subcategoria', $articulo->codigo_subcategoria)
            ->with('success','Artículo actualizado correctamente');
    }

    public function destroy($id)
    {
        $art = Articulo::findOrFail($id);
        $cat = $art->codigo_categoria;
        $art->delete();

        return redirect()
            ->route('articulo.filtrar.categoria', $cat)
            ->with('success','Artículo eliminado correctamente');
    }
}
