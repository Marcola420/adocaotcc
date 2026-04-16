<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'tipo',
        'idade',
        'descricao',
        'foto'
    ];

    // Relação com adoções
    public function adocoes()
    {
        return $this->hasMany(Adocao::class);
    }
}