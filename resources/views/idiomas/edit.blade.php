
@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Editar idioma</h2>

    <form action="{{ route('idiomas.update', $idioma) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome do idioma</label>

            <input
                type="text"
                name="nome"
                id="nome"
                class="form-control @error('nome') is-invalid @enderror"
                value="{{ old('nome', $idioma->nome) }}"
                maxlength="255"
                required
            >

            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Atualizar
        </button>

        <a href="{{ route('idiomas.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
