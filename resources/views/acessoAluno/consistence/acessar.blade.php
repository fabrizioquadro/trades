@extends('layoutAluno')

@section('conteudo')
<style media="screen">
table, tr, td, th{
    font-size: 18px !important;
    vertical-align: middle !important;
    text-align: center !important;
    text-transform: none !important;
}
.form-control{
    width: 70px !important;
    font-size: 35px !important;
    margin: auto !important;
}

.form-control option {
    text-align: center;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Consistency Diamond: {{ $diamante->mes."/".$diamante->ano }}</h5>
            </div>
            <form action="{{ route('aluno.consistence.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $diamante->id }}">
                <div class="row justify-content-md-center">
                    <div class="col-md-10">
                        <table class="table">
                            <tr>
                                <td></td>
                                <td><b>Semana 1</b></td>
                                <td><b>Semana 2</b></td>
                                <td><b>Semana 3</b></td>
                                <td><b>Semana 4</b></td>
                                <td><b>Semana 5</b></td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important;">
                                    <button id="btnInfoRiskReword" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                        <img src="{{ asset('/public/img/IconsPng/Risk Reward.png') }}" height="100px" alt="">
                                    </button>
                                    <b>Risk X Reward</b>
                                </td>
                                <td>
                                    <select name="sem1Risk" id="sem1Risk" class="form-control">
                                        <option @if($diamante->sem1Risk == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem1Risk == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem1Risk == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem1Risk == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem1Risk == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem1Risk == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem2Risk" id="sem2Risk" class="form-control">
                                        <option @if($diamante->sem2Risk == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem2Risk == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem2Risk == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem2Risk == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem2Risk == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem2Risk == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem3Risk" id="sem3Risk" class="form-control">
                                        <option @if($diamante->sem3Risk == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem3Risk == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem3Risk == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem3Risk == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem3Risk == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem3Risk == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem4Risk" id="sem4Risk" class="form-control">
                                        <option @if($diamante->sem4Risk == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem4Risk == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem4Risk == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem4Risk == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem4Risk == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem4Risk == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem5Risk" id="sem5Risk" class="form-control">
                                        <option @if($diamante->sem5Risk == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem5Risk == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem5Risk == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem5Risk == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem5Risk == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem5Risk == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important;">
                                    <button id="btnInfoWeeks" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                        <img src="{{ asset('/public/img/IconsPng/Profitable Weeks.png') }}" height="100px" alt="">
                                    </button>
                                    <b>Profitable Weeks</b>
                                </td>
                                <td>
                                    <select name="sem1Weeks" id="sem1Weeks" class="form-control">
                                        <option @if($diamante->sem1Weeks == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem1Weeks == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem1Weeks == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem1Weeks == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem1Weeks == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem1Weeks == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem2Weeks" id="sem2Weeks" class="form-control">
                                        <option @if($diamante->sem2Weeks == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem2Weeks == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem2Weeks == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem2Weeks == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem2Weeks == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem2Weeks == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem3Weeks" id="sem3Weeks" class="form-control">
                                        <option @if($diamante->sem3Weeks == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem3Weeks == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem3Weeks == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem3Weeks == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem3Weeks == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem3Weeks == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem4Weeks" id="sem4Weeks" class="form-control">
                                        <option @if($diamante->sem4Weeks == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem4Weeks == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem4Weeks == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem4Weeks == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem4Weeks == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem4Weeks == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem5Weeks" id="sem5Weeks" class="form-control">
                                        <option @if($diamante->sem5Weeks == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem5Weeks == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem5Weeks == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem5Weeks == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem5Weeks == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem5Weeks == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important;">
                                    <button id="btnInfoMonths" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                        <img src="{{ asset('/public/img/IconsPng/Profitable Months.png') }}" height="100px" alt="">
                                    </button>
                                    <b>Profitable Months</b>
                                </td>
                                <td>
                                    <select name="sem1Months" id="sem1Months" class="form-control">
                                        <option @if($diamante->sem1Months == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem1Months == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem1Months == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem1Months == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem1Months == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem1Months == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem2Months" id="sem2Months" class="form-control">
                                        <option @if($diamante->sem2Months == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem2Months == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem2Months == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem2Months == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem2Months == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem2Months == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem3Months" id="sem3Months" class="form-control">
                                        <option @if($diamante->sem3Months == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem3Months == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem3Months == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem3Months == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem3Months == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem3Months == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem4Months" id="sem4Months" class="form-control">
                                        <option @if($diamante->sem4Months == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem4Months == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem4Months == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem4Months == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem4Months == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem4Months == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem5Months" id="sem5Months" class="form-control">
                                        <option @if($diamante->sem5Months == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem5Months == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem5Months == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem5Months == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem5Months == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem5Months == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important;">
                                    <button id="btnInfoGainsLosses" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                        <img src="{{ asset('/public/img/IconsPng/Gains X Losses.png') }}" height="100px" alt="">
                                    </button>
                                    <b>Gains X Losses</b>
                                </td>
                                <td>
                                    <select name="sem1GainLoss" id="sem1GainLoss" class="form-control">
                                        <option @if($diamante->sem1GainLoss == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem1GainLoss == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem1GainLoss == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem1GainLoss == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem1GainLoss == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem1GainLoss == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem2GainLoss" id="sem2GainLoss" class="form-control">
                                        <option @if($diamante->sem2GainLoss == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem2GainLoss == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem2GainLoss == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem2GainLoss == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem2GainLoss == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem2GainLoss == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem3GainLoss" id="sem3GainLoss" class="form-control">
                                        <option @if($diamante->sem3GainLoss == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem3GainLoss == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem3GainLoss == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem3GainLoss == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem3GainLoss == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem3GainLoss == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem4GainLoss" id="sem4GainLoss" class="form-control">
                                        <option @if($diamante->sem4GainLoss == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem4GainLoss == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem4GainLoss == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem4GainLoss == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem4GainLoss == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem4GainLoss == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem5GainLoss" id="sem4GainLoss" class="form-control">
                                        <option @if($diamante->sem5GainLoss == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem5GainLoss == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem5GainLoss == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem5GainLoss == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem5GainLoss == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem5GainLoss == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td style="text-align: left !important;">
                                    <button id="btnInfoTrade" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                        <img src="{{ asset('/public/img/IconsPng/Trade Plan Compliance.png') }}" height="100px" alt="">
                                    </button>
                                    <b>Trade Plan Compliance</b>
                                </td>
                                <td>
                                    <select name="sem1TradePlan" id="sem1TradePlan" class="form-control">
                                        <option @if($diamante->sem1TradePlan == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem1TradePlan == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem1TradePlan == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem1TradePlan == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem1TradePlan == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem1TradePlan == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem2TradePlan" id="sem2TradePlan" class="form-control">
                                        <option @if($diamante->sem2TradePlan == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem2TradePlan == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem2TradePlan == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem2TradePlan == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem2TradePlan == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem2TradePlan == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem3TradePlan" id="sem3TradePlan" class="form-control">
                                        <option @if($diamante->sem3TradePlan == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem3TradePlan == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem3TradePlan == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem3TradePlan == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem3TradePlan == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem3TradePlan == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem4TradePlan" id="sem4TradePlan" class="form-control">
                                        <option @if($diamante->sem4TradePlan == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem4TradePlan == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem4TradePlan == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem4TradePlan == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem4TradePlan == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem4TradePlan == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                                <td>
                                    <select name="sem5TradePlan" id="sem5TradePlan" class="form-control">
                                        <option @if($diamante->sem5TradePlan == '0') selected @endif value="0">0</option>
                                        <option @if($diamante->sem5TradePlan == '5') selected @endif value="5">5</option>
                                        <option @if($diamante->sem5TradePlan == '10') selected @endif value="10">10</option>
                                        <option @if($diamante->sem5TradePlan == '15') selected @endif value="15">15</option>
                                        <option @if($diamante->sem5TradePlan == '20') selected @endif value="20">20</option>
                                        <option @if($diamante->sem5TradePlan == '25') selected @endif value="25">25</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan='6' style="text-align:right !important">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <a href="{{ route('aluno.consistence.excluir', $diamante->id) }}" class='btn btn-danger'>Excluir</a>
                                </td>
                            </tr>
                            @php
                            $lapidacao1 = $diamante->sem1Risk + $diamante->sem1Weeks + $diamante->sem1Months + $diamante->sem1GainLoss + $diamante->sem1TradePlan;
                            $lapidacao2 = $diamante->sem2Risk + $diamante->sem2Weeks + $diamante->sem2Months + $diamante->sem2GainLoss + $diamante->sem2TradePlan;
                            $lapidacao3 = $diamante->sem3Risk + $diamante->sem3Weeks + $diamante->sem3Months + $diamante->sem3GainLoss + $diamante->sem3TradePlan;
                            $lapidacao4 = $diamante->sem4Risk + $diamante->sem4Weeks + $diamante->sem4Months + $diamante->sem4GainLoss + $diamante->sem4TradePlan;
                            $lapidacao5 = $diamante->sem5Risk + $diamante->sem5Weeks + $diamante->sem5Months + $diamante->sem5GainLoss + $diamante->sem5TradePlan;
                            @endphp
                            <tr>
                                <td style='font-size: 35px !important'><b>Nível de Lapidação</b></td>
                                <td style='font-size: 60px !important'><b>{{ $lapidacao1 }}</b></td>
                                <td style='font-size: 60px !important'><b>{{ $lapidacao2 }}</b></td>
                                <td style='font-size: 60px !important'><b>{{ $lapidacao3 }}</b></td>
                                <td style='font-size: 60px !important'><b>{{ $lapidacao4 }}</b></td>
                                <td style='font-size: 60px !important'><b>{{ $lapidacao5 }}</b></td>
                            </tr>
                            <tr>
                                <td style='font-size: 35px !important'><b>Fase</b></td>
                                <td>
                                    @if($lapidacao1 > 0)
                                        @foreach($fases as $fase)
                                            @if($lapidacao1 >= $fase->vlInc && $lapidacao1 <= $fase->vlFn)
                                                <button title="{{ $fase->nmFase }}" onclick="mostraDetalhesFase({{ $fase->id }})" style="background-color: rgba(0,0,0,0.0);border:none;" type="button" name="button">
                                                    <img src="{{ asset('/public/img/IconsPng/'.$fase->icone) }}" height="100px" alt="">
                                                </button>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($lapidacao2 > 0)
                                        @foreach($fases as $fase)
                                            @if($lapidacao2 >= $fase->vlInc && $lapidacao2 <= $fase->vlFn)
                                                <button title="{{ $fase->nmFase }}" onclick="mostraDetalhesFase({{ $fase->id }})" style="background-color: rgba(0,0,0,0.0);border:none;" type="button" name="button">
                                                    <img src="{{ asset('/public/img/IconsPng/'.$fase->icone) }}" height="100px" alt="">
                                                </button>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($lapidacao3 > 0)
                                        @foreach($fases as $fase)
                                            @if($lapidacao3 >= $fase->vlInc && $lapidacao3 <= $fase->vlFn)
                                                <button title="{{ $fase->nmFase }}" onclick="mostraDetalhesFase({{ $fase->id }})" style="background-color: rgba(0,0,0,0.0);border:none;" type="button" name="button">
                                                    <img src="{{ asset('/public/img/IconsPng/'.$fase->icone) }}" height="100px" alt="">
                                                </button>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($lapidacao4 > 0)
                                        @foreach($fases as $fase)
                                            @if($lapidacao4 >= $fase->vlInc && $lapidacao4 <= $fase->vlFn)
                                                <button title="{{ $fase->nmFase }}" onclick="mostraDetalhesFase({{ $fase->id }})" style="background-color: rgba(0,0,0,0.0);border:none;" type="button" name="button">
                                                    <img src="{{ asset('/public/img/IconsPng/'.$fase->icone) }}" height="100px" alt="">
                                                </button>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($lapidacao5 > 0)
                                        @foreach($fases as $fase)
                                            @if($lapidacao5 >= $fase->vlInc && $lapidacao5 <= $fase->vlFn)
                                                <button title="{{ $fase->nmFase }}" onclick="mostraDetalhesFase({{ $fase->id }})" style="background-color: rgba(0,0,0,0.0);border:none;" type="button" name="button">
                                                    <img src="{{ asset('/public/img/IconsPng/'.$fase->icone) }}" height="100px" alt="">
                                                </button>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
    function mostraDetalhesFase(fase_id){
        $.getJSON(
            "{{ route('aluno.consistence.detalhesFase') }}",
            {
                fase_id : fase_id
            },
            function(json){
                document.getElementById('modalFase_nome').innerHTML = json.nome;
                document.getElementById('modalFase_dados').innerHTML = json.dados;
                const myModal = new bootstrap.Modal(document.getElementById('modalFase'));
                myModal.show();
            }
        );
    }
    </script>
    <!-- Modal de adicionar Info -->
    <div class="modal fade" id="modalFase" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 id='modalFase_nome' class="card-title"></h5>
                            <div class="row">
                                <div class="col-md-12" id="modalFase_dados">

                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 form-group">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
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
            <h5 class="card-title">Gráfico</h5>
            <div id="radarChart"></div>
            <script>
            var labelColor = "#ffffff";
            var legendColor = "#ffffff";
            var borderColor = "#696969";
            var series1 = "#00ffff";
            var series2 = "#ffffff";
            var series3 = "#ffff00";
            var series4 = "#ffa500";
            var series5 = "#ff0000";
            const radarChartEl = document.querySelector('#radarChart'),
                radarChartConfig = {
                    chart: {
                        height: 800,
                        type: 'radar',
                        toolbar: {
                            show: false
                        },
                        dropShadow: {
                            enabled: false,
                            blur: 8,
                            left: 1,
                            top: 1,
                            opacity: 0.2
                        }
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        labels: {
                            colors: legendColor,
                            useSeriesColors: false
                        }
                    },
                    plotOptions: {
                        radar: {
                            polygons: {
                                strokeColors: borderColor,
                                connectorColors: borderColor
                            }
                        }
                    },
                    yaxis: {
                        show: true,
                        min: 0,
                        max:25,
                        stepSize: 5,
                        tickAmount: 5,
                        labels: {
                            show: true,
                            align: 'right',
                            minWidth: 0,
                            maxWidth: 160,
                            style: {
                                colors: [labelColor,labelColor,labelColor,labelColor,labelColor,labelColor],
                                fontSize: '14px',
                                fontFamily: 'sans-serif',
                                fontWeight: 700,
                                cssClass: 'apexcharts-yaxis-label',
                            }
                        }
                    },
                    series: [
                        @php
                        for($i=1 ; $i<=5 ; $i++){
                            $varLap = "lapidacao".$i;
                            $lapidacao = $$varLap;
                            if($lapidacao > 0){
                                $semRisk = 'sem'.$i.'Risk';
                                $semWeeks = 'sem'.$i.'Weeks';
                                $semMonths = 'sem'.$i.'Months';
                                $semGainLoss = 'sem'.$i.'GainLoss';
                                $semTradePlan = 'sem'.$i.'TradePlan';
                                @endphp
                                {
                                    name: 'Semana {{ $i }}',
                                    data: [{{ $diamante->$semRisk }},{{ $diamante->$semWeeks }},{{ $diamante->$semMonths }},{{ $diamante->$semGainLoss }},{{ $diamante->$semTradePlan }}]
                                },
                                @php
                            }
                        }
                        @endphp
                    ],
                    colors: [series1, series2, series3, series4, series5],
                    xaxis: {
                        categories: ['Risk X Reward', 'Profitable Weeks', 'Profitable Months', 'Gains X Losses', 'Trade Plan Cumpliance'],
                        labels: {
                            show: true,
                            style: {
                                colors: [labelColor, labelColor, labelColor, labelColor, labelColor, labelColor, labelColor, labelColor],
                                fontSize: '15px',
                                fontFamily: 'sans-serif'
                            }
                        }
                    },
                    fill: {
                        opacity: [1, 0.8]
                    },
                    stroke: {
                        show: false,
                        width: 0
                    },
                    markers: {
                        size: 0
                    },
                    grid: {
                        show: false,
                        padding: {
                            top: -20,
                            bottom: -20
                        }
                    }
                };
                if (typeof radarChartEl !== undefined && radarChartEl !== null) {
                    const radarChart = new ApexCharts(radarChartEl, radarChartConfig);
                    radarChart.render();
                }
            </script>
        </div>
    </div>
</div>

<script>

document.getElementById('btnInfoRiskReword').addEventListener('click', ()=>{
    nome = "Risk X Reword";
    dados = '{!! $info->riskReward !!}';

    document.getElementById('modalInfo_nome').innerHTML = nome;
    document.getElementById('modalInfo_dados').innerHTML = dados;

    const myModal = new bootstrap.Modal(document.getElementById('modalInfo'));
    myModal.show();
})

document.getElementById('btnInfoWeeks').addEventListener('click', ()=>{
    nome = "Profitable Weeks";
    dados = '{!! $info->weeks !!}';

    document.getElementById('modalInfo_nome').innerHTML = nome;
    document.getElementById('modalInfo_dados').innerHTML = dados;

    const myModal = new bootstrap.Modal(document.getElementById('modalInfo'));
    myModal.show();
})

document.getElementById('btnInfoMonths').addEventListener('click', ()=>{
    nome = "Profitable Months";
    dados = '{!! $info->months !!}';

    document.getElementById('modalInfo_nome').innerHTML = nome;
    document.getElementById('modalInfo_dados').innerHTML = dados;

    const myModal = new bootstrap.Modal(document.getElementById('modalInfo'));
    myModal.show();
})

document.getElementById('btnInfoGainsLosses').addEventListener('click', ()=>{
    nome = "Gains X Losses";
    dados = '{!! $info->gainsLosses !!}';

    document.getElementById('modalInfo_nome').innerHTML = nome;
    document.getElementById('modalInfo_dados').innerHTML = dados;

    const myModal = new bootstrap.Modal(document.getElementById('modalInfo'));
    myModal.show();
})

document.getElementById('btnInfoTrade').addEventListener('click', ()=>{
    nome = "Trade Plan Cumpliance";
    dados = '{!! $info->trades !!}';

    document.getElementById('modalInfo_nome').innerHTML = nome;
    document.getElementById('modalInfo_dados').innerHTML = dados;

    const myModal = new bootstrap.Modal(document.getElementById('modalInfo'));
    myModal.show();
})

</script>

<!-- Modal de adicionar Info -->
<div class="modal fade" id="modalInfo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <h5 id='modalInfo_nome' class="card-title"></h5>
                        <div class="row">
                            <div class="col-md-12" id="modalInfo_dados">

                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12 form-group">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
