
@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Cadastrar categoria</h2>

    <form action="{{ route('categorias.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da categoria</label>

            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control @error('nome') is-invalid @enderror"
                value="{{ old('nome') }}"
                maxlength="255"
                required
            >

            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Salvar
        </button>

        <a href="{{ route('categorias.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
