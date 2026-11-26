
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-title {
        font-weight: bold;
        color: #252525;
    }

    .dashboard-subtitle {
        color: #777;
    }

    .dashboard-card {
        display: block;
        height: 100%;
        background-color: #ffffff;
        border: 1px solid #eeeeee;
        border-radius: 12px;
        text-decoration: none;
        transition: all 0.25s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 22px rgba(0, 0, 0, 0.12);
        border-color: #d4a84f;
    }

    .dashboard-card .card-body {
        padding: 25px;
    }

    .dashboard-icon {
        width: 58px;
        height: 58px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background-color: #fceaea;
        color: #c62828;
        font-size: 27px;
        margin-bottom: 20px;
    }

    .dashboard-card:hover .dashboard-icon {
        background-color: #c62828;
        color: #ffffff;
    }

    .dashboard-card h5 {
        color: #252525;
        font-weight: bold;
        margin-bottom: 9px;
    }

    .dashboard-card p {
        color: #777777;
        margin-bottom: 18px;
    }

    .dashboard-card .card-link {
        color: #c62828;
        font-size: 14px;
        font-weight: bold;
    }

    .dashboard-card .card-link i {
        margin-left: 5px;
        transition: margin 0.2s;
    }

    .dashboard-card:hover .card-link i {
        margin-left: 10px;
    }
</style>

<div class="mb-4">
    <h2 class="dashboard-title">
        <i class="bi bi-speedometer2 me-2 text-danger"></i>
        Dashboard
    </h2>

    <p class="dashboard-subtitle">
        Bem-vindo ao Sistema de Gerenciamento de Filmes!
        Escolha uma opção para começar.
    </p>
</div>

<div class="row g-4">

    <!-- Filmes -->
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('filmes.index') }}" class="dashboard-card">
            <div class="card-body">
                <div class="dashboard-icon">
                    <i class="bi bi-camera-reels"></i>
                </div>

                <h5>Filmes</h5>

                <p>
                    Cadastre, consulte, edite e exclua os filmes do catálogo.
                </p>

                <span class="card-link">
                    Acessar filmes
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
        </a>
    </div>

    <!-- Atores -->
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('atores.index') }}" class="dashboard-card">
            <div class="card-body">
                <div class="dashboard-icon">
                    <i class="bi bi-people"></i>
                </div>

                <h5>Atores</h5>

                <p>
                    Gerencie os atores cadastrados no sistema.
                </p>

                <span class="card-link">
                    Acessar atores
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
        </a>
    </div>

    <!-- Nacionalidades -->
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('nacionalidades.index') }}" class="dashboard-card">
            <div class="card-body">
                <div class="dashboard-icon">
                    <i class="bi bi-globe"></i>
                </div>

                <h5>Nacionalidades</h5>

                <p>
                    Gerencie as nacionalidades dos atores e filmes.
                </p>

                <span class="card-link">
                    Acessar nacionalidades
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
        </a>
    </div>

    <!-- Categorias -->
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('categorias.index') }}" class="dashboard-card">
            <div class="card-body">
                <div class="dashboard-icon">
                    <i class="bi bi-tags"></i>
                </div>

                <h5>Categorias</h5>

                <p>
                    Organize os filmes de acordo com suas categorias.
                </p>

                <span class="card-link">
                    Acessar categorias
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
        </a>
    </div>

    <!-- Idiomas -->
    <div class="col-md-6 col-xl-4">
        <a href="{{ route('idiomas.index') }}" class="dashboard-card">
            <div class="card-body">
                <div class="dashboard-icon">
                    <i class="bi bi-translate"></i>
                </div>

                <h5>Idiomas</h5>

                <p>
                    Gerencie os idiomas disponíveis para os filmes.
                </p>

                <span class="card-link">
                    Acessar idiomas
                    <i class="bi bi-arrow-right"></i>
                </span>
            </div>
        </a>
    </div>

</div>

@endsection
