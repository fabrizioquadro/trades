<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Corretora;
use App\Models\Tag;
use App\Models\Ativo;
use App\Models\Trade;
use App\Models\Aluno;
use App\Http\Controllers\ResultadoController;
use App\Http\Controllers\FiltroController;

class DashboardController extends Controller
{
    public function index(Request $request){
        $user = \Auth::user();

        $filtro = new FiltroController();
        $filtro = $filtro->gerarFiltro('dashboard');

        if($user->moedaBase == "BRL"){
            $multiplicador = 'cotacaoBRL';
            $moedaBase = "R$";
        }
        elseif($user->moedaBase == "USD"){
            $multiplicador = 'cotacaoUSD';
            $moedaBase = "US$";
        }
        elseif($user->moedaBase == "EUR"){
            $multiplicador = 'cotacaoEUR';
            $moedaBase = "€";
        }
        elseif($user->moedaBase == "GBP"){
            $multiplicador = 'cotacaoGBP';
            $moedaBase = "£";
        }
        elseif($user->moedaBase == "JPY"){
            $multiplicador = 'cotacaoJPY';
            $moedaBase = "¥$";
        }

        $trades = Trade::listaResultadosUsers($user);

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
        $qtOperacaoCompra = 0;
        $qtOperacaoVenda = 0;
        $qtOperacaoCompraGain = 0;
        $qtOperacaoVendaGain = 0;
        $qtFase1 = 0;
        $qtFase2 = 0;
        $qtFase3 = 0;
        $qtFase4 = 0;
        $qtFase5 = 0;

        $qtFase1Gain = 0;
        $qtFase2Gain = 0;
        $qtFase3Gain = 0;
        $qtFase4Gain = 0;
        $qtFase5Gain = 0;

        $somaTendenciaGain = 0;
        $somaTendenciaLoss = 0;

        $arrayAtivos = array();
        $arrayAtivosDados = array();

        foreach($trades as $trade){
            $arrayDados = array();
            if(array_key_exists($trade->id_ativo, $arrayAtivos)){
                $arrayAtivos[$trade->id_ativo] = $arrayAtivos[$trade->id_ativo] + 1;

                $arrayDados = $arrayAtivosDados[$trade->id_ativo];
                $arrayDados['qt'] = $arrayDados['qt'] + 1;
                if($trade->gainOrLoss == 'Gain'){
                    $arrayDados['qt_acertos'] = $arrayDados['qt_acertos'] + 1;
                }
                elseif($trade->gainOrLoss == 'Loss'){
                    $arrayDados['qt_erros'] = $arrayDados['qt_erros'] + 1;
                }

                $arrayDados['qt_pontosAtivo'] = $arrayDados['qt_pontosAtivo'] + $trade->resContratoPontos;
                $arrayDados['qt_contratos'] = $arrayDados['qt_contratos'] + $trade->quantidadeContratos;
                $arrayAtivosDados[$trade->id_ativo] = $arrayDados;
            }
            else{
                $arrayAtivos[$trade->id_ativo] = 1;

                $arrayDados['qt'] = 1;
                if($trade->gainOrLoss == 'Gain'){
                    $arrayDados['qt_acertos'] = 1;
                    $arrayDados['qt_erros'] = 0;

                }
                elseif($trade->gainOrLoss == 'Loss'){
                    $arrayDados['qt_acertos'] = 0;
                    $arrayDados['qt_erros'] = 1;
                }
                else{
                    $arrayDados['qt_acertos'] = 0;
                    $arrayDados['qt_erros'] = 0;
                }
                $arrayDados['qt_pontosAtivo'] = $trade->valorPontoContrato;
                $arrayDados['qt_contratos'] = $trade->quantidadeContratos;
                $arrayAtivosDados[$trade->id_ativo] = $arrayDados;
            }

            $tempoTradeSegundos = strtotime($trade->dtHrSaida) - strtotime($trade->dtHrEntrada);
            $contador['total']++;
            $varTradesGerais .= ",".$trade->id_trade;

            if($trade->fase == "Fase 01"){
                $qtFase1++;
            }
            elseif($trade->fase == "Fase 02"){
                $qtFase2++;
            }
            elseif($trade->fase == "Fase 03"){
                $qtFase3++;
            }
            elseif($trade->fase == "Fase 04"){
                $qtFase4++;
            }
            elseif($trade->fase == "Fase 05"){
                $qtFase5++;
            }

            if($trade->operacao == "Compra"){
                $qtOperacaoCompra++;
            }elseif($trade->operacao == "Venda"){
                $qtOperacaoVenda++;
            }

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

                if($trade->operacao == "Compra"){
                    $qtOperacaoCompraGain++;
                }elseif($trade->operacao == "Venda"){
                    $qtOperacaoVendaGain++;
                }

                if($trade->fase == "Fase 01"){
                    $qtFase1Gain++;
                }
                elseif($trade->fase == "Fase 02"){
                    $qtFase2Gain++;
                }
                elseif($trade->fase == "Fase 03"){
                    $qtFase3Gain++;
                }
                elseif($trade->fase == "Fase 04"){
                    $qtFase4Gain++;
                }
                elseif($trade->fase == "Fase 05"){
                    $qtFase5Gain++;
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

        $principaisAtivos = array();
        arsort($arrayAtivos);
        $controlAtivo = 0;
        foreach ($arrayAtivos as $id => $qt) {
            if($controlAtivo < 5){
                $ativo = Ativo::where('id', $id)->first();
                $principaisAtivos[] = $ativo;
            }
            $controlAtivo++;
        }


        $porcAcertoFase1 = $qtFase1 > 0 ? round($qtFase1Gain * 100 / $qtFase1,2) : 0;
        $porcAcertoFase2 = $qtFase2 > 0 ? round($qtFase2Gain * 100 / $qtFase2,2) : 0;
        $porcAcertoFase3 = $qtFase3 > 0 ? round($qtFase3Gain * 100 / $qtFase3,2) : 0;
        $porcAcertoFase4 = $qtFase4 > 0 ? round($qtFase4Gain * 100 / $qtFase4,2) : 0;
        $porcAcertoFase5 = $qtFase5 > 0 ? round($qtFase5Gain * 100 / $qtFase5,2) : 0;

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
        //$tradesSomatorio = Trade::where('id_aluno', $aluno->id)
        //    ->where('stOperacao', 'Closed')
        //    ->where('dtHrSaida', '<=', $dtHrSaida)
        //    ->get();
        //$valorSomatorio = 0;
        //foreach($tradesSomatorio as $t){
        //    $valorSomatorio += round($t->resPosicaoFinanceiro * $t->$multiplicador);
        //}

        //$stringSomadorTrades .= "'$valorSomatorio'";

        $arrayGraficoLine = array();

        $retorno = Trade::buscaResultadosDataUser($user, $dtTradeInc);
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
            $retorno = Trade::buscaResultadosDataUser($user, $data);
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
            $array[] = $data;
            $array[] = $varGain;
            $array[] = $varLoss;
            $array[] = $varEmpate;

            $arrayGraficoLine[] = $array;
        }

        $retorno = Trade::buscaResultadosDataUser($user, $dtTradeFn);
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
        $resultado = new ResultadoController();
        $resultadosGerais = $resultado->onePageReport($request, $varTradesGerais, 'retorno');
        $resultadosTendencia = $resultado->onePageReport($request, $varTradesTendencia, 'retorno');
        $resultadosContraTendencia = $resultado->onePageReport($request, $varTradesContraTendencia, 'retorno');

        //vamos buscar os 3 maiores gains e loss
        $gains3Maiores = Trade::listaResultados3MaioresUser($user, 'Gain');
        $loss3Maiores = Trade::listaResultados3MaioresUser($user, 'Loss');

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

        if($tempo['tendenciaTotalPorcentagem'] < 10){
            $tempo['tendenciaTotalPorcentagem'] = 10;
            $tempo['contraTotalPorcentagem'] = 90;
        }
        elseif($tempo['contraTotalPorcentagem'] < 10){
            $tempo['tendenciaTotalPorcentagem'] = 90;
            $tempo['contraTotalPorcentagem'] = 10;
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

        if(@$tempo['gainTotalPorcentagem'] < 10){
            $tempo['gainTotalPorcentagem'] = 10;
        }

        if(@$tempo['lossTotalPorcentagem'] < 10){
            $tempo['lossTotalPorcentagem'] = 10;
        }

        if(@$tempo['empateTotalPorcentagem'] < 10){
            $tempo['empateTotalPorcentagem'] = 10;
        }

        $tempo['gainMediaDescricao'] = $contador['gain'] ?  calculaTempoTotal($tempo['gainTotal'] / $contador['gain']) : null;
        $tempo['lossMediaDescricao'] = $contador['loss'] ?  calculaTempoTotal($tempo['lossTotal'] / $contador['loss']) : null;
        $tempo['empateMediaDescricao'] = $contador['empate'] ?  calculaTempoTotal($tempo['empateTotal'] / $contador['empate']) : null;

        return view('dashboard/index2', compact('filtro','resultadosGerais','resultadosTendencia','resultadosContraTendencia',
        'dias','qtOperacaoCompra','qtOperacaoCompraGain','qtOperacaoVenda','qtOperacaoVendaGain','porcAcertoFase1',
        'porcAcertoFase2','porcAcertoFase3','porcAcertoFase4','porcAcertoFase5','principaisAtivos','arrayAtivosDados',
        'arrayGraficoLine','contador','totalGainMB','totalLossMB','tradeMaiorGain','tradeMaiorLoss','gains3Maiores',
        'loss3Maiores','tempo','trades'));
    }

    public function indexOld(Request $request){
        $user = \Auth::user();

        if($request->has('controle')){
            if($request->get('controle') == "limparFiltros"){
                //entrando aqui vamos salvar os dados no db
                $user->filtroTag = null;
                $user->filtroAluno = null;
                $user->filtroDtEntradaInc = null;
                $user->filtroDtEntradaFn = null;
                $user->filtroDtSaidaInc = null;
                $user->filtroDtSaidaFn = null;
                $user->filtroTipoOperacao = null;
                $user->filtroPais = null;
                $user->filtroCorretora = null;
                $user->filtroTipoConta = null;
                $user->filtroAtivo = null;
                $user->filtroTipoAtivo = null;
                $user->filtroOperacao = null;
                $user->filtroDirecao = null;
                $user->filtroFase = null;
                $user->filtroMoeda = null;
                $user->filtroTipoCusto = null;
                $user->filtroResultado = null;
            }
            else{
                //entrando aqui vamos salvar os dados no db
                $user->filtroTag = substr($request->get('filtroTag'), 1);
                $user->filtroAluno = substr($request->get('filtroAluno'), 1);
                $user->filtroDtEntradaInc = $request->get('dtEntradaInc');
                $user->filtroDtEntradaFn = $request->get('dtEntradaFn');
                $user->filtroDtSaidaInc = $request->get('dtSaidaInc');
                $user->filtroDtSaidaFn = $request->get('dtSaidaFn');
                $user->filtroTipoOperacao = substr($request->get('filtroTipoOperacao'), 1);
                $user->filtroPais = substr($request->get('filtroPais'), 1);
                $user->filtroCorretora = substr($request->get('filtroCorretora'), 1);
                $user->filtroTipoConta = substr($request->get('filtroTipoConta'), 1);
                $user->filtroAtivo = substr($request->get('filtroAtivo'), 1);
                $user->filtroTipoAtivo = substr($request->get('filtroTipoAtivo'), 1);
                $user->filtroOperacao = substr($request->get('filtroOperacao'), 1);
                $user->filtroDirecao = substr($request->get('filtroDirecao'), 1);
                $user->filtroFase = substr($request->get('filtroFase'), 1);
                $user->filtroMoeda = substr($request->get('filtroMoeda'), 1);
                $user->filtroTipoCusto = substr($request->get('filtroTipoCusto'), 1);
                $user->filtroResultado = substr($request->get('filtroResultado'), 1);
            }

            $user->save();
        }

        $tags = Tag::all()->sortBy('nmTag');
        $alunos = Aluno::listarAlunosTags($user->filtroTag);
        //$alunos = Aluno::all()->sortBy('nmAluno');
        $corretoras = Corretora::all()->sortBy('nome');
        $ativos = Ativo::all()->sortBy('nome');

        if($user->moedaBase == "BRL"){
            $multiplicador = 'cotacaoBRL';
            $moedaBase = "R$";
        }
        elseif($user->moedaBase == "USD"){
            $multiplicador = 'cotacaoUSD';
            $moedaBase = "US$";
        }
        elseif($user->moedaBase == "EUR"){
            $multiplicador = 'cotacaoEUR';
            $moedaBase = "€";
        }
        elseif($user->moedaBase == "GBP"){
            $multiplicador = 'cotacaoGBP';
            $moedaBase = "£";
        }
        elseif($user->moedaBase == "JPY"){
            $multiplicador = 'cotacaoJPY';
            $moedaBase = "¥$";
        }

        $trades = Trade::listaResultadosUsers($user);

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

        //vamos começar a fazer os calculos do dashboard
        $resultado = new ResultadoController();
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

        return view('dashboard/index', compact('tags','corretoras','ativos','resultadosGerais','resultadosTendencia',
        'resultadosContraTendencia','contador','tempo','tradeMaiorGain','tradeMaiorLoss','totalGainMB','totalLossMB','alunos'));
    }

    public function perfil(){
        return view('dashboard/perfil');
    }

    public function perfilUpdate(Request $request){
        $id = auth()->user()->id;
        $dados = $request->only('nome','email','tipo','moedaBase');
        User::where('id', $id)->update($dados);

        if($request->hasFile('imagem') && $request->file('imagem')->isValid()){
            $imagem = $request->imagem;
            $extensao = $imagem->extension();

            $nmImagem = $id.".".$extensao;
            $dadosUpdate['imagem'] = $nmImagem;

            $request->imagem->move(public_path('img/usuarios'), $nmImagem);

            User::where('id', $id)->update($dadosUpdate);
        }

        return redirect()->route('perfil')->with('mensagem', "Perfil Alterado");
    }

    public function alterarSenha(){
        return view('dashboard/alterarSenha');
    }

    public function updatePassword(Request $request){
        $dados['password'] = bcrypt($request->get('password'));
        User::where('id', auth()->user()->id)->update($dados);

        return redirect()->route('perfil')->with('mensagem', "Senha Alterada");
    }

    public function filtroTagsAlunos(){
        $tags = substr($_GET['tags'],1);

        $alunos = Aluno::listarAlunosTags($tags);

        $html = "";
        foreach ($alunos as $aluno){
            $html .= "<option value='".$aluno->id_aluno."' selected>".$aluno->nmAluno."</option>";
        }
        $retorno['html'] = $html;

        echo json_encode($retorno) ;
    }
}
