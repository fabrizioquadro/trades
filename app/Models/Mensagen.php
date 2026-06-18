<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mensagen extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_aluno',
        'dtHrMensagem',
        'dsMensagem',
        'stViewAluno',
        'stViewAdm',
        'emissor',
    ];

    public static function buscaMensagensAdm(){
        $sql = "SELECT * FROM mensagens
        LEFT JOIN alunos ON (mensagens.id_aluno=alunos.id)
        WHERE mensagens.id IN (SELECT max(id) FROM mensagens GROUP BY id_aluno)";

        return \DB::select($sql);
    }
}
