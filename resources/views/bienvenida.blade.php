@extends('layouts.app')

@section('title', 'Bienvenida')

@section('content')
  <div class="d-flex align-items-center rounded p-4"
       style="background-color: #282a36;">
    <!-- Imagen a la izquierda -->
    <img
      src="{{ asset('images/logo.png') }}"
      alt="Bienvenida"
      style="width: 100px; height: auto; border-radius: 8px;"
      class="me-4"
    >

    <!-- Texto al costado -->
    <div class="text-white">
      <h2>Bienvenido</h2>
      <p>
        Pagina de gestion de categorías, subcategorías y artículos.
      </p>
    </div>
  </div>
@endsection
