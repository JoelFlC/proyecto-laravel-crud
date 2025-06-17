@extends('layouts.app')

@section('title', isset($subcategoria) ? 'Editar Subcategoría' : 'Adicionar Subcategoría')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-white">
      {{ isset($subcategoria) ? 'Editar Subcategoría' : 'Adicionar Subcategoría' }}
    </h2>
  </div>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="formSubcat"
        action="{{ isset($subcategoria)
                     ? route('subcategoria.update', $subcategoria->codigo_subcategoria)
                     : route('subcategoria.store') }}"
        method="POST"
        class="bg-dark text-white p-4 rounded">
    @csrf
    @if(isset($subcategoria))
      @method('PUT')
    @endif

    <input type="hidden" name="origen" value="{{ $origen ?? 'general' }}">

    <div class="mb-3">
      <label for="nombre_subcategoria" class="form-label">Nombre</label>
      <input type="text"
             name="nombre_subcategoria"
             id="nombre_subcategoria"
             class="form-control"
             value="{{ old('nombre_subcategoria', $subcategoria->nombre_subcategoria ?? '') }}"
             required>
    </div>

    <div class="mb-3">
      <label for="codigo_categoria" class="form-label">Categoría</label>
      <select name="codigo_categoria" id="codigo_categoria" class="form-select" required>
        <option value="">-- Selecciona categoría --</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat->codigo_categoria }}"
            {{ (old('codigo_categoria', $subcategoria->codigo_categoria ?? $codigo_categoria ?? '') == $cat->codigo_categoria) ? 'selected' : '' }}>
            {{ $cat->nombre_categoria }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-outline-info">
      {{ isset($subcategoria) ? 'Actualizar' : 'Guardar' }}
    </button>

    <a href="{{ ($origen ?? 'general') === 'general'
               ? route('subcategoria.index')
               : route('subcategoria.filtrar', $origen) }}"
       class="btn btn-outline-light">Cancelar</a>
  </form>

  <script>
    document.getElementById('formSubcat').addEventListener('submit', function(e) {
      const nombre = document.getElementById('nombre_subcategoria').value.trim();
      const cat    = document.getElementById('codigo_categoria').value;
      if (!nombre || !cat) {
        alert('Todos los campos son obligatorios');
        e.preventDefault();
      }
    });
  </script>
@endsection
