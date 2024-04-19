<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlunoTag extends Model
{
    use HasFactory;

    protected $table = "alunos_tags";

    protected $fillable = [
        'id_aluno',
        'id_tag',
    ];
}
