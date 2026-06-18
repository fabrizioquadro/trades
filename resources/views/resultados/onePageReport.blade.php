@extends('layoutAdmin')

@section('conteudo')
<form id='formulario' action="{{ route('exportarDadosPdf') }}" target='_blank' method="post">
    @csrf
    <input type="hidden" name="dados" id='formulario_dados'>
    <input type="hidden" name="titulo" value="One Page Report">
</form>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-between">
                <div class="col-10">
                    <div class="d-flex justify-content-start align-items-center">
                        <a href="{{ route('resultados') }}" title="Voltar" style="margin-right: 20px">
                            <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                        </a>
                        <h5 class="card-title">One Page Report Smart Money Metrics</h5>
                    </div>
                </div>
                <div class="col-2">
                    <button type="button" id='botaoExportarOnePage' class="btn btn-primary btn-sm">Exportar</button>
                </div>
            </div>
            <div id='divDados'>
                <style>
                td, th{
                    font-size: 11px !important;
                    vertical-align: middle !important;
                    text-transform: none !important;
                }

                .riskReward td, .riskReward th{
                    font-size: 20px !important;
                }
                </style>
                <div class="row" style="border-bottom: 1px solid #696969">
                    <div class="col-md-12">
                        <table class="table riskReward">
                            <tr>
                                <td></td>
                                <td>Risk X Reward</td>
                                <td >Taxa de Acerto</td>
                                <td>Net Profit\ Gross Loss</td>
                                <td>Despesas</td>
                            </tr>
                            <tr>
                                <th class='text-center'>Geral</th>
                                <th class='text-center' style='color: red'><span style='color: red'>{{ $resultado['risk_reward_1'] }}</span> <span style="color: #696969">X</span> <span style='color: green'>{{ $resultado['risk_reward_2'] }}</span> </th>
                                <th style='color:#26c6f9'>{{ $resultado['txAcertos'] }} %</th>
                                <th style="color: {{ $resultado['netProfitGrossLoss'] < 0 ? 'red' : '#26c6f9' }}">{{ $moeda.' '.valorDbForm($resultado['netProfitGrossLoss']) }}</th>
                                <th style="color: red">{{ $moeda.' '.valorDbForm($resultado['despesas']) }}</th>
                            </tr>
                            <tr>
                                <th class='text-center'>Tendência</th>
                                <th class='text-center' style='color: red'><span style='color: red'>{{ $resultado['risk_reward_1_tendencia'] }}</span> <span style="color: #696969">X</span> <span style='color: green'>{{ $resultado['risk_reward_2_tendencia'] }}</span> </th>
                                <th style='color:#26c6f9'>{{ $resultado['txAcertos_tendencia'] }} %</th>
                                <th style="color: {{ $resultado['netProfitGrossLoss'] < 0 ? 'red' : '#26c6f9' }}">{{ $moeda.' '.valorDbForm($resultado['netProfitGrossLossTendencia']) }}</th>
                                <th style="color: red">{{ $moeda.' '.valorDbForm($resultado['despesasTendencia']) }}</th>
                            </tr>
                            <tr>
                                <th class='text-center'>Contra</th>
                                <th class='text-center' style='color: red'><span style='color: red'>{{ $resultado['risk_reward_1_contra'] }}</span> <span style="color: #696969">X</span> <span style='color: green'>{{ $resultado['risk_reward_2_contra'] }}</span> </th>
                                <th style='color:#26c6f9'>{{ $resultado['txAcertos_contra'] }} %</th>
                                <th style="color: {{ $resultado['netProfitGrossLoss'] < 0 ? 'red' : '#26c6f9' }}">{{ $moeda.' '.valorDbForm($resultado['netProfitGrossLossContra']) }}</th>
                                <th style="color: red">{{ $moeda.' '.valorDbForm($resultado['despesasContra']) }}</th>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #696969">
                    <div class="col-md-4 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan='2' class="text-center">Quantidade Operações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Quantidade De Operações</td>
                                            <th>{{ $qtOperacoes }}</th>
                                        </tr>
                                        <tr>
                                            <td>Quantidade De Gains</td>
                                            <th class="text-left">{{ $resultado['qtGain'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Quantidade De Loss</td>
                                            <th class="text-left">{{ $resultado['qtLoss'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Quantidade De 0 X 0</td>
                                            <th class="text-left">{{ $resultado['qtEmpate'] }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan='3' class="text-center">Tempos das Operações</th>
                                        </tr>
                                        <tr>
                                            <th>Operações</th>
                                            <th class="text-center">Total</th>
                                            <th class="text-center">Média</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Todas</td>
                                            <th class="text-center">{{ $resultado['tempoOperacoes'] }}</th>
                                            <th class="text-center">{{ $resultado['tempoMedioOperacoes'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Gains</td>
                                            <th class="text-center">{{ $resultado['tempoGain'] }}</th>
                                            <th class="text-center">{{ $resultado['tempoMedioGain'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Loss</td>
                                            <th class="text-center">{{ $resultado['tempoLoss'] }}</th>
                                            <th class="text-center">{{ $resultado['tempoMedioLoss'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>0 X 0</td>
                                            <th class="text-center">{{ $resultado['tempoEmpate'] }}</th>
                                            <th class="text-center">{{ $resultado['tempoMedioEmpate'] }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan='2' class="text-center">Posição Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Soma Pontos Posição Total</td>
                                            <th class='text-center'>{{ $resultado['somaPontosPosicao'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Soma Pontos Por Contrato</td>
                                            <th class='text-center'>{{ $resultado['somaPontosContrato'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Soma Dinheiro Posição Total</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['somaDinheiroPosicao']) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Soma Dinheiro Por Contrato</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['somaDinheiroContrato']) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #696969">
                    <div class="col-md-4 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan='2' class="text-center">Média Posição Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Média Pontos Posição Total</td>
                                            <th class='text-center'>{{ $resultado['mediaPontosPosicao'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Média Pontos Por Contrato</td>
                                            <th class='text-center'>{{ $resultado['mediaPontosContrato'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Média Dinheiro Posição Total</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['mediaDinheiroPosicao']) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Média Dinheiro Por Contrato</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['mediaDinheiroContrato']) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan='3' class="text-center">Resultado Gains</th>
                                        </tr>
                                        <tr>
                                            <th>Descrição</th>
                                            <th class="text-center">Soma</th>
                                            <th class="text-center">Média</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pontos Posição Total</td>
                                            <th class='text-center'>{{ $resultado['somaPontosPosicaoGain'] }}</th>
                                            <th class='text-center'>{{ $resultado['mediaPontosPosicaoGain'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Pontos Por Contrato</td>
                                            <th class='text-center'>{{ $resultado['somaPontosContratoGain'] }}</th>
                                            <th class='text-center'>{{ $resultado['mediaPontosContratoGain'] }}</th
                                        </tr>
                                        <tr>
                                            <td>Dinheiro Posição Total</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['somaDinheiroPosicaoGain']) }}</th>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['mediaDinheiroPosicaoGain']) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Dinheiro Por Contrato</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['somaDinheiroContratoGain']) }}</th>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['mediaDinheiroContratoGain']) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan='3' class="text-center">Resultado Loss</th>
                                        </tr>
                                        <tr>
                                            <th>Descrição</th>
                                            <th class="text-center">Soma</th>
                                            <th class="text-center">Média</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Pontos Posição Total</td>
                                            <th class='text-center'>{{ $resultado['somaPontosPosicaoLoss'] }}</th>
                                            <th class='text-center'>{{ $resultado['mediaPontosPosicaoLoss'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Pontos Por Contrato</td>
                                            <th class='text-center'>{{ $resultado['somaPontosContratoLoss'] }}</th>
                                            <th class='text-center'>{{ $resultado['mediaPontosContratoLoss'] }}</th
                                        </tr>
                                        <tr>
                                            <td>Dinheiro Posição Total</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['somaDinheiroPosicaoLoss']) }}</th>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['mediaDinheiroPosicaoLoss']) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Dinheiro Por Contrato</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['somaDinheiroContratoLoss']) }}</th>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['mediaDinheiroContratoLoss']) }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #696969">
                    <div class="col-md-3 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Operações de Gain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Maior Operação Gain</td>
                                            <th class='text-center'>Trade id:{{ $resultado['maiorOperacaoGain'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Valor Maior Operação Gain</td>
                                            <th class='text-center'>{{ $moeda." ".valorDbForm($resultado['valorMaiorOperacaoGain']) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Maior Sequência Gain</td>
                                            <th class='text-center'>{{ $resultado['maiorSequenciaGain'] }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Operações de Loss</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Maior Operação Loss</td>
                                            <th class='text-center'>Trade id:{{ $resultado['maiorOperacaoLoss'] }}</th>
                                        </tr>
                                        <tr>
                                            <td>Valor Maior Operação Loss</td>
                                            <th class='text-center'>{{ $moeda." -".valorDbForm($resultado['valorMaiorOperacaoLoss']) }}</th>
                                        </tr>
                                        <tr>
                                            <td>Maior Sequência Loss</td>
                                            <th class='text-center'>{{ $resultado['maiorSequenciaLoss'] }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="card shadow-none bg-transparent" style="height: 100% !important">
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="3" class="text-center">Variações Percentuais</th>
                                        </tr>
                                        <tr>
                                            <th>Descrição</th>
                                            <th class="text-center">Soma</th>
                                            <th class="text-center">Média</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Total Variação de Preço</td>
                                            <th>{{ $resultado['somaVariacaoPreco'] }} %</th>
                                            <th>{{ $resultado['mediaVariacaoPreco'] }} %</th>
                                        </tr>
                                        <tr>
                                            <td>Gains</td>
                                            <th>{{ $resultado['somaVariacaoPrecoGain'] }} %</th>
                                            <th>{{ $resultado['mediaVariacaoPrecoGain'] }} %</th>
                                        </tr>
                                        <tr>
                                            <td>Loss</td>
                                            <th>{{ $resultado['somaVariacaoPrecoLoss'] }} %</th>
                                            <th>{{ $resultado['mediaVariacaoPrecoLoss'] }} %</th>
                                        </tr>
                                        <tr>
                                            <td>0 X 0</td>
                                            <th>{{ $resultado['somaVariacaoPrecoEmpate'] }} %</th>
                                            <th>{{ $resultado['mediaVariacaoPrecoEmpate'] }} %</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #696969">
                    <div class="col-md-6 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="3">Compra X Venda</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td></td>
                                            <td>Quantidade Operações</td>
                                            <td>Percentual Acertos</td>
                                        </tr>
                                        <tr>
                                            <td>Compra</td>
                                            <th>{{ $qtOperacaoCompra }}</th>
                                            <th>{{ $qtOperacaoCompra > 0 ? round($qtOperacaoCompraGain * 100 / $qtOperacaoCompra, 2)."%" : '0%' }}</th>
                                        </tr>
                                        <tr>
                                            <td>Venda</td>
                                            <th>{{ $qtOperacaoVenda }}</th>
                                            <th>{{ $qtOperacaoVenda > 0 ? round($qtOperacaoVendaGain * 100 / $qtOperacaoVenda, 2)."%" : '0%' }}</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="6">% Acertos Fase</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Fase 01</td>
                                            <td>Fase 02</td>
                                            <td>Fase 03</td>
                                            <td>Fase 04</td>
                                            <td>Fase 06</td>
                                        </tr>
                                        <tr>
                                            <th>{{ $porcAcertoFase1 }}%</th>
                                            <th>{{ $porcAcertoFase2 }}%</th>
                                            <th>{{ $porcAcertoFase3 }}%</th>
                                            <th>{{ $porcAcertoFase4 }}%</th>
                                            <th>{{ $porcAcertoFase5 }}%</th>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" style="border-bottom: 1px solid #696969">
                    <div class="col-md-12 mt-1">
                        <div class="card shadow-none bg-transparent" style='height: 100% !important'>
                            <div class="card-body">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th colspan="6">Principais Ativos</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ativo</td>
                                            <td>Quantidade</td>
                                            <td>Percentual Acerto</td>
                                            <td>Percentual Erro</td>
                                            <td>Pontos Ativo Médio</td>
                                            <td>Capital Investido</td>
                                        </tr>
                                        @foreach($principaisAtivos as $ativo)
                                            @php
                                            $dados = $arrayAtivosDados[$ativo->id];
                                            $percentualAcerto = round($dados['qt_acertos'] * 100 / $dados['qt'], 2);
                                            $percentualErro = round($dados['qt_erros'] * 100 / $dados['qt'], 2);
                                            $pontosAtivoMedia = round($dados['qt_pontosAtivo'] / $dados['qt'], 2);
                                            $capitalInvestido = round($dados['qt_contratos'] * $ativo->dayTrading , 2);
                                            @endphp
                                            <tr>
                                                <th>{{ $ativo->simbolo." - ".$ativo->nome }}</th>
                                                <th>{{ $dados['qt'] }}</th>
                                                <th>{{ $percentualAcerto."%" }}</th>
                                                <th>{{ $percentualErro."%" }}</th>
                                                <th>{{ $pontosAtivoMedia }}</th>
                                                <th>{{ buscaPrefixoMoeda($ativo->moedaAtivo)." ".valorDbForm($capitalInvestido) }}</th>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h6>Filtros Aplicados</h6>
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Entrada</td>
                                    <td>Saída</td>
                                    <td>Tipo Operação</td>
                                    <td>Países</td>
                                    <td>Corretora</td>
                                    <td>Tipo Conta</td>
                                    <td>Contas</td>
                                    <td>Ativos</td>
                                    <td>Tipo Ativo</td>
                                    <td>Operação</td>
                                    <td>Direção</td>
                                    <td>Fase</td>
                                    <td>Moeda</td>
                                    <td>Tipo Custo</td>
                                    <td>Resultado</td>
                                </tr>
                                <tr>
                                    <th>
                                        @if($user->dtEntradaInc)
                                            De: {{ dataDbForm($user->dtEntradaInc) }} <br>
                                        @endif
                                        @if($user->dtEntradaFn)
                                            Até: {{ dataDbForm($user->dtEntradaFn) }} <br>
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->dtSaidaInc)
                                            De: {{ dataDbForm($user->dtSaidaInc) }} <br>
                                        @endif
                                        @if($user->dtSaidaFn)
                                            Até: {{ dataDbForm($user->dtSaidaFn) }} <br>
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroTipoOperacao)
                                            {{ str_replace(',', ', ',$user->filtroTipoOperacao) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroPais)
                                            {{ str_replace(',', ', ',$user->filtroPais) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroCorretora)
                                            {{ $stringCorretoras }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroTipoConta)
                                            {{ str_replace(',', ', ',$user->filtroTipoConta) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroConta)
                                            {{ $stringContas }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroAtivo)
                                            {{ $stringAtivos }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroTipoAtivo)
                                            {{ str_replace(',', ', ',$user->filtroTipoAtivo) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroOperacao)
                                            {{ str_replace(',', ', ',$user->filtroOperacao) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroDirecao)
                                            {{ str_replace(',', ', ',$user->filtroDirecao) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroFase)
                                            {{ str_replace(',', ', ',$user->filtroFase) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroMoeda)
                                            {{ str_replace(',', ', ',$user->filtroMoeda) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroTipoCusto)
                                            {{ str_replace(',', ', ',$user->filtroTipoCusto) }}
                                        @endif
                                    </th>
                                    <th>
                                        @if($user->filtroResultado)
                                            {{ str_replace(',', ', ',$user->filtroResultado) }}
                                        @endif
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                        <h6>Trades</h6>
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td style='text-align: left !important'><p>{{ $tradesFiltros }}</p></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById('botaoExportarOnePage').addEventListener('click', ()=>{
    document.getElementById('formulario_dados').value = document.getElementById('divDados').innerHTML;
    document.getElementById('formulario').submit();
})
</script>
@endsection
