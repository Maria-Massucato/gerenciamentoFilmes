
@extends('layouts.app')

@section('title', 'Idiomas')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-translate text-danger me-2"></i>Idiomas
            </h2>
            <p class="text-muted mb-0">
                Gerencie os idiomas utilizados no cadastro dos filmes.
            </p>
        </div>

        <a href="{{ route('idiomas.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Novo idioma
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if ($idiomas->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-translate text-muted" style="font-size: 45px;"></i>

                    <h5 class="mt-3">Nenhum idioma cadastrado</h5>

                    <p class="text-muted">
                        Comece adicionando o primeiro idioma.
                    </p>

                    <a href="{{ route('idiomas.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Cadastrar idioma
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">ID</th>
                                <th>Nome do idioma</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($idiomas as $idioma)
                                <tr>
                                    <td class="ps-3 text-muted">#{{ $idioma->id }}</td>

                                    <td class="fw-semibold">
                                        <i class="bi bi-translate text-danger me-2"></i>
                                        {{ $idioma->nome }}
                                    </td>

                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('idiomas.edit', $idioma) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           title="Editar idioma">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('idiomas.destroy', $idioma) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Deseja realmente excluir este idioma?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Excluir idioma">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="border-top px-3 py-3">
                    <small class="text-muted">
                        <i class="bi bi-translate me-1"></i>
                        Total de idiomas cadastrados: {{ $idiomas->count() }}
                    </small>
                </div>
            @endif
        </div>
    </div>
@endsection
