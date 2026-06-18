<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MatrizDecisao extends Model
{
    use HasFactory;

    protected $table = "matrizdecisao";

    protected $fillable = [
        'id_aluno',
        'id_ativo',
        'dtHrCadastro',
        'tLMensal',
        'tLMensalFlag',
        'tUTMensal',
        'tUTMensalFlag',
        'candleMensal',
        'candleMensalFlag',
        'conclusaoMensal',
        'obsMensal',
        'tLSemanal',
        'tLSemanalFlag',
        'tUTSemanal',
        'tUTSemanalFlag',
        'candleSemanal',
        'candleSemanalFlag',
        'conclusaoSemanal',
        'obsSemanal',
        'tLDiario',
        'tLDiarioFlag',
        'tUTDiario',
        'tUTDiarioFlag',
        'candleDiario',
        'candleDiarioFlag',
        'conclusaoDiario',
        'obsDiario',
        'tL60min',
        'tL60minFlag',
        'tUT60min',
        'tUT60minFlag',
        'candle60min',
        'candle60minFlag',
        'conclusao60min',
        'obs60min',
        'tL15min',
        'tL15minFlag',
        'tUT15min',
        'tUT15minFlag',
        'candle15min',
        'candle15minFlag',
        'conclusao15min',
        'obs15min',
        'tL5min',
        'tL5minFlag',
        'tUT5min',
        'tUT5minFlag',
        'candle5min',
        'candle5minFlag',
        'conclusao5min',
        'obs5min',
        'conclusaoTL',
        'conclusaoTUT',
        'conclusaoCandle',
        'conclusaoConclusao',
        'conclusaoObs',
    ];

    static public function  listarMatrizesAlunosFiltro($user){
        if($user->filtroAluno){
            $alunos = explode(',', $user->filtroAluno);
            $in = "";
            foreach ($alunos as $aluno){
                $in .= ",".$aluno;
            }
            $in = substr($in, 1);
            $sql = "SELECT * FROM matrizdecisao
            LEFT JOIN alunos ON (matrizdecisao.id_aluno = alunos.id)
            LEFT JOIN ativos ON (matrizdecisao.id_ativo = ativos.id)
            WHERE matrizdecisao.id_aluno IN ($in)";
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
                $sql = "SELECT * FROM matrizdecisao
                LEFT JOIN alunos ON (matrizdecisao.id_aluno = alunos.id)
                LEFT JOIN ativos ON (matrizdecisao.id_ativo = ativos.id)
                WHERE matrizdecisao.id_aluno IN ($in)";
            }
            else{
                $sql = "SELECT * FROM matrizdecisao
                LEFT JOIN alunos ON (matrizdecisao.id_aluno = alunos.id)
                LEFT JOIN ativos ON (matrizdecisao.id_ativo = ativos.id)
                ";
            }
        }
        else{
            $sql = "SELECT * FROM matrizdecisao
            LEFT JOIN alunos ON (matrizdecisao.id_aluno = alunos.id)
            LEFT JOIN ativos ON (matrizdecisao.id_ativo = ativos.id)
            ";
        }

        return \DB::select($sql);
    }
}
