
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Sistema') - Gerenciamento de Filmes</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --cor-fundo: #f4f4f6;
            --cor-menu: #171717;
            --cor-menu-hover: #292929;
            --cor-vermelha: #c62828;
            --cor-vermelha-hover: #a91f1f;
            --cor-dourada: #d4a84f;
            --cor-texto: #333333;
        }

        body {
            min-height: 100vh;
            background-color: var(--cor-fundo);
            color: var(--cor-texto);
            font-family: Arial, sans-serif;
        }

        /* Menu lateral */
        .sidebar {
            width: 255px;
            min-height: 100vh;
            background-color: var(--cor-menu);
            flex-shrink: 0;
        }

        .logo-area {
            padding: 24px 18px;
            border-bottom: 1px solid #343434;
        }

        .logo-area h5 {
            color: white;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .logo-area small {
            color: var(--cor-dourada);
        }

        .menu-titulo {
            color: #999999;
            font-size: 11px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 25px 12px 12px;
        }

        .sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #cccccc;
            padding: 12px 15px;
            border-radius: 7px;
            margin-bottom: 5px;
            transition: 0.2s;
        }

        .sidebar .nav-link i {
            font-size: 18px;
        }

        .sidebar .nav-link:hover {
            background-color: var(--cor-menu-hover);
            color: white;
        }

        .sidebar .nav-link.active {
            background-color: var(--cor-vermelha);
            color: white;
            font-weight: bold;
        }

        /* Área principal */
        .main-content {
            flex: 1;
            min-width: 0;
        }

        .top-header {
            background-color: white;
            border-bottom: 1px solid #e5e5e5;
            padding: 19px 28px;
        }

        .top-header h5 {
            margin: 0;
            font-weight: bold;
        }

        .content-area {
            padding: 30px;
        }

        /* Botões */
        .btn-primary {
            background-color: var(--cor-vermelha);
            border-color: var(--cor-vermelha);
        }

        .btn-primary:hover {
            background-color: var(--cor-vermelha-hover);
            border-color: var(--cor-vermelha-hover);
        }

        /* Cartões e tabelas */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .table {
            vertical-align: middle;
        }

        .table thead th {
            background-color: #292929;
            color: white;
            font-weight: 500;
            white-space: nowrap;
        }

        /* Formulários */
        .form-control,
        .form-select {
            border-radius: 7px;
            padding: 10px 12px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--cor-vermelha);
            box-shadow: 0 0 0 0.2rem rgba(198, 40, 40, 0.15);
        }

        /* Responsividade */
        @media (max-width: 767.98px) {
            .layout-container {
                flex-direction: column;
            }

            .sidebar {
                width: 100%;
                min-height: auto;
            }

            .content-area {
                padding: 18px;
            }

            .top-header {
                padding: 16px 20px;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex layout-container">

        <!-- Menu lateral -->
        <aside class="sidebar p-3">

            <a href="{{ route('dashboard') }}"
               class="text-decoration-none d-block logo-area">

                <h5>
                    <i class="bi bi-film me-2"></i>
                    Gerenciamento
                </h5>

                <small>Sistema de Filmes</small>
            </a>

            <div class="menu-titulo">Menu principal</div>

            <nav class="nav flex-column">

                <a href="{{ route('dashboard') }}"
                   class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>

                <a href="{{ route('filmes.index') }}"
                   class="nav-link {{ request()->routeIs('filmes.*') ? 'active' : '' }}">
                    <i class="bi bi-camera-reels"></i>
                    Filmes
                </a>

                <a href="{{ route('atores.index') }}"
                   class="nav-link {{ request()->routeIs('atores.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i>
                    Atores
                </a>

                <a href="{{ route('categorias.index') }}"
                   class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                    <i class="bi bi-tags"></i>
                    Categorias
                </a>

                <a href="{{ route('idiomas.index') }}"
                   class="nav-link {{ request()->routeIs('idiomas.*') ? 'active' : '' }}">
                    <i class="bi bi-translate"></i>
                    Idiomas
                </a>

                <a href="{{ route('nacionalidades.index') }}"
                   class="nav-link {{ request()->routeIs('nacionalidades.*') ? 'active' : '' }}">
                    <i class="bi bi-globe"></i>
                    Nacionalidades
                </a>

            </nav>
        </aside>

        <!-- Conteúdo principal -->
        <div class="main-content">

            <header class="top-header d-flex align-items-center justify-content-between">
                <h5>
                    <i class="bi bi-film me-2 text-danger"></i>
                    Gerenciamento de Filmes
                </h5>

                <span class="text-muted small">
                    <i class="bi bi-collection-play me-1"></i>
                    Sistema de catálogo
                </span>
            </header>

            <main class="content-area">

                @if (session('sucesso'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('sucesso') }}

                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if (session('erro'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ session('erro') }}

                        <button type="button" class="btn-close"
                                data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @yield('content')

            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
