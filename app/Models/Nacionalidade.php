<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nacionalidade extends Model
{
    protected $table = 'nacionalidades';

    protected $fillable = [
        'nome',
    ];

    public function atores(): HasMany
    {
        return $this->hasMany(Ator::class, 'nacionalidade_id');
    }

    public function filmes(): HasMany
    {
        return $this->hasMany(Filme::class, 'nacionalidade_id');
    }
}
