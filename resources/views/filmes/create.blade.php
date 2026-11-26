
@extends('layouts.app')

@section('title', 'Cadastrar filme')

@section('content')
    <div class="mb-4">
        <h2 class="fw-bold mb-1">
            <i class="bi bi-camera-reels text-danger me-2"></i>Cadastrar filme
        </h2>
        <p class="text-muted mb-0">
            Preencha as informações para adicionar um novo filme ao catálogo.
        </p>
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('filmes.store') }}" method="POST">
                @csrf

                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-info-circle text-danger me-2"></i>Informações do filme
                </h5>

                <div class="mb-3">
                    <label for="titulo" class="form-label fw-semibold">Título</label>
                    <input type="text" name="titulo" id="titulo"
                           class="form-control @error('titulo') is-invalid @enderror"
                           value="{{ old('titulo') }}" maxlength="255" required>
                    @error('titulo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="descricao" class="form-label fw-semibold">Descrição</label>
                    <textarea name="descricao" id="descricao"
                              class="form-control @error('descricao') is-invalid @enderror"
                              rows="4">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="ano_lancamento" class="form-label fw-semibold">
                            Ano de lançamento
                        </label>
                        <input type="number" name="ano_lancamento" id="ano_lancamento"
                               class="form-control @error('ano_lancamento') is-invalid @enderror"
                               value="{{ old('ano_lancamento') }}"
                               min="1888" max="{{ date('Y') }}" step="1" required>
                        @error('ano_lancamento')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="classificacao" class="form-label fw-semibold">
                            Classificação indicativa
                        </label>
                        <select name="classificacao" id="classificacao"
                                class="form-select @error('classificacao') is-invalid @enderror"
                                required>
                            <option value="">Selecione a classificação</option>
                            @foreach (['Livre', '10', '12', '14', '16', '18'] as $classificacao)
                                <option value="{{ $classificacao }}"
                                    @selected(old('classificacao') == $classificacao)>
                                    {{ $classificacao === 'Livre' ? 'Livre' : $classificacao . ' anos' }}
                                </option>
                            @endforeach
                        </select>
                        @error('classificacao')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <hr class="my-4">

                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-collection text-danger me-2"></i>Classificação e origem
                </h5>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="categoria_id" class="form-label fw-semibold">Categoria</label>
                        <select name="categoria_id" id="categoria_id"
                                class="form-select @error('categoria_id') is-invalid @enderror"
                                required>
                            <option value="">Selecione uma categoria</option>
                            @foreach ($categorias as $categoria)
                                <option value="{{ $categoria->id }}"
                                    @selected(old('categoria_id') == $categoria->id)>
                                    {{ $categoria->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('categoria_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="idioma_id" class="form-label fw-semibold">Idioma</label>
                        <select name="idioma_id" id="idioma_id"
                                class="form-select @error('idioma_id') is-invalid @enderror"
                                required>
                            <option value="">Selecione um idioma</option>
                            @foreach ($idiomas as $idioma)
                                <option value="{{ $idioma->id }}"
                                    @selected(old('idioma_id') == $idioma->id)>
                                    {{ $idioma->nome }}
                                </option>
                            @endforeach
                        </select>
                        @error('idioma_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-3">
                    <label for="nacionalidade_id" class="form-label fw-semibold">
                        Nacionalidade <span class="text-muted fw-normal">(opcional)</span>
                    </label>
                    <select name="nacionalidade_id" id="nacionalidade_id"
                            class="form-select @error('nacionalidade_id') is-invalid @enderror">
                        <option value="">Selecione uma nacionalidade</option>
                        @foreach ($nacionalidades as $nacionalidade)
                            <option value="{{ $nacionalidade->id }}"
                                @selected(old('nacionalidade_id') == $nacionalidade->id)>
                                {{ $nacionalidade->nome }}
                            </option>
                        @endforeach
                    </select>
                    @error('nacionalidade_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <hr class="my-4">

                <h5 class="fw-semibold mb-3">
                    <i class="bi bi-people text-danger me-2"></i>Elenco
                </h5>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Atores do filme</label>

                    @if ($atores->isEmpty())
                        <div class="alert alert-info mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Nenhum ator cadastrado. Cadastre atores antes de vinculá-los ao filme.
                        </div>
                    @else
                        <div class="border rounded p-3">
                            <div class="row">
                                @foreach ($atores as $ator)
                                    <div class="col-md-6 mb-2">
                                        <div class="form-check">
                                            <input type="checkbox" name="atores[]"
                                                   id="ator_{{ $ator->id }}"
                                                   value="{{ $ator->id }}"
                                                   class="form-check-input"
                                                   @checked(in_array($ator->id, old('atores', [])))>
                                            <label for="ator_{{ $ator->id }}"
                                                   class="form-check-label">
                                                {{ $ator->nome }} {{ $ator->sobrenome }}
                                            </label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @error('atores')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                    @error('atores.*')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror

                    <small class="text-muted">
                        Selecione os atores que participam deste filme. A seleção é opcional.
                    </small>
                </div>

                <hr class="my-4">

                <div class="d-flex flex-wrap gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle me-2"></i>Salvar filme
                    </button>

                    <a href="{{ route('filmes.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle me-2"></i>Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
