@extends('layouts.app')

@section('title', isset($categoria) ? 'Editar Categoría' : 'Adicionar Categoría')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-white">
            {{ isset($categoria) ? 'Editar Categoría' : 'Adicionar Categoría' }}
        </h2>
    </div>

    <form id="formCategoria" action="{{ isset($categoria) ? route('categoria.update', $categoria->codigo_categoria) : route('categoria.store') }}" method="POST" class="bg-dark text-white p-4 rounded">
        @csrf
        @if(isset($categoria))
            @method('PUT')
        @endif

        <div class="mb-3">
            <label for="nombre_categoria" class="form-label">Nombre</label>
            <input type="text" name="nombre_categoria" id="nombre_categoria"
                class="form-control"
                value="{{ old('nombre_categoria', $categoria->nombre_categoria ?? '') }}" required>
        </div>

        <button type="submit" class="btn btn-outline-info">
            {{ isset($categoria) ? 'Actualizar' : 'Guardar' }}
        </button>
        <a href="{{ route('categoria.index') }}" class="btn btn-outline-light">Cancelar</a>
    </form>

    <script>
        document.getElementById('formCategoria').addEventListener('submit', function(event) {
            const nombre = document.getElementById('nombre_categoria').value.trim();
            if (!nombre) {
                alert('El campo Nombre no debe estar vacío');
                event.preventDefault();
            }
        });
    </script>
@endsection
