
@extends('layouts.app')

@section('title', 'Editar Ator')

@section('content')

<div class="card shadow-sm">
    <div class="card-header">
        <h4 class="mb-0">Editar Ator</h4>
    </div>

    <div class="card-body">

        <form action="{{ route('atores.update', $ator) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label for="nome" class="form-label">Nome</label>

                    <input
                        type="text"
                        name="nome"
                        id="nome"
                        class="form-control @error('nome') is-invalid @enderror"
                        value="{{ old('nome', $ator->nome) }}"
                        required
                    >

                    @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sobrenome" class="form-label">Sobrenome</label>

                    <input
                        type="text"
                        name="sobrenome"
                        id="sobrenome"
                        class="form-control @error('sobrenome') is-invalid @enderror"
                        value="{{ old('sobrenome', $ator->sobrenome) }}"
                        required
                    >

                    @error('sobrenome')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nacionalidade_id" class="form-label">
                        Nacionalidade
                    </label>

                    <select
                        name="nacionalidade_id"
                        id="nacionalidade_id"
                        class="form-select @error('nacionalidade_id') is-invalid @enderror"
                        required
                    >
                        <option value="">Selecione uma nacionalidade</option>

                        @foreach ($nacionalidades as $nacionalidade)
                            <option
                                value="{{ $nacionalidade->id }}"
                                {{ old('nacionalidade_id', $ator->nacionalidade_id) == $nacionalidade->id ? 'selected' : '' }}
                            >
                                {{ $nacionalidade->nome }}
                            </option>
                        @endforeach
                    </select>

                    @error('nacionalidade_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="data_nascimento" class="form-label">
                        Data de nascimento
                    </label>

                    <input
                        type="date"
                        name="data_nascimento"
                        id="data_nascimento"
                        class="form-control @error('data_nascimento') is-invalid @enderror"
                        value="{{ old('data_nascimento', $ator->data_nascimento) }}"
                        max="{{ date('Y-m-d') }}"
                        required
                    >

                    @error('data_nascimento')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-6 mb-3">
                    <label for="sexo" class="form-label">Sexo</label>

                    <select
                        name="sexo"
                        id="sexo"
                        class="form-select @error('sexo') is-invalid @enderror"
                        required
                    >
                        <option value="">Selecione</option>

                        <option value="Masculino" {{ old('sexo', $ator->sexo) == 'Masculino' ? 'selected' : '' }}>
                            Masculino
                        </option>

                        <option value="Feminino" {{ old('sexo', $ator->sexo) == 'Feminino' ? 'selected' : '' }}>
                            Feminino
                        </option>

                        <option value="Outro" {{ old('sexo', $ator->sexo) == 'Outro' ? 'selected' : '' }}>
                            Outro
                        </option>
                    </select>

                    @error('sexo')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Atualizar
                </button>

                <a href="{{ route('atores.index') }}" class="btn btn-secondary">
                    Voltar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
