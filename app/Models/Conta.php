<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conta extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_aluno',
        'id_corretora',
        'nrConta',
        'nmConta',
        'dsConta',
        'vlContaInc',
        'moeda',
    ];

    public static function listarContasAluno($id_aluno){
        return \DB::table('contas')
          ->select('contas.id','contas.id_corretora','contas.nrConta','contas.nmConta','contas.vlContaInc','contas.dsConta','contas.moeda','corretoras.nome')
          ->leftJoin('corretoras', 'contas.id_corretora','=','corretoras.id')
          ->where('contas.id_aluno','=',$id_aluno)
          ->get();
    }
}
