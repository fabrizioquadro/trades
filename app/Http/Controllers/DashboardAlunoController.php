<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Corretora;
use App\Models\Conta;
use App\Models\Ativo;
use App\Models\AtivoMercado;
use App\Models\Trade;
use App\Models\Agreements;
use App\Models\LogAceiteTermos;
use App\Models\ConsistenceDiamond;
use App\Models\ConsistenceFase;
use App\Http\Controllers\ResultadoAlunoController;
use App\Http\Controllers\FiltroAlunoController;

class DashboardAlunoController extends Controller
{
    public function index(Request $request){
        $filtro = new FiltroAlunoController();
        $filtroHtml = $filtro->geraFiltroAluno('aluno.dashboard');

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

        //vamos buscar os 3 maiores gains e loss
        $gains3Maiores = Trade::listaResultados3Maiores($aluno, 'Gain');
        $loss3Maiores = Trade::listaResultados3Maiores($aluno, 'Loss');

        $diamante = collect(ConsistenceDiamond::where('aluno_id', $aluno->id)
            ->orderByDesc('ano')
            ->orderByDesc('mes')
            ->get()
        )->first();

        $lapidacao = null;
        if($diamante){
            $lapidacao1 = $diamante->sem1Risk + $diamante->sem1Weeks + $diamante->sem1Months + $diamante->sem1GainLoss + $diamante->sem1TradePlan;
            $lapidacao2 = $diamante->sem2Risk + $diamante->sem2Weeks + $diamante->sem2Months + $diamante->sem2GainLoss + $diamante->sem2TradePlan;
            $lapidacao3 = $diamante->sem3Risk + $diamante->sem3Weeks + $diamante->sem3Months + $diamante->sem3GainLoss + $diamante->sem3TradePlan;
            $lapidacao4 = $diamante->sem4Risk + $diamante->sem4Weeks + $diamante->sem4Months + $diamante->sem4GainLoss + $diamante->sem4TradePlan;
            $lapidacao5 = $diamante->sem5Risk + $diamante->sem5Weeks + $diamante->sem5Months + $diamante->sem5GainLoss + $diamante->sem5TradePlan;

            if($lapidacao5 > 0){
                $lapidacao = $lapidacao5;
            }
            elseif($lapidacao4 > 0){
                $lapidacao = $lapidacao4;
            }
            elseif($lapidacao3 > 0){
                $lapidacao = $lapidacao3;
            }
            elseif($lapidacao2 > 0){
                $lapidacao = $lapidacao2;
            }
            elseif($lapidacao1 > 0){
                $lapidacao = $lapidacao1;
            }
        }

        $fases = ConsistenceFase::all();

        return view('acessoAluno/dashboard/index', compact(
            'aluno','resultadosGerais','resultadosTendencia','filtroHtml',
            'resultadosContraTendencia','arrayGraficoLine','contador','tempo','tradeMaiorGain',
            'tradeMaiorLoss','gains3Maiores','loss3Maiores','stringSomadorTrades','totalGainMB',
            'totalLossMB','dias','qtOperacaoVenda',
            'qtOperacaoCompra','qtOperacaoVendaGain','qtOperacaoCompraGain','porcAcertoFase1',
            'porcAcertoFase2','porcAcertoFase3','porcAcertoFase4','porcAcertoFase5','principaisAtivos',
            'arrayAtivosDados','trades','lapidacao','fases'));
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
            'userTradingView' => $request->get('userTradingView'),
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

    public function stocks(){
        $ativos = AtivoMercado::where('tipo','Stocks')->orderBy('simbolo')->get();
        if($_GET && $_GET['ativo']){
            $simbolo = $_GET['ativo'];
        }
        else{
            $ativo = collect($ativos)->first();
            $simbolo = $ativo->simbolo;
        }

        return view('acessoAluno/dashboard/stocks', compact('ativos','simbolo'));
    }

    public function forex(){
        $ativos = AtivoMercado::where('tipo','Forex')->orderBy('simbolo')->get();
        if($_GET && $_GET['ativo']){
            $simbolo = $_GET['ativo'];
        }
        else{
            $ativo = collect($ativos)->first();
            $simbolo = $ativo->simbolo;
        }
        return view('acessoAluno/dashboard/forex', compact('ativos','simbolo'));
    }

    public function cryptos(){
        $ativos = AtivoMercado::where('tipo','Cryptos')->orderBy('simbolo')->get();
        if($_GET && $_GET['ativo']){
            $simbolo = $_GET['ativo'];
        }
        else{
            $ativo = collect($ativos)->first();
            $simbolo = $ativo->simbolo;
        }

        return view('acessoAluno/dashboard/cryptos', compact('ativos','simbolo'));
    }

    public function worldIndex(){
        return view('acessoAluno/dashboard/worldIndex');
    }

    public function termosPrivacyPolicy(){
        $agreements = Agreements::where('id', 1)->first();

        $aluno = session()->get('aluno');

        $log = LogAceiteTermos::getUltimoLog($aluno->id, 'PrivacyPolicy');
        $log = explode(' ', $log);
        $log = dataDbForm($log[0])." ".$log[1];

        $dados = $agreements->termosPrivacyPolicy;
        $logo = "/public/img/IconsPng/Privacy Policy 2.png";

        return view('acessoAluno/dashboard/termosDeCumpliece', compact('dados','logo','log'));
    }

    public function cookiesPolicy(){
        $agreements = Agreements::where('id', 1)->first();

        $aluno = session()->get('aluno');

        $log = LogAceiteTermos::getUltimoLog($aluno->id, 'CookiesPolicy');
        $log = explode(' ', $log);
        $log = dataDbForm($log[0])." ".$log[1];

        $dados = $agreements->cookiesPolicy;
        $logo = "/public/img/IconsPng/Cookies Policy.png";

        return view('acessoAluno/dashboard/termosDeCumpliece', compact('dados','logo','log'));
    }

    public function termsAndConditions(){
        $agreements = Agreements::where('id', 1)->first();

        $aluno = session()->get('aluno');

        $log = LogAceiteTermos::getUltimoLog($aluno->id, 'TermsAndConditions');
        $log = explode(' ', $log);
        $log = dataDbForm($log[0])." ".$log[1];

        $dados = $agreements->termsAndConditions;
        $logo = "/public/img/IconsPng/Terms Conditions.png";

        return view('acessoAluno/dashboard/termosDeCumpliece', compact('dados','logo','log'));
    }

    public function nonDisclosure(){
        $agreements = Agreements::where('id', 1)->first();

        $aluno = session()->get('aluno');

        $log = LogAceiteTermos::getUltimoLog($aluno->id, 'NonDisclosure');
        $log = explode(' ', $log);
        $log = dataDbForm($log[0])." ".$log[1];

        $dados = $agreements->nonDisclosure;
        $logo = "/public/img/IconsPng/Non-Disclosure.png";

        return view('acessoAluno/dashboard/termosDeCumpliece', compact('dados','logo','log'));
    }

    public function riskWarning(){
        $agreements = Agreements::where('id', 1)->first();

        $aluno = session()->get('aluno');

        $log = LogAceiteTermos::getUltimoLog($aluno->id, 'RiskWarning');
        $log = explode(' ', $log);
        $log = dataDbForm($log[0])." ".$log[1];

        $dados = $agreements->riskWarning;
        $logo = "/public/img/IconsPng/Risk Warning.png";

        return view('acessoAluno/dashboard/termosDeCumpliece', compact('dados','logo','log'));
    }

}
