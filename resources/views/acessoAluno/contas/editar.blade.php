@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Editar Conta</h5>
            </div>
            <form action="{{ route('aluno.contas.update') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $conta->id }}">
              <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="number" id="nrConta" name="nrConta" placeholder="Número" value="{{ $conta->nrConta }}" />
                    <label for="nrConta">Número:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmConta" name="nmConta" placeholder="Nome" value="{{ $conta->nmConta }}" />
                    <label for="nmConta">Nome:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_corretora" name='id_corretora' class="select2 form-select">
                        <option value="">Opções</option>
                        @foreach($corretoras as $corretora)
                            <option @if($corretora->id == $conta->id_corretora) selected @endif value="{{ $corretora->id }}">{{ $corretora->nome }}</option>
                        @endforeach
                    </select>
                    <label for="id_corretora">Corretora:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="vlContaInc" name="vlContaInc" placeholder="Valor Inicial" onkeypress="return(MascaraMoeda(this,'.',',',event))" value="{{ valorDbForm($conta->vlContaInc) }}"/>
                    <label for="vlContaInc">Valor Inicial:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                      <select disabled='disabled' required id="moeda" name='moeda' class="select2 form-select">
                          <option value="">Opções</option>
                          <option @if($conta->moeda == "BRL") selected @endif value="BRL">BRL</option>
                          <option @if($conta->moeda == "USD") selected @endif value="USD">USD</option>
                          <option @if($conta->moeda == "EUR") selected @endif value="EUR">EUR</option>
                          <option @if($conta->moeda == "GBP") selected @endif value="GBP">GBP</option>
                      </select>
                      <label for="moeda">Moeda:</label>
                    </div>
                  </div>
                  <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                      <select required id="tpConta" name='tpConta' class="select2 form-select">
                          <option value="">Opções</option>
                          <option @if($conta->tpConta == "Real") selected @endif value="Real">Real</option>
                          <option @if($conta->tpConta == "Demo") selected @endif value="Demo">Demo</option>
                      </select>
                      <label for="moeda">Tipo de Conta:</label>
                    </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                    <div class="form-floating form-floating-outline mb-4">
                      <textarea class="form-control h-px-100" id="dsConta" name='dsConta' placeholder="Alguma observação pertinente ...">{{ $conta->dsConta }}</textarea>
                      <label for="dsConta">Descrição:</label>
                    </div>
                  </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
