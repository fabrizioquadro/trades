<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AtivoFavoritoAluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'ativo_id',
        'nmAtivoFav',
    ];
}
