<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trade;
use App\Models\Conta;
use App\Models\Ativo;
use App\Models\AtivoCorretora;
use App\Models\AtivoFavoritoAluno;
use App\Models\Aluno;
use App\Models\Corretora;
use App\Http\Controllers\ResultadoAlunoController;
use App\Http\Controllers\FiltroAlunoController;

class TradeAlunoController extends Controller
{
    public function index(Request $request){
        $aluno = session()->get('aluno');

        $filtro = new FiltroAlunoController();
        $filtroHtml = $filtro->geraFiltroAluno('aluno.trades');

        $trades = Trade::listaTradesAlunoTrades($aluno);

        $contas = Conta::where('id_aluno', $aluno->id)->orderBy('nrConta')->get();
        $corretoras = Corretora::all()->sortBy('nome');
        $ativos = Ativo::all()->sortBy('nome');

        return view('acessoAluno/trades/index', compact('aluno','trades','contas',
        'corretoras','ativos','filtroHtml'));
    }

    public function filtroTempo($tempo){
        $filtro = new FiltroAlunoController();
        return $filtro->filtrarTempo($tempo, 'aluno.trades');
    }

    public function buscaAtivosCorretora(){
        $aluno = session()->get('aluno');

        $conta = Conta::where('id', $_GET['id_conta'])->first();

        $ativos = AtivoCorretora::where('id_corretora', $conta->id_corretora)->get();

        $ativos_fav = AtivoFavoritoAluno::where('aluno_id', $aluno->id)->orderBy('nmAtivoFav')->get();

        $array_ativos = array();

        $favoritos = array();

        foreach($ativos_fav as $linha){
            $array_ativos[] = $linha->ativo_id;
            $favoritos[] = $linha->ativo_id;
        }

        foreach($ativos as $linha){
            if(array_search($linha->id_ativo, $favoritos) === false){
                array_push($array_ativos, $linha->id_ativo);
            }
        }

        $html = "<option value=''>Opções</option>";

        foreach ($array_ativos as $linha){
            $ativo = Ativo::where('id', $linha)->first();
            if($ativo && $ativo->stAtivo == "Ativo"){
                $html .= "<option value='".$ativo->id."'>".$ativo->simbolo." - ".$ativo->nome." - Moeda: ".$ativo->moedaAtivo." - Tipo de Custo: ".$ativo->tipoCusto."</option>";
            }
        }

        $retorno['html'] = $html;
        echo json_encode($retorno);
    }

    public function buscaValorContratoAtivo(){
        $ativo = Ativo::where('id', $_GET['ativo_id'])->first();

        $retorno['valor'] = $ativo->valor;
        $retorno['contrato'] = $ativo->tamanhoContrato;

        $retorno['controle_valor'] = 'true';
        $retorno['controle_contrato'] = 'true';

        //caso 1 se o contrato for preenchido e o valor for zero ou null
        if(($ativo->valor == null OR $ativo->valor == 0) && $ativo->tamanhoContrato != null && $ativo->tamanhoContrato != 'Variável'){
            $retorno['controle_valor_contrato'] = 'caso1';
        }
        //caso 2 se o tamanho do contrato for variavel e o valor fixo
        elseif(($ativo->tamanhoContrato == null OR $ativo->tamanhoContrato == 'Variável') && $ativo->valor != null && $ativo->valor != 0){
            $retorno['controle_valor_contrato'] = 'caso2';
        }
        //caso 3 Estados unidos valor fixo e contrato com numero inteiro
        elseif($ativo->tamanhoContrato != null && $ativo->tamanhoContrato != 'Variável' && $ativo->valor != null && $ativo->valor != 0){
            $retorno['controle_valor_contrato'] = 'caso3';
        }

        echo json_encode($retorno);
    }

    public function insert(Request $request){
        $aluno = session()->get('aluno');

        $dados = $request->all();
        $dados['id_aluno'] = $aluno->id;

        $conta = Conta::where('id', $request->get('id_conta'))->first();
        $ativo = Ativo::where('id', $request->get('id_ativo'))->first();

        if(strpos($dados['quantidadeContratos'], ',')){
            $dados['quantidadeContratos'] = str_replace(',','.',$dados['quantidadeContratos']);
        }

        if(strpos($dados['valorPontoContrato'], ',')){
            $dados['valorPontoContrato'] = str_replace(',','.',$dados['valorPontoContrato']);
        }

        if(strpos($dados['custoOperacaoEntrada'], ',')){
            $dados['custoOperacaoEntrada'] = str_replace(',','.',$dados['custoOperacaoEntrada']);
        }

        if(strpos($dados['custoOperacaoSaida'], ',')){
            $dados['custoOperacaoSaida'] = str_replace(',','.',$dados['custoOperacaoSaida']);
        }

        if(strpos($dados['precoEntrada'], ',')){
            $dados['precoEntrada'] = str_replace(',','.',$dados['precoEntrada']);
        }

        if(strpos($dados['precoSaida'], ',')){
            $dados['precoSaida'] = str_replace(',','.',$dados['precoSaida']);
        }

        $dados['idOperacao'] = Trade::getProximoIdOaoAluno($aluno->id);
        $dados['pais'] = $ativo != NULL ? $ativo->pais : "";
        $dados['id_corretora'] = $conta != NULL ? $conta->id_corretora : NULL;
        $dados['tipoAtivo'] = $ativo != NULL ? $ativo->tipoAtivo : "";
        $dados['moeda'] = $ativo != NULL ? $ativo->moedaAtivo : "";
        $dados['tipoConta'] = $conta != NULL ? $conta->tpConta : "";
        $dados['tipoCusto'] = $ativo != NULL ? $ativo->tipoCusto : "";

        if($request->get('dtEntrada') != "" && $request->get('hrEntrada') != ""){
            $dados['dtHrEntrada'] = $request->get('dtEntrada')." ".$request->get('hrEntrada');
        }
        else{
            $dados['dtHrEntrada'] = NULL;
        }

        if($request->get('dtSaida') != "" && $request->get('hrSaida') != ""){
            $dados['dtHrSaida'] = $request->get('dtSaida')." ".$request->get('hrSaida');
        }
        else{
            $dados['dtHrSaida'] = NULL;
        }


        if($dados['dtHrEntrada'] && $dados['dtHrSaida'] && $dados['tipoOperacao'] && $request->get('id_conta') && $dados['tipoConta'] && $dados['id_ativo'] && $dados['operacao'] && $dados['direcao'] && $dados['fase'] && $dados['quantidadeContratos'] &&  $dados['valorPontoContrato'] && $dados['tipoCusto'] && $dados['custoOperacaoEntrada'] && $dados['custoOperacaoSaida'] && $dados['precoEntrada'] && $dados['precoSaida']){
          $dados['stOperacao'] = "Closed";
          $dados['tempoOperacao'] = NULL;
        }
        else{
          $dados['stOperacao'] = "Open";
          $dados['tempoOperacao'] = NULL;
        }

        /*
        //vamos buscar o saldo do momento da conta

        $vlResTradesConta = Trade::buscaResTradesContasData($conta->id, $request->get('dtEntrada'));

        */

        $trade = Trade::create($dados);

        $this->calculaTrade($request, $trade->id);

        //$resultado = new ResultadoAlunoController();
        //return $resultado->limparFiltros('trades');

        return redirect()->route('aluno.trades')->with('mensagem', 'Trade Salva');
    }

    public function update(Request $request){
        $id = $request->get('id_trade');
        $aluno = session()->get('aluno');

        $dados = $request->except('id_trade','_token','dtEntrada','hrEntrada','dtSaida','hrSaida');

        $conta = Conta::where('id', $request->get('id_conta'))->first();
        $ativo = Ativo::where('id', $request->get('id_ativo'))->first();

        if(strpos($dados['quantidadeContratos'], ',')){
            $dados['quantidadeContratos'] = str_replace(',','.',$dados['quantidadeContratos']);
        }

        if(strpos($dados['valorPontoContrato'], ',')){
            $dados['valorPontoContrato'] = str_replace(',','.',$dados['valorPontoContrato']);
        }

        if(strpos($dados['custoOperacaoEntrada'], ',')){
            $dados['custoOperacaoEntrada'] = str_replace(',','.',$dados['custoOperacaoEntrada']);
        }

        if(strpos($dados['custoOperacaoSaida'], ',')){
            $dados['custoOperacaoSaida'] = str_replace(',','.',$dados['custoOperacaoSaida']);
        }

        if(strpos($dados['precoEntrada'], ',')){
            $dados['precoEntrada'] = str_replace(',','.',$dados['precoEntrada']);
        }

        if(strpos($dados['precoSaida'], ',')){
            $dados['precoSaida'] = str_replace(',','.',$dados['precoSaida']);
        }

        $dados['pais'] = $ativo != NULL ? $ativo->pais : "";
        $dados['id_corretora'] = $conta != NULL ? $conta->id_corretora : NULL;
        $dados['tipoAtivo'] = $ativo != NULL ? $ativo->tipoAtivo : "";
        $dados['moeda'] = $ativo != NULL ? $ativo->moedaAtivo : "";
        $dados['tipoConta'] = $conta != NULL ? $conta->tpConta : "";
        $dados['tipoCusto'] = $ativo != NULL ? $ativo->tipoCusto : "";



        if($request->get('dtEntrada') != "" && $request->get('hrEntrada') != ""){
            $dados['dtHrEntrada'] = $request->get('dtEntrada')." ".$request->get('hrEntrada');
        }
        else{
            $dados['dtHrEntrada'] = NULL;
        }

        if($request->get('dtSaida') != "" && $request->get('hrSaida') != ""){
            $dados['dtHrSaida'] = $request->get('dtSaida')." ".$request->get('hrSaida');
        }
        else{
            $dados['dtHrSaida'] = NULL;
        }

        if($dados['dtHrEntrada'] && $dados['dtHrSaida'] && $dados['tipoOperacao'] && $request->get('id_conta') && $dados['tipoConta'] && $dados['id_ativo'] && $dados['operacao'] && $dados['direcao'] && $dados['fase'] && $dados['quantidadeContratos'] && $dados['valorPontoContrato'] && $dados['tipoCusto'] && $dados['custoOperacaoEntrada'] && $dados['custoOperacaoSaida'] && $dados['precoEntrada'] && $dados['precoSaida']){
          $dados['stOperacao'] = "Closed";
          $dados['tempoOperacao'] = NULL;
        }
        else{
          $dados['stOperacao'] = "Open";
          $dados['tempoOperacao'] = NULL;
        }

        Trade::where('id', $id)->update($dados);

        $this->calculaTrade($request, $id);

        return redirect()->route('aluno.trades')->with('mensagem', 'Trade Salva');

    }

    public function calculaTrade(Request $request, $id_trade){
        //variavel que controla a quantidade de casas decimais
        $decimais = 5;
        $trade = Trade::where('id', $id_trade)->first();

        $aluno = Aluno::where('id', $trade->id_aluno)->first();

        if($trade->stOperacao != "Closed"){
            return false;
        }

        if(strtotime($trade->dtHrEntrada) >= strtotime($trade->dtHrSaida)){
            $trade->stOperacao = 'Open';
            $trade->dtHrSaida = null;
            $trade->save();

            return false;
        }

        $trade->tempoOperacao = calculaTempoOperacao($trade->dtHrEntrada, $trade->dtHrSaida);
        $data = explode(' ', $trade->dtHrSaida);

        //vamos cotar as moedas
        if($trade->moeda != "BRL"){
            $resposta = $this->cotacaoMoeda($trade->moeda, 'BRL', $data[0]);
            if(isset($resposta[0]['bid'])){
                $trade->cotacaoBRL = $resposta[0]['bid'];
            }
        }
        else{
            $trade->cotacaoBRL = 1;
        }

        if($trade->moeda != "USD"){
            $resposta = $this->cotacaoMoeda($trade->moeda, 'USD', $data[0]);
            if(isset($resposta[0]['bid'])){
                $trade->cotacaoUSD = $resposta[0]['bid'];
            }
        }
        else{
            $trade->cotacaoUSD = 1;
        }

        if($trade->moeda != "EUR"){
            $resposta = $this->cotacaoMoeda($trade->moeda, 'EUR', $data[0]);
            if(isset($resposta[0]['bid'])){
                $trade->cotacaoEUR = $resposta[0]['bid'];
            }
        }
        else{
            $trade->cotacaoEUR = 1;
        }

        if($trade->moeda != "GBP"){
            $resposta = $this->cotacaoMoeda($trade->moeda, 'GBP', $data[0]);
            if(isset($resposta[0]['bid'])){
                $trade->cotacaoGBP = $resposta[0]['bid'];
            }
        }
        else{
            $trade->cotacaoGBP = 1;
        }

        if($trade->moeda != "JPY"){
            $resposta = $this->cotacaoMoeda($trade->moeda, 'JPY', $data[0]);
            if(isset($resposta[0]['bid'])){
                $trade->cotacaoJPY = $resposta[0]['bid'];
            }
        }
        else{
            $trade->cotacaoJPY = 1;
        }

        //vamos verificar a questao do custo de entrada e do custo de saida
        if($trade->tipoCusto == "Spread"){
            $trade->custoEntrada = round($trade->custoOperacaoEntrada * $trade->quantidadeContratos * $trade->valorPontoContrato, $decimais);
            $trade->custoSaida = round($trade->custoOperacaoSaida * $trade->quantidadeContratos * $trade->valorPontoContrato, $decimais);
        }
        elseif($trade->tipoCusto == "Valor Fixo"){
            $trade->custoEntrada = round($trade->custoOperacaoEntrada, $decimais);
            $trade->custoSaida = round($trade->custoOperacaoSaida, $decimais);
        }
        elseif($trade->tipoCusto == "Percentual"){
            $trade->custoEntrada = round($trade->precoEntrada * $trade->custoOperacaoEntrada * $trade->quantidadeContratos * $trade->valorPontoContrato / 100, $decimais);
            $trade->custoSaida = round($trade->precoSaida * $trade->custoOperacaoSaida * $trade->quantidadeContratos * $trade->valorPontoContrato / 10000, $decimais);
        }

        //vamos calcular o resPosicaoPontos
        if($trade->operacao == "Compra"){
            $trade->resPosicaoPontos = round(($trade->precoSaida - $trade->precoEntrada) * $trade->quantidadeContratos, $decimais);
        }
        else{
            $trade->resPosicaoPontos = round(($trade->precoEntrada - $trade->precoSaida) * $trade->quantidadeContratos, $decimais);
        }

        //vamos calcular o resPosicaoFinanceiro
        $trade->resPosicaoFinanceiro = round( ($trade->resPosicaoPontos * $trade->valorPontoContrato) - ($trade->custoEntrada + $trade->custoSaida), $decimais);

        //vamos calcular o resContratoPontos
        if($trade->operacao == "Compra" || $trade->operacao == "Hedge Comprado"){
            $trade->resContratoPontos = round($trade->precoSaida - $trade->precoEntrada , $decimais);
        }
        else{
            $trade->resContratoPontos = round(($trade->precoSaida - $trade->precoEntrada) * -1 , $decimais);
        }

        //vamos calcular o resContratoFinanceiro
        $trade->resContratoFinanceiro = round($trade->resPosicaoFinanceiro / $trade->quantidadeContratos, $decimais);

        //vamos descobrir as margens de lucro e prejuizo
        $prejuizo = ($aluno->porcentagemPrejuizo * $trade->precoEntrada / 100) * -1;
        $lucro = $aluno->porcentagemLucro * $trade->precoEntrada / 100;


        if($trade->resPosicaoFinanceiro > $lucro){
            $trade->gainOrLoss = 'Gain';
        }
        elseif($trade->resPosicaoFinanceiro < $prejuizo){
            $trade->gainOrLoss = 'Loss';
        }
        else{
            $trade->gainOrLoss = '0 x 0';
        }

        $trade->variacaoEntradaSaida = round( ($trade->resContratoPontos / $trade->precoEntrada) * 100 , $decimais);

        $trade->save();

        $filtro = new FiltroAlunoController();
        $filtro->setarFiltros($request, true);
        return true;
    }

    public function cotacaoMoeda($moeda1, $moeda2, $data){
        do{
            $dataVar = str_replace('-','', $data);

            $endPoint = "https://economia.awesomeapi.com.br/json/daily/".$moeda1."-".$moeda2."/?token=f29303cf626a399c4dcf14346fe0c619a38245988b3cd178a3803496e33ac959&start_date=".$dataVar."&end_date=".$dataVar;
            $curl = curl_init();
            curl_setopt_array($curl, [
                CURLOPT_URL => $endPoint,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CUSTOMREQUEST => 'GET'
            ]);

            $resposta = curl_exec($curl);

            curl_close($curl);
            $data = date('Y-m-d', strtotime("- 1 day",strtotime($data)));
            $resposta = json_decode($resposta, true);
        }while($resposta == NULL);

        return $resposta;
    }

    public function buscar(){
        $trade = Trade::where('id', $_GET['id'])->first();

        $retorno['tipoOperacao'] = NULL;
        $retorno['id_conta'] = NULL;
        $retorno['tipoConta'] = NULL;
        $retorno['operacao'] = NULL;
        $retorno['direcao'] = NULL;
        $retorno['fase'] = NULL;
        $retorno['quantidadeContratos'] = NULL;
        $retorno['tipoCusto'] = NULL;
        $retorno['valorPontoContrato'] = NULL;
        $retorno['custoOperacaoEntrada'] = NULL;
        $retorno['custoOperacaoSaida'] = NULL;
        $retorno['precoEntrada'] = NULL;
        $retorno['precoSaida'] = NULL;
        $retorno['motivosEntrada'] = NULL;
        $retorno['motivosSaida'] = NULL;
        $retorno['ativoHtml'] = NULL;
        $retorno['analiseMentor'] = NULL;
        $retorno['aprovacaoMentor'] = NULL;
        $retorno['obsMentor'] = NULL;

        if($trade->dtHrEntrada){
            $var = explode(' ', $trade->dtHrEntrada);
            $retorno['dtEntrada'] = $var[0];
            $retorno['hrEntrada'] = $var[1];
        }
        else{
          $retorno['dtEntrada'] = NULL;
          $retorno['hrEntrada'] = NULL;
        }

        if($trade->dtHrSaida){
            $var = explode(' ', $trade->dtHrSaida);
            $retorno['dtSaida'] = $var[0];
            $retorno['hrSaida'] = $var[1];
        }
        else{
          $retorno['dtSaida'] = NULL;
          $retorno['hrSaida'] = NULL;
        }

        $retorno['tipoOperacao'] = $trade->tipoOperacao;
        $retorno['id_conta'] = $trade->id_conta;
        $retorno['tipoConta'] = $trade->tipoConta;
        $retorno['operacao'] = $trade->operacao;
        $retorno['direcao'] = $trade->direcao;
        $retorno['fase'] = $trade->fase == NULL ? 'Não Informada' : $trade->fase;
        $retorno['quantidadeContratos'] = $trade->quantidadeContratos;
        $retorno['tipoCusto'] = $trade->tipoCusto;
        $retorno['valorPontoContrato'] = $trade->valorPontoContrato == "" ? "" : $trade->valorPontoContrato;
        $retorno['custoOperacaoEntrada'] = $trade->custoOperacaoEntrada == "" ? "" : $trade->custoOperacaoEntrada;
        $retorno['custoOperacaoSaida'] = $trade->custoOperacaoSaida == "" ? "" : $trade->custoOperacaoSaida;
        $retorno['precoEntrada'] = $trade->precoEntrada == "" ? "" : $trade->precoEntrada;
        $retorno['precoSaida'] = $trade->precoSaida == "" ? "" : $trade->precoSaida;
        $retorno['motivosEntrada'] = $trade->motivosEntrada;
        $retorno['motivosSaida'] = $trade->motivosSaida;
        $retorno['id_ativo'] = $trade->id_ativo;
        $retorno['analiseMentor'] = $trade->analiseMentor;
        $retorno['aprovacaoMentor'] = $trade->aprovacaoMentor;
        $retorno['obsMentor'] = $trade->obsMentor;

        $retorno['controleAnaliseMentor'] = $trade->aprovacaoMentor ? 'true' : 'false';

        //vamos ver o ativos
        if($trade->id_conta){
            $conta = Conta::where('id', $trade->id_conta)->first();

            $ativos = AtivoCorretora::where('id_corretora', $conta->id_corretora)->get();

            $html = "<option value=''>Opções</option>";

            foreach ($ativos as $linha){
                $selected = '';
                $ativo = Ativo::where('id', $linha->id_ativo)->first();
                if($ativo){
                    if($ativo->id == $trade->id_ativo){
                        $selected = 'selected';
                    }
                    $html .= "<option $selected value='$ativo->id'>$ativo->simbolo - $ativo->nome - Moeda: $ativo->moedaAtivo - Tipo de Custo: $ativo->tipoCusto</option>";
                }
            }

            $retorno['ativoHtml'] = $html;
        }
        else{
            $retorno['ativoHtml'] = NULL;
        }

        echo json_encode($retorno);
    }

    public function delete($id = null){
        $aluno = session()->get('aluno');
        $trade = Trade::where('id', $id)->first();

        if($aluno->id == $trade->id_aluno){
            Trade::where('id', $trade->id)->delete();

            return redirect()->route('aluno.trades')->with('mensagem', 'Trade Excluída');
        }
    }
}
