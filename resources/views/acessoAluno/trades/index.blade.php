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
}

.table-trades td{
    font-size: 10px !important;
}

</style>
<div class="container-xxl flex-grow-1 container-p-y">
    {!! $filtroHtml !!}
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Trades</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <div class="col-md-6">
                        <button type="button" class='btn btn-sm btn-primary' id='botaoAdicionarTrade'>Adicionar Trade</button>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <div class="btn-group">
                    <button type="button" class="btn btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                        Acesso Rápido
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('aluno.trades.filtroTempo', 'semana') }}">Última Semana</a></li>
                        <li><a class="dropdown-item" href="{{ route('aluno.trades.filtroTempo', 'mes') }}">Última Mês</a></li>
                        <li><a class="dropdown-item" href="{{ route('aluno.trades.filtroTempo', '3meses') }}">Últimos 3 Meses</a></li>
                        <li><a class="dropdown-item" href="{{ route('aluno.trades.filtroTempo', '6meses') }}">Últimos 6 Meses</a></li>
                    </ul>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table-trades table " id="table-index">
                            <thead>
                                <tr>
                                    <td></td>
                                    <td>Número</td>
                                    <td>Entrada</td>
                                    <td>Saída</td>
                                    <td>Tempo</td>
                                    <td>Status</td>
                                    <td>Tipo</td>
                                    <td>País</td>
                                    <td>Corretora</td>
                                    <td>Tipo Conta</td>
                                    <td>Conta</td>
                                    <td>Ativo</td>
                                    <td>Tipo Ativo</td>
                                    <td>Operação</td>
                                    <td>Direção</td>
                                    <td>Fase</td>
                                    <td>Qt Contratos</td>
                                    <td>Moeda</td>
                                    <td>Valor Ponto Por Contrato</td>
                                    <td>Tipo Custo</td>
                                    <td>Custo Entrada por Contrato</td>
                                    <td>Custo Saída por Contrato</td>
                                    <td>Preço &nbspEntrada&nbsp</td>
                                    <td>Custo Entrada</td>
                                    <td>Preço &nbsp&nbspSaída&nbsp&nbsp</td>
                                    <td>Custo Saída</td>
                                    <td>Resultado Posição Pontos</td>
                                    <td>Resultado Posição Financeiro</td>
                                    <td>Resultado Contrato Pontos</td>
                                    <td>Resultado Contrato Financeiro</td>
                                    <td>Variação Entrada Saída</td>
                                    {{-- <th>Resultado Operação Capital</th> --}}
                                    <td>Gain ou Loss</td>
                                    {{-- <th>Saúde Conta</th> --}}
                                    {{-- <th>Validador</th> --}}
                                </tr>
                            </thead>
                            <tbody>
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

                                $variacaoEntradaSaida = '';
                                if($trade->variacaoEntradaSaida){
                                    $variacaoEntradaSaida = $trade->variacaoEntradaSaida."%";
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

                                $moedaTrade = '';
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
                                    <tr id='linha{{ $trade->id_trade }}' onclick="selecionaTrade({{ $trade->id_trade }})" style='cursor: pointer !important'>
                                        <td>
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
                                        <td><span style='display:none'>{{ strtotime($trade->dtHrEntrada) }}</span>{{ $entrada }}</td>
                                        <td><span style='display:none'>{{ strtotime($trade->dtHrSaida) }}</span>{{ $saida }}</td>
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
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->valorPontoContrato) }}</td>
                                        <td>{{ $trade->tipoCusto }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoOperacaoEntrada) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoOperacaoSaida) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->precoEntrada) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoEntrada) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->precoSaida) }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->custoSaida) }}</td>
                                        <td>{{ $trade->resPosicaoPontos }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->resPosicaoFinanceiro) }}</td>
                                        <td>{{ $trade->resContratoPontos }}</td>
                                        <td>{{ $moedaTrade." ".valorDbForm($trade->resContratoFinanceiro) }}</td>
                                        <td>{{ $variacaoEntradaSaida }}</td>
                                        {{-- <td>{{ $trade->resOperacaoCapital }}</td> --}}
                                        <td style='color: {{ $color }};'>{{ $trade->gainOrLoss }}</td>
                                        {{-- <td>{{ $trade->saudeConta }}</td> --}}
                                        {{-- <td>{{ $trade->validador }}</td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    lengthMenu: [
          [25, 50, -1],
          [25, 50, 'All']
    ],
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

</script>

<style>
input, select, label{
    font-size: 14px !important;
}
</style>

<!-- Modal de adicionar trade -->
<div class="modal fade" id="modalTrade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <form id='formulario' action="{{ route('aluno.trades.insert') }}" method="post">
          <input type="hidden" name="id_trade" id='modalTrade_id'>
          @csrf
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <div class="card">
                  <div class="card-body">
                      <h5 class='card-title'>Trade</h5>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input required class="form-control" max="{{ date('Y-m-d') }}" type="date" id="dtEntrada" name="dtEntrada" placeholder="Data Entrada"/>
                              <label for="dtEntrada">Data Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="time" id="hrEntrada" name="hrEntrada" placeholder="Hora Entrada"/>
                              <label for="hrEntrada">Hora Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" max="{{ date('Y-m-d') }}" type="date" id="dtSaida" name="dtSaida" placeholder="Data Saída"/>
                              <label for="dtSaida">Data Saída:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="time" id="hrSaida" name="hrSaida" placeholder="Hora Saída"/>
                              <label for="hrSaida">Hora Saída:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="tipoOperacao" name='tipoOperacao' class="select2 form-select">
                                  <option value="">Opções</option>
                                  <option value="Day Trade">Day Trade</option>
                                  <option value="Hedge">Hedge</option>
                                  <option value="Position">Position</option>
                                  <option value="Scalp">Scalp</option>
                                  <option value="Swing Trade">Swing Trade</option>

                              </select>
                              <label for="tipoOperacao">Tipo de Operação:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="modalTrade_id_conta" name='id_conta' onchange="buscaAtivosCorretora()" class="select2 form-select">
                                  <option value="">Opções</option>
                                  @foreach($contas as $linha)
                                      <option value="{{ $linha->id }}">{{ $linha->nrConta }} {{ $linha->nmConta." - ".$linha->tpConta }}</option>
                                  @endforeach
                              </select>
                              <label for="id_corretora">Conta Corretora:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="modalTrade_id_ativo" name='id_ativo' class="select2 form-select" onchange='buscaValorContratoAtivo(this.value, "true")'>
                                  <option value="">Opções</option>
                              </select>
                              <label for="id_tipoConta">Ativo:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <select id="operacao" name='operacao' class="select2 form-select">
                                  <option value="">Opções</option>
                                  <option value="Compra">Compra</option>
                                  <option value="Venda">Venda</option>
                                  <option value="Hedge Comprado">Hedge Comprado</option>
                                  <option value="Hedge Vendido">Hedge Vendido</option>
                              </select>
                              <label for="operacao">Operação:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-2 gy-4">
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                            <select id="direcao" name='direcao' class="select2 form-select">
                                <option value="">Opções</option>
                                <option value="Não Informado">Não Informado</option>
                                <option value="Tendência">Tendência</option>
                                <option value="Contra-tendência">Contra-tendência</option>
                                <option value="Divergência">Divergência</option>
                            </select>
                            <label for="direcao">Direção:</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                            <select id="fase" name='fase' class="select2 form-select">
                                <option value="Não Informada">Não Informada</option>
                                <option value="Fase 01">Fase 01</option>
                                <option value="Fase 02">Fase 02</option>
                                <option value="Fase 03">Fase 03</option>
                                <option value="Fase 04">Fase 04</option>
                                <option value="Fase 05">Fase 05</option>
                            </select>
                            <label for="fase">Fase:</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                                <input readonly class="form-control" type="number" id="quantidadeContratos" name="quantidadeContratos" placeholder="Qtd. Contratos" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                            <label for="quantidadeContratos">Qtd. Contratos:</label>
                          </div>
                        </div>
                        <div class="col-md-3">
                          <div class="form-floating form-floating-outline">
                            <input readonly class="form-control" type="number" id="valorPontoContrato" name="valorPontoContrato" placeholder="Valor Por Ponto, por Contrato" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                            <label for="valorPontoContrato">Valor Por Ponto, por Contrato:</label>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="number" id="custoOperacaoEntrada" name="custoOperacaoEntrada" placeholder="Valor (Spread / Fixo / %) Entrada:" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="custoOperacaoEntrada">Valor (Spread / Fixo / %) Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="number" id="custoOperacaoSaida" name="custoOperacaoSaida" placeholder="Valor (Spread / Fixo / %) Saída:" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="custoOperacaoSaida">Valor (Spread / Fixo / %) Saída:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="number" id="precoEntrada" name="precoEntrada" placeholder="Preço de Entrada" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="precoEntrada">Preço de Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-3">
                            <div class="form-floating form-floating-outline">
                              <input class="form-control" type="number" id="precoSaida" name="precoSaida" placeholder="Preço de Saída" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any"/>
                              <label for="precoSaida">Preço de Saída:</label>
                            </div>
                          </div>
                      </div>
                      <div class="row mt-2 gy-4">
                          <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                              <textarea class="form-control h-px-100" id="motivosEntrada" name='motivosEntrada' placeholder="Alguma observação pertinente ..."></textarea>
                              <label for="motivosEntrada">Motivos Entrada:</label>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-floating form-floating-outline mb-4">
                              <textarea class="form-control h-px-100" id="motivosSaida" name='motivosSaida' placeholder="Alguma observação pertinente ..."></textarea>
                              <label for="motivosSaida">Motivos Saída:</label>
                            </div>
                          </div>
                      </div>
                  </div>
              </div>
              <div class="card mt-3" style='display:none' id='divAnaliseMentor'>
                    <div class="card-body">
                        <h5 class="card-title">Análise Mentor</h5>
                        <div class="row mt-3">
                            <div class="col-md-6 form-group">
                                <label for="">Análise:</label><br>
                                <b id='analiseMentor'></b>
                            </div>
                            <div class="col-md-6 form-group">
                                <label for="">Aprovação:</label><br>
                                <b id='aprovacaoMentor'></b>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 form-group">
                                <label for="">Análise:</label><br>
                                <b id='obsMentor'></b>
                            </div>
                        </div>
                    </div>
              </div>
              <div class="d-flex justify-content-start">
                    <div id="divBotaoCarregando" style='display:none'>
                        <button class="btn btn-primary waves-effect waves-light" type="button" disabled="">
                            <span class="spinner-grow me-1" role="status" aria-hidden="true"></span>
                            Carregando...
                        </button>
                    </div>
                    <div id="divBotaoSalvar">
                        <button type="button" onclick="habilitaBotaoCarregando()" class="btn btn-primary">Salvar</button>
                    </div>
                    <div>
                        <button style="margin-left: 10px !important" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </div>
                    <div id='divFooterModal'>

                    </div>
              </div>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
function habilitaBotaoCarregando(){
    document.getElementById('divBotaoSalvar').style.display = 'none';
    document.getElementById('divBotaoCarregando').style.display = 'block';
    document.getElementById('formulario').submit();
}

document.getElementById('dtEntrada').addEventListener('blur', (e)=>{
    if(e.target.value != ""){
        document.getElementById('dtSaida').setAttribute('min',e.target.value);
    }
    else{
        document.getElementById('dtSaida').removeAttribute('min');
    }
});

document.getElementById('dtSaida').addEventListener('blur', (e)=>{
    if(e.target.value != ""){
        dataEntrada = new Date(document.getElementById('dtEntrada').value);
        dataSaida = new Date(e.target.value);
        if(dataSaida <= dataEntrada && document.getElementById('hrEntrada').value != ""){
            document.getElementById('hrSaida').setAttribute('min', document.getElementById('hrEntrada').value);
        }
        else{
            document.getElementById('hrSaida').removeAttribute('min');
        }
    }
    else{
        document.getElementById('hrSaida').removeAttribute('min');
    }
});


document.getElementById('botaoAdicionarTrade').addEventListener('click', ()=>{
    document.getElementById('divAnaliseMentor').style.display = 'none';
    const myModal = new bootstrap.Modal(document.getElementById('modalTrade'));
    document.getElementById('formulario').action = "{{ route('aluno.trades.insert') }}"
    myModal.show();
})

function selecionaTrade(id_trade){
    const myModal = new bootstrap.Modal(document.getElementById('modalTrade'));
    document.getElementById('formulario').action = "{{ route('aluno.trades.update') }}";
    document.getElementById('modalTrade_id').value = id_trade;

    document.getElementById('divFooterModal').innerHTML = "";

    //vamos criar o botao de excluir a trade
    botao = document.createElement('button');
    botao.innerHTML = "Excluir";
    botao.setAttribute('class', 'btn btn-danger');
    botao.setAttribute('type', 'button');
    botao.setAttribute('style', 'margin-left: 10px !important');
    botao.setAttribute('onclick', "deleteTrade(" + id_trade + ")");

    document.getElementById('divFooterModal').appendChild(botao);

    $.getJSON(
        "/trades/alunoTradesbuscar/" + id_trade,
        {
            id : id_trade
        },
        function(json){
            document.getElementById('dtEntrada').value = json.dtEntrada;
            document.getElementById('hrEntrada').value = json.hrEntrada;
            document.getElementById('dtSaida').value = json.dtSaida;
            document.getElementById('hrSaida').value = json.hrSaida;
            document.getElementById('tipoOperacao').value = json.tipoOperacao;
            document.getElementById('modalTrade_id_conta').value = json.id_conta;
            //document.getElementById('id_tipoConta').value = json.tipoConta;
            document.getElementById('modalTrade_id_ativo').innerHTML = json.ativoHtml;
            document.getElementById('operacao').value = json.operacao;
            document.getElementById('direcao').value = json.direcao;
            document.getElementById('fase').value = json.fase;
            document.getElementById('quantidadeContratos').value = json.quantidadeContratos;
            //document.getElementById('tipoCusto').value = json.tipoCusto;
            document.getElementById('custoOperacaoEntrada').value = json.custoOperacaoEntrada;
            document.getElementById('custoOperacaoSaida').value = json.custoOperacaoSaida;
            document.getElementById('precoEntrada').value = json.precoEntrada;
            document.getElementById('precoSaida').value = json.precoSaida;
            document.getElementById('motivosEntrada').value = json.motivosEntrada;
            document.getElementById('motivosSaida').value = json.motivosSaida;
            document.getElementById('analiseMentor').innerHTML = json.analiseMentor;
            document.getElementById('aprovacaoMentor').innerHTML = json.aprovacaoMentor;
            document.getElementById('obsMentor').innerHTML = json.obsMentor;
            //buscaValorContratoAtivo(json.id_ativo, 'false');
            if(json.controleAnaliseMentor == 'true'){
                document.getElementById('divAnaliseMentor').style.display = 'block';
            }
            else{
                document.getElementById('divAnaliseMentor').style.display = 'none';
            }

            if(json.dtEntrada){
                document.getElementById('dtSaida').setAttribute('min', json.dtEntrada);
            }

            myModal.show();
            document.getElementById('valorPontoContrato').value = json.valorPontoContrato;

        }
    );
}

function deleteTrade(id_trade){
    if(confirm('Tem certeza que deseja excluir a trade?')){
        window.location.href = "{{ route('aluno.trades.delete') }}/" + id_trade;
    }
}

function buscaAtivosCorretora(){
    if(document.getElementById('modalTrade_id_conta').value != ""){
        $.getJSON(
            "{{ route('aluno.trade.buscaAtivosCorretora') }}",
            {
                id_conta : document.getElementById('modalTrade_id_conta').value
            },
            function(json){
                document.getElementById('modalTrade_id_ativo').innerHTML = json.html;
            }
        );
    }
    else{
        document.getElementById('modalTrade_id_ativo').innerHTML = "<option value=''>Opções</option>";
    }
}

function buscaValorContratoAtivo(ativo_id, controle){
    if(ativo_id){
        $.getJSON(
            "{{ route('aluno.trade.buscaValorContratoAtivo') }}",
            {
                ativo_id : ativo_id
            },
            function(json){
                if(json.controle_valor_contrato == "caso1"){
                    if(controle == 'true'){
                        document.getElementById('valorPontoContrato').value = '';
                        document.getElementById('quantidadeContratos').value = json.contrato;
                    }
                    document.getElementById('valorPontoContrato').removeAttribute('readonly');
                    document.getElementById('quantidadeContratos').setAttribute('readonly','readonly');
                    document.getElementById('quantidadeContratos').setAttribute('type','text');
                }
                else if(json.controle_valor_contrato == "caso2"){
                    if(controle == 'true'){
                        document.getElementById('valorPontoContrato').value = json.valor;
                        document.getElementById('quantidadeContratos').value = '';
                    }
                    document.getElementById('valorPontoContrato').setAttribute('readonly','readonly');
                    document.getElementById('quantidadeContratos').removeAttribute('readonly');
                    document.getElementById('quantidadeContratos').setAttribute('type','text');
                }
                else if(json.controle_valor_contrato == "caso3"){
                    if(controle = 'true'){
                        document.getElementById('valorPontoContrato').value = json.valor;
                        document.getElementById('quantidadeContratos').value = '';
                    }

                    document.getElementById('valorPontoContrato').setAttribute('readonly','readonly');
                    document.getElementById('quantidadeContratos').removeAttribute('readonly');
                    document.getElementById('quantidadeContratos').setAttribute('type','number');
                }
            }
        )
    }
    else{
        document.getElementById('valorPontoContrato').value = '';
        document.getElementById('valorPontoContrato').removeAttribute('readonly');
        document.getElementById('quantidadeContratos').value = '';
        document.getElementById('quantidadeContratos').removeAttribute('readonly');
    }
}




</script>

@endsection
