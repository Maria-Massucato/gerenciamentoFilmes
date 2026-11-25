<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Filme extends Model
{
    protected $table = 'filmes';

    protected $fillable = [
        'titulo',
        'descricao',
        'ano_lancamento',
        'categoria_id',
        'idioma_id',
        'nacionalidade_id',
        'classificacao',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(Categoria::class, 'categoria_id');
    }

    public function idioma(): BelongsTo
    {
        return $this->belongsTo(Idioma::class, 'idioma_id');
    }

    public function nacionalidade(): BelongsTo
    {
        return $this->belongsTo(Nacionalidade::class, 'nacionalidade_id');
    }

    public function atores(): BelongsToMany
    {
        return $this->belongsToMany(Ator::class, 'ator_filme', 'filme_id', 'ator_id');
    }
}
