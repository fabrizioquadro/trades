@extends('layoutAluno')

@section('conteudo')
<style>
    tr, td, th{
        font-size: 12px !important;
    }
</style>
@php
if($planTrade->moeda == "BRL"){
    $moeda = "R$";
}
elseif($planTrade->moeda == "USD"){
    $moeda = "US$";
}
elseif($planTrade->moeda == "EUR"){
    $moeda = "€";
}
elseif($planTrade->moeda == "GBP"){
    $moeda = "£";
}
elseif($planTrade->moeda == "JPY"){
    $moeda = "¥$";
}
$controleLancar = true;

$nr = $planTrade->nrPlan;

$var = "plan".$nr."MetaGanhoDiario";
$planMetaGanhoDiario = $aluno->$var;

$planPontosContratoAtivo = $planTrade->pontosContratoAtivo;

$var = "plan".$nr."MetaMaximaPontos";
$planMetaMaximaPontos = $aluno->$var;

$planGarantiaContrato = $planTrade->garantiaContratoAtivo;

$var = "plan".$nr."LimiteGanhoDia";
$planLimiteGanhoDia = $aluno->$var;

$var = "plan".$nr."MaximoContratos";
$planMaximoContratos = $aluno->$var;

$valorAcumulado = $planTrade->vlInc;
$contadorTrades = 0;
$contadorGains = 0;

@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Plan Trades Acessar</h5>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="">Ativo:</label><br>
                            <b>{{ $ativo->simbolo." - ".$ativo->nome." - ".$ativo->corretora() }}</b>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Meta Ganho Diário:</label><br>
                            <b>{{ $planMetaGanhoDiario."%" }}</b>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Pontos Contrato Ativo:</label><br>
                            <b>{{ $moeda." ".valorDbForm($planPontosContratoAtivo) }}</b>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Meta Máximo Pontos Ativo:</label><br>
                            <b>{{ $planMetaMaximaPontos }}</b>
                        </div>
                    </div>
                    <div class="row mt-3 align-items-end">
                        <div class="col-md-3 form-group">
                            <label for="">Margem de Garantia por Contrato:</label><br>
                            <b>{{ $moeda." ".valorDbForm($planGarantiaContrato) }}</b>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Limite Ganho Diário:</label><br>
                            <b>{{ $moeda." ".valorDbForm($planLimiteGanhoDia) }}</b>
                        </div>
                        <div class="col-md-3 form-group">
                            <label for="">Máximo Contrato / Máximo $ por Ponto:</label><br>
                            <b>{{ $planMaximoContratos }}</b>
                        </div>
                        <div class="col-md-3 form-group">
                            {{--<a href="{{ route('aluno.planTrade.recalcular', $planTrade->id) }}" class='btn btn-primary'>Recalcular</a>--}}
                            <button type="button" id='btnRecalcular' class="btn btn-primary">Recalcular</button>
                            <a href="{{ route('aluno.planTrade.excluir', $planTrade->id) }}" class="btn btn-danger">Excluir</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <div class="table-responsive" style="max-height: 700px">
                        <table class="table mt-3">
                            <thead>
                                <tr>
                                    <td><b>Data</b></td>
                                    <td><b>Dia Semana</b></td>
                                    <td><b>Meta Dia Anterior</b></td>
                                    <td><b>Meta</b></td>
                                    <td><b>A Realizar</b></td>
                                    <td><b>Risk Managment Planejado</b></td>
                                    <td><b>Pontos Ativo Planejado/Contrato</b></td>
                                    <td><b>Máx. Contratos Ou Máx $ Pontos</b></td>
                                    <td><b>Pontos Ativo/Contrato Realizado</b></td>
                                    <td><b>Realizado Acumulado</b></td>
                                    <td><b>Realizado X Planejado</b></td>
                                    <td><b>Realizado X Planejado Acumulado</b></td>
                                    <td><b>Risk Managment Realizado</b></td>
                                    <td><b>Realizado Liquido</b></td>
                                    <td><b>Realizado</b></td>
                                    <td><b>Custo</b></td>
                                    <td><b>Trades</b></td>
                                    <td><b>Gains</b></td>
                                    <td><b>Losses</b></td>
                                    <td><b>Gain X Losses Diario</b></td>
                                    <td><b>Gain X Losses Acumulado</b></td>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dias as $dia)
                                    @php
                                    $realXPlanDia = null;
                                    $realXPlanAcumulado = null;
                                    $riskRealizado = null;
                                    if(strtotime($dia->dia) <= strtotime($ultimoDiaInsert)){
                                        $contadorTrades += $dia->nrTrades;
                                        $contadorGains += $dia->nrGains;
                                        $realizadoLiquido = $dia->valorRealizado ? round($dia->valorRealizado - $dia->custoRealizado, 2) : 0;
                                        $valorAcumulado += $realizadoLiquido;
                                        $pontosAtivoContrato = round(($realizadoLiquido / $dia->contratosPlanejado) / $planPontosContratoAtivo ,2);
                                        $realXPlanDia = round($realizadoLiquido / $dia->meta * 100, 2)."%";
                                        $realXPlanAcumulado = round($valorAcumulado / $dia->realizar * 100, 2)."%";
                                        $riskRealizado = round($dia->meta / $valorAcumulado * 100, 2)."%";
                                        $gainXLossDiario = $dia->valorRealizado ? round($dia->nrGains / $dia->nrTrades * 100, 2) : null;
                                        $gainXLossAcumulado = $contadorTrades == 0 ? '' : round($contadorGains / $contadorTrades * 100, 2);
                                    }

                                    if($dia->pontosContratoPlanejado > $planMetaMaximaPontos){
                                        $cor = 'red';
                                    }
                                    else{
                                        $cor = '';
                                    }

                                    @endphp
                                    <tr onclick="abrirModal({{ $dia->id }})" style="cursor:pointer;" title="{{ dataDbForm($dia->dia) }}">
                                        <td>{{ dataDbForm($dia->dia) }}</td>
                                        <td>{{ $dia->diaSemana }}</td>
                                        <td>{{ $moeda." ".valorDbForm($dia->metaDiaAnterior) }}</td>
                                        <td>{{ $moeda." ".valorDbForm($dia->meta) }}</td>
                                        <td>{{ $moeda." ".valorDbForm($dia->realizar) }}</td>
                                        <td>{{ $dia->riskMagagmentPlanejado."%" }}</td>
                                        <td style='color:{{ $cor }}'>{{ $dia->pontosContratoPlanejado }}</td>
                                        <td>{{ $dia->contratosPlanejado }}</td>
                                        <td>{{ $dia->valorRealizado ? $pontosAtivoContrato : '' }}</td>
                                        <td>{{ strtotime($dia->dia) <= strtotime($ultimoDiaInsert) ? $moeda." ".valorDbForm($valorAcumulado) : '' }}</td>
                                        <td>{{ $realXPlanDia }}</td>
                                        <td>{{ $realXPlanAcumulado }}</td>
                                        <td>{{ $riskRealizado }}</td>
                                        <td>{{ $dia->valorRealizado  ? $moeda." ".valorDbForm(round($dia->valorRealizado - $dia->custoRealizado,2)) : '' }}</td>
                                        <td>{{ $dia->valorRealizado  ? $moeda." ".valorDbForm($dia->valorRealizado) : '' }}</td>
                                        <td>{{ $dia->valorRealizado  ? $moeda." ".valorDbForm($dia->custoRealizado) : '' }}</td>
                                        <td>{{ $dia->valorRealizado  ? $dia->nrTrades : '' }}</td>
                                        <td>{{ $dia->valorRealizado  ? $dia->nrGains : '' }}</td>
                                        <td>{{ $dia->valorRealizado  ? $dia->nrLoss : '' }}</td>
                                        <td>{{ $dia->valorRealizado ? $gainXLossDiario."%" : "" }}</td>
                                        <td>{{ strtotime($dia->dia) <= strtotime($ultimoDiaInsert) ? $gainXLossAcumulado."%" : "" }}</td>
                                        <td>{{--<button type="button" class="btn btn-sm btn-primary" onclick="abrirModal({{ $dia->id }})">Lançar</button>--}}</td>
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

<!-- Modal de adicionar trade -->
<div class="modal fade" id="modalLancar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form id='formulario' action="{{ route('aluno.planTrade.lancar') }}" method="post">
                <input type="hidden" name="id_planTradeDia" id='modallancar_id'>
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class='card-title'>Lançar</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Valor Realizado:</label>
                                    <input required class="form-control" type="text" name="valorRealizado" id="valorRealizado"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Custo Realizado:</label>
                                    <input required class="form-control" type="text" name="custoRealizado" id="custoRealizado" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <label for="">Nr Trades:</label>
                                    <input required class="form-control" type="number" name="nrTrades" id="nrTrades"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Nr Gains:</label>
                                    <input required class="form-control" type="number" name="nrGains" id="nrGains"/>
                                </div>
                                <div class="col-md-4 form-group">
                                    <label for="">Nr Loss:</label>
                                    <input required class="form-control" type="number" name="nrLoss" id="nrLoss"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function abrirModal(id){
    const myModal = new bootstrap.Modal(document.getElementById('modalLancar'));
    document.getElementById('modallancar_id').value = id;
    $.getJSON(
        "{{ route('aluno.planTrade.buscar.lancado') }}",
        {
            id : id
        },
        function(json){
            console.log(json);
            if(json.controle == 'lancado'){
                document.getElementById('valorRealizado').value = json.valorRealizado;
                document.getElementById('custoRealizado').value = json.custoRealizado;
                document.getElementById('nrTrades').value = json.nrTrades;
                document.getElementById('nrGains').value = json.nrGains;
                document.getElementById('nrLoss').value = json.nrLoss;
            }
            else{
                document.getElementById('valorRealizado').value = '';
                document.getElementById('custoRealizado').value = '';
                document.getElementById('nrTrades').value = '';
                document.getElementById('nrGains').value = '';
                document.getElementById('nrLoss').value = '';
            }
        }
    );
    myModal.show();
}


document.getElementById('btnRecalcular').addEventListener('click', ()=>{
    const myModal = new bootstrap.Modal(document.getElementById('modalRecalcular'));
    myModal.show();
})
</script>

<!-- Modal de adicionar trade -->
<div class="modal fade" id="modalRecalcular" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <form action="{{ route('aluno.planTrade.recalcular') }}" method="post">
                <input type="hidden" name="planTrade_id" value="{{ $planTrade->id }}">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class='card-title'>Recalcular</h5>
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label for="">Data Início:</label>
                                    <input required class="form-control" type="date" name="dtInc" value="{{ $planTrade->dtInc }}"/>
                                </div>
                                <div class="col-md-6 form-group">
                                    <label for="">Valor Início:</label>
                                    <input required class="form-control" type="text" name="vlInc" value="{{ valorDbForm($planTrade->vlInc) }}" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Recalcular</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
