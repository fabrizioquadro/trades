<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Corretora;
use App\Models\Conta;
use App\Models\Ativo;
use App\Models\Trade;
use App\Http\Controllers\ResultadoAlunoController;

class DashboardAlunoController extends Controller
{
    public function index(Request $request){
        $aluno = session()->get('aluno');

        if($aluno->moedaBase == "BRL"){
            $multiplicador = 'cotacaoBRL';
            $moedaBase = "R$";
        }
        elseif($aluno->moedaBase == "USD"){
            $multiplicador = 'cotacaoUSD';
            $moedaBase = "US$";
        }
        elseif($aluno->moedaBase == "EUR"){
            $multiplicador = 'cotacaoEUR';
            $moedaBase = "€";
        }
        elseif($aluno->moedaBase == "GBP"){
            $multiplicador = 'cotacaoGBP';
            $moedaBase = "£";
        }
        elseif($aluno->moedaBase == "JPY"){
            $multiplicador = 'cotacaoJPY';
            $moedaBase = "¥$";
        }

        if($request->has('pesquisar')){
            $dados = $request->except('_token','controleFiltro');

            $aluno->dtEntradaInc = $dados['dtEntradaInc'];
            $aluno->dtEntradaFn = $dados['dtEntradaFn'];
            $aluno->dtSaidaInc = $dados['dtSaidaInc'];
            $aluno->dtSaidaFn = $dados['dtSaidaFn'];
            $aluno->filtroStatus = $dados['filtroStatus'] == NULL ? NULL : substr($dados['filtroStatus'], 1);
            $aluno->filtroTipoOperacao = $dados['filtroTipoOperacao'] == NULL ? NULL : substr($dados['filtroTipoOperacao'], 1);
            $aluno->filtroPais = $dados['filtroPais'] == NULL ? NULL : substr($dados['filtroPais'], 1);
            $aluno->filtroCorretora = $dados['filtroCorretora'] == NULL ? NULL : substr($dados['filtroCorretora'], 1);
            $aluno->filtroTipoConta = $dados['filtroTipoConta'] == NULL ? NULL : substr($dados['filtroTipoConta'], 1);
            $aluno->filtroConta = $dados['filtroConta'] == NULL ? NULL : substr($dados['filtroConta'], 1);
            $aluno->filtroAtivo = $dados['filtroAtivo'] == NULL ? NULL : substr($dados['filtroAtivo'], 1);
            $aluno->filtroTipoAtivo = $dados['filtroTipoAtivo'] == NULL ? NULL : substr($dados['filtroTipoAtivo'], 1);
            $aluno->filtroOperacao = $dados['filtroOperacao'] == NULL ? NULL : substr($dados['filtroOperacao'], 1);
            $aluno->filtroDirecao = $dados['filtroDirecao'] == NULL ? NULL : substr($dados['filtroDirecao'], 1);
            $aluno->filtroFase = $dados['filtroFase'] == NULL ? NULL : substr($dados['filtroFase'], 1);
            $aluno->filtroMoeda = $dados['filtroMoeda'] == NULL ? NULL : substr($dados['filtroMoeda'], 1);
            $aluno->filtroTipoCusto = $dados['filtroTipoCusto'] == NULL ? NULL : substr($dados['filtroTipoCusto'], 1);
            $aluno->filtroResultado = $dados['filtroResultado'] == NULL ? NULL : substr($dados['filtroResultado'], 1);

            $aluno->save();

        }

        $corretoras = Corretora::all()->sortBy('nome');
        $contas = Conta::where('id_aluno', $aluno->id)->orderBy('nrConta')->get();
        $ativos = Ativo::all()->sortBy('nome');

        $trades = Trade::listaResultados($aluno);

        $varTradesGerais = "";
        $varTradesTendencia = "";
        $varTradesContraTendencia = "";
        $dtTradeInc = "3000-12-31 23:59:59";
        $dtTradeFn = "0000-00-00 00:00:00";
        $contador['total'] = 0;
        $contador['tendencia'] = 0;
        $contador['contra'] = 0;
        $contador['gain'] = 0;
        $contador['loss'] = 0;
        $contador['empate'] = 0;
        $tempo['tendenciaTotal'] = 0;
        $tempo['contraTotal'] = 0;
        $tempo['gainTotal'] = 0;
        $tempo['lossTotal'] = 0;
        $tempo['empateTotal'] = 0;
        $tradeMaiorGain = null;
        $tradeMaiorLoss = null;
        $tempoTradeSegundos = 0;
        $tempo['tendenciaTotalPorcentagem'] = 0;
        $tempo['contraTotalPorcentagem'] = 0;
        $tempo['tendenciaTotalView'] = 0;
        $tempo['contraTotalView'] = 0;
        $tempo['tendenciaTotalDescricao'] = 0;
        $tempo['contraTotalDescricao'] = 0;
        $totalGainMB = 0;
        $totalLossMB = 0;

        foreach($trades as $trade){
            $tempoTradeSegundos = strtotime($trade->dtHrSaida) - strtotime($trade->dtHrEntrada);
            $contador['total']++;
            $varTradesGerais .= ",".$trade->id_trade;

            if($trade->direcao == "Tendência"){
                $varTradesTendencia .= ",".$trade->id_trade;
                $contador['tendencia']++;
                $tempo['tendenciaTotal'] += $tempoTradeSegundos;
            }
            elseif($trade->direcao == "Contra-tendência"){
                $varTradesContraTendencia .= ",".$trade->id_trade;
                $contador['contra']++;
                $tempo['contraTotal'] += $tempoTradeSegundos;
            }

            if($trade->gainOrLoss == "Gain"){
                $totalGainMB += round($trade->resPosicaoFinanceiro * $trade->$multiplicador);
                $tempo['gainTotal'] += $tempoTradeSegundos;
                $contador['gain']++;
                if($tradeMaiorGain == null || $tradeMaiorGain->resPosicaoFinanceiro < $trade->resPosicaoFinanceiro){
                    $tradeMaiorGain = $trade;
                }
            }
            elseif($trade->gainOrLoss == "Loss"){
                $totalLossMB += round($trade->resPosicaoFinanceiro * $trade->$multiplicador);
                $tempo['lossTotal'] += $tempoTradeSegundos;
                $contador['loss']++;
                if($tradeMaiorLoss == null || $tradeMaiorLoss->resPosicaoFinanceiro > $trade->resPosicaoFinanceiro){
                    $tradeMaiorLoss = $trade;
                }
            }
            elseif($trade->gainOrLoss == "0 x 0"){
                $tempo['empateTotal'] += $tempoTradeSegundos;
                $contador['empate']++;
            }

            //vamos verificar a primeira e a ultima trade
            if(strtotime($trade->dtHrSaida) < strtotime($dtTradeInc)){
                $dtTradeInc = $trade->dtHrSaida;
            }

            if(strtotime($trade->dtHrSaida) > strtotime($dtTradeFn)){
                $dtTradeFn = $trade->dtHrSaida;
            }
        }

        $stringSomadorTrades = '';

        $var = explode(' ', $dtTradeInc);
        $dtTradeInc = $var[0];

        $var = explode(' ', $dtTradeFn);
        $dtTradeFn = $var[0];

        $dif = strtotime($dtTradeFn) - strtotime($dtTradeInc);

        //vamos verificar qual a diferença de dias
        $dias = round($dif / 86400);

        if($dias > 30){
            $nrDias = 30;
            $qtDias = round($dias / 30);
        }
        else{
            $nrDias = $dias;
            $qtDias = 1;
        }

        //vamos buscar as trades até a data inicial
        $dtHrSaida = $dtTradeInc." 23:59:59";
        $tradesSomatorio = Trade::where('id_aluno', $aluno->id)
            ->where('stOperacao', 'Closed')
            ->where('dtHrSaida', '<=', $dtHrSaida)
            ->get();
        $valorSomatorio = 0;
        foreach($tradesSomatorio as $t){
            $valorSomatorio += round($t->resPosicaoFinanceiro * $t->$multiplicador);
        }

        $stringSomadorTrades .= "'$valorSomatorio'";

        $arrayGraficoLine = array();

        $retorno = Trade::buscaResultadosData($aluno->id, $dtTradeInc);
        $varGain = 0;
        $varLoss = 0;
        $varEmpate = 0;

        foreach($retorno as $linha){
            if($linha->gainOrLoss == '0 x 0'){
                $varEmpate = $linha->quantidade;
            }
            if($linha->gainOrLoss == 'Gain'){
                $varGain = $linha->quantidade;
            }
            if($linha->gainOrLoss == 'Loss'){
                $varLoss = $linha->quantidade;
            }
        }
        $array = array();
        $array[] = $dtTradeInc;
        $array[] = $varGain;
        $array[] = $varLoss;
        $array[] = $varEmpate;

        $arrayGraficoLine[] = $array;

        $data = $dtTradeInc;

        for($i=1 ; $i<$nrDias ; $i++){
            $data = date('Y-m-d', strtotime("+ $qtDias days",strtotime($data)));
            $retorno = Trade::buscaResultadosData($aluno->id, $data);
            $varGain = 0;
            $varLoss = 0;
            $varEmpate = 0;

            //vamos buscar as trades até a data inicial
            $dtHrSaida = $data." 23:59:59";
            $tradesSomatorio = Trade::where('id_aluno', $aluno->id)
                ->where('stOperacao', 'Closed')
                ->where('dtHrSaida', '<=', $dtHrSaida)
                ->get();
            $valorSomatorio = 0;
            foreach($tradesSomatorio as $t){
                $valorSomatorio += round($t->resPosicaoFinanceiro * $t->$multiplicador);
            }

            $stringSomadorTrades .= ",'$valorSomatorio'";

            foreach($retorno as $linha){
                if($linha->gainOrLoss == '0 x 0'){
                    $varEmpate = $linha->quantidade;
                }
                if($linha->gainOrLoss == 'Gain'){
                    $varGain = $linha->quantidade;
                }
                if($linha->gainOrLoss == 'Loss'){
                    $varLoss = $linha->quantidade;
                }
            }
            $array = array();
            $array[] = $data;
            $array[] = $varGain;
            $array[] = $varLoss;
            $array[] = $varEmpate;

            $arrayGraficoLine[] = $array;
        }

        //vamos buscar as trades até a data inicial
        $dtHrSaida = $dtTradeFn." 23:59:59";
        $tradesSomatorio = Trade::where('id_aluno', $aluno->id)
            ->where('stOperacao', 'Closed')
            ->where('dtHrSaida', '<=', $dtHrSaida)
            ->get();
        $valorSomatorio = 0;
        foreach($tradesSomatorio as $t){
            $valorSomatorio += round($t->resPosicaoFinanceiro * $t->$multiplicador);
        }

        $stringSomadorTrades .= ",'$valorSomatorio'";

        $retorno = Trade::buscaResultadosData($aluno->id, $dtTradeFn);
        $varGain = 0;
        $varLoss = 0;
        $varEmpate = 0;

        foreach($retorno as $linha){
            if($linha->gainOrLoss == '0 x 0'){
                $varEmpate = $linha->quantidade;
            }
            if($linha->gainOrLoss == 'Gain'){
                $varGain = $linha->quantidade;
            }
            if($linha->gainOrLoss == 'Loss'){
                $varLoss = $linha->quantidade;
            }
        }
        $array = array();
        $array[] = $dtTradeFn;
        $array[] = $varGain;
        $array[] = $varLoss;
        $array[] = $varEmpate;

        $arrayGraficoLine[] = $array;

        //vamos montar as strings do grafico do gain loss e empate
        $arrayGraficoLineCat = "";
        $arrayGraficoLineGain = "";
        $arrayGraficoLineLoss = "";
        $arrayGraficoLineEmpate = "";

        foreach($arrayGraficoLine as $array){
            $arrayGraficoLineCat .= ",'".dataDbForm($array[0])."'";
            $arrayGraficoLineGain .= ",".$array[1];
            $arrayGraficoLineLoss .= ",".$array[2];
            $arrayGraficoLineEmpate.= ",".$array[3];
        }

        $arrayGraficoLineCat = substr($arrayGraficoLineCat, 1);
        $arrayGraficoLineGain = substr($arrayGraficoLineGain, 1);
        $arrayGraficoLineLoss = substr($arrayGraficoLineLoss, 1);
        $arrayGraficoLineEmpate = substr($arrayGraficoLineEmpate, 1);

        $arrayGraficoLine = array();
        $arrayGraficoLine['cat'] = $arrayGraficoLineCat;
        $arrayGraficoLine['gain'] = $arrayGraficoLineGain;
        $arrayGraficoLine['loss'] = $arrayGraficoLineLoss;
        $arrayGraficoLine['empate'] = $arrayGraficoLineEmpate;

        //vamos começar a fazer os calculos do dashboard
        $resultado = new ResultadoAlunoController();
        $resultadosGerais = $resultado->onePageReport($request, $varTradesGerais, 'retorno');
        $resultadosTendencia = $resultado->onePageReport($request, $varTradesTendencia, 'retorno');
        $resultadosContraTendencia = $resultado->onePageReport($request, $varTradesContraTendencia, 'retorno');

        //vamos verificar os tempos da tendencia e contra tendencia
        $varTotal = $tempo['tendenciaTotal'] + $tempo['contraTotal'];
        if($varTotal > 0){
            $tempo['tendenciaTotalPorcentagem'] = round($tempo['tendenciaTotal'] *100 / $varTotal, 1);
            $tempo['contraTotalPorcentagem'] = round($tempo['contraTotal'] *100 / $varTotal, 1);
        }

        $tempo['tendenciaTotalView'] = $tempo['tendenciaTotalPorcentagem'];
        $tempo['contraTotalView'] = $tempo['contraTotalPorcentagem'];

        $tempo['tendenciaTotalDescricao'] = calculaTempoTotal($tempo['tendenciaTotal']);
        $tempo['contraTotalDescricao'] = calculaTempoTotal($tempo['contraTotal']);

        if($tempo['tendenciaTotalPorcentagem'] < 20){
            $tempo['tendenciaTotalPorcentagem'] = 20;
            $tempo['contraTotalPorcentagem'] = 80;
        }
        elseif($tempo['contraTotalPorcentagem'] < 20){
            $tempo['tendenciaTotalPorcentagem'] = 80;
            $tempo['contraTotalPorcentagem'] = 20;
        }

        $tempo['tendenciaMediaDescricao'] = $contador['tendencia'] > 0 ? calculaTempoTotal($tempo['tendenciaTotal'] / $contador['tendencia']) : null;
        $tempo['contraMediaDescricao'] = $contador['contra'] > 0 ? calculaTempoTotal($tempo['contraTotal'] / $contador['contra']) : null;

        //vamos verificar os tempos da gain loss e empate
        $varTotal = $tempo['gainTotal'] + $tempo['lossTotal'] + $tempo['empateTotal'];
        if($varTotal > 0){
            $tempo['gainTotalPorcentagem'] = round($tempo['gainTotal'] *100 / $varTotal, 1);
            $tempo['lossTotalPorcentagem'] = round($tempo['lossTotal'] *100 / $varTotal, 1);
            $tempo['empateTotalPorcentagem'] = round($tempo['empateTotal'] *100 / $varTotal, 1);
        }

        $tempo['gainTotalView'] = @$tempo['gainTotalPorcentagem'];
        $tempo['lossTotalView'] = @$tempo['lossTotalPorcentagem'];
        $tempo['empateTotalView'] = @$tempo['empateTotalPorcentagem'];

        $tempo['gainTotalDescricao'] = calculaTempoTotal($tempo['gainTotal']);
        $tempo['lossTotalDescricao'] = calculaTempoTotal($tempo['lossTotal']);
        $tempo['empateTotalDescricao'] = calculaTempoTotal($tempo['empateTotal']);

        if(@$tempo['gainTotalPorcentagem'] < 20){
            $tempo['gainTotalPorcentagem'] = 20;
        }

        if(@$tempo['lossTotalPorcentagem'] < 20){
            $tempo['lossTotalPorcentagem'] = 20;
        }

        if(@$tempo['empateTotalPorcentagem'] < 20){
            $tempo['empateTotalPorcentagem'] = 20;
        }

        $tempo['gainMediaDescricao'] = $contador['gain'] ?  calculaTempoTotal($tempo['gainTotal'] / $contador['gain']) : null;
        $tempo['lossMediaDescricao'] = $contador['loss'] ?  calculaTempoTotal($tempo['lossTotal'] / $contador['loss']) : null;
        $tempo['empateMediaDescricao'] = $contador['empate'] ?  calculaTempoTotal($tempo['empateTotal'] / $contador['empate']) : null;

        //vamos buscar os 3 maiores gains e loss
        $gains3Maiores = Trade::listaResultados3Maiores($aluno, 'Gain');
        $loss3Maiores = Trade::listaResultados3Maiores($aluno, 'Loss');
        /*
        $dados_pesq = [
            'id_aluno' => $aluno->id,
            'gainOrLoss' => 'Gain',
        ];
        $gains3Maiores = Trade::where($dados_pesq)->orderByDesc('resPosicaoFinanceiro')->take(3)->get();

        $dados_pesq = [
            'id_aluno' => $aluno->id,
            'gainOrLoss' => 'Loss',
        ];
        $loss3Maiores = Trade::where($dados_pesq)->orderBy('resPosicaoFinanceiro')->take(3)->get();
        */

        return view('acessoAluno/dashboard/index', compact(
            'aluno','corretoras','contas','ativos','resultadosGerais','resultadosTendencia',
            'resultadosContraTendencia','arrayGraficoLine','contador','tempo','tradeMaiorGain',
            'tradeMaiorLoss','gains3Maiores','loss3Maiores','stringSomadorTrades','totalGainMB',
            'totalLossMB'));
    }

    public function setarMoedaBase(Request $request){
        $aluno = session()->get('aluno');

        $aluno->moedaBase = $request->get('moedaBase');
        $aluno->save();

        return redirect()->route('aluno.perfil.settings')->with('mensagem', 'Moeda Base salva com sucesso');
    }

    public function setarPorcentagemLucroPrejuizo(Request $request){
        $aluno = session()->get('aluno');

        $aluno->porcentagemPrejuizo = valorFormDb($request->get('porcentagemPrejuizo'));
        $aluno->porcentagemLucro = valorFormDb($request->get('porcentagemLucro'));
        $aluno->save();

        return redirect()->route('aluno.perfil.settings')->with('mensagem', 'Porcentagens Salvas');
    }

    public function perfil(){
        return view('acessoAluno/dashboard/perfil');
    }

    public function perfilUpdate(Request $request){
        $aluno = session()->get('aluno');

        $dados = [
            'nmAluno' => $request->get('nmAluno'),
            'dsEndereco' => $request->get('dsEndereco'),
            'nrEndereco' => $request->get('nrEndereco'),
            'dsComplemento' => $request->get('dsComplemento'),
            'dsBairro' => $request->get('dsBairro'),
            'nmCidade' => $request->get('nmCidade'),
            'dsEstado' => $request->get('dsEstado'),
            'nmPais' => $request->get('nmPais'),
            'nrCep' => $request->get('nrCep'),
            'nrTel' => $request->get('nrTel'),
        ];

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $aluno->id.".".$extensao;

            $request->imagem->move(public_path('img/alunos'), $nmImagem);

            $dados['imagem'] = $nmImagem;

        }

        Aluno::where('id', $aluno->id)
            ->update($dados);

        $aluno = Aluno::where('id', $aluno->id)->first();
        $request->session()->put('aluno', $aluno);

        return redirect()->route('aluno.perfil')->with('mensagem', 'Perfil Editado');
    }

    public function alterarSenha(){
        return view('acessoAluno/dashboard/alterarSenha');
    }

    public function alterarSenhaUpdate(Request $request){
        $aluno = session()->get('aluno');

        $dsSenha = md5($request->get('password'));

        Aluno::where('id', $aluno->id)->update([
            'dsSenha' => $dsSenha,
        ]);

        return redirect()->route('aluno.perfil')->with('mensagem', 'Senha Alterada');
    }

    public function settings(){
        $aluno = session()->get('aluno');

        return view('acessoAluno/dashboard/settings', compact('aluno'));
    }
}
