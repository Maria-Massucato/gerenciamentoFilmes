
@extends('layouts.app')

@section('title', 'Nacionalidades')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h2 class="fw-bold mb-1">
                <i class="bi bi-globe text-danger me-2"></i>Nacionalidades
            </h2>

            <p class="text-muted mb-0">
                Gerencie as nacionalidades utilizadas no cadastro de atores e filmes.
            </p>
        </div>

        <a href="{{ route('nacionalidades.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle me-2"></i>Nova nacionalidade
        </a>
    </div>

    <div class="card">
        <div class="card-body p-0">
            @if ($nacionalidades->isEmpty())
                <div class="text-center py-5">
                    <i class="bi bi-globe text-muted" style="font-size: 45px;"></i>

                    <h5 class="mt-3">Nenhuma nacionalidade cadastrada</h5>

                    <p class="text-muted">
                        Comece adicionando a primeira nacionalidade.
                    </p>

                    <a href="{{ route('nacionalidades.create') }}" class="btn btn-primary">
                        <i class="bi bi-plus-circle me-2"></i>Cadastrar nacionalidade
                    </a>
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="ps-3">ID</th>
                                <th>Nome da nacionalidade</th>
                                <th class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($nacionalidades as $nacionalidade)
                                <tr>
                                    <td class="ps-3 text-muted">#{{ $nacionalidade->id }}</td>

                                    <td class="fw-semibold">
                                        <i class="bi bi-globe text-danger me-2"></i>
                                        {{ $nacionalidade->nome }}
                                    </td>

                                    <td class="text-center text-nowrap">
                                        <a href="{{ route('nacionalidades.edit', $nacionalidade) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           title="Editar nacionalidade">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('nacionalidades.destroy', $nacionalidade) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Deseja realmente excluir esta nacionalidade?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Excluir nacionalidade">
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
                        <i class="bi bi-globe me-1"></i>
                        Total de nacionalidades cadastradas: {{ $nacionalidades->count() }}
                    </small>
                </div>
            @endif
        </div>
    </div>
@endsection
