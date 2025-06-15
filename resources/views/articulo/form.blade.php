@extends('layouts.app')

@section('title', isset($articulo) ? 'Editar Artículo' : 'Adicionar Artículo')

@section('content')
  <h2 class="mb-4 text-white">
    {{ isset($articulo) ? 'Editar Artículo' : 'Adicionar Artículo' }}
  </h2>

  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form id="formArticulo"
        action="{{ isset($articulo)
                    ? route('articulo.update', $articulo->codigo_articulo)
                    : route('articulo.store') }}"
        method="POST"
        class="bg-dark text-white p-4 rounded">
    @csrf
    @if(isset($articulo)) @method('PUT') @endif

    <div class="mb-3">
      <label for="nombre_articulo" class="form-label">Nombre Artículo</label>
      <input type="text" name="nombre_articulo" id="nombre_articulo"
             class="form-control"
             value="{{ old('nombre_articulo', $articulo->nombre_articulo ?? '') }}"
             required>
    </div>

    <div class="mb-3">
      <label for="codigo_categoria" class="form-label">Categoría</label>
      <select name="codigo_categoria" id="codigo_categoria" class="form-select" required>
        <option value="">-- Selecciona categoría --</option>
        @foreach($categorias as $cat)
          <option value="{{ $cat->codigo_categoria }}"
            {{ old('codigo_categoria', $articulo->codigo_categoria ?? '') == $cat->codigo_categoria ? 'selected':'' }}>
            {{ $cat->nombre_categoria }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="codigo_subcategoria" class="form-label">Subcategoría</label>
      <select name="codigo_subcategoria" id="codigo_subcategoria" class="form-select" required>
        <option value="">-- Selecciona subcategoría --</option>
        @foreach($subcategorias as $sub)
          <option value="{{ $sub->codigo_subcategoria }}"
            {{ old('codigo_subcategoria', $articulo->codigo_subcategoria ?? '') == $sub->codigo_subcategoria ? 'selected':'' }}>
            {{ $sub->nombre_subcategoria }}
          </option>
        @endforeach
      </select>
    </div>

    <button type="submit" class="btn btn-outline-info">
      {{ isset($articulo) ? 'Actualizar' : 'Guardar' }}
    </button>
    <a href="{{ route('articulo.index') }}" class="btn btn-outline-light">Cancelar</a>
  </form>

  <script>
  document.getElementById('formArticulo').addEventListener('submit', function(e){
    const nombre = document.getElementById('nombre_articulo').value.trim();
    if(!nombre
      || !document.getElementById('codigo_categoria').value
      || !document.getElementById('codigo_subcategoria').value){
      alert('Todos los campos son obligatorios');
      e.preventDefault();
    }
  });
  </script>
@endsection
