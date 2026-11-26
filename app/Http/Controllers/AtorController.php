<?php

namespace App\Http\Controllers;

use App\Models\Ator;
use App\Models\Nacionalidade;
use Illuminate\Http\Request;

class AtorController extends Controller
{
    public function index()
    {
        $atores = Ator::with('nacionalidade')
            ->orderBy('nome')
            ->get();

        return view('atores.index', compact('atores'));
    }

    public function create()
    {
        $nacionalidades = Nacionalidade::orderBy('nome')->get();

        return view('atores.create', compact('nacionalidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'sobrenome' => ['required', 'string', 'max:255'],
            'nacionalidade_id' => ['required', 'exists:nacionalidades,id'],
            'data_nascimento' => ['required', 'date', 'before_or_equal:today'],
            'sexo' => ['required', 'string', 'max:20'],
        ], [
            'nome.required' => 'O nome do ator é obrigatório.',
            'sobrenome.required' => 'O sobrenome do ator é obrigatório.',
            'nacionalidade_id.required' => 'Selecione uma nacionalidade.',
            'nacionalidade_id.exists' => 'A nacionalidade selecionada não é válida.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser futura.',
            'sexo.required' => 'Informe o sexo do ator.',
        ]);

        Ator::create($request->only([
            'nome',
            'sobrenome',
            'nacionalidade_id',
            'data_nascimento',
            'sexo',
        ]));

        return redirect()
            ->route('atores.index')
            ->with('sucesso', 'Ator cadastrado com sucesso!');
    }

    public function edit(Ator $ator)
    {
        $nacionalidades = Nacionalidade::orderBy('nome')->get();

        return view('atores.edit', compact('ator', 'nacionalidades'));
    }

    public function update(Request $request, Ator $ator)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'sobrenome' => ['required', 'string', 'max:255'],
            'nacionalidade_id' => ['required', 'exists:nacionalidades,id'],
            'data_nascimento' => ['required', 'date', 'before_or_equal:today'],
            'sexo' => ['required', 'string', 'max:20'],
        ], [
            'nome.required' => 'O nome do ator é obrigatório.',
            'sobrenome.required' => 'O sobrenome do ator é obrigatório.',
            'nacionalidade_id.required' => 'Selecione uma nacionalidade.',
            'nacionalidade_id.exists' => 'A nacionalidade selecionada não é válida.',
            'data_nascimento.required' => 'A data de nascimento é obrigatória.',
            'data_nascimento.before_or_equal' => 'A data de nascimento não pode ser futura.',
            'sexo.required' => 'Informe o sexo do ator.',
        ]);

        $ator->update($request->only([
            'nome',
            'sobrenome',
            'nacionalidade_id',
            'data_nascimento',
            'sexo',
        ]));

        return redirect()
            ->route('atores.index')
            ->with('sucesso', 'Ator atualizado com sucesso!');
    }

    public function destroy(Ator $ator)
    {
        if ($ator->filmes()->exists()) {
            return redirect()->route('atores.index')
                ->with('erro', 'Não é possível excluir este ator, pois ele está associado a um ou mais filmes.');
        }

        $ator->delete();

        return redirect()->route('atores.index')
            ->with('sucesso', 'Ator excluído com sucesso!');
    }
}
