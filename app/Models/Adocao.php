<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Pet;

class Adocao extends Model
{
    use HasFactory;

    protected $table = 'adocaos'; // importante (nome fora do padrão)

    protected $fillable = [
        'user_id',
        'pet_id',
        'telefone',
        'endereco',
        'cidade',
        'estado',
        'status'
    ];

    // Relação com usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relação com pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}