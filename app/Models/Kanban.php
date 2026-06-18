<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kanban extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'dia',
        'prioridade',
        'nmKanban',
        'dsKanban',
        'stKanban',
    ];
}
