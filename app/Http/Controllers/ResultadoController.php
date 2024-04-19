<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Models\Corretora;
use App\Models\Conta;
use App\Models\Ativo;
use App\Models\Trade;
use App\Models\Aluno;

class ResultadoController extends Controller
{
    public function index(Request $request){
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
        //$tags = Tag::all()->sortBy('nmTag');
        $corretoras = Corretora::all()->sortBy('nome');
        $ativos = Ativo::all()->sortBy('nome');

        $trades = Trade::listaResultadosUsers($user);

        $stringCorretoras = '';
        $explode = explode(',', $user->filtroCorretora);
        if($explode[0] != null){
            foreach($explode as $id_corretora) {
                $corretora = Corretora::where('id', $id_corretora)->first();
                $stringCorretoras .= ",".$corretora->nome;
            }
            $stringCorretoras = substr($stringCorretoras, 1);
        }

        $stringAtivos = '';
        if($explode[0] != null){
            $explode = explode(',', $user->filtroAtivo);
            foreach($explode as $id_ativo) {
                $ativo = Ativo::where('id', $id_ativo)->first();
                $stringAtivos .= ",".$ativo->nome;
            }
            $stringAtivos = substr($stringAtivos, 1);
        }

        return view('resultados/index', compact('tags','corretoras','ativos',
        'stringCorretoras','stringAtivos','trades','alunos'));
    }

    public function onePageReport(Request $request, $trades = NULL, $controleRetorno = null){
        if($controleRetorno == null){
            $controleRetorno = 'view';
            $trades = $request->get('trades');
        }

        $trades = substr($trades, 1);

        $trades = explode(',', $trades);

        $user = auth()->user();

        $multiplicador = "";
        $moeda = "";
        if($user->moedaBase == "BRL"){
            $multiplicador = 'cotacaoBRL';
            $moeda = "R$";
        }
        elseif($user->moedaBase == "USD"){
            $multiplicador = 'cotacaoUSD';
            $moeda = "US$";
        }
        elseif($user->moedaBase == "EUR"){
            $multiplicador = 'cotacaoEUR';
            $moeda = "€";
        }
        elseif($user->moedaBase == "GBP"){
            $multiplicador = 'cotacaoGBP';
            $moeda = "£";
        }
        elseif($user->moedaBase == "JPY"){
            $multiplicador = 'cotacaoJPY';
            $moeda = "¥$";
        }

        $somaPontosPosicao = 0;
        $somaPontosContrato = 0;
        $somaDinheiroPosicao = 0;
        $somaDinheiroContrato = 0;

        $somaPontosPosicaoGain = 0;
        $somaPontosContratoGain = 0;
        $somaDinheiroPosicaoGain = 0;
        $somaDinheiroContratoGain = 0;

        $somaPontosPosicaoLoss = 0;
        $somaPontosContratoLoss = 0;
        $somaDinheiroPosicaoLoss = 0;
        $somaDinheiroContratoLoss = 0;

        $qtGain = 0;
        $qtLoss = 0;
        $qtEmpate = 0;

        $tempoOperacoes = 0;
        $tempoGain = 0;
        $tempoLoss = 0;
        $tempoEmpate = 0;

        $maiorOperacaoGain = ['0',0]; //primeiro e o identificador e o segundo o valor

        $maiorOperacaoLoss = ['0',0]; //primeiro e o identificador e o segundo o valor

        $controleSequencia = "";
        $maiorSequenciaGain = 0;
        $maiorSequenciaLoss = 0;
        $qtSequenciaGain = 0;
        $qtSequenciaLoss = 0;
        $netProfitGrossLoss = 0;

        $despesas = 0;

        $somaVariacaoPreco = 0;
        $somaVariacaoPrecoGain = 0;
        $somaVariacaoPrecoLoss = 0;
        $somaVariacaoPrecoEmpate = 0;

        $i = 0;

        if(count($trades) > 0 && $trades[0] != ""){
            foreach ($trades as $id_trade){
                $i++;
                $trade = Trade::where('id', $id_trade)->first();

                //vamos analizar a sequencia de gain ou loss
                if($trade->gainOrLoss == "Gain"){
                    if($controleSequencia == "Gain"){
                        $qtSequenciaGain++;
                    }
                    else{
                        $qtSequenciaGain = 1;
                    }
                }
                elseif($trade->gainOrLoss == "Loss"){
                    if($controleSequencia == "Loss"){
                        $qtSequenciaLoss++;
                    }
                    else{
                        $qtSequenciaLoss = 1;
                    }
                }

                $controleSequencia = $trade->gainOrLoss;

                $maiorSequenciaGain = $qtSequenciaGain > $maiorSequenciaGain ? $qtSequenciaGain : $maiorSequenciaGain;
                $maiorSequenciaLoss = $qtSequenciaLoss > $maiorSequenciaLoss ? $qtSequenciaLoss : $maiorSequenciaLoss;


                $var = strtotime($trade->dtHrSaida) - strtotime($trade->dtHrEntrada);
                $tempoOperacoes += $var;
                $resPosicaoFinanceiriMB = $trade->resPosicaoFinanceiro * $trade->$multiplicador;
                $custoEntradaMB = $trade->custoEntrada * $trade->$multiplicador;
                $custoSaidaMB = $trade->custoSaida * $trade->$multiplicador;

                $netProfitGrossLoss += $resPosicaoFinanceiriMB;

                $despesas += $custoEntradaMB + $custoSaidaMB;

                if($trade->gainOrLoss == "Gain"){
                    $qtGain++;
                    $tempoGain += $var;
                    $somaPontosPosicaoGain += $trade->resPosicaoPontos;
                    $somaPontosContratoGain += $trade->resContratoPontos;
                    $somaDinheiroPosicaoGain += ($trade->resPosicaoFinanceiro * $trade->$multiplicador);
                    $somaDinheiroContratoGain += ($trade->resContratoFinanceiro * $trade->$multiplicador);

                    //vamos verificar a maiorOperacaoGain
                    if($resPosicaoFinanceiriMB > $maiorOperacaoGain[1]){
                        $maiorOperacaoGain[0] = $trade->idOperacao;
                        $maiorOperacaoGain[1] = $resPosicaoFinanceiriMB;
                    }

                    $somaVariacaoPrecoGain += $trade->variacaoEntradaSaida;

                }
                elseif($trade->gainOrLoss == "Loss"){
                    $qtLoss++;
                    $tempoLoss += $var;
                    $somaPontosPosicaoLoss += $trade->resPosicaoPontos;
                    $somaPontosContratoLoss += $trade->resContratoPontos;
                    $somaDinheiroPosicaoLoss += ($trade->resPosicaoFinanceiro * $trade->$multiplicador);
                    $somaDinheiroContratoLoss += ($trade->resContratoFinanceiro * $trade->$multiplicador);

                    //vamos verificar a maiorOperacaoLoss
                    if(abs($resPosicaoFinanceiriMB) > abs($maiorOperacaoLoss[1])){
                        $maiorOperacaoLoss[0] = $trade->idOperacao;
                        $maiorOperacaoLoss[1] = abs($resPosicaoFinanceiriMB);
                    }

                    $somaVariacaoPrecoLoss += $trade->variacaoEntradaSaida;
                }
                elseif($trade->gainOrLoss == "0 x 0"){
                    $qtEmpate++;
                    $tempoEmpate += $var;

                    $somaVariacaoPrecoEmpate += $trade->variacaoEntradaSaida;
                }

                $somaPontosPosicao += $trade->resPosicaoPontos;
                $somaPontosContrato += $trade->resContratoPontos;
                $somaDinheiroPosicao += ($trade->resPosicaoFinanceiro * $trade->$multiplicador);
                $somaDinheiroContrato += ($trade->resContratoFinanceiro * $trade->$multiplicador);

                $somaVariacaoPreco += $trade->variacaoEntradaSaida;

                //echo "<pre>";
                //print_r($trade);
                //echo "</pre>";
                //echo $somaDinheiroPosicaoGain."<br>";
                //echo $somaDinheiroPosicaoLoss."<br>";
            }
        }

        //dd($somaDinheiroPosicaoGain, $somaDinheiroPosicaoLoss);

        $resultado['somaPontosPosicao'] = round($somaPontosPosicao,2);
        $resultado['somaPontosContrato'] = round($somaPontosContrato,2);
        $resultado['somaDinheiroPosicao'] = $somaDinheiroPosicao;
        $resultado['somaDinheiroContrato'] = $somaDinheiroContrato;

        $resultado['mediaPontosPosicao'] = $i > 0 ? round($somaPontosPosicao / $i,2) : null;
        $resultado['mediaPontosContrato'] = $i > 0 ? round($somaPontosContrato / $i,2) : null;
        $resultado['mediaDinheiroPosicao'] = $i > 0 ? $somaDinheiroPosicao / $i : null;
        $resultado['mediaDinheiroContrato'] = $i > 0 ? $somaDinheiroContrato / $i : null;

        $resultado['somaPontosPosicaoGain'] = round($somaPontosPosicaoGain,2);
        $resultado['somaPontosContratoGain'] = round($somaPontosContratoGain,2);
        $resultado['somaDinheiroPosicaoGain'] = $somaDinheiroPosicaoGain;
        $resultado['somaDinheiroContratoGain'] = $somaDinheiroContratoGain;

        $resultado['somaPontosPosicaoLoss'] = round($somaPontosPosicaoLoss,2);
        $resultado['somaPontosContratoLoss'] = round($somaPontosContratoLoss,2);
        $resultado['somaDinheiroPosicaoLoss'] = $somaDinheiroPosicaoLoss;
        $resultado['somaDinheiroContratoLoss'] = $somaDinheiroContratoLoss;

        if($qtGain > 0){
            $resultado['mediaPontosPosicaoGain'] = round($somaPontosPosicaoGain / $qtGain,2);
            $resultado['mediaPontosContratoGain'] = round($somaPontosContratoGain / $qtGain,2);
            $resultado['mediaDinheiroPosicaoGain'] = $somaDinheiroPosicaoGain / $qtGain;
            $resultado['mediaDinheiroContratoGain'] = $somaDinheiroContratoGain / $qtGain;
        }
        else{
            $resultado['mediaPontosPosicaoGain'] = 0;
            $resultado['mediaPontosContratoGain'] = 0;
            $resultado['mediaDinheiroPosicaoGain'] = 0;
            $resultado['mediaDinheiroContratoGain'] = 0;
        }

        if($qtLoss > 0){
            $resultado['mediaPontosPosicaoLoss'] = round($somaPontosPosicaoLoss / $qtLoss,2);
            $resultado['mediaPontosContratoLoss'] = round($somaPontosContratoLoss / $qtLoss,2);
            $resultado['mediaDinheiroPosicaoLoss'] = $somaDinheiroPosicaoLoss / $qtLoss;
            $resultado['mediaDinheiroContratoLoss'] = $somaDinheiroContratoLoss / $qtLoss;
        }
        else{
            $resultado['mediaPontosPosicaoLoss'] = 0;
            $resultado['mediaPontosContratoLoss'] = 0;
            $resultado['mediaDinheiroPosicaoLoss'] = 0;
            $resultado['mediaDinheiroContratoLoss'] = 0;
        }


        $resultado['qtGain'] = $qtGain;
        $resultado['qtLoss'] = $qtLoss;
        $resultado['qtEmpate'] = $qtEmpate;

        $resultado['tempoOperacoes'] = calculaTempoTotal($tempoOperacoes) != "" ? calculaTempoTotal($tempoOperacoes) : "Sem Tempo";
        $resultado['tempoGain'] = calculaTempoTotal($tempoGain) != "" ? calculaTempoTotal($tempoGain) : "Sem Tempo";
        $resultado['tempoLoss'] = calculaTempoTotal($tempoLoss) != "" ? calculaTempoTotal($tempoLoss) : "Sem Tempo";
        $resultado['tempoEmpate'] = calculaTempoTotal($tempoEmpate) != "" ? calculaTempoTotal($tempoEmpate) : "Sem Tempo";

        $resultado['tempoMedioOperacoes'] = $i > 0 && calculaTempoTotal($tempoOperacoes / $i) != "" ? calculaTempoTotal($tempoOperacoes / $i) : "Sem Tempo";


        $resultado['tempoMedioGain'] = $qtGain > 0 ? calculaTempoTotal($tempoGain / $qtGain) : "Sem Tempo";
        $resultado['tempoMedioLoss'] = $qtLoss > 0 ? calculaTempoTotal($tempoLoss / $qtLoss) : "Sem Tempo";
        $resultado['tempoMedioEmpate'] = $qtEmpate > 0 ? calculaTempoTotal($tempoEmpate / $qtEmpate) : "Sem Tempo";

        $resultado['maiorOperacaoGain'] = $maiorOperacaoGain[0];
        $resultado['maiorOperacaoLoss'] = $maiorOperacaoLoss[0];

        $resultado['valorMaiorOperacaoGain'] = $maiorOperacaoGain[1];
        $resultado['valorMaiorOperacaoLoss'] = $maiorOperacaoLoss[1];

        $resultado['maiorSequenciaGain'] = $maiorSequenciaGain;
        $resultado['maiorSequenciaLoss'] = $maiorSequenciaLoss;
        $resultado['despesas'] = $despesas;
        $resultado['netProfitGrossLoss'] = $netProfitGrossLoss;

        if($somaDinheiroPosicaoGain > 0 && $somaDinheiroPosicaoLoss == 0){
            $resultado['risk_reward_1'] = "0";
            $resultado['risk_reward_2'] = 'Ganho Max';
        }
        elseif($somaDinheiroPosicaoGain == 0 && abs($somaDinheiroPosicaoLoss) > 0){
            $resultado['risk_reward_1'] = "Perda Max";
            $resultado['risk_reward_2'] = '0';
        }
        else{
            if($somaDinheiroPosicaoGain == 0 && $somaPontosPosicaoLoss == 0){
                $resultado['risk_reward_1'] = "1";
                $resultado['risk_reward_2'] = "1";
            }
            elseif(abs($somaDinheiroPosicaoLoss) > $somaDinheiroPosicaoGain){
                $resultado['risk_reward_1'] = round(abs($somaDinheiroPosicaoLoss) / $somaDinheiroPosicaoGain, 2);
                $resultado['risk_reward_2'] = '1';
            }
            else{
                $resultado['risk_reward_1'] = "1";
                $resultado['risk_reward_2'] = round(abs($somaDinheiroPosicaoGain / $somaDinheiroPosicaoLoss), 2);
            }
        }

        if($qtGain == 0){
            $resultado['txAcertos'] = '0';
        }
        else{
            $resultado['txAcertos'] = round($qtGain / ($qtGain + $qtLoss) * 100, 2);
        }

        $resultado['somaVariacaoPreco'] = $somaVariacaoPreco;
        $resultado['mediaVariacaoPreco'] = $i > 0 ? round($somaVariacaoPreco / $i, 2) : null;
        $resultado['somaVariacaoPrecoGain'] = $somaVariacaoPrecoGain;
        $resultado['somaVariacaoPrecoLoss'] = $somaVariacaoPrecoLoss;
        $resultado['somaVariacaoPrecoEmpate'] = $somaVariacaoPrecoEmpate;
        if($qtGain > 0){
            $resultado['mediaVariacaoPrecoGain'] = round($somaVariacaoPrecoGain / $qtGain, 2);
        }
        else{
            $resultado['mediaVariacaoPrecoGain'] = 0;
        }

        if($qtLoss > 0){
            $resultado['mediaVariacaoPrecoLoss'] = round($somaVariacaoPrecoLoss / $qtLoss, 2);
        }
        else{
            $resultado['mediaVariacaoPrecoLoss'] = 0;
        }

        if($qtEmpate > 0){
            $resultado['mediaVariacaoPrecoEmpate'] = round($somaVariacaoPrecoEmpate / $qtEmpate, 2);
        }
        else{
            $resultado['mediaVariacaoPrecoEmpate'] = 0;
        }

        $qtOperacoes = $i;

        $resultado['qtOperacoes'] = $qtOperacoes;
        $resultado['moeda'] = $moeda;

        $stringCorretoras = '';
        $explode = explode(',', $user->filtroCorretora);
        if($explode[0] != null){
            foreach($explode as $id_corretora) {
                $corretora = Corretora::where('id', $id_corretora)->first();
                $stringCorretoras .= ",".$corretora->nome;
            }
            $stringCorretoras = substr($stringCorretoras, 1);
        }

        $stringAtivos = '';
        if($explode[0] != null){
            $explode = explode(',', $user->filtroAtivo);
            foreach($explode as $id_ativo) {
                $ativo = Ativo::where('id', $id_ativo)->first();
                $stringAtivos .= ",".$ativo->nome;
            }
            $stringAtivos = substr($stringAtivos, 1);
        }

        if($controleRetorno == "view"){
            return view('resultados/onePageReport', compact('resultado','moeda','qtOperacoes','user','stringCorretoras','stringAtivos'));
        }
        else{
            return $resultado;
        }
    }

    public function exportarListaTrades(Request $request){
        $user = auth()->user();

        if($user->moedaBase == "BRL"){
            $multiplicador = 'cotacaoBRL';
            $moeda = "R$";
        }
        elseif($user->moedaBase == "USD"){
            $multiplicador = 'cotacaoUSD';
            $moeda = "US$";
        }
        elseif($user->moedaBase == "EUR"){
            $multiplicador = 'cotacaoEUR';
            $moeda = "€";
        }
        elseif($user->moedaBase == "GBP"){
            $multiplicador = 'cotacaoGBP';
            $moeda = "£";
        }
        elseif($user->moedaBase == "JPY"){
            $multiplicador = 'cotacaoJPY';
            $moeda = "¥$";
        }

        $var = substr($request->get('trades'),1);
        $trades = explode(',', $var);

        $totalMbCustoEntrada = 0;
        $totalMbCustoSaida = 0;
        $totalMbResultadoContrato = 0;
        $totalMbResultadoPosicao = 0;

        $table = "
        <table>
            <thead>
                <tr>
                    <th>Aluno</td>
                    <th>Numero</td>
                    <th>Entrada</td>
                    <th>Saida</td>
                    <th>Tempo</td>
                    <th>Status</td>
                    <th>Tipo</td>
                    <th>Pais</td>
                    <th>Corretora</td>
                    <th>Tipo Conta</td>
                    <th>Conta</td>
                    <th>Ativo</td>
                    <th>Tipo Ativo</td>
                    <th>Operação</td>
                    <th>Direção</td>
                    <th>Fase</td>
                    <th>QT Contratos</td>
                    <th>Moeda</td>
                    <th>Valor Ponto por Contrato</td>
                    <th>Tipo Custo</td>
                    <th>Custo Entrada por Contrato</td>
                    <th>Custo Saída por Contrato</td>
                    <th>Preço Entrada</td>
                    <th>Custo Entrada</td>
                    <th>Preço Saída</td>
                    <th>Custo Saída</td>
                    <th>Resultado Posição Pontos</td>
                    <th>Resultado Posição Financeiro</td>
                    <th>Resultado Contrato Pontos</td>
                    <th>Resultado Contrato Financeiro</td>
                    <th>Variação Entrada Saída</td>
                    <th>Gain or Loss</td>
                    <th>Motivos Entrada</td>
                    <th>Motivos Saída</td>
                    <th>Moeda Base Custo Entrada</td>
                    <th>Moeda Base Custo Saída</td>
                    <th>Moeda Base Resultado Contrato</td>
                    <th>Moeda Base Resultado Posição</td>
                </tr>
            </thead>
            <tbody>";
            foreach ($trades as $id){
                //$trade = Trade::where('id', $id)->first();
                $trade = Trade::listaResultadosTrade($id);
                $trade = $trade[0];

                //dd($trade->valorPontoContrato);

                $var = explode(' ',$trade->dtHrEntrada);
                $entrada = dataDbForm($var[0])." ".$var[1];

                $var = explode(' ',$trade->dtHrSaida);
                $saida = dataDbForm($var[0])." ".$var[1];

                $mbCustoEntrada = round($trade->custoEntrada * $trade->$multiplicador,2);
                $mbCustoSaida = round($trade->custoSaida * $trade->$multiplicador,2);
                $mbResultadoContrato = round($trade->resContratoFinanceiro * $trade->$multiplicador,2);
                $mbResultadoPosicao = round($trade->resPosicaoFinanceiro * $trade->$multiplicador,2);

                $totalMbCustoEntrada += $mbCustoEntrada;
                $totalMbCustoSaida += $mbCustoSaida;
                $totalMbResultadoContrato += $mbResultadoContrato;
                $totalMbResultadoPosicao += $mbResultadoPosicao;

                if($trade->moeda == "BRL"){
                    $moedaTrade = "R$";
                }
                elseif($trade->moeda == "USD"){
                    $moedaTrade = "US$";
                }
                elseif($trade->moeda == "EUR"){
                    $moedaTrade = "€";
                }
                elseif($trade->moeda == "GBP"){
                    $moedaTrade = "£";
                }
                elseif($trade->moeda == "JPY"){
                    $moedaTrade = "¥$";
                }

                if($trade->gainOrLoss == 'Gain'){
                    $color = 'green';
                }
                elseif($trade->gainOrLoss == 'Loss'){
                    $color = 'red';
                }
                elseif($trade->gainOrLoss == '0 x 0'){
                    $color = '#b8b814';
                }
                else{
                    $color = '';
                }

                $table .= "
                <tr>
                    <td style='color: $color'>$trade->nmAluno</td>
                    <td style='color: $color'>$trade->idOperacao</td>
                    <td style='color: $color'>$entrada</td>
                    <td style='color: $color'>$saida</td>
                    <td style='color: $color'>$trade->tempoOperacao</td>
                    <td style='color: $color'>$trade->stOperacao</td>
                    <td style='color: $color'>$trade->tipoOperacao</td>
                    <td style='color: $color'>$trade->pais</td>
                    <td style='color: $color'>$trade->nmCorretora</td>
                    <td style='color: $color'>$trade->tipoConta</td>
                    <td style='color: $color'>$trade->nmConta</td>
                    <td style='color: $color'>$trade->nmAtivo</td>
                    <td style='color: $color'>$trade->tipoAtivo</td>
                    <td style='color: $color'>$trade->operacao</td>
                    <td style='color: $color'>$trade->direcao</td>
                    <td style='color: $color'>$trade->fase</td>
                    <td style='color: $color'>$trade->quantidadeContratos</td>
                    <td style='color: $color'>$trade->moeda</td>
                    <td style='color: $color'>".$moedaTrade." ".valorDbForm($trade->valorPontoContrato)."</td>
                    <td style='color: $color'>$trade->tipoCusto</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->custoOperacaoEntrada)."</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->custoOperacaoSaida)."</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->precoEntrada)."</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->custoEntrada)."</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->precoSaida)."</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->custoSaida)."</td>
                    <td style='color: $color'>$trade->resPosicaoPontos</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->resPosicaoFinanceiro)."</td>
                    <td style='color: $color'>$trade->resContratoPontos</td>
                    <td style='color: $color'>$moedaTrade ".valorDbForm($trade->resContratoFinanceiro)."</td>
                    <td style='color: $color'>$trade->variacaoEntradaSaida</td>
                    <td style='color: $color'>$trade->gainOrLoss</td>
                    <td style='color: $color'>$trade->motivosEntrada</td>
                    <td style='color: $color'>$trade->motivosSaida</td>
                    <td style='color: $color'>$moeda ".valorDbForm($mbCustoEntrada)."</td>
                    <td style='color: $color'>$moeda ".valorDbForm($mbCustoSaida)."</td>
                    <td style='color: $color'>$moeda ".valorDbForm($totalMbResultadoContrato)."</td>
                    <td style='color: $color'>$moeda ".valorDbForm($totalMbResultadoPosicao)."</td>
                </tr>
                ";
            }
            $table .= "
            </tbody>
            <tfoot>
                <tr>
                    <td colspan='34'><b>TOTAL</b></td>
                    <td><b>$moeda ".valorDbForm($totalMbCustoEntrada)."</b></td>
                    <td><b>$moeda ".valorDbForm($totalMbCustoSaida)."</b></td>
                    <td><b>$moeda ".valorDbForm($totalMbResultadoContrato)."</b></td>
                    <td><b>$moeda ".valorDbForm($totalMbResultadoPosicao)."</b></td>
                </tr>
            </tfoot>
        </table>
        ";

        $arquivo = date('Y-m-d H:i:s')."_ListaDeTrades.xls";
        // Configurações header para forçar o download
        header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
        header ("Cache-Control: no-cache, must-revalidate");
        header ("Pragma: no-cache");
        header ("Content-type: application/x-msexcel");
        header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
        header ("Content-Description: PHP Generated Data" );
        // Envia o conteúdo do arquivo
        echo "
        <!doctype html>
        <html lang='en'>
            <head>
                <meta charset='utf-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
                <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css' integrity='sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm' crossorigin='anonymous'>

                <title>Excel</title>
            </head>
            <body>
                <div class='container-fluid'>
                    $table
                </div>
            </body>
        </html>";
        exit();
    }

}
