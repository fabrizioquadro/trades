<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $fillable = [
        'nmAluno',
        'dsEmail',
        'dsSenha',
        'stAluno',
        'dsEndereco',
        'nrEndereco',
        'dsComplemento',
        'dsBairro',
        'nmCidade',
        'dsEstado',
        'nmPais',
        'nrCep',
        'nrTel',
        'imagem',
        'moedaBase',
        'porcentagemPrejuizo',
        'porcentagemLucro',
        'dtEntradaInc',
        'dtEntradaFn',
        'dtSaidaInc',
        'dtSaidaFn',
        'filtroStatus',
        'filtroTipoOperacao',
        'filtroPais',
        'filtroCorretora',
        'filtroTipoConta',
        'filtroConta',
        'filtroAtivo',
        'filtroTipoAtivo',
        'filtroOperacao',
        'filtroDirecao',
        'filtroFase',
        'filtroMoeda',
        'filtroTipoCusto',
        'filtroResultado',
    ];

    public static function listarAlunosTags($tags){
        if($tags != ""){
            $tags = explode(',', $tags);
            $in = "";
            foreach ($tags as $tag){
                $in .= ",".$tag;
            }
            $in = substr($in, 1);
            $sql = "SELECT * FROM alunos_tags
            LEFT JOIN alunos ON (alunos_tags.id_aluno = alunos.id)
            WHERE alunos_tags.id_tag IN ($in)
            ORDER BY alunos.nmAluno";
        }
        else{
            $sql = "SELECT id AS id_aluno, nmAluno FROM alunos ORDER BY nmAluno";
        }
        return \DB::select($sql);
    }
}
