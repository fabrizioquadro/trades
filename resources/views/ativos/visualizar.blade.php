@extends('layoutAdmin')

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
    $moeda = "€$";
}
elseif($ativo->moedaAtivo == "GBP"){
    $moeda = "£$";
}
elseif($ativo->moedaAtivo == "JPY"){
    $moeda = "¥$";
}
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Visualizar Ativo</h5>
                </div>
            </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                    <span class="fw-medium">Tipo de Ativo:</span><br>
                    <span>{{ $ativo->tipoAtivo }}</span>
                </div>
                <div class="col-md-4">
                    <span class="fw-medium">Pais:</span><br>
                    <span>{{ $ativo->pais }}</span>
                </div>
                <div class="col-md-4">
                    <span class="fw-medium">Situação:</span><br>
                    <span>{{ $ativo->stAtivo }}</span>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                    <span class="fw-medium">Nome:</span><br>
                    <span>{{ $ativo->nome }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">Tipo Custo:</span><br>
                    <span>{{ $ativo->tipoCusto }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">Exchange:</span><br>
                    <span>{{ $ativo->exchange }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">Simbolo:</span><br>
                    <span>{{ $ativo->simbolo }}</span>
                </div>
                <div class="col-md-2">
                    <span class="fw-medium">CQG Simbolo:</span><br>
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
                    <span class="fw-medium">Swing:</span><br>
                    <span>{{ $moeda." ".valorDbForm($ativo->swing) }}</span>
                </div>
                <div class="col-md-3">
                    <span class="fw-medium">Day Trading:</span><br>
                    <span>{{ $moeda." ".valorDbForm($ativo->dayTrading) }}</span>
                </div>
              </div>
              <div class="card mt-3">
                  <div class="card-body">
                    <h6 class="card-title">Corretoras</h6>
                    <table class='table table-sm'>
                        <thead>
                            <tr>
                                <th>Nome</th>
                            </tr>
                        </thead>
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
        </div>
    </div>
</div>

@endsection
