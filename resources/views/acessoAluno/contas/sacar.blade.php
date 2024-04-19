@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Sacar: Conta {{ $conta->nrConta }} - {{ $conta->nmConta }}</h5>
                </div>
            </div>
            <form action="{{ route('aluno.contas.saque.insert') }}" method="post">
              @csrf
              <input type="hidden" name="id_conta" value='{{ $conta->id }}'>
              <div class="row mt-2 gy-4">
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="date" id="dtMovimento" name="dtMovimento" placeholder="Data Saque"/>
                    <label for="dtMovimento">Data Saque:</label>
                  </div>
                </div>
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="vlMovimento" name="vlMovimento" placeholder="Valor Saque" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="vlMovimento">Valor Saque:</label>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Sacar</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
