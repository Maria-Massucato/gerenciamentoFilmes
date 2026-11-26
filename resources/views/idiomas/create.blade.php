
@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Cadastrar idioma</h2>

    <form action="{{ route('idiomas.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do idioma</label>

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

        <a href="{{ route('idiomas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
