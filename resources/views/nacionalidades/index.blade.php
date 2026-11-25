
@extends('layouts.app')

@section('title', 'Nacionalidades')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Nacionalidades</h2>

    <a href="{{ route('nacionalidades.create') }}"
       class="btn btn-primary">
        Nova Nacionalidade
    </a>
</div>

<div class="card shadow-sm">
    <div class="card-body">

        @if ($nacionalidades->isEmpty())

            <p class="text-center text-muted mb-0">
                Nenhuma nacionalidade cadastrada.
            </p>

        @else

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th class="text-end">Ações</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($nacionalidades as $nacionalidade)
                            <tr>
                                <td>{{ $nacionalidade->id }}</td>
                                <td>{{ $nacionalidade->nome }}</td>

                                <td class="text-end">
                                    <a href="{{ route('nacionalidades.edit', $nacionalidade) }}"
                                       class="btn btn-warning btn-sm">
                                        Editar
                                    </a>

                                    <form action="{{ route('nacionalidades.destroy', $nacionalidade) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Deseja realmente excluir esta nacionalidade?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Excluir
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        @endif

    </div>
</div>

@endsection
