<?php

namespace App\Http\Controllers;

use App\Models\Nacionalidade;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NacionalidadeController extends Controller
{
    public function index()
    {
        $nacionalidades = Nacionalidade::orderBy('nome')->get();

        return view('nacionalidades.index', compact('nacionalidades'));
    }

    public function create()
    {
        return view('nacionalidades.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:nacionalidades,nome'],
        ], [
            'nome.required' => 'O nome da nacionalidade é obrigatório.',
            'nome.unique' => 'Essa nacionalidade já está cadastrada.',
        ]);

        Nacionalidade::create($request->only('nome'));

        return redirect()
            ->route('nacionalidades.index')
            ->with('sucesso', 'Nacionalidade cadastrada com sucesso!');
    }

    public function edit(Nacionalidade $nacionalidade)
    {
        return view('nacionalidades.edit', compact('nacionalidade'));
    }

    public function update(Request $request, Nacionalidade $nacionalidade)
    {
        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('nacionalidades', 'nome')->ignore($nacionalidade->id),
            ],
        ], [
            'nome.required' => 'O nome da nacionalidade é obrigatório.',
            'nome.unique' => 'Essa nacionalidade já está cadastrada.',
        ]);

        $nacionalidade->update($request->only('nome'));

        return redirect()
            ->route('nacionalidades.index')
            ->with('sucesso', 'Nacionalidade atualizada com sucesso!');
    }

    public function destroy(Nacionalidade $nacionalidade)
    {
        if (
            $nacionalidade->atores()->exists() ||
            $nacionalidade->filmes()->exists()
        ) {
            return redirect()
                ->route('nacionalidades.index')
                ->with('erro', 'Não é possível excluir uma nacionalidade vinculada a atores ou filmes.');
        }

        $nacionalidade->delete();

        return redirect()
            ->route('nacionalidades.index')
            ->with('sucesso', 'Nacionalidade excluída com sucesso!');
    }
}
