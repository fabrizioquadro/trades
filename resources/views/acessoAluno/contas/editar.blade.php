@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Conta</h5>
                </div>
            </div>
            <form action="{{ route('aluno.contas.update') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $conta->id }}">
              <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="number" id="nrConta" name="nrConta" placeholder="Numero" value="{{ $conta->nrConta }}" />
                    <label for="nrConta">Numero:</label>
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
