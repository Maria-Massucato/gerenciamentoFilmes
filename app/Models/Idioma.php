<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Idioma extends Model
{
    protected $table = 'idiomas';

    protected $fillable = [
        'nome',
    ];

    public function filmes(): HasMany
    {
        return $this->hasMany(Filme::class, 'idioma_id');
    }
}
