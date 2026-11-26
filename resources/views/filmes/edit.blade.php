
@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Editar filme</h2>

    <form action="{{ route('filmes.update', $filme) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input
                type="text"
                name="titulo"
                id="titulo"
                class="form-control @error('titulo') is-invalid @enderror"
                value="{{ old('titulo', $filme->titulo) }}"
                maxlength="255"
                required
            >
            @error('titulo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea
                name="descricao"
                id="descricao"
                class="form-control @error('descricao') is-invalid @enderror"
                rows="4"
            >{{ old('descricao', $filme->descricao) }}</textarea>
            @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="ano_lancamento" class="form-label">Ano de lançamento</label>
            <input
                type="number"
                name="ano_lancamento"
                id="ano_lancamento"
                class="form-control @error('ano_lancamento') is-invalid @enderror"
                value="{{ old('ano_lancamento', $filme->ano_lancamento) }}"
                min="1888"
                max="{{ date('Y') }}"
                step="1"
                required
            >
            @error('ano_lancamento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria</label>
            <select
                name="categoria_id"
                id="categoria_id"
                class="form-select @error('categoria_id') is-invalid @enderror"
                required
            >
                <option value="">Selecione uma categoria</option>

                @foreach ($categorias as $categoria)
                    <option
                        value="{{ $categoria->id }}"
                        @selected(old('categoria_id', $filme->categoria_id) == $categoria->id)
                    >
                        {{ $categoria->nome }}
                    </option>
                @endforeach
            </select>
            @error('categoria_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="idioma_id" class="form-label">Idioma</label>
            <select
                name="idioma_id"
                id="idioma_id"
                class="form-select @error('idioma_id') is-invalid @enderror"
                required
            >
                <option value="">Selecione um idioma</option>

                @foreach ($idiomas as $idioma)
                    <option
                        value="{{ $idioma->id }}"
                        @selected(old('idioma_id', $filme->idioma_id) == $idioma->id)
                    >
                        {{ $idioma->nome }}
                    </option>
                @endforeach
            </select>
            @error('idioma_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nacionalidade_id" class="form-label">
                Nacionalidade (opcional)
            </label>
            <select
                name="nacionalidade_id"
                id="nacionalidade_id"
                class="form-select @error('nacionalidade_id') is-invalid @enderror"
            >
                <option value="">Selecione uma nacionalidade</option>

                @foreach ($nacionalidades as $nacionalidade)
                    <option
                        value="{{ $nacionalidade->id }}"
                        @selected(old('nacionalidade_id', $filme->nacionalidade_id) == $nacionalidade->id)
                    >
                        {{ $nacionalidade->nome }}
                    </option>
                @endforeach
            </select>
            @error('nacionalidade_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="classificacao" class="form-label">
                Classificação indicativa
            </label>
            <select
                name="classificacao"
                id="classificacao"
                class="form-select @error('classificacao') is-invalid @enderror"
                required
            >
                <option value="">Selecione a classificação</option>

                @foreach (['Livre', '10', '12', '14', '16', '18'] as $classificacao)
                    <option
                        value="{{ $classificacao }}"
                        @selected(old('classificacao', $filme->classificacao) == $classificacao)
                    >
                        {{ $classificacao === 'Livre' ? 'Livre' : $classificacao . ' anos' }}
                    </option>
                @endforeach
            </select>
            @error('classificacao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Atualizar
        </button>

        <a href="{{ route('filmes.index') }}" class="btn btn-secondary">
            Cancelar
        </a>
    </form>
@endsection
