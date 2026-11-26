
@extends('layouts.app')

@section('title', 'Atores')

@section('content')

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h2 class="fw-bold mb-1">
            <i class="bi bi-people text-danger me-2"></i>
            Atores
        </h2>

        <p class="text-muted mb-0">
            Gerencie os atores cadastrados no sistema.
        </p>
    </div>

    <a href="{{ route('atores.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle me-2"></i>
        Novo ator
    </a>
</div>

<div class="card">
    <div class="card-body p-0">

        @if ($atores->isEmpty())

            <div class="text-center py-5">
                <i class="bi bi-person-video3 text-muted"
                   style="font-size: 45px;"></i>

                <h5 class="mt-3">Nenhum ator cadastrado</h5>

                <p class="text-muted">
                    Comece adicionando o primeiro ator ao sistema.
                </p>

                <a href="{{ route('atores.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle me-2"></i>
                    Cadastrar ator
                </a>
            </div>

        @else

            <div class="table-responsive">
                <table class="table table-hover mb-0">

                    <thead>
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Nome</th>
                            <th>Sobrenome</th>
                            <th>Nacionalidade</th>
                            <th>Data de nascimento</th>
                            <th>Sexo</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($atores as $ator)
                            <tr>
                                <td class="ps-3 text-muted">
                                    #{{ $ator->id }}
                                </td>

                                <td class="fw-semibold">
                                    {{ $ator->nome }}
                                </td>

                                <td>
                                    {{ $ator->sobrenome }}
                                </td>

                                <td>
                                    <i class="bi bi-globe2 text-muted me-1"></i>
                                    {{ $ator->nacionalidade->nome }}
                                </td>

                                <td>
                                    {{ \Carbon\Carbon::parse($ator->data_nascimento)->format('d/m/Y') }}
                                </td>

                                <td>
                                    {{ $ator->sexo }}
                                </td>

                                <td class="text-center text-nowrap">
                                    <a href="{{ route('atores.edit', $ator) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Editar ator">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('atores.destroy', $ator) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Deseja realmente excluir este ator?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Excluir ator">
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
                    <i class="bi bi-people me-1"></i>
                    Total de atores cadastrados: {{ $atores->count() }}
                </small>
            </div>

        @endif

    </div>
</div>

@endsection
