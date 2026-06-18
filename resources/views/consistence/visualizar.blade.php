@extends('layoutAdmin')

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
                <h5 class="card-title">Consistency Diamond Aluno: {{ $aluno->nmAluno." - ".$diamante->mes."/".$diamante->ano }}</h5>
            </div>
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
                            <td> <b>{{ $diamante->sem1Risk }}</b> </td>
                            <td> <b>{{ $diamante->sem2Risk }}</b></td>
                            <td> <b>{{ $diamante->sem3Risk }}</b></td>
                            <td> <b>{{ $diamante->sem4Risk }}</b></td>
                            <td> <b>{{ $diamante->sem5Risk }}</b></td>
                        </tr>
                        <tr>
                            <td style="text-align: left !important;">
                                <button id="btnInfoWeeks" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                    <img src="{{ asset('/public/img/IconsPng/Profitable Weeks.png') }}" height="100px" alt="">
                                </button>
                                <b>Profitable Weeks</b>
                            </td>
                            <td> <b>{{ $diamante->sem1Weeks }}</b> </td>
                            <td> <b>{{ $diamante->sem2Weeks }}</b> </td>
                            <td> <b>{{ $diamante->sem3Weeks }}</b> </td>
                            <td> <b>{{ $diamante->sem4Weeks }}</b> </td>
                            <td> <b>{{ $diamante->sem5Weeks }}</b> </td>
                        </tr>
                        <tr>
                            <td style="text-align: left !important;">
                                <button id="btnInfoMonths" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                    <img src="{{ asset('/public/img/IconsPng/Profitable Months.png') }}" height="100px" alt="">
                                </button>
                                <b>Profitable Months</b>
                            </td>
                            <td> <b>{{ $diamante->sem1Months }}</b> </td>
                            <td> <b>{{ $diamante->sem2Months }}</b> </td>
                            <td> <b>{{ $diamante->sem3Months }}</b> </td>
                            <td> <b>{{ $diamante->sem4Months }}</b> </td>
                            <td> <b>{{ $diamante->sem5Months }}</b> </td>
                        </tr>
                        <tr>
                            <td style="text-align: left !important;">
                                <button id="btnInfoGainsLosses" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                    <img src="{{ asset('/public/img/IconsPng/Gains X Losses.png') }}" height="100px" alt="">
                                </button>
                                <b>Gains X Losses</b>
                            </td>
                            <td> <b>{{ $diamante->sem1GainLoss }}</b> </td>
                            <td> <b>{{ $diamante->sem2GainLoss }}</b> </td>
                            <td> <b>{{ $diamante->sem3GainLoss }}</b> </td>
                            <td> <b>{{ $diamante->sem4GainLoss }}</b> </td>
                            <td> <b>{{ $diamante->sem5GainLoss }}</b> </td>
                        </tr>
                        <tr>
                            <td style="text-align: left !important;">
                                <button id="btnInfoTrade" style="background-color: rgba(0,0,0,0.0);border:none; margin-right: 20px;" type="button" name="button">
                                    <img src="{{ asset('/public/img/IconsPng/Trade Plan Compliance.png') }}" height="100px" alt="">
                                </button>
                                <b>Trade Plan Cumpliance</b>
                            </td>
                            <td> <b>{{ $diamante->sem1TradePlan }}</b> </td>
                            <td> <b>{{ $diamante->sem2TradePlan }}</b> </td>
                            <td> <b>{{ $diamante->sem3TradePlan }}</b> </td>
                            <td> <b>{{ $diamante->sem4TradePlan }}</b> </td>
                            <td> <b>{{ $diamante->sem5TradePlan }}</b> </td>
                        </tr>
                        @php
                        $lapidacao1 = $diamante->sem1Risk + $diamante->sem1Weeks + $diamante->sem1Months + $diamante->sem1GainLoss + $diamante->sem1TradePlan;
                        $lapidacao2 = $diamante->sem2Risk + $diamante->sem2Weeks + $diamante->sem2Months + $diamante->sem2GainLoss + $diamante->sem2TradePlan;
                        $lapidacao3 = $diamante->sem3Risk + $diamante->sem3Weeks + $diamante->sem3Months + $diamante->sem3GainLoss + $diamante->sem3TradePlan;
                        $lapidacao4 = $diamante->sem4Risk + $diamante->sem4Weeks + $diamante->sem4Months + $diamante->sem4GainLoss + $diamante->sem4TradePlan;
                        $lapidacao5 = $diamante->sem5Risk + $diamante->sem5Weeks + $diamante->sem5Months + $diamante->sem5GainLoss + $diamante->sem5TradePlan;
                        @endphp
                        <tr>
                            <td><b>Nível de Lapidação</b></td>
                            <td style='font-size: 60px !important'><b>{{ $lapidacao1 }}</b></td>
                            <td style='font-size: 60px !important'><b>{{ $lapidacao2 }}</b></td>
                            <td style='font-size: 60px !important'><b>{{ $lapidacao3 }}</b></td>
                            <td style='font-size: 60px !important'><b>{{ $lapidacao4 }}</b></td>
                            <td style='font-size: 60px !important'><b>{{ $lapidacao5 }}</b></td>
                        </tr>
                        <tr>
                            <td><b>Fase</b></td>
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
