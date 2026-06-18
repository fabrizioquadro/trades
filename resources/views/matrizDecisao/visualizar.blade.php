@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Matriz de Decição</h5>
            </div>
            <div class="card mt-3">
                <div class="card-header">{{ 'Ativo: '.$ativo->nome.". Data: ".$matrizSet->dtHrCadastro }}</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class='table table-sm table-borderless'>
                            <thead>
                                <tr>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Time Frame</b></td>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Trend Longa</b></td>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Flag</b></td>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Última Trend</b></td>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Flag</b></td>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Candle</b></td>
                                    <td style="width: 10% !important" class="text-center align-middle"><b>Flag</b></td>
                                    <td style="width: 15% !important" class="text-center align-middle"><b>Conclusão</b></td>
                                    <td style="width: 15% !important" class="text-center align-middle"><b>Observação</b></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><b>Mensal</b></td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tLMensal) !!}>
                                        {{ $matrizSet->tLMensal }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tLMensalFlag) !!}>
                                        {{ $matrizSet->tLMensalFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUTMensal) !!}>
                                        {{ $matrizSet->tUTMensal }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUTMensalFlag) !!}>
                                        {{ $matrizSet->tUTMensalFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candleMensal) !!}>
                                        {{ $matrizSet->candleMensal }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candleMensalFlag) !!}>
                                        {{ $matrizSet->candleMensalFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusaoMensal) !!}>
                                        {{ $matrizSet->conclusaoMensal }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->obsMensal }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>Semanal</b></td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tLSemanal) !!}>
                                        {{ $matrizSet->tLSemanal }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tLSemanalFlag) !!}>
                                        {{ $matrizSet->tLSemanalFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUTSemanal) !!}>
                                        {{ $matrizSet->tUTSemanal }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUTSemanalFlag) !!}>
                                        {{ $matrizSet->tUTSemanalFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candleSemanal) !!}>
                                        {{ $matrizSet->candleSemanal }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candleSemanalFlag) !!}>
                                        {{ $matrizSet->candleSemanalFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusaoSemanal) !!}>
                                        {{ $matrizSet->conclusaoSemanal }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->obsSemanal }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>Diário</b></td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tLDiario) !!}>
                                        {{ $matrizSet->tLDiario }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tLDiarioFlag) !!}>
                                        {{ $matrizSet->tLDiarioFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUTDiario) !!}>
                                        {{ $matrizSet->tUTDiario }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUTDiarioFlag) !!}>
                                        {{ $matrizSet->tUTDiarioFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candleDiario) !!}>
                                        {{ $matrizSet->candleDiario }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candleDiarioFlag) !!}>
                                        {{ $matrizSet->candleDiarioFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusaoDiario) !!}>
                                        {{ $matrizSet->conclusaoDiario }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->obsDiario }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>60 MIN</b></td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tL60min) !!}>
                                        {{ $matrizSet->tL60min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tL60minFlag) !!}>
                                        {{ $matrizSet->tL60minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUT60min) !!}>
                                        {{ $matrizSet->tUT60min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUT60minFlag) !!}>
                                        {{ $matrizSet->tUT60minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candle60min) !!}>
                                        {{ $matrizSet->candle60min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candle60minFlag) !!}>
                                        {{ $matrizSet->candle60minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusao60min) !!}>
                                        {{ $matrizSet->conclusao60min }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->obs60min }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>15 MIN</b></td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tL15min) !!}>
                                        {{ $matrizSet->tL15min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tL15minFlag) !!}>
                                        {{ $matrizSet->tL15minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUT15min) !!}>
                                        {{ $matrizSet->tUT15min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUT15minFlag) !!}>
                                        {{ $matrizSet->tUT15minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candle15min) !!}>
                                        {{ $matrizSet->candle15min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candle15minFlag) !!}>
                                        {{ $matrizSet->candle15minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusao15min) !!}>
                                        {{ $matrizSet->conclusao15min }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->obs15min }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>5 MIN</b></td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tL5min) !!}>
                                        {{ $matrizSet->tL5min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tL5minFlag) !!}>
                                        {{ $matrizSet->tL5minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUT5min) !!}>
                                        {{ $matrizSet->tUT5min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->tUT5minFlag) !!}>
                                        {{ $matrizSet->tUT5minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candle5min) !!}>
                                        {{ $matrizSet->candle5min }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->candle5minFlag) !!}>
                                        {{ $matrizSet->candle5minFlag }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusao5min) !!}>
                                        {{ $matrizSet->conclusao5min }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->obs5min }}</td>
                                </tr>
                                <tr>
                                    <td class="text-center"><b>Conclusão</b></td>
                                    <td class="text-center" colspan='2' {!! defineCorTendenciaMatriz($matrizSet->conclusaoTL) !!}>
                                        {{ $matrizSet->conclusaoTL }}
                                    </td>
                                    <td class="text-center" colspan='2' {!! defineCorTendenciaMatriz($matrizSet->conclusaoTUT) !!}>
                                        {{ $matrizSet->conclusaoTUT }}
                                    </td>
                                    <td class="text-center" colspan='2' {!! defineCorTendenciaMatriz($matrizSet->conclusaoCandle) !!}>
                                        {{ $matrizSet->conclusaoCandle }}
                                    </td>
                                    <td class="text-center" {!! defineCorTendenciaMatriz($matrizSet->conclusaoConclusao) !!}>
                                        {{ $matrizSet->conclusaoConclusao }}
                                    </td>
                                    <td class="text-center">{{ $matrizSet->conclusaoObs }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
