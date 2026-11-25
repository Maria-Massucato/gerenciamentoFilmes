
@extends('layouts.app')

@section('title', 'Editar Nacionalidade')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Editar Nacionalidade</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('nacionalidades.update', $nacionalidade) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">
                    Nome da nacionalidade
                </label>

                <input
                    type="text"
                    name="nome"
                    id="nome"
                    class="form-control @error('nome') is-invalid @enderror"
                    value="{{ old('nome', $nacionalidade->nome) }}"
                    required
                >

                @error('nome')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Atualizar
                </button>

                <a href="{{ route('nacionalidades.index') }}"
                   class="btn btn-secondary">
                    Voltar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
