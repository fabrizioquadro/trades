@extends('layoutAdmin')

@section('conteudo')
@php
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

@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    {!! $filtro !!}
    <div class="card mt-3">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-md-3">
                    <h6 class="card-title">One Page Report</h6>
                </div>
                <div class="col-md-9" align='right'>
                    <button type="button" id="btnExportarListaPdf" class="btn btn-sm btn-info">Exportar Lista de Trades</button>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table-trades table " id="table-index">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <td class="text-center">Aluno</td>
                            <td class="text-center">Número</td>
                            <td class="text-center">Entrada</td>
                            <td class="text-center">Saída</td>
                            <td class="text-center">Tempo</td>
                            <td class="text-center">Status</td>
                            <td class="text-center">Tipo</td>
                            <td class="text-center">Pais</td>
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
                            <td class="text-center">Valor Ponto Por Contrato</td>
                            <td class="text-center">Tipo Custo</td>
                            <td class="text-center">Custo Entrada por Contrato</td>
                            <td class="text-center">Custo Saída por Contrato</td>
                            <td class="text-center">Preço &nbspEntrada&nbsp</td>
                            <td class="text-center">Custo Entrada</td>
                            <td class="text-center">Preço &nbsp&nbspSaída&nbsp&nbsp</td>
                            <td class="text-center">Custo Saída</td>
                            <td class="text-center">Resultado Posição Pontos</td>
                            <td class="text-center">Resultado Posição Financeiro</td>
                            <td class="text-center">Resultado Contrato Pontos</td>
                            <td class="text-center">Resultado Contrato Financeiro</td>
                            <td class="text-center">Variação Entrada Saída</td>
                            <td class="text-center">Gain ou Loss</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Custo Entrada</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Custo Saída</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado Contrato</td>
                            <td class="text-center">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbspMB&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Resultado Posição</td>
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
                                    <input type="checkbox" class='selecionados' value='{{ $trade->id_trade }}' checked>
                                    @if($trade->analiseMentor == 'Analisado')
                                        <img src="{{ asset('/public/img/IconsPng/Analisado.png') }}" style="height: 20px">
                                    @endif
                                    @if($trade->aprovacaoMentor == 'Aprovado')
                                        <img src="{{ asset('/public/img/IconsPng/Aprovado.png') }}" style="height: 20px">
                                    @elseif($trade->aprovacaoMentor == 'Não Aprovado')
                                        <img src="{{ asset('/public/img/IconsPng/Nao Aprovado.png') }}" style="height: 20px">
                                    @endif
                                </td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->nmAluno }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->idOperacao }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $entrada }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $saida }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->tempoOperacao }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->stOperacao }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->tipoOperacao }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->pais }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->nmCorretora }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->tipoConta }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->nmConta }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->nmAtivo }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->tipoAtivo }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})' style='color: {{ $corOperacao }};'>{{ $trade->operacao }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})' style='color: {{ $corDirecao }};'>{{ $trade->direcao }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->fase }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->quantidadeContratos }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->moeda }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->valorPontoContrato) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->tipoCusto }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->custoOperacaoEntrada) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->custoOperacaoSaida) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->precoEntrada) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->custoEntrada) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->precoSaida) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->custoSaida) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->resPosicaoPontos }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->resPosicaoFinanceiro) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->resContratoPontos }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moedaTrade.' '.valorDbForm($trade->resContratoFinanceiro) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $trade->variacaoEntradaSaida }}%</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})' style='color: {{ $color }};'>{{ $trade->gainOrLoss }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moeda.' '.valorDbForm($mbCustoEntrada) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moeda.' '.valorDbForm($mbCustoSaida) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moeda.' '.valorDbForm($mbResultadoContrato) }}</td>
                                <td style='cursor: pointer' onclick='abrirModalAvaliacao({{ $trade->id_trade }})'>{{ $moeda.' '.valorDbForm($mbResultadoPosicao) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="33" style="text-align: right !important;"><b>TOTAL</b></td>
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
                    <button type="button" name="button" id='btnExportar' class="btn btn-primary btn-sm">Exportar para Relatório</button>
                </div>
            </div>
        </div>
    </div>
</div>
<form id='formularioOnePageReport' action="{{ route('resultados.onePageReport') }}" method="post">
    @csrf
    <input type="hidden" name="trades" id='formularioOnePageReport_trades'>
</form>

<form id='formularioExportarListaTrades' action="{{ route('resultados.exportarListaTrades') }}" target='_blank' method="post">
    @csrf
    <input type="hidden" name="trades" id='formularioExportarListaTrades_trades'>
</form>
<script>

window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    paging: false,
    order: [[2, 'desc']],
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

function abrirModalAvaliacao(trade_id){
    const myModal = new bootstrap.Modal(document.getElementById('modalAvaliacao'));
    document.getElementById('modalAvaliacao_trade_id').value = trade_id;
    $.getJSON(
        "{{ route('resultados.buscar.avaliacao') }}",
        {
            trade_id : trade_id
        },
        function(json){
            document.getElementById('analiseMentor').value = json.analiseMentor;
            document.getElementById('aprovacaoMentor').value = json.aprovacaoMentor;
            document.getElementById('obsMentor').value = json.obsMentor;
        }
    );
    myModal.show();
}

</script>

<!-- Modal de adicionar trade -->
<div class="modal fade" id="modalAvaliacao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('resultados.avaliar') }}" method="post">
                            <input type="hidden" name="trade_id" id="modalAvaliacao_trade_id">
                            @csrf
                            <h5 class="card-title">Avaliação Mentor</h5>
                            <div class="row mt-3">
                                <div class="col-md-12 form-group">
                                    <label for="">Análise:</label>
                                    <select name="analiseMentor" id="analiseMentor" class="form-control">
                                        <option></option>
                                        <option value="Analisado">Analisado</option>
                                        <option value="Não Analisado">Não Analisado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 form-group">
                                    <label for="">Aprovação:</label>
                                    <select name="aprovacaoMentor" id="aprovacaoMentor" class="form-control">
                                        <option></option>
                                        <option value="Aprovado">Aprovado</option>
                                        <option value="Não Aprovado">Não Aprovado</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 form-group">
                                    <label for="">Observação:</label>
                                    <textarea name="obsMentor" id="obsMentor" class="form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 form-group">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
