@extends('layoutAluno')

@section('conteudo')
<!--
<style>
.table-filtro th, td{
    font-size: 8px !important;
}

.dropdown-menu{
    width: 300px !important;
}

.dropdown-menu .card-title{
    font-size: 12px !important;
}

.dropdown-menu label{
    font-size: 10px !important;
}



</style>
-->
<style media="screen">
.table-trades th{
    font-size: 10px !important;
    vertical-align: middle !important;
}

.table-trades td{
    font-size: 10px !important;
    vertical-align: middle !important;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    {!! $filtroHtml !!}
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-3">
                <h6 class="card-title">One Page Report</h6>
                <div>
                    <button type="button" id="btnExportarListaPdf" class="btn btn-info">Exportar Lista de Trades</button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            Acesso Rápido
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('aluno.resultados.onePageReportTempo', 'semana') }}">Última Semana</a></li>
                            <li><a class="dropdown-item" href="{{ route('aluno.resultados.onePageReportTempo', 'mes') }}">Última Mês</a></li>
                            <li><a class="dropdown-item" href="{{ route('aluno.resultados.onePageReportTempo', '3meses') }}">Últimos 3 Meses</a></li>
                            <li><a class="dropdown-item" href="{{ route('aluno.resultados.onePageReportTempo', '6meses') }}">Últimos 6 Meses</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table-trades table " id="table-index">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <td class="text-center">Número</td>
                            <td class="text-center">Entrada</td>
                            <td class="text-center">Saída</td>
                            <td class="text-center">Tempo</td>
                            <td class="text-center">Status</td>
                            <td class="text-center">Tipo</td>
                            <td class="text-center">País</td>
                            <td class="text-center">Corretora</td>
                            <td class="text-center">Tipo Conta</td>
                            <td class="text-center">Conta</td>
                            <td class="text-center">Ativo</td>
                            <td class="text-center">Tipo Ativo</td>
                            <td class="text-center">Operação</td>
                            <td class="text-center">Direção</td>
                            <td class="text-center">Fase</td>
                            <td class="text-center">Qt Contratos</td>
                            <td class="text-center">Moeda</td>
                            <td class="text-center">Valor Ponto Contrato</td>
                            <td class="text-center">Tipo Custo</td>
                            <td class="text-center">Custo Entrada Contrato</td>
                            <td class="text-center">Custo Saída Contrato</td>
                            <td class="text-center">Preço &nbspEntrada&nbsp</td>
                            <td class="text-center">Custo Entrada</td>
                            <td class="text-center">Preço &nbsp&nbspSaída&nbsp&nbsp</td>
                            <td class="text-center">Custo Saída</td>
                            <td class="text-center">Resultado Posição Pontos</td>
                            <td class="text-center">Resultado Posição Financeiro</td>
                            <td class="text-center">Resultado Contrato Pontos</td>
                            <td class="text-center">Resultado Contrato Financeiro</td>
                            <td class="text-center">Variação Entrada Saída</td>
                            {{--<th>Resultado Operação Capital</th>--}}
                            <td class="text-center">Gain ou Loss</td>
                            {{--<th>Saúde Conta</th>--}}
                            {{--<th>Validador</th>--}}
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Custo Entrada</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Custo Saída</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado Contrato</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado Posição</td>
                            {{--<td class="text-center">Motivos Entrada</td>--}}
                            {{--<td class="text-center">Motivos Saída</td>--}}
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $totalMbCustoEntrada = 0;
                            $totalMbCustoSaida = 0;
                            $totalMbResultadoContrato = 0;
                            $totalMbResultadoPosicao = 0;
                        @endphp
                        @foreach($trades as $trade)
                            @php
                                if($trade->dtHrEntrada){
                                    $var = explode(' ',$trade->dtHrEntrada);
                                    $entrada = dataDbForm($var[0])." ".$var[1];
                                }
                                else{
                                    $entrada = "";
                                }

                                if($trade->dtHrSaida){
                                    $var = explode(' ',$trade->dtHrSaida);
                                    $saida = dataDbForm($var[0])." ".$var[1];
                                }
                                else{
                                    $saida = "";
                                }
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

                                if($trade->operacao == "Compra" || $trade->operacao == "Hedge Comprado"){
                                    $corOperacao = "#4472c4";
                                }
                                else{
                                    $corOperacao = "#ff0000";
                                }

                                if($trade->direcao == "Tendência"){
                                    $corDirecao = "#4472c4";
                                }
                                elseif($trade->direcao == "Contra-tendência"){
                                    $corDirecao = "#ff0000";
                                }
                                else{
                                    $corDirecao = "#cf6621";
                                }

                            @endphp
                            <tr>
                                <td>
                                    @php
                                    if($aluno->filtroTrades){
                                        $vars = explode(',',$aluno->filtroTrades);
                                        if(array_search($trade->id_trade, $vars) || array_search($trade->id_trade, $vars) === 0){
                                            $checked = 'checked';
                                        }
                                        else{
                                            $checked = '';
                                        }
                                    }
                                    else{
                                        $checked = 'checked';
                                    }
                                    @endphp
                                    <input type="checkbox" class='selecionados' value='{{ $trade->id_trade }}' {{ $checked }}>
                                    @if($trade->analiseMentor == 'Analisado')
                                        <img src="{{ asset('/public/img/IconsPng/Analisado.png') }}" style="height: 20px">
                                    @endif
                                    @if($trade->aprovacaoMentor == 'Aprovado')
                                        <img src="{{ asset('/public/img/IconsPng/Aprovado.png') }}" style="height: 20px">
                                    @elseif($trade->aprovacaoMentor == 'Não Aprovado')
                                        <img src="{{ asset('/public/img/IconsPng/Nao Aprovado.png') }}" style="height: 20px">
                                    @endif
                                </td>
                                <td>{{ $trade->idOperacao }}</td>
                                <td>{{ $entrada }}</td>
                                <td>{{ $saida }}</td>
                                <td>{{ $trade->tempoOperacao }}</td>
                                <td>{{ $trade->stOperacao }}</td>
                                <td>{{ $trade->tipoOperacao }}</td>
                                <td>{{ $trade->pais }}</td>
                                <td>{{ $trade->nmCorretora }}</td>
                                <td>{{ $trade->tipoConta }}</td>
                                <td>{{ $trade->nmConta }}</td>
                                <td>{{ $trade->nmAtivo }}</td>
                                <td>{{ $trade->tipoAtivo }}</td>
                                <td style='color: {{ $corOperacao }};'>{{ $trade->operacao }}</td>
                                <td style='color: {{ $corDirecao }};'>{{ $trade->direcao }}</td>
                                <td>{{ $trade->fase }}</td>
                                <td>{{ $trade->quantidadeContratos }}</td>
                                <td>{{ $trade->moeda }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->valorPontoContrato) }}</td>
                                <td>{{ $trade->tipoCusto }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoOperacaoEntrada) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoOperacaoSaida) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->precoEntrada) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoEntrada) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->precoSaida) }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->custoSaida) }}</td>
                                <td>{{ $trade->resPosicaoPontos }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->resPosicaoFinanceiro) }}</td>
                                <td>{{ $trade->resContratoPontos }}</td>
                                <td>{{ $moedaTrade.' '.valorDbForm($trade->resContratoFinanceiro) }}</td>
                                <td>{{ $trade->variacaoEntradaSaida }}%</td>
                                {{--<td>{{ $trade->resOperacaoCapital }}</td>--}}
                                <td style='color: {{ $color }};'>{{ $trade->gainOrLoss }}</td>
                                {{--<td>{{ $trade->saudeConta }}</td>--}}
                                {{--<td>{{ $trade->validador }}</td>--}}
                                <td>{{ $moeda.' '.valorDbForm($mbCustoEntrada) }}</td>
                                <td>{{ $moeda.' '.valorDbForm($mbCustoSaida) }}</td>
                                <td>{{ $moeda.' '.valorDbForm($mbResultadoContrato) }}</td>
                                <td>{{ $moeda.' '.valorDbForm($mbResultadoPosicao) }}</td>
                                {{--<td>{{ $trade->motivosEntrada }}</td>--}}
                                {{--<td>{{ $trade->motivosSaida }}</td>--}}
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="32" style="text-align: right !important;"><b>TOTAL</b></td>
                            <td><b>{{ $moeda.' '.$totalMbCustoEntrada }}</b></td>
                            <td><b>{{ $moeda.' '.$totalMbCustoSaida }}</b></td>
                            <td><b>{{ $moeda.' '.$totalMbResultadoContrato }}</b></td>
                            <td><b>{{ $moeda.' '.$totalMbResultadoPosicao }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button type="button" name="button" id='btnExportar' class="btn btn-primary">Exportar para Relatório</button>
                </div>
            </div>
        </div>
    </div>
</div>
<form id='formularioOnePageReport' action="{{ route('aluno.resultados.onePageReport') }}" method="post">
    @csrf
    <input type="hidden" name="trades" id='formularioOnePageReport_trades'>
</form>

<form id='formularioExportarListaTrades' action="{{ route('aluno.resultados.exportarListaTrades') }}" target='_blank' method="post">
    @csrf
    <input type="hidden" name="trades" id='formularioExportarListaTrades_trades'>
</form>

<script>

window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    paging: false,
    order: [[1, 'desc']],
    "language": {
			"sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
})

document.getElementById('btnExportarListaPdf').addEventListener('click', ()=>{
    var trades = '';
    var controle = false;
    inputs = document.querySelectorAll('input.selecionados');

    [].forEach.call(inputs, function(input) {
        if(input.checked == true){
            trades = trades + ',' + input.value;
            controle = true;
        }
    });

    if(controle){
        document.getElementById('formularioExportarListaTrades_trades').value = trades;
        document.getElementById('formularioExportarListaTrades').submit();
    }
    else{
        alert('É necessário escolher pelo menos 1 trade');
    }
});


document.getElementById('btnExportar').addEventListener('click', ()=>{
    var trades = '';
    var controle = false;
    inputs = document.querySelectorAll('input.selecionados');

    [].forEach.call(inputs, function(input) {
        if(input.checked == true){
            trades = trades + ',' + input.value;
            controle = true;
        }
    });

    if(controle){
        document.getElementById('formularioOnePageReport_trades').value = trades;
        document.getElementById('formularioOnePageReport').submit();
    }
    else{
        alert('É necessário escolher pelo menos 1 trade');
    }
})
</script>
@endsection
