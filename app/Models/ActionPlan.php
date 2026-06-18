<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id',
        'nrPlan',
        'oque',
        'quem',
        'quando',
        'como',
        'onde',
        'quanto',
        'status',
    ];

    static public function getProximoNrPlan($aluno_id){
        $sql = "SELECT MAX(nrPlan) As quantidade FROM action_plans WHERE aluno_id='$aluno_id'";
        $res = collect(\DB::select($sql))->first();
        if($res->quantidade){
            return $res->quantidade + 1;
        }
        else{
            return 0;
        }

    }

    public function aluno(){
        return Aluno::where('id', $this->aluno_id)->first();
    }

    static public function listarActionsFiltro($user, $GET){
        if($user->filtroAluno){
            $alunos = explode(',', $user->filtroAluno);
            $in = "";
            foreach ($alunos as $aluno){
                $in .= ",".$aluno;
            }
            $in = substr($in, 1);
            $sql = "SELECT *, action_plans.id AS id FROM action_plans
            LEFT JOIN alunos ON (action_plans.aluno_id = alunos.id)
            WHERE action_plans.aluno_id IN ($in)";
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
                $sql = "SELECT *, action_plans.id AS id FROM action_plans
                LEFT JOIN alunos ON (action_plans.aluno_id = alunos.id)
                WHERE action_plans.aluno_id IN ($in)";
            }
            else{
                $sql = "SELECT *, action_plans.id AS id FROM action_plans
                LEFT JOIN alunos ON (action_plans.aluno_id = alunos.id)
                WHERE 1=1";
            }
        }
        else{
            $sql = "SELECT *, action_plans.id AS id FROM action_plans
            LEFT JOIN alunos ON (action_plans.aluno_id = alunos.id)
            WHERE 1=1";
        }

        if($GET['dtInc']){
            $sql .= " AND quando>='$GET[dtInc]'";
        }

        if($GET['dtFn']){
            $sql .= " AND quando<='$GET[dtFn]'";
        }

        if($GET['dsQuem']){
            $sql .= " AND quem<='$GET[dsQuem]'";
        }

        if($GET['situacao']){
            $sql .= " AND status<='$GET[situacao]'";
        }

        return \DB::select($sql);

    }
}
