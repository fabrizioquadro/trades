@extends('layoutAluno')

@section('conteudo')
@php
$moeda = '';
if($ativo->moedaAtivo == "BRL"){
    $moeda = "R$";
}
elseif($ativo->moedaAtivo == "USD"){
    $moeda = "US$";
}
elseif($ativo->moedaAtivo == "EUR"){
    $moeda = "€";
}
elseif($ativo->moedaAtivo == "GBP"){
    $moeda = "£";
}
elseif($ativo->moedaAtivo == "JPY"){
    $moeda = "¥$";
}
@endphp
<style media="screen">
table, tr, td, th{
    font-size: 14px !important;
    vertical-align: bottom !important;
    text-align: left !important;
    text-transform: none !important;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title mb-0">Visualizar Ativo</h5>
            </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                    <span class="fw-medium">Tipo de Ativo:</span><br>
                    <span>{{ $ativo->tipoAtivo }}</span>
                </div>
                <div class="col-md-4">
                    <span class="fw-medium">País:</span><br>
                    <span>{{ $ativo->pais }}</span>
                </div>
                <div class="col-md-4">
                    <span class="fw-medium">Situação:</span><br>
                    <span>{{ $ativo->stAtivo }}</span>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                    <span class="fw-medium">Nome:</span><br>
                    <span>{{ $ativo->nome }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">Exchange:</span><br>
                    <span>{{ $ativo->exchange }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">Símbolo:</span><br>
                    <span>{{ $ativo->simbolo }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">CQG Símbolo:</span><br>
                    <span>{{ $ativo->cqgSimbolo }}</span>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                    <span class="fw-medium">Tamanho do Contrato:</span><br>
                    <span>{{ $ativo->tamanhoContrato }}</span>
                </div>
                <div class="col-md-6">
                    <span class="fw-medium">Meses:</span><br>
                    <span>{{ $ativo->meses }}</span>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-3">
                    <span class="fw-medium">Valor:</span><br>
                    <span>{{ $moeda." ".valorDbForm($ativo->valor) }}</span>
                </div>
                <div class="col-md-3">
                    <span class="fw-medium">Tick:</span><br>
                    <span>{{ $moeda." ".valorDbForm($ativo->tick) }}</span>
                </div>
                <div class="col-md-3">
                    <span class="fw-medium">Margem Swing:</span><br>
                    <span>{{ $moeda." ".valorDbForm($ativo->swing) }}</span>
                </div>
                <div class="col-md-3">
                    <span class="fw-medium">Margem Day Trading:</span><br>
                    <span>{{ $moeda." ".valorDbForm($ativo->dayTrading) }}</span>
                </div>
              </div>
              <div class="card mt-3">
                  <div class="card-body">
                    <h6 class="card-title">Corretoras</h6>
                    <table class='table table-sm'>
                        <tbody>
                            @foreach($corretoras as $corretora)
                                @php
                                $checked = "";
                                $controle = testaCorretoraAtivo($ativo->id, $corretora->id);
                                if($controle){
                                    @endphp
                                    <tr>
                                        <td>{{ $corretora->nome }}</td>
                                    </tr>
                                    @php
                                }
                                @endphp
                            @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
              <div class="row mt-4">
                  <div class="col md-12">

                  </div>
              </div>
        </div>
    </div>
</div>

@endsection
