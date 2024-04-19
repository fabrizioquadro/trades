@extends('layoutAluno')

@section('conteudo')
<style>
.form-control{
    font-size: 14px !important;
}
tr, td, th {
    font-size: 14px !important;
    vertical-align: middle !important;
}
select {
    text-align: center;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Matriz Decisão</h5>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form action="{{ $controle == 'true' ? route('aluno.matrizDecisao.update') : route('aluno.matrizDecisao.insert') }}" method="post">
                @csrf
                @if($controle == "true")
                    <input type="hidden" name="id_matriz" value="{{ $matrizSet->id_matriz }}">
                @else
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label for="">Ativo:</label>
                            <select required id="ativo" name='id_ativo' class="form-control combobox">
                                <option value="">Opções</option>
                                @foreach($ativos as $ativo)
                                    <option value="{{ $ativo->id }}">{{ $ativo->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif
                <div class="row mt-3">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class='table table-sm'>
                                <thead>
                                    <tr>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Time Frame</b></td>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Trend Longa</b></td>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Flag</b></td>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Última Trend</b></td>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Flag</b></td>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Candle</b></td>
                                        <td style='min-width: 120px !important; width: 10% !important' class="minColuna text-center align-middle"><b>Flag</b></td>
                                        <td style='min-width: 160px !important; width: 15% !important' class="minColuna text-center align-middle"><b>Conclusão</b></td>
                                        <td style='min-width: 120px !important; width: 15% !important' class="minColuna text-center align-middle"><b>Observação</b></td>
                                    </tr>
                                </thead>

                                <tbody>
                                    <tr>
                                        <td>Mensal</td>
                                        <td>
                                            <select name="tLMensal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensal == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensal == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tLMensalFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLMensalFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tUTMensal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensal == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensal == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tUTMensalFlag' class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTMensalFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candleMensal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensal == 'Subindo' ? 'selected' : '' }} value="Subindo">Subindo</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensal == 'Descendo' ? 'selected' : '' }} value="Descendo">Descendo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candleMensalFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleMensalFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusaoMensal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoMensal == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoMensal == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoMensal == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="obsMensal" class="form-control" value="{{ $controle == 'true' ? $matrizSet->obsMensal : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Semanal</td>
                                        <td>
                                            <select name="tLSemanal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanal == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanal == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tLSemanalFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLSemanalFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tUTSemanal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanal == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanal == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tUTSemanalFlag' class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTSemanalFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candleSemanal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanal == 'Subindo' ? 'selected' : '' }} value="Subindo">Subindo</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanal == 'Descendo' ? 'selected' : '' }} value="Descendo">Descendo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candleSemanalFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleSemanalFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusaoSemanal" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoSemanal == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoSemanal == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoSemanal == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="obsSemanal" class="form-control" value="{{ $controle == 'true' ? $matrizSet->obsSemanal : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <td>Diário</td>
                                        <td>
                                            <select name="tLDiario" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiario == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiario == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tLDiarioFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tLDiarioFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tUTDiario" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiario == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiario == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tUTDiarioFlag' class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUTDiarioFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candleDiario" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiario == 'Subindo' ? 'selected' : '' }} value="Subindo">Subindo</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiario == 'Descendo' ? 'selected' : '' }} value="Descendo">Descendo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candleDiarioFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->candleDiarioFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusaoDiario" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoDiario == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoDiario == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoDiario == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="obsDiario" class="form-control" value="{{ $controle == 'true' ? $matrizSet->obsDiario : '' }}"></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td>60 Min</td>
                                        <td>
                                            <select name="tL60min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60min == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60min == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tL60minFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL60minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tUT60min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60min == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60min == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tUT60minFlag' class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT60minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candle60min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60min == 'Subindo' ? 'selected' : '' }} value="Subindo">Subindo</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60min == 'Descendo' ? 'selected' : '' }} value="Descendo">Descendo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candle60minFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle60minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusao60min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao60min == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao60min == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao60min == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="obs60min" class="form-control" value="{{ $controle == 'true' ? $matrizSet->obs60min : '' }}"></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td>15 Min</td>
                                        <td>
                                            <select name="tL15min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15min == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15min == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tL15minFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL15minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tUT15min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15min == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15min == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tUT15minFlag' class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT15minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candle15min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15min == 'Subindo' ? 'selected' : '' }} value="Subindo">Subindo</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15min == 'Descendo' ? 'selected' : '' }} value="Descendo">Descendo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candle15minFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle15minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusao15min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao15min == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao15min == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao15min == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="obs15min" class="form-control" value="{{ $controle == 'true' ? $matrizSet->obs15min : '' }}"></td>
                                    </tr>
                                    </tr>
                                    <tr>
                                        <td>5 Min</td>
                                        <td>
                                            <select name="tL5min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5min == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5min == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tL5minFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tL5minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="tUT5min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5min == 'Compra' ? 'selected' : '' }} value="Compra">Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5min == 'Venda' ? 'selected' : '' }} value="Venda">Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name='tUT5minFlag' class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->tUT5minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candle5min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5min == 'Subindo' ? 'selected' : '' }} value="Subindo">Subindo</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5min == 'Descendo' ? 'selected' : '' }} value="Descendo">Descendo</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="candle5minFlag" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Alerta' ? 'selected' : '' }} value="Alerta">Alerta</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Onda A' ? 'selected' : '' }} value="Onda A">Onda A</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Onda B' ? 'selected' : '' }} value="Onda B">Onda B</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Onda C' ? 'selected' : '' }} value="Onda C">Onda C</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == '+ Volume' ? 'selected' : '' }} value="+ Volume">+ Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == '- Volume' ? 'selected' : '' }} value="- Volume">- Volume</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Fase 01' ? 'selected' : '' }} value="Fase 01">Fase 01</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Fase 02' ? 'selected' : '' }} value="Fase 02">Fase 02</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Fase 03' ? 'selected' : '' }} value="Fase 03">Fase 03</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Fase 04' ? 'selected' : '' }} value="Fase 04">Fase 04</option>
                                                <option {{ $controle == 'true' && $matrizSet->candle5minFlag == 'Fase 05' ? 'selected' : '' }} value="Fase 05">Fase 05</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusao5min" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao5min == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao5min == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusao5min == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="obs5min" class="form-control" value="{{ $controle == 'true' ? $matrizSet->obs5min : '' }}"></td>
                                    </tr>
                                    <tr>
                                        <th>Conclusão</th>
                                        <td colspan='2'>
                                            <select name="conclusaoTL" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoTL == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoTL == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoTL == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td colspan='2'>
                                            <select name="conclusaoTUT" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoTUT == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoTUT == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoTUT == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td colspan='2'>
                                            <select name="conclusaoCandle" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoCandle == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoCandle == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoCandle == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select name="conclusaoConclusao" class="form-control">
                                                <option></option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoConclusao == 'Divergência' ? 'selected' : '' }} value="Divergência">Divergência</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoConclusao == 'Trend Compra' ? 'selected' : '' }} value="Trend Compra">Trend Compra</option>
                                                <option {{ $controle == 'true' && $matrizSet->conclusaoConclusao == 'Trend Venda' ? 'selected' : '' }} value="Trend Venda">Trend Venda</option>
                                            </select>
                                        </td>
                                        <td><input type="text" name="conclusaoObs" class="form-control" value="{{ $controle == 'true' ? $matrizSet->conclusaoObs : '' }}"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary me-2">{{ $controle == "true" ? 'Editar' : 'Salvar' }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 form-group">
                    <label for="matriz">Matriz Salva</label>
                    <select required id="matriz" name='id_matriz' onchange="buscarMatriz(this)" class="form-control combobox">
                        <option value="">Opções</option>
                        @foreach($matrizes as $matriz)
                            @php
                            $var = explode(' ',$matriz->dtHrCadastro);
                            $dtHrCadastro = dataDbForm($var[0])." ".$var[1];
                            @endphp
                            <option value="{{ $matriz->id }}">Ativo: {{ $matriz->nome." Data:".$dtHrCadastro }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            @if($matrizSet)
            <div class="card mt-3">
                <div class="card-header">{{ 'Ativo: '.$matrizSet->nome.". Data: ".$matrizSet->dtHrCadastro }}</div>
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
                    <div class="row">
                        <div class="col-md-12" align='right'>
                            <button onclick="deleteMatriz({{ $matrizSet->id_matriz }})" class='btn btn-sm btn-danger'>Excluir</button>
                            <a href="{{ route('aluno.matrizDecisao',[$matrizSet->id_matriz,'true']) }}" class='btn btn-sm btn-warning'>Editar</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<script>
function buscarMatriz(e){
    if(e.value != ""){
        window.location.href = "{{ route('aluno.matrizDecisao') }}/" + e.value;
    }
}

window.addEventListener('load',()=>{
    $('.combobox').combobox();
});

function deleteMatriz(id_matriz){
    if(confirm('Tem certeza que deseja excluir a matriz?')){
        window.location.href = "{{ route('aluno.matrizDecisao.delete') }}/" + id_matriz;
    }
}

</script>
@endsection
