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
        'filtroTrades',
        'plan1AtivoBase',
        'plan1MetaGanhoDiario',
        'plan1PontosContratoAtivo',
        'plan1MetaMaximaPontos',
        'plan1GarantiaContrato',
        'plan1FatorCorrecaoGarantia',
        'plan1LimiteGanhoDia',
        'plan1MaximoContratos',
        'plan2AtivoBase',
        'plan2MetaGanhoDiario',
        'plan2PontosContratoAtivo',
        'plan2MetaMaximaPontos',
        'plan2GarantiaContrato',
        'plan2FatorCorrecaoGarantia',
        'plan2LimiteGanhoDia',
        'plan2MaximoContratos',
        'plan3AtivoBase',
        'plan3MetaGanhoDiario',
        'plan3PontosContratoAtivo',
        'plan3MetaMaximaPontos',
        'plan3GarantiaContrato',
        'plan3FatorCorrecaoGarantia',
        'plan3LimiteGanhoDia',
        'plan3MaximoContratos',
        'plan4AtivoBase',
        'plan4MetaGanhoDiario',
        'plan4PontosContratoAtivo',
        'plan4MetaMaximaPontos',
        'plan4GarantiaContrato',
        'plan4FatorCorrecaoGarantia',
        'plan4LimiteGanhoDia',
        'plan4MaximoContratos',
        'plan5AtivoBase',
        'plan5MetaGanhoDiario',
        'plan5PontosContratoAtivo',
        'plan5MetaMaximaPontos',
        'plan5GarantiaContrato',
        'plan5FatorCorrecaoGarantia',
        'plan5LimiteGanhoDia',
        'plan5MaximoContratos',
        'aceitePrivacyPolice',
        'dataPrivacyPolice',
        'aceiteCookiesPolice',
        'dataCookiesPolice',
        'aceiteTermsAndConditions',
        'dataTermsAndConditions',
        'aceiteNonDisclosure',
        'dataNonDisclosure',
        'aceiteRiskWarning',
        'dataRiskWarning',
        'userTradingView',
        'setarNovaSenha',
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
