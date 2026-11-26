<?php

namespace App\Http\Controllers;

use App\Models\Filme;
use App\Models\Categoria;
use App\Models\Idioma;
use App\Models\Nacionalidade;
use App\Models\Ator;
use Illuminate\Http\Request;

class FilmeController extends Controller
{
    public function index()
    {
        $filmes = Filme::with([
            'categoria',
            'idioma',
            'nacionalidade'
        ])->orderBy('titulo')->get();

        return view('filmes.index', compact('filmes'));
    }

            
    public function create()
        {
            $categorias = Categoria::orderBy('nome')->get();
            $idiomas = Idioma::orderBy('nome')->get();
            $nacionalidades = Nacionalidade::orderBy('nome')->get();
            $atores = Ator::orderBy('nome')->get();

            return view('filmes.create', compact(
                'categorias',
                'idiomas',
                'nacionalidades',
                'atores'
            ));
        }

    
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'ano_lancamento' => [
                'required',
                'integer',
                'digits:4',
                'min:1888',
                'max:' . date('Y'),
            ],
            'atores' => ['nullable', 'array'],
            'atores.*' => ['integer', 'exists:atores,id'],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'idioma_id' => ['required', 'exists:idiomas,id'],
            'nacionalidade_id' => [
                'nullable',
                'exists:nacionalidades,id',
            ],
            'classificacao' => [
                'required',
                'in:Livre,10,12,14,16,18',
            ],
        ], [
            'titulo.required' => 'O título do filme é obrigatório.',
            'ano_lancamento.required' => 'O ano de lançamento é obrigatório.',
            'ano_lancamento.integer' => 'O ano deve ser um número inteiro.',
            'ano_lancamento.digits' => 'Informe um ano com quatro dígitos.',
            'ano_lancamento.min' => 'O ano de lançamento deve ser igual ou superior a 1888.',
            'ano_lancamento.max' => 'O ano não pode ser maior que o ano atual.',
            'categoria_id.required' => 'Selecione uma categoria.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
            'idioma_id.required' => 'Selecione um idioma.',
            'idioma_id.exists' => 'O idioma selecionado é inválido.',
            'nacionalidade_id.exists' => 'A nacionalidade selecionada é inválida.',
            'classificacao.required' => 'Selecione a classificação indicativa.',
            'classificacao.in' => 'A classificação indicativa selecionada é inválida.',
        ]);

        $filme = Filme::create($request->only([
            'titulo',
            'descricao',
            'ano_lancamento',
            'categoria_id',
            'idioma_id',
            'nacionalidade_id',
            'classificacao',
        ]));

        $filme->atores()->sync($request->input('atores', []));
        
        return redirect()->route('filmes.index')
            ->with('sucesso', 'Filme cadastrado com sucesso!');
    }


    
    public function edit(Filme $filme)
    {
        $categorias = Categoria::orderBy('nome')->get();
        $idiomas = Idioma::orderBy('nome')->get();
        $nacionalidades = Nacionalidade::orderBy('nome')->get();

        return view('filmes.edit', compact(
            'filme',
            'categorias',
            'idiomas',
            'nacionalidades'
        ));
    }


    
    public function update(Request $request, Filme $filme)
    {
        $request->validate([
            'titulo' => ['required', 'string', 'max:255'],
            'descricao' => ['nullable', 'string'],
            'ano_lancamento' => [
                'required',
                'integer',
                'digits:4',
                'min:1888',
                'max:' . date('Y'),
            ],
            'categoria_id' => ['required', 'exists:categorias,id'],
            'idioma_id' => ['required', 'exists:idiomas,id'],
            'nacionalidade_id' => [
                'nullable',
                'exists:nacionalidades,id',
            ],
            'classificacao' => [
                'required',
                'in:Livre,10,12,14,16,18',
            ],
        ], [
            'titulo.required' => 'O título do filme é obrigatório.',
            'ano_lancamento.required' => 'O ano de lançamento é obrigatório.',
            'ano_lancamento.integer' => 'O ano deve ser um número inteiro.',
            'ano_lancamento.digits' => 'Informe um ano com quatro dígitos.',
            'ano_lancamento.min' => 'O ano de lançamento deve ser igual ou superior a 1888.',
            'ano_lancamento.max' => 'O ano não pode ser maior que o ano atual.',
            'categoria_id.required' => 'Selecione uma categoria.',
            'categoria_id.exists' => 'A categoria selecionada é inválida.',
            'idioma_id.required' => 'Selecione um idioma.',
            'idioma_id.exists' => 'O idioma selecionado é inválido.',
            'nacionalidade_id.exists' => 'A nacionalidade selecionada é inválida.',
            'classificacao.required' => 'Selecione a classificação indicativa.',
            'classificacao.in' => 'A classificação indicativa selecionada é inválida.',
        ]);

        $filme->update($request->only([
            'titulo',
            'descricao',
            'ano_lancamento',
            'categoria_id',
            'idioma_id',
            'nacionalidade_id',
            'classificacao',
        ]));

        return redirect()->route('filmes.index')
            ->with('sucesso', 'Filme atualizado com sucesso!');
    }


    
    public function destroy(Filme $filme)
    {
        $filme->delete();

        return redirect()->route('filmes.index')
            ->with('sucesso', 'Filme excluído com sucesso!');
    }

}
