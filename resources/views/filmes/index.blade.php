
@extends('layouts.app')

@section('title', 'Filmes')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-camera-reels text-danger me-2"></i>
            Filmes
        </h2>

        <p class="text-muted mb-0">
            Gerencie os filmes cadastrados no catálogo.
        </p>
    </div>

    <a href="{{ route('filmes.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Novo filme
    </a>
</div>

<div class="card">
    <div class="card-body p-0">

        @if ($filmes->isEmpty())

            <div class="text-center py-5">
                <i class="bi bi-film text-muted" style="font-size: 45px;"></i>

                <h5 class="mt-3">Nenhum filme cadastrado</h5>

                <p class="text-muted">
                    Comece adicionando o primeiro filme ao catálogo.
                </p>

                <a href="{{ route('filmes.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Cadastrar filme
                </a>
            </div>

        @else

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Título</th>
                            <th>Ano</th>
                            <th>Categoria</th>
                            <th>Idioma</th>
                            <th>Nacionalidade</th>
                            <th>Classificação</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($filmes as $filme)
                            <tr>
                                <td class="ps-3 text-muted">
                                    #{{ $filme->id }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $filme->titulo }}
                                </td>

                                <td>
                                    {{ $filme->ano_lancamento }}
                                </td>

                                <td>
                                    {{ $filme->categoria->nome }}
                                </td>

                                <td>
                                    {{ $filme->idioma->nome }}
                                </td>

                                <td>
                                    {{ $filme->nacionalidade->nome ?? 'Não informada' }}
                                </td>

                                <td>
                                    @if ($filme->classificacao === 'Livre')
                                        <span class="badge bg-success">
                                            Livre
                                        </span>
                                    @else
                                        <span class="badge bg-dark">
                                            {{ $filme->classificacao }} anos
                                        </span>
                                    @endif
                                </td>

                                <td class="text-center text-nowrap">
                                    <a href="{{ route('filmes.edit', $filme) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Editar filme">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('filmes.destroy', $filme) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Deseja realmente excluir este filme?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Excluir filme">
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
                    <i class="bi bi-film me-1"></i>
                    Total de filmes cadastrados: {{ $filmes->count() }}
                </small>
            </div>

        @endif

    </div>
</div>

@endsection
