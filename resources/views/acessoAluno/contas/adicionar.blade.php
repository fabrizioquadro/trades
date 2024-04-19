@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Conta</h5>
                </div>
            </div>
            <form action="{{ route('aluno.contas.insert') }}" method="post">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="number" id="nrConta" name="nrConta" placeholder="Numero"/>
                    <label for="nrConta">Numero:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmConta" name="nmConta" placeholder="Nome"/>
                    <label for="nmConta">Nome:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_corretora" name='id_corretora' class="select2 form-select">
                        <option value="">Opções</option>
                        @foreach($corretoras as $corretora)
                            <option value="{{ $corretora->id }}">{{ $corretora->nome }}</option>
                        @endforeach
                    </select>
                    <label for="id_corretora">Corretora:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="vlContaInc" name="vlContaInc" placeholder="Valor Inicial" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="vlContaInc">Valor Inicial:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-3 mt-3">
                    <div class="form-floating form-floating-outline">
                      <select required id="moeda" name='moeda' class="select2 form-select">
                          <option value="">Opções</option>
                          <option value="BRL">BRL</option>
                          <option value="USD">USD</option>
                          <option value="EUR">EUR</option>
                          <option value="GBP">GBP</option>
                      </select>
                      <label for="moeda">Moeda:</label>
                    </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                    <div class="form-floating form-floating-outline mb-4">
                      <textarea class="form-control h-px-100" id="dsConta" name='dsConta' placeholder="Alguma observação pertinente ..."></textarea>
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
