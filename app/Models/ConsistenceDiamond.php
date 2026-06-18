<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsistenceDiamond extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'ano',
        'mes',
        'sem1Risk',
        'sem1Weeks',
        'sem1Months',
        'sem1GainLoss',
        'sem1TradePlan',
        'sem2Risk',
        'sem2Weeks',
        'sem2Months',
        'sem2GainLoss',
        'sem2TradePlan',
        'sem3Risk',
        'sem3Weeks',
        'sem3Months',
        'sem3GainLoss',
        'sem3TradePlan',
        'sem4Risk',
        'sem4Weeks',
        'sem4Months',
        'sem4GainLoss',
        'sem4TradePlan',
        'sem5Risk',
        'sem5Weeks',
        'sem5Months',
        'sem5GainLoss',
        'sem5TradePlan',
    ];

    static public function  listarConsistenceAlunosFiltro($user){
        if($user->filtroAluno){
            $alunos = explode(',', $user->filtroAluno);
            $in = "";
            foreach ($alunos as $aluno){
                $in .= ",".$aluno;
            }
            $in = substr($in, 1);
            $sql = "SELECT *, consistence_diamonds.id AS diamond_id FROM consistence_diamonds
            LEFT JOIN alunos ON (consistence_diamonds.aluno_id = alunos.id)
            WHERE consistence_diamonds.aluno_id IN ($in)";
        }
        elseif($user->filtroTag){
            $tags = explode(',', $user->filtroTag);
            $in = "";

            foreach ($tags as $id_tag){
                $alunos = AlunoTag::where('id_tag', $id_tag)->get();
                if($alunos->count() > 0){
                    foreach($alunos as $aluno){
                        $in .= ','.$aluno->id_aluno;
                    }
                }
            }
            if($in != ""){
                $in = substr($in, 1);
                $sql = "SELECT *, consistence_diamonds.id AS diamond_id FROM consistence_diamonds
                LEFT JOIN alunos ON (consistence_diamonds.aluno_id = alunos.id)
                WHERE consistence_diamonds.aluno_id IN ($in)";
            }
            else{
                $sql = "SELECT *, consistence_diamonds.id AS diamond_id FROM consistence_diamonds
                LEFT JOIN alunos ON (consistence_diamonds.aluno_id = alunos.id)
                ";
            }
        }
        else{
            $sql = "SELECT *, consistence_diamonds.id AS diamond_id FROM consistence_diamonds
            LEFT JOIN alunos ON (consistence_diamonds.aluno_id = alunos.id)
            ";
        }

        return \DB::select($sql);
    }
}
