
@extends('layouts.app')

@section('title', 'Categorias')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-tags text-danger me-2"></i>
            Categorias
        </h2>

        <p class="text-muted mb-0">
            Gerencie as categorias utilizadas na classificação dos filmes.
        </p>
    </div>

    <a href="{{ route('categorias.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Nova categoria
    </a>
</div>

<div class="card">
    <div class="card-body p-0">

        @if ($categorias->isEmpty())

            <div class="text-center py-5">
                <i class="bi bi-tags text-muted" style="font-size: 45px;"></i>

                <h5 class="mt-3">Nenhuma categoria cadastrada</h5>

                <p class="text-muted">
                    Comece adicionando a primeira categoria.
                </p>

                <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Cadastrar categoria
                </a>
            </div>

        @else

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Nome da categoria</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($categorias as $categoria)
                            <tr>
                                <td class="ps-3 text-muted">
                                    #{{ $categoria->id }}
                                </td>

                                <td class="fw-semibold">
                                    <i class="bi bi-tag text-danger me-2"></i>
                                    {{ $categoria->nome }}
                                </td>

                                <td class="text-center text-nowrap">
                                    <a href="{{ route('categorias.edit', $categoria) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Editar categoria">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('categorias.destroy', $categoria) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Deseja realmente excluir esta categoria?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Excluir categoria">
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
                    <i class="bi bi-tags me-1"></i>
                    Total de categorias cadastradas: {{ $categorias->count() }}
                </small>
            </div>

        @endif

    </div>
</div>

@endsection
