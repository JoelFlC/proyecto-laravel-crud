@extends('layouts.app')

@section('title', 'Categorías')

@section('content')

    <h2 class="mb-4 text-white">Listado de Categorías</h2>
    <a href="{{ route('categoria.create') }}" class="btn btn-outline-info mb-4">Adicionar</a>

    
    <table class="table table-bordered table-striped table-hover table-dark">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Ver</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categorias as $categoria)
                <tr>
                    <td>{{ $categoria->codigo_categoria }}</td>
                    <td>{{ $categoria->nombre_categoria }}</td>
                    <td>
                        <a href="{{ route('subcategoria.filtrar', $categoria->codigo_categoria) }}" class="btn btn-outline-light">
                            Subcategorías
                        </a>
                        <a href="{{ route('articulo.filtrar.categoria', $categoria->codigo_categoria) }}" class="btn btn-outline-light btn-sm">Artículos</a>

                    </td>
                    <td>
                        <a href="{{ route('categoria.editar', $categoria->codigo_categoria) }}" class="btn btn-outline-info btn-sm">Editar</a>

                        <form action="{{ route('categoria.destroy', $categoria->codigo_categoria) }}" method="POST" style="display:inline-block" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta categoría?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-outline-danger">Eliminar</button>
                        </form>

                    </td>
                    
                </tr>
            @endforeach
        </tbody>
    </table>

    


@endsection
