<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanTrade extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'nrPlan',
        'nmPlan',
        'moeda',
        'id_ativo',
        'pontosContratoAtivo',
        'garantiaContratoAtivo',
        'dtInc',
        'vlInc',
    ];

    public function ativo(){
        return $this->belongsTo(Ativo::class, 'id_ativo');
    }

    static public function  listarPlanoAlunosFiltro($user){
        if($user->filtroAluno){
            $alunos = explode(',', $user->filtroAluno);
            $in = "";
            foreach ($alunos as $aluno){
                $in .= ",".$aluno;
            }
            $in = substr($in, 1);
            $sql = "SELECT *, plan_trades.id AS plan_id FROM plan_trades
            LEFT JOIN alunos ON (plan_trades.aluno_id = alunos.id)
            LEFT JOIN ativos ON (plan_trades.id_ativo = ativos.id)
            WHERE plan_trades.aluno_id IN ($in)";
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
                $sql = "SELECT *, plan_trades.id AS plan_id FROM plan_trades
                LEFT JOIN alunos ON (plan_trades.aluno_id = alunos.id)
                LEFT JOIN ativos ON (plan_trades.id_ativo = ativos.id)
                WHERE plan_trades.aluno_id IN ($in)";
            }
            else{
                $sql = "SELECT *, plan_trades.id AS plan_id FROM plan_trades
                LEFT JOIN alunos ON (plan_trades.aluno_id = alunos.id)
                LEFT JOIN ativos ON (plan_trades.id_ativo = ativos.id)
                ";
            }
        }
        else{
            $sql = "SELECT *, plan_trades.id AS plan_id FROM plan_trades
            LEFT JOIN alunos ON (plan_trades.aluno_id = alunos.id)
            LEFT JOIN ativos ON (plan_trades.id_ativo = ativos.id)
            ";
        }

        return \DB::select($sql);
    }
}
