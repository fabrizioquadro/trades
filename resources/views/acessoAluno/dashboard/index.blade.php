@extends('layoutAluno')

@section('conteudo')
@php
if($aluno->moedaBase == "BRL"){
    $multiplicador = 'cotacaoBRL';
    $moedaBase = "R$";
}
elseif($aluno->moedaBase == "USD"){
    $multiplicador = 'cotacaoUSD';
    $moedaBase = "US$";
}
elseif($aluno->moedaBase == "EUR"){
    $multiplicador = 'cotacaoEUR';
    $moedaBase = "€";
}
elseif($aluno->moedaBase == "GBP"){
    $multiplicador = 'cotacaoGBP';
    $moedaBase = "£";
}
elseif($aluno->moedaBase == "JPY"){
    $multiplicador = 'cotacaoJPY';
    $moedaBase = "¥$";
}
@endphp

<style>
    .dropdown-menu{
        z-index: 10000000;
    }

    .font-geral{
        font-size: 16px !important;
    }
</style>

<style media="screen">
    h5{
        font-weight: 900;
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    {!! $filtroHtml !!}
    <div class="row">
        <div class="col-lg-4 col-sm-12 mt-3">
            <div class="card" style='height: 100%'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Geral</h5>
                        <img src="{{ asset('/public/img/IconsPng/Risk Reward.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <p class="mb-0 fontSize25" style="color: red;">Risk</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-center fontSize12">{{ $resultadosGerais['risk_reward_1'] }}</h4>
                        </div>
                        <div class="col-2">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-end pe-lg-0 pe-xl-2">
                            <div class="d-flex gap-2 justify-content-end align-items-center justify-content-center mb-2">
                                <p class="mb-0 fontSize25" style='color: #4472c4'>Reward</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-center fontSize12">{{ $resultadosGerais['risk_reward_2'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mt-3">
            <div class="card" style='height: 100%'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Tendência</h5>
                        <img src="{{ asset('/public/img/IconsPng/Risk Reward Tendencia.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <p class="mb-0 fontSize25" style="color: red;">Risk</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-center fontSize12">{{ $resultadosTendencia['risk_reward_1'] }}</h4>
                        </div>
                        <div class="col-2">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-end pe-lg-0 pe-xl-2">
                            <div class="d-flex gap-2 justify-content-end align-items-center justify-content-center mb-2">
                                <p class="mb-0 fontSize25" style='color: #4472c4'>Reward</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-center fontSize12">{{ $resultadosTendencia['risk_reward_2'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-sm-12 mt-3">
            <div class="card" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Contra-Tendência</h5>
                        <img src="{{ asset('/public/img/IconsPng/Risk Reward ContraTendencia.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="row mt-3">
                        <div class="col-5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <p class="mb-0 fontSize25" style="color: red;">Risk</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-center fontSize12">{{ $resultadosContraTendencia['risk_reward_1'] }}</h4>
                        </div>
                        <div class="col-2">
                            <div class="divider divider-vertical">
                                <div class="divider-text">
                                    <span class="badge-divider-bg bg-label-secondary">VS</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-5 text-end pe-lg-0 pe-xl-2">
                            <div class="d-flex justify-content-end align-items-center justify-content-center mb-2">
                                <p class="mb-0 fontSize25" style='color: #4472c4'>Reward</p>
                            </div>
                            <h4 class="mb-0 pt-1 text-center fontSize12">{{ $resultadosContraTendencia['risk_reward_2'] }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5>Taxa de Acerto Geral</h5>
                        <img src="{{ asset('/public/img/IconsPng/Gains X Losses.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <div id="txAcertosGeral"></div>
                        <script>
                        var options = {
                            chart: {
                                height: 280,
                                type: "radialBar"
                            },
                            series: [{{ $resultadosGerais['txAcertos'] }}],
                            colors: ["#26c6f9"],
                            plotOptions: {
                                radialBar: {
                                    hollow: {
                                        margin: 0,
                                        size: "40%"
                                    },
                                    dataLabels: {
                                        showOn: "always",
                                        name: {
                                            offsetY: -10,
                                            show: false,
                                            color: "#636578",
                                            fontSize: "13px"
                                        },
                                        value: {
                                            offsetY: 10,
                                            color: "#fff",
                                            fontSize: "30px",
                                            show: true
                                        }
                                    }
                                }
                            },
                            stroke: {
                                lineCap: "round",
                            },
                            labels: ["Progress"]
                        };
                        var txAcertosGeral = new ApexCharts(document.querySelector("#txAcertosGeral"), options);
                        txAcertosGeral.render();
                        </script>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">

                    <div class="card" style="height: 47% !important">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center" style="height: 100%">
                                <img src="{{ asset('/public/img/IconsPng/Taxa Acertos Tendencia.png') }}" style="height: 60px" alt="">
                                <h3>{{ $resultadosTendencia['txAcertos'] }} %</h3>
                                <h5 class="text-center">Taxa Acertos <br> Tendência</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-3" style="height: 47% !important">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center" style="height: 100%">
                                <img src="{{ asset('/public/img/IconsPng/Taxa Acertos ContraTendencia.png') }}" style="height: 60px" alt="">
                                <h3>{{ $resultadosContraTendencia['txAcertos'] }} %</h3>
                                <h5 class="text-center">Taxa Acertos <br> Contra-Tendência</h5>
                            </div>
                        </div>
                    </div>


        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            @php
            $despesasXgainsLosses = $resultadosGerais['netProfitGrossLoss'] > 0 ? round($resultadosGerais['despesas'] * 100 / $resultadosGerais['netProfitGrossLoss'], 2) : '0';
            @endphp
            <div class="col-12" style="height: 100% !important">
                <div class="row" style="height: 48% !important">
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Financeiro.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosGerais['netProfitGrossLoss']) }}</h3>
                                </div>
                                <h5 class="text-center">Net Profit<br>Gross Loss</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Despesas.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosGerais['despesas']) }}</h3>
                                </div>
                                <h5 class="text-center">Despesas</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" style="height: 48% !important">
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Dias Operados.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $dias }}</h3>
                                </div>
                                <h5 class="text-center">Dias<br>Operados</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Despesas.png') }}" style="height: 60px" alt="">
                                    <h3>{{ valorDbForm($despesasXgainsLosses) }}%</h3>
                                </div>
                                <h5 class="text-center">% Despesas <br> Gains X Losses</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @php
        $porcAcertoCompra = $qtOperacaoCompra > 0 ? round($qtOperacaoCompraGain * 100 / $qtOperacaoCompra,2) : 0;
        $porcAcertoVenda = $qtOperacaoVenda > 0 ? round($qtOperacaoVendaGain * 100 / $qtOperacaoVenda,2) : 0;

        @endphp
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="col-12" style="height: 100% !important">
                <div class="row" style="height: 48% !important">
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Compra.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $qtOperacaoCompra }}</h3>
                                </div>
                                <h5 class="text-center">Quantidade<br> Operações de Compra</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Acertos.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $porcAcertoCompra }} %</h3>
                                </div>
                                <h5 class="text-center">% Acertos <br> Operações de Compra</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" style="height: 48% !important">
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Venda.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $qtOperacaoVenda }}</h3>
                                </div>
                                <h5 class="text-center">Quantidade <br> Operações de Venda</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Acertos.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $porcAcertoVenda }} %</h3>
                                </div>
                                <h5 class="text-center">% Acertos <br> Operações de Venda</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card">
                <div class="card-body">
                    <h5 class='text-center'>% Acertos Fase </h5>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('/public/img/IconsPng/Fase 01.png') }}" style="height: 60px; margin-right: 20px" alt="">
                                <h2>{{ $porcAcertoFase1 }} %</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('/public/img/IconsPng/Fase 02.png') }}" style="height: 60px; margin-right: 20px" alt="">
                                <h2>{{ $porcAcertoFase2 }} %</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-5">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('/public/img/IconsPng/Fase 03.png') }}" style="height: 60px; margin-right: 20px" alt="">
                                <h2>{{ $porcAcertoFase3 }} %</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('/public/img/IconsPng/Fase 04.png') }}" style="height: 60px; margin-right: 20px" alt="">
                                <h2>{{ $porcAcertoFase4 }} %</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-start">
                                <img src="{{ asset('/public/img/IconsPng/Fase 05.png') }}" style="height: 60px; margin-right: 20px" alt="">
                                <h2>{{ $porcAcertoFase5 }} %</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="col-12" style="height: 100% !important">
                <div class="row" style="height: 48% !important">
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Gains Tendencia.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosTendencia['mediaDinheiroPosicaoGain']) }}</h3>
                                </div>
                                <h5 class="text-center">Média <br> Gains Tendência</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Media Gain Contra.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosContraTendencia['mediaDinheiroPosicaoGain']) }}</h3>
                                </div>
                                <h5 class="text-center">Média <br> Gains Contra-Tendência</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" style="height: 48% !important">
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Despesas.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosTendencia['mediaDinheiroPosicaoLoss']) }}</h3>
                                </div>
                                <h5 class="text-center">Média <br> Loss Tendência</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Despesas.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['moeda']." ".valorDbForm($resultadosContraTendencia['mediaDinheiroPosicaoLoss']) }}</h3>
                                </div>
                                <h5 class="text-center">Média <br> Loss Contra-Tendência</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Trades / Ativos<br>Quantidade</h5>
                        <img src="{{ asset('/public/img/IconsPng/Trades.png') }}" style="height: 100px" alt="">
                    </div>
                    @php
                    $controlAtivo = 1;
                    $marginLeft = 0;
                    @endphp
                    @foreach($principaisAtivos as $ativo)
                        @php
                        $dados = $arrayAtivosDados[$ativo->id];
                        @endphp
                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <img src="{{ asset('/public/img/IconsPng/'.$controlAtivo.'.png') }}" style="height: 50px; margin-left: {{ $marginLeft }}px; margin-right: 20px" alt="">
                            <h3>{{ $ativo->simbolo." - ".$dados['qt'] }}</h3>
                        </div>
                        @php
                        $controlAtivo++;
                        $marginLeft += 30;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Acertos / Ativos<br>Percentual</h5>
                        <img src="{{ asset('/public/img/IconsPng/Taxa Acertos Tendencia.png') }}" style="height: 100px" alt="">
                    </div>
                    @php
                    $controlAtivo = 1;
                    $marginLeft = 0;
                    @endphp
                    @foreach($principaisAtivos as $ativo)
                        @php
                        $dados = $arrayAtivosDados[$ativo->id];
                        $valor = round($dados['qt_acertos'] * 100 / $dados['qt'], 2);
                        @endphp
                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <img src="{{ asset('/public/img/IconsPng/'.$controlAtivo.'.png') }}" style="height: 50px; margin-left: {{ $marginLeft }}px; margin-right: 20px" alt="">
                            <h3>{{ $ativo->simbolo." - ".$valor }} %</h3>
                        </div>
                        @php
                        $controlAtivo++;
                        $marginLeft += 30;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Erros / Ativos<br>Percentual</h5>
                        <img src="{{ asset('/public/img/IconsPng/Taxa Acertos ContraTendencia.png') }}" style="height: 100px" alt="">
                    </div>
                    @php
                    $controlAtivo = 1;
                    $marginLeft = 0;
                    @endphp
                    @foreach($principaisAtivos as $ativo)
                        @php
                        $dados = $arrayAtivosDados[$ativo->id];
                        $valor = round($dados['qt_erros'] * 100 / $dados['qt'], 2);
                        @endphp
                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <img src="{{ asset('/public/img/IconsPng/'.$controlAtivo.'.png') }}" style="height: 50px; margin-left: {{ $marginLeft }}px; margin-right: 20px" alt="">
                            <h3>{{ $ativo->simbolo." - ".$valor }} %</h3>
                        </div>
                        @php
                        $controlAtivo++;
                        $marginLeft += 30;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Pontos Ativo Média</h5>
                        <img src="{{ asset('/public/img/IconsPng/Trades.png') }}" style="height: 100px" alt="">
                    </div>
                    @php
                    $controlAtivo = 1;
                    $marginLeft = 0;
                    @endphp
                    @foreach($principaisAtivos as $ativo)
                        @php
                        $dados = $arrayAtivosDados[$ativo->id];
                        $valor = round($dados['qt_pontosAtivo'] / $dados['qt'], 2);
                        @endphp
                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <img src="{{ asset('/public/img/IconsPng/'.$controlAtivo.'.png') }}" style="height: 50px; margin-left: {{ $marginLeft }}px; margin-right: 20px" alt="">
                            <h3>{{ $ativo->simbolo." - ".$valor }}</h3>
                        </div>
                        @php
                        $controlAtivo++;
                        $marginLeft += 30;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Capital Investido</h5>
                        <img src="{{ asset('/public/img/IconsPng/Taxa Acertos Tendencia.png') }}" style="height: 100px" alt="">
                    </div>
                    @php
                    $controlAtivo = 1;
                    $marginLeft = 0;
                    @endphp
                    @foreach($principaisAtivos as $ativo)
                        @php
                        $dados = $arrayAtivosDados[$ativo->id];
                        $valor = round($dados['qt_contratos'] * $ativo->dayTrading , 2);
                        @endphp
                        <div class="d-flex justify-content-start align-items-center mt-3">
                            <img src="{{ asset('/public/img/IconsPng/'.$controlAtivo.'.png') }}" style="height: 50px; margin-left: {{ $marginLeft }}px; margin-right: 20px" alt="">
                            <h3>{{ $ativo->simbolo." - ".buscaPrefixoMoeda($ativo->moedaAtivo)." ".valorDbForm($valor) }}</h3>
                        </div>
                        @php
                        $controlAtivo++;
                        $marginLeft += 30;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Consistency Diamond</h5>
                        <img src="{{ asset('/public/img/IconsPng/Consistency Diamond.png') }}" style="height: 100px" alt="">
                    </div>
                    @if($lapidacao > 0)
                        @foreach($fases as $fase)
                            @if($lapidacao >= $fase->vlInc && $lapidacao <= $fase->vlFn)
                                <div class="d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/'.$fase->icone) }}" height="200px" alt="">
                                </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-3" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Quantidade de Gain X Loss X Zero Zero</h5>
                        <img src="{{ asset('/public/img/IconsPng/Gains Losses Zero.png') }}" style="height: 100px" alt="">
                    </div>
                    <div id="lineChart"></div>
                </div>
                <script>
                const lineChartEl = document.querySelector('#lineChart'),
                lineChartConfig = {
                    chart: {
                        height: 300,
                        fontFamily: 'Inter',
                        type: 'line',
                        parentHeightOffset: 0,
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    series: [
                        {
                            name: 'Gain',
                            data: [{!! $arrayGraficoLine['gain'] !!}]
                        },
                        {
                            name: 'Loss',
                            data: [{!! $arrayGraficoLine['loss'] !!}]
                        },
                        {
                            name: '0x0',
                            data: [{!! $arrayGraficoLine['empate'] !!}]
                        }
                    ],
                    markers: {
                        strokeWidth: 7,
                        strokeOpacity: 1,
                        strokeColors: ['#ffffff'],
                        colors: ['#ffffff']
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        markers: { offsetX: -3 },
                        itemMargin: {
                            vertical: 3,
                            horizontal: 10
                        },
                        labels: {
                            colors: '#cdcdcd',
                            useSeriesColors: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    colors: ['#00ff00','#ff0000','#ffff00'],
                    grid: {
                        borderColor: '#ffffff',
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -20
                        }
                    },
                    tooltip: {
                        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                            return '<div class="px-3 py-2">' + '<span>' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>';
                        }
                    },
                    xaxis: {
                        categories: [
                            {!! $arrayGraficoLine['cat'] !!}
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: '#ffffff',
                                fontSize: '9px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0);
                            },
                            style: {
                                colors: '#cdcdcd',
                                fontSize: '15px'
                            }
                        }
                    }
                };
                if (typeof lineChartEl !== undefined && lineChartEl !== null) {
                    const lineChart = new ApexCharts(lineChartEl, lineChartConfig);
                    lineChart.render();
                }
                </script>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mt-3" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Total X Tendência X Contra-Tendência</h5>
                        <img src="{{ asset('/public/img/IconsPng/Tendencia Contra.png') }}" style="height: 100px" alt="">
                    </div>
                    <div id="salesCountryChartTrade"></div>
                    <script>
                        const salesCountryChartElTrade = document.querySelector('#salesCountryChartTrade'),
                        salesCountryChartConfigTrade = {
                            chart: {
                                type: 'bar',
                                height: 300,
                                parentHeightOffset: 0,
                                toolbar: {
                                    show: false
                                }
                            },
                            series: [
                                {
                                    name: 'Numeros',
                                    data: [{{ $contador['total'] }}, {{ $contador['tendencia'] }}, {{ $contador['contra'] }}]
                                }
                            ],
                            plotOptions: {
                                bar: {
                                    borderRadius: 10,
                                    barHeight: '60%',
                                    horizontal: true,
                                    distributed: true,
                                    startingShape: 'rounded',
                                    dataLabels: {
                                        position: 'bottom'
                                    }
                                }
                            },
                            dataLabels: {
                                enabled: true,
                                textAnchor: 'start',
                                offsetY: 8,
                                offsetX: 11,
                                style: {
                                    fontWeight: 500,
                                    fontSize: '0.9375rem',
                                    fontFamily: 'Inter',
                                    colors: '#cdcdcd'
                                }
                            },
                            tooltip: {
                                enabled: false
                            },
                            legend: {
                                show: false
                            },
                            colors: [
                                '#00ff00',
                                '#26c6f9',
                                '#ff0000'
                            ],
                            grid: {
                                strokeDashArray: 8,
                                borderColor: '#ffffff',
                                xaxis: { lines: { show: false } },
                                yaxis: { lines: { show: false } },
                                padding: {
                                    top: -18,
                                    left: 10,
                                    right: 33,
                                    bottom: 10
                                }
                            },
                            xaxis: {
                                categories: ['Total', 'Tendência', 'Contra-Tendência'],
                                labels: {
                                    style: {
                                        fontSize: '0.9375rem',
                                        colors: '#cdcdcd',
                                        fontFamily: 'Inter'
                                    }
                                },
                                axisBorder: {
                                    show: false
                                },
                                axisTicks: {
                                    show: false
                                }
                            },
                            yaxis: {
                                labels: {
                                    style: {
                                        fontWeight: 500,
                                        fontSize: '0.7375rem',
                                        colors: '#cdcdcd',
                                        fontFamily: 'Inter'
                                    }
                                }
                            },
                            states: {
                                hover: {
                                    filter: {
                                        type: 'none'
                                    }
                                },
                                active: {
                                    filter: {
                                        type: 'none'
                                    }
                                }
                            }
                        };
                        if (typeof salesCountryChartElTrade !== undefined && salesCountryChartElTrade !== null) {
                            const salesCountryChartTrade = new ApexCharts(salesCountryChartElTrade, salesCountryChartConfigTrade);
                            salesCountryChartTrade.render();
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
    <div class='row mt-3'>
        <div class='col-md-3 mt-3'>
            <div class="card" style="height: 100%">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Gain X Loss Moeda Base</h5>
                        <img src="{{ asset('/public/img/IconsPng/Dashboard Forex.png') }}" style="height: 60px" alt="">
                    </div>
                    <div id="donutChart"></div>
                    <script>
                    const donutChartEl = document.querySelector('#donutChart'),
                    donutChartConfig = {
                        chart: {
                            height: 200,
                            type: 'donut'
                        },
                        labels: ['Gain', 'Loss'],
                        series: [{{ $totalGainMB }}, {{ abs($totalLossMB) }}],
                        colors: [
                            '#008000',
                            '#ff0000'
                        ],
                        stroke: {
                            show: false,
                            curve: 'straight'
                        },
                        dataLabels: {
                            enabled: true,
                            formatter: function (val, opt) {
                                return parseInt(val, 10) + '%';
                            }
                        },
                        legend: {
                            show: false,
                            position: 'bottom',
                            markers: { offsetX: -3 },
                            itemMargin: {
                                vertical: 3,
                                horizontal: 10
                            },
                            labels: {
                                colors: '#ffffff',
                                useSeriesColors: false
                            }
                        },
                        plotOptions: {
                            pie: {
                                donut: {
                                    labels: {
                                        show: true,
                                        name: {
                                            fontSize: '2rem',
                                            fontFamily: 'Arial'
                                        },
                                        value: {
                                            fontSize: '1.2rem',
                                            color: '#cdcdcd',
                                            fontFamily: 'Arial',
                                            formatter: function (val) {
                                                return "{!! @$moedaBase !!} " + parseInt(val, 10);
                                            }
                                        },
                                        total: {
                                            show: false,
                                            fontSize: '1.5rem',
                                            color: '#ffffff',
                                            label: 'Operational',
                                            formatter: function (w) {
                                                return '31%';
                                            }
                                        }
                                    }
                                }
                            }
                        },
                        responsive: [
                            {
                                breakpoint: 992,
                                options: {
                                    chart: {
                                        height: 380
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            colors: '#ffffff',
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 576,
                                options: {
                                    chart: {
                                        height: 320
                                    },
                                    plotOptions: {
                                        pie: {
                                            donut: {
                                                labels: {
                                                    show: true,
                                                    name: {
                                                        fontSize: '1.5rem'
                                                    },
                                                    value: {
                                                        fontSize: '1rem'
                                                    },
                                                    total: {
                                                        fontSize: '1.5rem'
                                                    }
                                                }
                                            }
                                        }
                                    },
                                    legend: {
                                        position: 'bottom',
                                        labels: {
                                            colors: '#ffffff',
                                            useSeriesColors: false
                                        }
                                    }
                                }
                            },
                            {
                                breakpoint: 420,
                                options: {
                                    chart: {
                                        height: 280
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            },
                            {
                                breakpoint: 360,
                                options: {
                                    chart: {
                                        height: 250
                                    },
                                    legend: {
                                        show: false
                                    }
                                }
                            }
                        ]
                    };
                    if (typeof donutChartEl !== undefined && donutChartEl !== null) {
                        const donutChart = new ApexCharts(donutChartEl, donutChartConfig);
                        donutChart.render();
                    }
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-7 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Maior Gain e Maior Loss</h5>
                        <img src="{{ asset('/public/img/IconsPng/Maior Gain Loss.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <td style="font-size: 16px !important"><b>Operação</b></td>
                                    <td style="font-size: 16px !important"><b>Nº Trade</b></td>
                                    <td style="font-size: 16px !important"><b>Moeda Ativo</b></td>
                                    <td style="font-size: 16px !important"><b>Valor</b></td>
                                    <td style="font-size: 16px !important"><b>Valor MB</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 16px !important">Maior Gain</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorGain->idOperacao }}</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorGain->moedaAtivo }}</td>
                                    <td style="font-size: 16px !important">{{ @buscaPrefixoMoeda($tradeMaiorGain->moeda)." ".@valorDbForm($tradeMaiorGain->resPosicaoFinanceiro) }}</td>
                                    <td style="font-size: 16px !important">{{ @$moedaBase." ".@valorDbForm($tradeMaiorGain->resPosicaoFinanceiro * $tradeMaiorGain->$multiplicador) }}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 16px !important">Maior Loss</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorLoss->idOperacao }}</td>
                                    <td style="font-size: 16px !important">{{ @$tradeMaiorLoss->moeda }}</td>
                                    <td style="font-size: 16px !important">{{ @buscaPrefixoMoeda($tradeMaiorLoss->moeda)." ".@valorDbForm($tradeMaiorLoss->resPosicaoFinanceiro) }}</td>
                                    <td style="font-size: 16px !important">{{ @$moedaBase." ".@valorDbForm($tradeMaiorLoss->resPosicaoFinanceiro * $tradeMaiorLoss->$multiplicador) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2 mt-3">
            <div class="row">
                <div class="col-md-12">
                    <div class="card"></div>
                </div>
            </div>
            <div class="col-12" style="height: 100% !important">
                <div class="row" style="height: 48% !important">
                    <div class="col-12">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Sequencia Gains.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['maiorSequenciaGain'] }}</h3>
                                </div>
                                <h5 class="text-center">Maior <br> Sequência Gain</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3" style="height: 48% !important">
                    <div class="col-12">
                        <div class="card" style="height: 100% !important">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <img src="{{ asset('/public/img/IconsPng/Sequencia Losses.png') }}" style="height: 60px" alt="">
                                    <h3>{{ $resultadosGerais['maiorSequenciaLoss'] }}</h3>
                                </div>
                                <h5 class="text-center">Maior <br> Sequência Loss</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">3 Maiores Gains</h5>
                        <img src="{{ asset('/public/img/IconsPng/Maiores Gains.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <td style='font-size: 12px !important'><b>Nº Trade</b></td>
                                    <td style='font-size: 12px !important'><b>Data Entrada</b></td>
                                    <td style='font-size: 12px !important'><b>Data Saída</b></td>
                                    <td style='font-size: 12px !important'><b>Moeda Ativo</b></td>
                                    <td style='font-size: 12px !important'><b>Valor</b></td>
                                    <td style='font-size: 12px !important'><b>Valor MB</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($gains3Maiores as $gain)
                                    @php
                                    $var = explode(" ", $gain->dtHrEntrada);
                                    $dtHrEntrada = dataDbForm($var[0])." ".$var[1];
                                    $var = explode(" ", $gain->dtHrSaida);
                                    $dtHrSaida = dataDbForm($var[0])." ".$var[1];
                                    @endphp
                                    <tr>
                                        <td style='font-size: 12px !important'>{{ $gain->idOperacao }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrEntrada }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrSaida }}</td>
                                        <td style='font-size: 12px !important'>{{ $gain->moedaAtivo }}</td>
                                        <td style='font-size: 12px !important'>{{ buscaPrefixoMoeda($gain->moedaAtivo)." ".valorDbForm($gain->resPosicaoFinanceiro) }}</td>
                                        <td style='font-size: 12px !important'>{{ $moedaBase." ".valorDbForm($gain->resPosicaoFinanceiro * $gain->$multiplicador) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card" style='height: 100% !important'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">3 Maiores Loss</h5>
                        <img src="{{ asset('/public/img/IconsPng/Maiores Losses.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <td style='font-size: 12px !important'><b>Nº Trade</b></td>
                                    <td style='font-size: 12px !important'><b>Data Entrada</b></td>
                                    <td style='font-size: 12px !important'><b>Data Saída</b></td>
                                    <td style='font-size: 12px !important'><b>Moeda Ativo</b></td>
                                    <td style='font-size: 12px !important'><b>Valor</b></td>
                                    <td style='font-size: 12px !important'><b>Valor MB</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($loss3Maiores as $loss)
                                    @php
                                    $var = explode(" ", $loss->dtHrEntrada);
                                    $dtHrEntrada = dataDbForm($var[0])." ".$var[1];
                                    $var = explode(" ", $loss->dtHrSaida);
                                    $dtHrSaida = dataDbForm($var[0])." ".$var[1];
                                    @endphp
                                    <tr>
                                        <td style='font-size: 12px !important'>{{ $loss->idOperacao }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrEntrada }}</td>
                                        <td style='font-size: 12px !important'>{{ $dtHrSaida }}</td>
                                        <td style='font-size: 12px !important'>{{ $loss->moedaAtivo }}</td>
                                        <td style='font-size: 12px !important'>{{ buscaPrefixoMoeda($loss->moedaAtivo)." ".valorDbForm($loss->resPosicaoFinanceiro) }}</td>
                                        <td style='font-size: 12px !important'>{{ $moedaBase." ".valorDbForm($loss->resPosicaoFinanceiro * $loss->$multiplicador) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mt-3">
            <div class="card" style='height: 100%'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Tempo Tendência X Contra-Tendência</h5>
                        <img src="{{ asset('/public/img/IconsPng/Tempo Tendencia Contra.png') }}" style="height: 60px" alt="">
                    </div>
                        <div class="d-none d-lg-flex vehicles-progress-labels mb-3">
                        <div class="vehicles-progress-label unloading-text" style="width: {{ $tempo['tendenciaTotalPorcentagem'] }}%">Tendência</div>
                        <div class="vehicles-progress-label loading-text" style="width: {{ $tempo['contraTotalPorcentagem'] }}%">Contra</div>
                    </div>
                    <div class="vehicles-overview-progress progress rounded mb-3" style="height: 46px">
                        <div
                            class="progress-bar fs-big fw-medium text-start text-bg-info px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['tendenciaTotalPorcentagem'] }}%; font-size: 16px !important"
                            aria-valuenow="{{ $tempo['tendenciaTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['tendenciaTotalView'] }}%
                        </div>
                        <div
                            class="progress-bar fs-big fw-medium text-start bg-gray-900 px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['contraTotalPorcentagem'] }}%; font-size: 16px !important; background-color: red !important"
                            aria-valuenow="{{ $tempo['contraTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['contraTotalView'] }}%
                        </div>
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Total</th>
                                    <th>%</th>
                                    <th>Média</th>
                                    <th>Qtd</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Tendência</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['tendenciaTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['tendenciaTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['tendenciaMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['tendencia'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Contra-Tendência</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['contraTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['contraTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['contraMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['contra'] }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <div class="card" style='height: 100%'>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="text-center">Tempo Gain X Loss X Zero Zero</h5>
                        <img src="{{ asset('/public/img/IconsPng/Tempo Gain Loss.png') }}" style="height: 60px" alt="">
                    </div>
                    <div class="d-none d-lg-flex vehicles-progress-labels mb-3">
                        <div class="vehicles-progress-label unloading-text" style="width: {{ $tempo['gainTotalPorcentagem'] }}%">Gain</div>
                        <div class="vehicles-progress-label loading-text" style="width: {{ $tempo['lossTotalPorcentagem'] }}%">Loss</div>
                        <div class="vehicles-progress-label waiting-text" style="width: {{ $tempo['empateTotalPorcentagem'] }}%">Zero Zero</div>
                    </div>
                    <div class="vehicles-overview-progress progress rounded mb-3" style="height: 46px">
                        <div
                            class="progress-bar fs-big fw-medium text-start text-bg-info px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['gainTotalPorcentagem'] }}%; font-size: 16px !important;"
                            aria-valuenow="{{ $tempo['gainTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['gainTotalView'] }}%
                        </div>
                        <div
                            class="progress-bar fs-big fw-medium text-start bg-gray-900 px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['lossTotalPorcentagem'] }}%; font-size: 16px !important; background-color: red !important"
                            aria-valuenow="{{ $tempo['lossTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['lossTotalView'] }}%
                        </div>
                        <div
                            class="progress-bar fs-big fw-medium text-start bg-secondary px-1 px-lg-3"
                            role="progressbar"
                            style="width: {{ $tempo['empateTotalPorcentagem'] }}%; font-size: 16px !important"
                            aria-valuenow="{{ $tempo['empateTotalPorcentagem'] }}"
                            aria-valuemin="0"
                            aria-valuemax="100">
                            {{ $tempo['empateTotalView'] }}%
                        </div>
                    </div>
                    <div class="table-responsive" style='min-height: auto !important'>
                        <table class="table card-table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Total</th>
                                    <th>%</th>
                                    <th>Média</th>
                                    <th>Qtd</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Gain</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['gainTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['gainTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['gainMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['gain'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Loss</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['lossTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['lossTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['lossMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['loss'] }}</h6>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="w-50 ps-0">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <h6 class="mb-0 fw-normal">Zero Zero</h6>
                                        </div>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['empateTotalDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['empateTotalView'] }}%</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $tempo['empateMediaDescricao'] }}</h6>
                                    </td>
                                    <td class="pe-0 text-nowrap">
                                        <h6 class="mb-0">{{ $contador['empate'] }}</h6>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                <div class="card-header header-elements">
                    <div>
                        <h5 class="card-title mb-0">Evolução Financeira Moeda Base</h5>
                    </div>
                </div>
                <div class="card-body pt-2">
                    <div id="lineChartEvolucao"></div>
                </div>
                <script>
                const lineChartEvolucao = document.querySelector('#lineChartEvolucao'),
                lineChartConfigEv = {
                    chart: {
                        height: 400,
                        fontFamily: 'Inter',
                        type: 'line',
                        parentHeightOffset: 0,
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        }
                    },
                    series: [
                        {
                            name: 'Evolução',
                            data: [{!! $stringSomadorTrades !!}]
                        }
                    ],
                    markers: {
                        strokeWidth: 7,
                        strokeOpacity: 1,
                        strokeColors: ['#ffffff'],
                        colors: ['#ffffff']
                    },
                    legend: {
                        show: true,
                        position: 'bottom',
                        markers: { offsetX: -3 },
                        itemMargin: {
                            vertical: 3,
                            horizontal: 10
                        },
                        labels: {
                            colors: '#ffffff',
                            useSeriesColors: false
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        curve: 'straight'
                    },
                    colors: ['#ffff00','#ff0000','#ffff00'],
                    grid: {
                        borderColor: '#ffffff',
                        xaxis: {
                            lines: {
                                show: false
                            }
                        },
                        yaxis: {
                            lines: {
                                show: false
                            }
                        },
                        padding: {
                            top: -20
                        }
                    },
                    tooltip: {
                        custom: function ({ series, seriesIndex, dataPointIndex, w }) {
                            return '<div class="px-3 py-2">' + '<span> {!! @$moedaBase !!} ' + series[seriesIndex][dataPointIndex] + '</span>' + '</div>';
                        }
                    },
                    xaxis: {
                        categories: [
                            {!! $arrayGraficoLine['cat'] !!}
                        ],
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: false
                        },
                        labels: {
                            show: false,
                            style: {
                                colors: '#ffffff',
                                fontSize: '11px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val.toFixed(0);
                            },
                            style: {
                                colors: '#cdcdcd',
                                fontSize: '11px'
                            }
                        }
                    }
                };
                if (typeof lineChartEvolucao !== undefined && lineChartEvolucao !== null) {
                    const lineChartEv = new ApexCharts(lineChartEvolucao, lineChartConfigEv);
                    lineChartEv.render();
                }
                </script>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="text-center">Trades Filtradas</h5>
                <img src="{{ asset('/public/img/IconsPng/Trades.png') }}" style="height: 60px" alt="">
            </div>
            <div class="table-responsive" style='min-height: auto !important'>
                <table class="table card-table">
                    <thead>
                        <tr>
                            <td></td>
                            <td style='font-size: 12px !important'><b>Nº Trade</b></td>
                            <td style='font-size: 12px !important'><b>Data Entrada</b></td>
                            <td style='font-size: 12px !important'><b>Data Saída</b></td>
                            <td style='font-size: 12px !important'><b>Tempo</b></td>
                            <td style='font-size: 12px !important'><b>Ativo</b></td>
                            <td style='font-size: 12px !important'><b>Moeda</b></td>
                            <td style='font-size: 12px !important'><b>Resultado</b></td>
                            <td style='font-size: 12px !important'><b>Resultado Posição Financeiro</b></td>
                            <td style='font-size: 12px !important'><b>Resultado Posição Financeiro MB</b></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trades as $trade)
                            @php
                            $var = explode(" ", $trade->dtHrEntrada);
                            $dtHrEntrada = dataDbForm($var[0])." ".$var[1];
                            $var = explode(" ", $trade->dtHrSaida);
                            $dtHrSaida = dataDbForm($var[0])." ".$var[1];
                            @endphp
                            <tr>
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
                                <td style='font-size: 12px !important'>{{ $trade->idOperacao }}</td>
                                <td style='font-size: 12px !important'>{{ $dtHrEntrada }}</td>
                                <td style='font-size: 12px !important'>{{ $dtHrSaida }}</td>
                                <td style='font-size: 12px !important'>{{ $trade->tempoOperacao }}</td>
                                <td style='font-size: 12px !important'>{{ $trade->simbolo." - ".$trade->nmAtivo }}</td>
                                <td style='font-size: 12px !important'>{{ $trade->moeda }}</td>
                                <td style='font-size: 12px !important'>{{ $trade->gainOrLoss }}</td>
                                <td style='font-size: 12px !important'>{{ buscaPrefixoMoeda($trade->moeda)." ".valorDbForm($trade->resPosicaoFinanceiro) }}</td>
                                <td style='font-size: 12px !important'>{{ $moedaBase." ".valorDbForm($trade->resPosicaoFinanceiro * $trade->$multiplicador) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
