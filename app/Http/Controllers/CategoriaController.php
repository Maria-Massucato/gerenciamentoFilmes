<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::orderBy('nome')->get();

        return view('categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => ['required', 'string', 'max:255', 'unique:categorias,nome'],
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Essa categoria já está cadastrada.',
        ]);

        Categoria::create($request->only('nome'));

        return redirect()
            ->route('categorias.index')
            ->with('sucesso', 'Categoria cadastrada com sucesso!');
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => [
                'required',
                'string',
                'max:255',
                \Illuminate\Validation\Rule::unique('categorias', 'nome')
                    ->ignore($categoria->id),
            ],
        ], [
            'nome.required' => 'O nome da categoria é obrigatório.',
            'nome.unique' => 'Essa categoria já está cadastrada.',
        ]);

        $categoria->update($request->only('nome'));

        return redirect()
            ->route('categorias.index')
            ->with('sucesso', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        if ($categoria->filmes()->exists()) {
            return redirect()
                ->route('categorias.index')
                ->with('erro', 'Não é possível excluir uma categoria vinculada a filmes.');
        }

        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('sucesso', 'Categoria excluída com sucesso!');
    }
}
