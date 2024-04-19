@extends('layoutAluno')

@section('conteudo')
@php
if($vlSaldo >= $conta->vlContaInc){
    $classeSaldo = "success";
    $iconeSaldo = "up";
}
else{
    $classeSaldo = "danger";
    $iconeSaldo = "down";
}
$saldoPorcentagem = round((abs($vlSaldo - $conta->vlContaInc) * 100 / $conta->vlContaInc), 2);

if($drawndownCapIncAtual >= 0){
    $classeCPInc = "success";
    $iconeCPInc = "up";
}
else{
    $classeCPInc = "danger";
    $iconeCPInc = "down";
}
$porcentagemCPInc = round(($drawndownCapIncAtual * 100 / $conta->vlContaInc), 2);

if($drawndownCapMaxAtual >= 0){
    $classeCPMax = "success";
    $iconeCPMax = "up";
}
else{
    $classeCPMax = "danger";
    $iconeCPMax = "down";
}
$porcentagemCPMax = round(($drawndownCapMaxAtual * 100 / $capitalMaximo), 2);


@endphp
<style media="screen">
    tr, td, th {
        font-size: 12px !important;
    }
</style>
<form id='formulario' action="{{ route('exportarDadosPdf') }}" target='_blank' method="post">
    @csrf
    <input type="hidden" name="dados" id='formulario_dados'>
    <input type="hidden" name="titulo" value="Extrato Conta: {{ $conta->nmConta }}">
</form>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Extrato Conta : {{ $conta->nmConta }}</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <button type="button" id="btnImprimir" class='btn btn-sm btn-warning'>Imprimir</button>
                </div>
            </div>
            <div id="divDados">
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="card-title">Posições Atuais</h6>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="avatar me-3">
                                                <div class="avatar-initial bg-label-{{ $classeSaldo }} rounded">
                                                    <i class="mdi mdi-currency-usd mdi-24px"> </i>
                                                </div>
                                            </div>
                                            <div class="card-info">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="mb-0">{{ $moeda." ".valorDbForm($vlSaldo) }}</h4>
                                                    <i class="mdi mdi-chevron-{{ $iconeSaldo }} text-{{ $classeSaldo }} mdi-24px"></i>
                                                    <small class="text-{{ $classeSaldo }}">{{ $saldoPorcentagem }}%</small>
                                                </div>
                                                <small>Saldo</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="avatar me-3">
                                                <div class="avatar-initial bg-label-success rounded">
                                                    <i class="mdi mdi-plus mdi-24px"> </i>
                                                </div>
                                            </div>
                                            <div class="card-info">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="mb-0">{{ $moeda." ".valorDbForm($totalDepositos) }}</h4>
                                                </div>
                                                <small>Depósitos</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="avatar me-3">
                                                <div class="avatar-initial bg-label-danger rounded">
                                                    <i class="mdi mdi-minus mdi-24px"> </i>
                                                </div>
                                            </div>
                                            <div class="card-info">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="mb-0">{{ $moeda." ".valorDbForm($totalSaques) }}</h4>
                                                </div>
                                                <small>Saques</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="avatar me-3">
                                                <div class="avatar-initial bg-label-info rounded">
                                                    <i class="mdi mdi-cash-multiple mdi-24px"> </i>
                                                </div>
                                            </div>
                                            <div class="card-info">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="mb-0">{{ $moeda." ".valorDbForm($capitalMaximo) }}</h4>
                                                </div>
                                                <small>Capital Máximo</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="avatar me-3">
                                                <div class="avatar-initial bg-label-{{ $classeCPMax }} rounded">
                                                    <i class="mdi mdi-currency-usd mdi-24px"> </i>
                                                </div>
                                            </div>
                                            <div class="card-info">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="mb-0">{{ $moeda." ".valorDbForm($drawndownCapMaxAtual) }}</h4>
                                                    <i class="mdi mdi-chevron-{{ $iconeCPMax }} text-{{ $classeCPMax }} mdi-24px"></i>
                                                    <small class="text-{{ $classeCPMax }}">{{ $porcentagemCPMax }}%</small>
                                                </div>
                                                <small>Drawndown Capital Máximo</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center flex-wrap gap-2">
                                            <div class="avatar me-3">
                                                <div class="avatar-initial bg-label-{{ $classeCPInc }} rounded">
                                                    <i class="mdi mdi-currency-usd mdi-24px"> </i>
                                                </div>
                                            </div>
                                            <div class="card-info">
                                                <div class="d-flex align-items-center">
                                                    <h4 class="mb-0">{{ $moeda." ".valorDbForm($drawndownCapIncAtual) }}</h4>
                                                    <i class="mdi mdi-chevron-{{ $iconeCPInc }} text-{{ $classeCPInc }} mdi-24px"></i>
                                                    <small class="text-{{ $classeCPInc }}">{{ $porcentagemCPInc }}%</small>
                                                </div>
                                                <small>Drawndown Capital Inicial</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h6 class="card-title">Extrato</h6>
                        <div class="table-responsive">
                            <table class='table'>
                                <thead>
                                    <tr>
                                        <td><b>Data</b></td>
                                        <td><b>Descrição</b></td>
                                        <td><b>Tipo</b></td>
                                        <td><b>Valor</b></td>
                                        <td><b>Saldo</b></td>
                                        <td><b>Drawdown Inicial</b></td>
                                        {{--<td><b>Drawdown Máximo</b></td>--}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($array_extrato as $extrato)
                                        @php
                                        if($extrato[1] != "Saque" && $extrato[1] != "Depósito"){
                                            $drawndownCapInc = $extrato[5] - $conta->vlContaInc;
                                            if($drawndownCapInc > 0){
                                                $drawndownCapInc = 0;
                                            }
                                            $drawndownCapMax = $extrato[5] - $capitalMaximo;

                                            if($drawndownCapInc >= 0){
                                                $classeCapInc = "text-success";
                                            }
                                            else{
                                                $classeCapInc = "text-danger";
                                            }

                                            if($drawndownCapMax >= 0){
                                                $classeCapMax = "text-success";
                                            }
                                            else{
                                                $classeCapMax = "text-danger";
                                            }

                                            $drawndownCapInc = $moeda." ".valorDbForm($drawndownCapInc);
                                            $drawndownCapMax = $moeda." ".valorDbForm($drawndownCapMax);

                                        }
                                        else{
                                            $drawndownCapInc = '';
                                            $drawndownCapMax = '';
                                            $classeCapInc = '';
                                            $classeCapMax = '';
                                        }

                                        $varData = dataFormDb($extrato[0]);
                                        if(strtotime($varData) >= strtotime($dtIncExtrato)){
                                            if($controleInicio){
                                                @endphp
                                                <tr>
                                                    <td colspan='4'>Saldo Anterior</td>
                                                    <td>{{ $saldoAnterior }}</td>
                                                    <td></td>
                                                    <td></td>
                                                </tr>
                                                @php
                                            }
                                            $controleInicio = false;
                                            @endphp
                                            <tr>
                                                <td>{{ $extrato[0] }}</td>
                                                <td>{{ $extrato[1] }}</td>
                                                <td>{{ $extrato[2] }}</td>
                                                <td>{{ $extrato[3] }}</td>
                                                <td>{{ $extrato[4] }}</td>
                                                <td class='{{ $classeCapInc }}'>{{ $drawndownCapInc }}</td>
                                                {{--<td class='{{ $classeCapMax }}'>{{ $drawndownCapMax }}</td>--}}
                                            </tr>
                                            @php
                                        }
                                        $saldoAnterior = $extrato[4];
                                        @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('btnImprimir').addEventListener('click', ()=>{
    document.getElementById('formulario_dados').value = document.getElementById('divDados').innerHTML;
    document.getElementById('formulario').submit();
})
</script>
@endsection
