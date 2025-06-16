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

    {{-- SELECT de Categoría --}}
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

    {{-- SELECT de Subcategoría --}}
    <div class="mb-3">
      <label for="codigo_subcategoria" class="form-label">Subcategoría</label>
      <select name="codigo_subcategoria" id="codigo_subcategoria" class="form-select" required>
        <option value="">-- Selecciona subcategoría --</option>
        @foreach($subcategorias as $sub)
          <option value="{{ $sub->codigo_subcategoria }}"
                  data-categoria="{{ $sub->codigo_categoria }}"
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

  {{-- Script para filtrar subcategorías por categoría --}}
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const categoriaSelect = document.getElementById('codigo_categoria');
      const subcategoriaSelect = document.getElementById('codigo_subcategoria');

      function filtrarSubcategorias() {
        const categoriaSeleccionada = categoriaSelect.value;

        Array.from(subcategoriaSelect.options).forEach(opt => {
          const pertenece = opt.getAttribute('data-categoria') === categoriaSeleccionada;
          if (opt.value === "") {
            opt.style.display = "block"; // Placeholder
          } else {
            opt.style.display = pertenece ? "block" : "none";
          }
        });

        // Verifica si la opción seleccionada sigue válida
        const selectedOption = subcategoriaSelect.options[subcategoriaSelect.selectedIndex];
        if (selectedOption && selectedOption.style.display === "none") {
          alert("La subcategoría seleccionada no pertenece a la categoría. Selecciona una válida.");
          subcategoriaSelect.value = "";
        }
      }

      categoriaSelect.addEventListener('change', filtrarSubcategorias);
      filtrarSubcategorias(); // Ejecutar al cargar
    });
  </script>
@endsection
