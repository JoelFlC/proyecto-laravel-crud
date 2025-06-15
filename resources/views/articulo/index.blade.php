@extends('layouts.app')

@section('title','Artículos')

@section('content')
    <h2 class="mb-4 text-white">
        @if(isset($categoria))
            Artículos de la Categoría: <span class="text-info">{{ $categoria->nombre_categoria }}</span>
        @elseif(isset($subcategoria))
            Artículos de la Subcategoría: <span class="text-info">{{ $subcategoria->nombre_subcategoria }}</span>
        @else
            Listado de Artículos
        @endif
    </h2>

    <a href="{{ route('articulo.create') }}" class="btn btn-outline-info mb-4">Adicionar</a>

    <table class="table table-bordered table-dark table-striped table-hover">
      <thead>
        <tr>
          <th>ID</th><th>Nombre</th><th>Categoría</th><th>Subcategoría</th><th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($articulos as $art)
          <tr>
            <td>{{ $art->codigo_articulo }}</td>
            <td>{{ $art->nombre_articulo }}</td>
            <td>{{ $art->categoria->nombre_categoria ?? 'N/A' }}</td>
            <td>{{ $art->subcategoria->nombre_subcategoria ?? 'N/A' }}</td>
            <td>
              <a href="{{ route('articulo.edit', $art->codigo_articulo) }}" class="btn btn-outline-light btn-sm">Editar</a>
              <form action="{{ route('articulo.destroy', $art->codigo_articulo) }}"
                    method="POST" style="display:inline-block"
                    onsubmit="return confirm('Eliminar artículo?')">
                @csrf @method('DELETE')
                <button class="btn btn-outline-danger btn-sm">Eliminar</button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="5">No hay artículos.</td></tr>
        @endforelse
      </tbody>
    </table>
@endsection
