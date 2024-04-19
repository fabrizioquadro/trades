<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $fillable = [
        'nmTag',
    ];

    public static function buscaTagsAluno($id_aluno){
        $sql = "SELECT tags.nmTag FROM alunos_tags, tags WHERE
        alunos_tags.id_aluno=? AND
        alunos_tags.id_tag=tags.id";

        $dados = array();
        $dados[] = $id_aluno;

        return \DB::select($sql, $dados);
    }
}
