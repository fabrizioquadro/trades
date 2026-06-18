<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProntuarioAluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'aula',
        'dtAula',
        'hrInc',
        'hrFn',
        'presenca',
        'participacao',
        'permanencia',
        'atencao',
        'exercicios',
        'descricao',
    ];

    public function aluno(){
        return $this->belongsTo(Aluno::class, 'aluno_id');
    }
}
