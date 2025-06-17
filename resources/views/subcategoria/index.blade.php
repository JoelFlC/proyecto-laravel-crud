@extends('layouts.app')

@section('title', 'Subcategorías')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-4 text-white">
            @if($categoria)
                Subcategorías de la categoría: <span class="text-info">{{ $categoria->nombre_categoria }}</span>
            @else
                Listado de Subcategorías
            @endif
        </h2>
    </div>

    <a href="{{ route('subcategoria.create', [
            'codigo_categoria' => $categoria->codigo_categoria ?? null,
            'origen' => $categoria->codigo_categoria ?? 'general'
        ]) }}" class="btn btn-outline-info mb-4">Adicionar</a>

    <table class="table table-dark table-striped table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($subcategorias as $sub)
                <tr>
                    <td>{{ $sub->codigo_subcategoria }}</td>
                    <td>{{ $sub->nombre_subcategoria }}</td>
                    <td>{{ $sub->codigo_categoria }}</td>
                    <td>
                        <a href="{{ route('subcategoria.edit', $sub->codigo_subcategoria) }}?codigo_categoria={{ $categoria->codigo_categoria ?? '' }}&origen={{ $categoria->codigo_categoria ?? 'general' }}"
                           class="btn btn-outline-info btn-sm">Editar</a>

                        <form action="{{ route('subcategoria.destroy', $sub->codigo_subcategoria) }}?origen={{ $categoria->codigo_categoria ?? 'general' }}"
                              method="POST"
                              style="display:inline-block"
                              onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta subcategoría?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger btn-sm">Eliminar</button>
                        </form>

                        <a href="{{ route('articulo.filtrar.subcategoria', $sub->codigo_subcategoria) }}"
                           class="btn btn-outline-light btn-sm">Artículos</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
