<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Conta;
use App\Models\ContaSaqueDeposito;
use App\Models\Trade;

class FinanceiroAlunoController extends Controller
{
    public function extratoConta(){
        $aluno = session()->get('aluno');

        $contas = Conta::where('id_aluno', $aluno->id)->orderBy('nrConta')->get();

        return view('acessoAluno/financeiro/extratoConta', compact('contas'));
    }

    public function extratoContaGerar(Request $request){
        $aluno = session()->get('aluno');

        $conta = Conta::where('id', $request->get('id_conta'))->first();

        if($conta->moeda == "BRL"){
            $moeda = "R$";
        }
        elseif($conta->moeda == "USD"){
            $moeda = "US$";
        }
        elseif($conta->moeda == "EUR"){
            $moeda = "€";
        }
        elseif($conta->moeda == "GBP"){
            $moeda = "£";
        }
        elseif($conta->moeda == "JPY"){
            $moeda = "¥$";
        }

        $array_movimentos = array();

        $totalSaques = 0;
        $totalDepositos = 0;
        $capitalMaximo = 0;

        //vamos buscar todas as trades desta Conta
        $trades = Trade::listarTradesExtratoConta($conta->id, $request->get('dtFnExtrato'));

        foreach($trades as $trade) {
            $movimento = array();

            $var = explode(' ', $trade->dtHrSaida);
            $movimento[] = strtotime($trade->dtHrSaida);
            $movimento[] = dataDbForm($var[0]);
            $movimento[] = "Finalização da Trade ".$trade->idOperacao;
            if($trade->resPosicaoFinanceiro < 0){
                $movimento[] = 'Débito';
            }
            else{
                $movimento[] = 'Crédito';
            }
            $movimento[] = $trade->resPosicaoFinanceiro;

            $array_movimentos[] = $movimento;
        }

        //vamos Buscar todos os saques e depositos dessa conta
        if($request->get('dtFnExtrato')){
            $saquesDepositos = ContaSaqueDeposito::where('id_conta', $conta->id)->where('dtMovimento','<=',$request->get('dtFnExtrato'))->get();
        }
        else{
            $saquesDepositos = ContaSaqueDeposito::where('id_conta', $conta->id)->get();
        }

        foreach($saquesDepositos as $saqueDeposito){
            $movimento = array();

            $movimento[] = strtotime($saqueDeposito->dtMovimento);
            $movimento[] = dataDbForm($saqueDeposito->dtMovimento);
            $movimento[] = $saqueDeposito->tpMovimento;
            if($saqueDeposito->tpMovimento == "Saque"){
                $movimento[] = "Débito";
                $totalSaques += $saqueDeposito->vlMovimento;
            }
            else{
                $movimento[] = "Crédito";
                $totalDepositos += $saqueDeposito->vlMovimento;
            }
            $movimento[] = $saqueDeposito->vlMovimento;

            $array_movimentos[] = $movimento;
        }

        // vamos organizar as contas o array por ordem cronologica
        function cmp($a, $b) {
            return $a[0] > $b[0];
        }

        usort($array_movimentos, 'App\Http\Controllers\cmp');

        //vamos descobrir o capital maximo
        $array_extrato = array();
        $vlSaldo = $conta->vlContaInc;
        $capitalMaximo = $vlSaldo;
        $capitalMinimo = $vlSaldo;

        foreach($array_movimentos as $array){
            $extrato = array();
            $extrato[] = $array[1];
            $extrato[] = $array[2];
            $extrato[] = $array[3];
            $extrato[] = "$moeda ".valorDbForm($array[4]);
            $vlSaldo += $array[4];
            $extrato[] = "$moeda ".valorDbForm($vlSaldo);
            $extrato[] = $vlSaldo;
            if($vlSaldo > $capitalMaximo){
                $capitalMaximo = $vlSaldo;
            }

            if($vlSaldo < $capitalMinimo){
                $capitalMinimo = $vlSaldo;
            }

            $array_extrato[] = $extrato;
        }

        $drawndownCapIncAtual = $vlSaldo - $conta->vlContaInc;
        if($drawndownCapIncAtual > 0){
            $drawndownCapIncAtual = 0;
        }
        //$drawndownCapMaxAtual = $vlSaldo - $capitalMaximo;
        $drawndownCapMaxAtual = $capitalMinimo - $capitalMaximo;

        $dtIncExtrato = $request->get('dtIncExtrato');
        $controleInicio = true;

        $saldoAnterior = $moeda." ".valorDbForm($conta->vlContaInc);

        return view('acessoAluno/financeiro/extratoContaGerar',
            compact('array_extrato','conta','totalDepositos','totalSaques',
            'capitalMaximo','drawndownCapIncAtual','drawndownCapMaxAtual','moeda',
            'vlSaldo','dtIncExtrato','controleInicio','saldoAnterior'));
    }

    public function resumoGlobal(){
        $aluno = session()->get('aluno');

        if($aluno->moedaBase == "BRL"){
            $multiplicador = 'cotacaoBRL';
            $moeda = "R$";
        }
        elseif($aluno->moedaBase == "USD"){
            $multiplicador = 'cotacaoUSD';
            $moeda = "US$";
        }
        elseif($aluno->moedaBase == "EUR"){
            $multiplicador = 'cotacaoEUR';
            $moeda = "€";
        }
        elseif($aluno->moedaBase == "GBP"){
            $multiplicador = 'cotacaoGBP';
            $moeda = "£";
        }
        elseif($aluno->moedaBase == "JPY"){
            $multiplicador = 'cotacaoJPY';
            $moeda = "¥$";
        }

        $contas = Conta::where('id_aluno', $aluno->id)->get();

        $vlSaldoInicial = 0;
        $totalSaques = 0;
        $totalDepositos = 0;
        $array_movimentos = array();

        foreach($contas as $conta){
            //vamos verificar o saldo inicial na moeda base
            $multi = 1;
            if($conta->moeda != $aluno->moedaBase){
                $var = explode(' ', $conta->created_at);
                $data = $var[0];
                $resposta = $this->cotacaoMoeda($conta->moeda, $aluno->moedaBase, $data);
                $multi = $resposta[0]['bid'];
            }

            $vlSaldoInicial += $conta->vlContaInc * $multi;

            //vamos buscar todas as trades desta Conta
            $dados_trade = [
                'id_conta' => $conta->id,
                'stOperacao' => 'Closed',
            ];

            $trades = Trade::where($dados_trade)->orderBy('dtHrSaida')->get();

            foreach($trades as $trade) {
                $movimento = array();

                $var = explode(' ', $trade->dtHrSaida);
                $movimento[] = strtotime($trade->dtHrSaida);
                $movimento[] = dataDbForm($var[0]);
                $movimento[] = "Finalização da Trade ".$trade->idOperacao;
                if($trade->resPosicaoFinanceiro < 0){
                    $movimento[] = 'Débito';
                }
                else{
                    $movimento[] = 'Crédito';
                }
                $movimento[] = $trade->resPosicaoFinanceiro * $trade->$multiplicador;

                $array_movimentos[] = $movimento;
            }

            $saquesDepositos = ContaSaqueDeposito::where('id_conta', $conta->id)->get();

            foreach($saquesDepositos as $saqueDeposito){
                $movimento = array();

                $movimento[] = strtotime($saqueDeposito->dtMovimento);
                $movimento[] = dataDbForm($saqueDeposito->dtMovimento);
                $movimento[] = $saqueDeposito->tpMovimento;
                if($saqueDeposito->tpMovimento == "Saque"){
                    $movimento[] = "Débito";
                    $totalSaques += $saqueDeposito->vlMovimento * $multi;
                }
                else{
                    $movimento[] = "Crédito";
                    $totalDepositos += $saqueDeposito->vlMovimento * $multi;
                }
                $movimento[] = $saqueDeposito->vlMovimento * $multi;

                $array_movimentos[] = $movimento;
            }
        }

        // vamos organizar as contas o array por ordem cronologica
        function cmp($a, $b) {
            return $a[0] > $b[0];
        }

        usort($array_movimentos, 'App\Http\Controllers\cmp');

        //vamos descobrir o capital maximo
        $array_extrato = array();
        $vlSaldo = $vlSaldoInicial;
        $capitalMaximo = $vlSaldoInicial;

        foreach($array_movimentos as $array){
            $extrato = array();
            $extrato[] = $array[1];
            $extrato[] = $array[2];
            $extrato[] = $array[3];
            $extrato[] = "$moeda ".valorDbForm($array[4]);
            $vlSaldo += $array[4];
            $extrato[] = "$moeda ".valorDbForm($vlSaldo);
            $extrato[] = $vlSaldo;
            if($vlSaldo > $capitalMaximo){
                $capitalMaximo = $vlSaldo;
            }
            $array_extrato[] = $extrato;
        }

        $drawndownCapIncAtual = $vlSaldo - $vlSaldoInicial;
        if($drawndownCapIncAtual > 0){
            $drawndownCapIncAtual = 0;
        }
        $drawndownCapMaxAtual = $vlSaldo - $capitalMaximo;

        return view('acessoAluno/financeiro/extratoResumoGlobal',
            compact('array_extrato','totalDepositos','totalSaques',
            'capitalMaximo','drawndownCapIncAtual','drawndownCapMaxAtual','moeda',
            'vlSaldo','vlSaldoInicial'));
    }

    public function extratoContaGerarOld(Request $request){
        $aluno = session()->get('aluno');

        $conta = Conta::where('id', $request->get('id_conta'))->first();

        $dataControle = false;

        $controle = ContaSaqueDeposito::where('id_conta', $conta->id)->count();
        if($controle > 0){
            $movimentacao = ContaSaqueDeposito::where('id_conta', $conta->id)
            ->orderBy('dtMovimento')
            ->first();

            $dataControle =$movimentacao->dtMovimento;
        }

        $controle = Trade::where(['id_conta'=> $conta->id,'stOperacao'=>'Closed'])->count();
        if($controle > 0){
            $trade = Trade::where(['id_conta'=> $conta->id,'stOperacao'=>'Closed'])->orderBy('dtHrSaida')->first();
            if($dataControle){
                $var = explode(' ', $trade->dtHrSaida);
                $data = $var[0];
                if(strtotime($dataControle) > strtotime($data)){
                    $dataControle = $data;
                }
            }
        }

        $arrayDados = array();

        if($dataControle){
            while(strtotime($dataControle) <= strtotime(date('Y-m-d'))){

                $movimentos = ContaSaqueDeposito::where('id_conta', $conta->id)
                ->where('dtMovimento', $dataControle)
                ->get();

                foreach ($movimentos as $mov){
                    $array = array();
                    $array[] = $mov->dtMovimento;
                    $array[] = $mov->tpMovimento;
                    $array[] = $mov->vlMovimento;

                    $arrayDados[] = $array;
                }

                $trades = Trade::where('id_conta', $conta->id)
                ->where('stOperacao', 'Closed')
                ->where('dtHrSaida','>=',$dataControle." 00:00:00")
                ->where('dtHrSaida','<=',$dataControle." 23:59:59")
                ->orderBy('dtHrSaida')
                ->get();

                foreach ($trades as $trade){
                    $var = explode(' ', $trade->dtHrSaida);
                    $array = array();
                    $array[] = $var[0];
                    $array[] = 'Retorno Aplicação trade '.$trade->idOperacao;
                    $array[] = $trade->resPosicaoFinanceiro;

                    $arrayDados[] = $array;
                }
                $dataControle = date('Y-m-d', strtotime("+1 day", strtotime($dataControle)));
            }
        }

        return view('acessoAluno/financeiro/extratoContaGerar', compact('arrayDados', 'conta'));
    }

    public function cotacaoMoeda($moeda1, $moeda2, $data){
        $data = str_replace('-','', $data);

        $endPoint = "https://economia.awesomeapi.com.br/json/daily/".$moeda1."-".$moeda2."/?start_date=".$data."&end_date=".$data;

        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $endPoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ]);

        $resposta = curl_exec($curl);

        curl_close($curl);
        $resposta = json_decode($resposta, true);
        return $resposta;
    }

}
