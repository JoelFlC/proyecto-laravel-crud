<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Mi Proyecto Laravel')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: rgb(39, 39, 39);
            min-height: 100vh; /* antes: height: 100vh */
            overflow-x: hidden; /* permitimos scroll vertical */
            overflow-y: auto;
        }

        .container {
            display: grid;
            grid-template-columns: 200px 1fr;
            grid-template-rows: auto 1fr auto;
            grid-template-areas:
                "sidebar header"
                "sidebar main"
                "footer footer";
            min-height: 100vh;
        }


        header {
            grid-area: header;
            background-color: #282a36;
            color: white;
            padding: 1rem;
            text-align: center;
        }

        nav {
            grid-area: sidebar;
            background-color: rgb(50, 53, 67);
            padding: 4rem 1rem 1rem 1rem; /* Agrega más padding superior */
            border-right: 1px solid rgb(48, 48, 48);
            
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        nav a {
            display: block;
            margin: 0.75rem 0;
            padding: 0.5rem;
            text-decoration: none;
            color: rgb(255, 255, 255);
            font-weight: bold;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color:rgb(56, 59, 74);
        }

        main {
            grid-area: main;
            padding: 1rem 2rem;
            background-color: #282a36;
            /* QUITA overflow-y: auto; para que no recorte el contenido */
        }

        footer {
            grid-area: footer;
            background-color: #282a36;
            color: white;
            text-align: center;
            padding: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Proyecto Laravel CRUD</h1>
        </header>

        <nav>
            <a href="{{ url('/') }}">Inicio</a>
            <a href="{{ route('categoria.index') }}">Categorías</a>
            <a href="{{ route('subcategoria.index') }}">Subcategorías</a>
            <a href="{{ route('articulo.index') }}">Artículos</a>

        </nav>

        <main>
            @yield('content')
        </main>

        <footer>
            &copy; {{ date('Y') }} - Proyecto Laravel
        </footer>
    </div>

</body>
</html>
