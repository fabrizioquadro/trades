<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProntuarioTurma extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
        'aula',
        'dtAula',
        'hrInc',
        'hrFn',
        'descricao',
    ];
}
