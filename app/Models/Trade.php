<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\AlunoTag;

class Trade extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_aluno',
        'idOperacao',
        'dtHrEntrada',
        'dtHrSaida',
        'tempoOperacao',
        'stOperacao',
        'tipoOperacao',
        'pais',
        'id_corretora',
        'tipoConta',
        'id_conta',
        'id_ativo',
        'tipoAtivo',
        'operacao',
        'direcao',
        'fase',
        'quantidadeContratos',
        'moeda',
        'valorPontoContrato',
        'tipoCusto',
        'custoOperacaoEntrada',
        'custoOperacaoSaida',
        'precoEntrada',
        'custoEntrada',
        'precoSaida',
        'custoSaida',
        'resPosicaoPontos',
        'resPosicaoFinanceiro',
        'resContratoPontos',
        'resContratoFinanceiro',
        'variacaoEntradaSaida',
        'resOperacaoCapital',
        'gainOrLoss',
        'saudeConta',
        'validador',
        'motivosEntrada',
        'motivosSaida',
        'cotacaoBRL',
        'cotacaoUSD',
        'cotacaoEUR',
        'cotacaoGBP',
        'cotacaoJPY',
    ];

    public static function listarTradesExtratoConta($id_conta, $data){
        if($data){
            return \DB::table('trades')
            ->select('*')
            ->where('id_conta', $id_conta)
            ->where('stOperacao', 'Closed')
            ->where('dtHrSaida','<=', $data." 23:59:59")
            ->get();
        }
        else{
            return \DB::table('trades')
            ->select('*')
            ->where('id_conta', $id_conta)
            ->where('stOperacao', 'Closed')
            ->get();
        }
    }

    public static function getProximoIdOaoAluno($id_aluno){
        $linha = \DB::table('trades')
            ->where('id_aluno', $id_aluno)
            ->max('idOperacao');

        if($linha){
          return $linha + 1;
        }
        else{
          return 1;
        }
    }

    public static function listarTradesAluno($aluno){

        $sql = "SELECT *,ativos.nome AS nmAtivo,corretoras.nome AS nmCorretora,trades.id AS id_trade FROM trades
        LEFT JOIN corretoras ON (trades.id_corretora = corretoras.id)
        LEFT JOIN contas ON (trades.id_conta = contas.id)
        LEFT JOIN ativos ON (trades.id_ativo = ativos.id)
        WHERE trades.id_aluno=?
        ";

        $dados = array();
        $dados[] = $aluno->id;

        return \DB::select($sql, $dados);

    }

    public static function listaResultados($aluno){

        $sql = "SELECT *,ativos.nome AS nmAtivo,corretoras.nome AS nmCorretora,trades.id AS id_trade FROM trades
        LEFT JOIN corretoras ON (trades.id_corretora = corretoras.id)
        LEFT JOIN contas ON (trades.id_conta = contas.id)
        LEFT JOIN ativos ON (trades.id_ativo = ativos.id)
        WHERE trades.id_aluno='$aluno->id' AND trades.stOperacao='Closed'
        ";

        if($aluno->dtEntradaInc){
            $dtHrEntrada = $aluno->dtEntradaInc." 00:00:00";
            $sql .= " AND trades.dtHrEntrada >= '$dtHrEntrada'";
        }

        if($aluno->dtEntradaFn){
            $dtHrEntrada = $aluno->dtEntradaFn." 23:59:59";
            $sql .= " AND trades.dtHrEntrada <= '$dtHrEntrada'";
        }

        if($aluno->dtSaidaInc){
            $dtHrSaida = $aluno->dtSaidaInc." 00:00:00";
            $sql .= " AND trades.dtHrSaida >= '$dtHrSaida'";
        }

        if($aluno->dtSaidaFn){
            $dtHrSaida = $aluno->dtSaidaFn." 23:59:59";
            $sql .= " AND trades.dtHrSaida <= '$dtHrSaida'";
        }

        if($aluno->filtroStatus){
            $var = explode(',', $aluno->filtroStatus);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.stOao IN ($in)";
        }

        if($aluno->filtroTipoOperacao){
            $var = explode(',', $aluno->filtroTipoOperacao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoOperacao IN ($in)";
        }

        if($aluno->filtroPais){
            $var = explode(',', $aluno->filtroPais);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.pais IN ($in)";
        }

        if($aluno->filtroCorretora){
            $var = explode(',', $aluno->filtroCorretora);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_corretora IN ($in)";
        }

        if($aluno->filtroTipoConta){
            $var = explode(',', $aluno->filtroTipoConta);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoConta IN ($in)";
        }

        if($aluno->filtroConta){
            $var = explode(',', $aluno->filtroConta);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_conta IN ($in)";
        }

        if($aluno->filtroAtivo){
            $var = explode(',', $aluno->filtroAtivo);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_ativo IN ($in)";
        }

        if($aluno->filtroTipoAtivo){
            $var = explode(',', $aluno->filtroTipoAtivo);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoAtivo IN ($in)";
        }

        if($aluno->filtroOperacao){
            $var = explode(',', $aluno->filtroOperacao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.operacao IN ($in)";
        }

        if($aluno->filtroDirecao){
            $var = explode(',', $aluno->filtroDirecao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.direcao IN ($in)";
        }

        if($aluno->filtroFase){
            $var = explode(',', $aluno->filtroFase);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.fase IN ($in)";
        }

        if($aluno->filtroMoeda){
            $var = explode(',', $aluno->filtroMoeda);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.moeda IN ($in)";
        }

        if($aluno->filtroTipoCusto){
            $var = explode(',', $aluno->filtroTipoCusto);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoCusto IN ($in)";
        }

        if($aluno->filtroResultado){
            $var = explode(',', $aluno->filtroResultado);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.gainOrLoss IN ($in)";
        }

        return \DB::select($sql);

    }

    public static function listaResultados3Maiores($aluno, $resultado){

        $sql = "SELECT *,ativos.nome AS nmAtivo,corretoras.nome AS nmCorretora,trades.id AS id_trade FROM trades
        LEFT JOIN corretoras ON (trades.id_corretora = corretoras.id)
        LEFT JOIN contas ON (trades.id_conta = contas.id)
        LEFT JOIN ativos ON (trades.id_ativo = ativos.id)
        WHERE trades.id_aluno='$aluno->id' AND trades.stOperacao='Closed'
        AND gainOrLoss='$resultado'";

        if($aluno->dtEntradaInc){
            $dtHrEntrada = $aluno->dtEntradaInc." 00:00:00";
            $sql .= " AND trades.dtHrEntrada >= '$dtHrEntrada'";
        }

        if($aluno->dtEntradaFn){
            $dtHrEntrada = $aluno->dtEntradaFn." 23:59:59";
            $sql .= " AND trades.dtHrEntrada <= '$dtHrEntrada'";
        }

        if($aluno->dtSaidaInc){
            $dtHrSaida = $aluno->dtSaidaInc." 00:00:00";
            $sql .= " AND trades.dtHrSaida >= '$dtHrSaida'";
        }

        if($aluno->dtSaidaFn){
            $dtHrSaida = $aluno->dtSaidaFn." 23:59:59";
            $sql .= " AND trades.dtHrSaida <= '$dtHrSaida'";
        }

        if($aluno->filtroStatus){
            $var = explode(',', $aluno->filtroStatus);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.stOao IN ($in)";
        }

        if($aluno->filtroTipoOperacao){
            $var = explode(',', $aluno->filtroTipoOperacao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoOperacao IN ($in)";
        }

        if($aluno->filtroPais){
            $var = explode(',', $aluno->filtroPais);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.pais IN ($in)";
        }

        if($aluno->filtroCorretora){
            $var = explode(',', $aluno->filtroCorretora);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_corretora IN ($in)";
        }

        if($aluno->filtroTipoConta){
            $var = explode(',', $aluno->filtroTipoConta);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoConta IN ($in)";
        }

        if($aluno->filtroConta){
            $var = explode(',', $aluno->filtroConta);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_conta IN ($in)";
        }

        if($aluno->filtroAtivo){
            $var = explode(',', $aluno->filtroAtivo);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_ativo IN ($in)";
        }

        if($aluno->filtroTipoAtivo){
            $var = explode(',', $aluno->filtroTipoAtivo);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoAtivo IN ($in)";
        }

        if($aluno->filtroOperacao){
            $var = explode(',', $aluno->filtroOperacao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.operacao IN ($in)";
        }

        if($aluno->filtroDirecao){
            $var = explode(',', $aluno->filtroDirecao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.direcao IN ($in)";
        }

        if($aluno->filtroFase){
            $var = explode(',', $aluno->filtroFase);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.fase IN ($in)";
        }

        if($aluno->filtroMoeda){
            $var = explode(',', $aluno->filtroMoeda);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.moeda IN ($in)";
        }

        if($aluno->filtroTipoCusto){
            $var = explode(',', $aluno->filtroTipoCusto);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoCusto IN ($in)";
        }

        if($aluno->filtroResultado){
            $var = explode(',', $aluno->filtroResultado);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.gainOrLoss IN ($in)";
        }

        $sql .= " ORDER BY resPosicaoFinanceiro DESC LIMIT 3";

        return \DB::select($sql);

    }

    public static function listaResultadosUsers($user){
        $sql = "SELECT *,ativos.nome AS nmAtivo,corretoras.nome AS nmCorretora,trades.id AS id_trade FROM trades
        LEFT JOIN corretoras ON (trades.id_corretora = corretoras.id)
        LEFT JOIN contas ON (trades.id_conta = contas.id)
        LEFT JOIN ativos ON (trades.id_ativo = ativos.id)
        LEFT JOIN alunos ON (trades.id_aluno = alunos.id)
        WHERE trades.stOperacao='Closed'
        ";
        /*
        if($user->filtroTag){
            $controleVazio = true;
            $tags = explode(',', $user->filtroTag);
            $in = "";

            foreach ($tags as $id_tag){
                $alunos = AlunoTag::where('id_tag', $id_tag)->get();
                foreach($alunos as $aluno){
                    $controleVazio = false;
                    $in .= ','.$aluno->id_aluno;
                }
            }

            if($controleVazio){
                return null;
            }

            $in = substr($in, 1);
            $sql .= " AND trades.id_aluno IN ($in)";
        }*/

        if($user->filtroAluno){
            $var = explode(',', $user->filtroAluno);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_aluno IN ($in)";
        }

        if($user->filtroDtEntradaInc){
            $dtHrEntrada = $user->filtroDtEntradaInc." 00:00:00";
            $sql .= " AND trades.dtHrEntrada >= '$dtHrEntrada'";
        }

        if($user->filtroDtEntradaFn){
            $dtHrEntrada = $user->filtroDtEntradaFn." 23:59:59";
            $sql .= " AND trades.dtHrEntrada <= '$dtHrEntrada'";
        }

        if($user->filtroDtSaidaInc){
            $dtHrSaida = $user->filtroDtSaidaInc." 00:00:00";
            $sql .= " AND trades.dtHrSaida >= '$dtHrSaida'";
        }

        if($user->filtroDtSaidaFn){
            $dtHrSaida = $user->filtroDtSaidaFn." 23:59:59";
            $sql .= " AND trades.dtHrSaida <= '$dtHrSaida'";
        }

        if($user->filtroTipoOperacao){
            $var = explode(',', $user->filtroTipoOperacao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoOperacao IN ($in)";
        }

        if($user->filtroPais){
            $var = explode(',', $user->filtroPais);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.pais IN ($in)";
        }

        if($user->filtroCorretora){
            $var = explode(',', $user->filtroCorretora);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_corretora IN ($in)";
        }

        if($user->filtroTipoConta){
            $var = explode(',', $user->filtroTipoConta);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoConta IN ($in)";
        }

        if($user->filtroAtivo){
            $var = explode(',', $user->filtroAtivo);
            $in = "";
            foreach ($var as $opc){
                $in .= ",$opc";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.id_ativo IN ($in)";
        }

        if($user->filtroTipoAtivo){
            $var = explode(',', $user->filtroTipoAtivo);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoAtivo IN ($in)";
        }

        if($user->filtroOperacao){
            $var = explode(',', $user->filtroOperacao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.operacao IN ($in)";
        }

        if($user->filtroDirecao){
            $var = explode(',', $user->filtroDirecao);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.direcao IN ($in)";
        }

        if($user->filtroFase){
            $var = explode(',', $user->filtroFase);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.fase IN ($in)";
        }

        if($user->filtroMoeda){
            $var = explode(',', $user->filtroMoeda);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.moeda IN ($in)";
        }

        if($user->filtroTipoCusto){
            $var = explode(',', $user->filtroTipoCusto);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.tipoCusto IN ($in)";
        }

        if($user->filtroResultado){
            $var = explode(',', $user->filtroResultado);
            $in = "";
            foreach ($var as $opc){
                $in .= ",'$opc'";
            }
            $in = substr($in, 1);
            $sql .= " AND trades.gainOrLoss IN ($in)";
        }

        return \DB::select($sql);

    }

    public static function listaResultadosTrade($id_trade){
        $sql = "SELECT *,ativos.nome AS nmAtivo,corretoras.nome AS nmCorretora,trades.id AS id_trade FROM trades
        LEFT JOIN corretoras ON (trades.id_corretora = corretoras.id)
        LEFT JOIN contas ON (trades.id_conta = contas.id)
        LEFT JOIN ativos ON (trades.id_ativo = ativos.id)
        LEFT JOIN alunos ON (trades.id_aluno = alunos.id)
        WHERE trades.id='$id_trade' LIMIT 1
        ";

        return \DB::select($sql);
    }

    public static function buscaResultadosData($id_aluno, $data){
        $dtFn = $data." 23:59:59";

        $sql = "SELECT count('id') AS quantidade, `gainOrLoss` FROM `trades` WHERE
        `id_aluno`='$id_aluno' AND `stOperacao`='Closed' AND `dtHrSaida`<='$dtFn'
        GROUP BY `gainOrLoss`";

        return \DB::select($sql);
    }

}
