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
        $sql = "SELECT max(m.id), m.id, m.id_aluno, m.dtHrMensagem, m.emissor, m.stViewAdm, a.nmAluno
        FROM mensagens AS m
        LEFT JOIN alunos AS a ON (m.id_aluno=a.id)
        GROUP BY m.id_aluno
        ORDER BY m.id DESC";

        return \DB::select($sql);
    }
}
