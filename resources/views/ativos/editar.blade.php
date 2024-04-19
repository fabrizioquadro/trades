@extends('layoutAdmin')

@section('conteudo')
@php
//dd($ativo);
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Ativo</h5>
                </div>
            </div>
            <form action="{{ route('ativos.update') }}" method="post">
              @csrf
              <input type="hidden" name="id_ativo" value="{{ $ativo->id }}">
              <div class="row mt-2 gy-4">
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_tipoAtivo" name='tipoAtivo' class="select2 form-select">
                      <option value="">Opções</option>
                      <option @if($ativo->tipoAtivo == "Índices") selected  @endif value="Índices">Índices</option>
                      <option @if($ativo->tipoAtivo == "CFDs") selected  @endif value="CFDs">CFDs</option>
                      <option @if($ativo->tipoAtivo == "Ações") selected  @endif value="Ações">Ações</option>
                      <option @if($ativo->tipoAtivo == "Forex") selected  @endif value="Forex">Forex</option>
                      <option @if($ativo->tipoAtivo == "Cryptos") selected  @endif value="Cryptos">Cryptos</option>
                      <option @if($ativo->tipoAtivo == "Financeiros") selected  @endif value="Financeiros">Financeiros</option>
                      <option @if($ativo->tipoAtivo == "ADRs") selected  @endif value="ADRs">ADRs</option>
                      <option @if($ativo->tipoAtivo == "BDRs") selected  @endif value="BDRs">BDRs</option>
                      <option @if($ativo->tipoAtivo == "ETFs") selected  @endif value="ETFs">ETFs</option>
                      <option @if($ativo->tipoAtivo == "Fundos") selected  @endif value="Fundos">Fundos</option>
                      <option @if($ativo->tipoAtivo == "Energéticos") selected  @endif value="Energéticos">Energéticos</option>
                      <option @if($ativo->tipoAtivo == "Metais") selected  @endif value="Metais">Metais</option>
                      <option @if($ativo->tipoAtivo == "Grãos") selected  @endif value="Grãos">Grãos</option>
                      <option @if($ativo->tipoAtivo == "Carne") selected  @endif value="Carne">Carne</option>
                      <option @if($ativo->tipoAtivo == "Softs") selected  @endif value="Softs">Softs</option>
                    </select>
                    <label for="id_tipoAtivo">Tipo de Ativo:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_pais" name='pais' class="select2 form-select">
                      <option value="">Opções</option>
                      <option @if($ativo->pais == "BRA") selected @endif value="BRA">BRA</option>
                      <option @if($ativo->pais == "EUA") selected @endif value="EUA">EUA</option>
                      <option @if($ativo->pais == "EUR") selected @endif value="EUR">EUR</option>
                      <option @if($ativo->pais == "UK") selected @endif value="UK">UK</option>
                      <option @if($ativo->pais == "Cryptos") selected @endif value="Cryptos">Cryptos</option>
                    </select>
                    <label for="id_pais">País:</label>
                  </div>
                </div>
                <div class="col-md-3 form-group">
                    <div class="form-floating form-floating-outline">
                        <select id="moedaBase" name="moedaAtivo" required="" class="select2 form-select">
                            <option value=''>Opções</option>
                            <option @if($ativo->moedaAtivo == "BRL") selected @endif value="BRL">BRL</option>
                            <option @if($ativo->moedaAtivo == "USD") selected @endif value="USD">USD</option>
                            <option @if($ativo->moedaAtivo == "EUR") selected @endif value="EUR">EUR</option>
                            <option @if($ativo->moedaAtivo == "GBP") selected @endif value="GBP">GBP</option>
                        </select>
                      <label for="moedaBase">Moeda Ativo:</label>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <div class="form-floating form-floating-outline">
                        <select id="stAtivo" name="stAtivo" required="" class="select2 form-select">
                            <option value=''>Opções</option>
                            <option @if($ativo->stAtivo == "Ativo") selected @endif value="Ativo">Ativo</option>
                            <option @if($ativo->stAtivo == "Inativo") selected @endif value="Inativo">Inativo</option>
                        </select>
                      <label for="moedaBase">Situacao:</label>
                    </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nome" name="nome" placeholder="Nome" value="{{ $ativo->nome }}"/>
                    <label for="nome">Nome:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <select id="tipoCusto" name='tipoCusto' class="select2 form-select">
                        <option value="">Opções</option>
                        <option {{ $ativo->tipoCusto == "Spread" ? "selected" : "" }} value="Spread">Spread</option>
                        <option {{ $ativo->tipoCusto == "Valor Fixo" ? "selected" : "" }} value="Valor Fixo">Valor Fixo</option>
                        <option {{ $ativo->tipoCusto == "Percentual" ? "selected" : "" }} value="Percentual">Percentual</option>
                    </select>
                    <label for="tipoCusto">Tipo de Custo:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="exchange" name="exchange" placeholder="Exchange" value="{{ $ativo->exchange }}"/>
                    <label for="exchange">Exchange:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="simbolo" name="simbolo" placeholder="Símbolo"  value="{{ $ativo->simbolo }}"/>
                    <label for="simbolo">Símbolo:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="cqgSimbolo" name="cqgSimbolo" placeholder="CQG Símbolo"  value="{{ $ativo->cqgSimbolo }}"/>
                    <label for="cqgSimbolo">CQG Símbolo:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="tamanhoContrato" name="tamanhoContrato" placeholder="Tamanho Contrato"  value="{{ $ativo->tamanhoContrato }}"/>
                    <label for="tamanhoContrato">Tamanho Contrato:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="meses" name="meses" placeholder="Meses"  value="{{ $ativo->meses }}"/>
                    <label for="meses">Meses:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="valor" name="valor" placeholder="Valor" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="{{ valorDbForm($ativo->valor) }}"/>
                    <label for="valor">Valor:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="tick" name="tick" placeholder="Tick" onkeypress="return(MascaraMoeda(this,'.',',',event))"  value="{{ valorDbForm($ativo->tick) }}"/>
                    <label for="tick">Tick:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="swing" name="swing" placeholder="Swing" onkeypress="return(MascaraMoeda(this,'.',',',event))"  value="{{ valorDbForm($ativo->swing) }}"/>
                    <label for="swing">Swing:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dayTrading" name="dayTrading" placeholder="Day Trading" onkeypress="return(MascaraMoeda(this,'.',',',event))"  value="{{ valorDbForm($ativo->dayTrading) }}"/>
                    <label for="dayTrading">Day Trading:</label>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                  <div class="card-body">
                    <h6 class="card-title">Corretoras</h6>
                    <table class='table table-sm'>
                        <thead>
                            <tr>
                                <th> <input type="checkbox" id='checkAll'> All</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($corretoras as $corretora)
                                @php
                                $checked = "";
                                $controle = testaCorretoraAtivo($ativo->id, $corretora->id);
                                if($controle){
                                    $checked = 'checked';
                                }
                                @endphp
                                <tr>
                                    <td> <input type="checkbox" class="corretoras" {{ $checked }} name='corretora_{{ $corretora->id }}' value="Sim"></td>
                                    <td>{{ $corretora->nome }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('checkAll').addEventListener('click', (e)=>{
    if(e.target.checked){
        inputs = document.querySelectorAll('input.corretoras');
        [].forEach.call(inputs, function(input) {
            input.checked = true;
        });
    }
    else{
        inputs = document.querySelectorAll('input.corretoras');
        [].forEach.call(inputs, function(input) {
            input.checked = false;
        });
    }
})
</script>
@endsection
