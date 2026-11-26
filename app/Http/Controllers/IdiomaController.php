<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IdiomaController extends Controller
{
    public function index()
    {
        $idiomas = Idioma::orderBy('nome')->get();

        return view('idiomas.index', compact('idiomas'));
    }

    public function create()
    {
        return view('idiomas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:idiomas,nome'],
        ], [
            'nome.required' => 'O nome do idioma é obrigatório.',
            'nome.unique' => 'Esse idioma já está cadastrado.',
        ]);

        Idioma::create($request->only('nome'));

        return redirect()->route('idiomas.index')
            ->with('sucesso', 'Idioma cadastrado com sucesso!');
    }

    public function edit(Idioma $idioma)
    {
        return view('idiomas.edit', compact('idioma'));
    }

    public function update(Request $request, Idioma $idioma)
    {
        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                Rule::unique('idiomas', 'nome')->ignore($idioma->id),
            ],
        ], [
            'nome.required' => 'O nome do idioma é obrigatório.',
            'nome.unique' => 'Esse idioma já está cadastrado.',
        ]);

        $idioma->update($request->only('nome'));

        return redirect()->route('idiomas.index')
            ->with('sucesso', 'Idioma atualizado com sucesso!');
    }

    public function destroy(Idioma $idioma)
    {
        if ($idioma->filmes()->exists()) {
            return redirect()->route('idiomas.index')
                ->with('erro', 'Não é possível excluir um idioma vinculado a filmes.');
        }

        $idioma->delete();

        return redirect()->route('idiomas.index')
            ->with('sucesso', 'Idioma excluído com sucesso!');
    }
}
