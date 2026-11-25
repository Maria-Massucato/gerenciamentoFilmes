<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ator extends Model
{
    protected $table = 'atores';

    protected $fillable = [
        'nome',
        'sobrenome',
        'nacionalidade_id',
        'data_nascimento',
        'sexo',
    ];

    public function nacionalidade(): BelongsTo
    {
        return $this->belongsTo(Nacionalidade::class, 'nacionalidade_id');
    }

    public function filmes(): BelongsToMany
    {
        return $this->belongsToMany(Filme::class, 'ator_filme', 'ator_id', 'filme_id');
    }
}
