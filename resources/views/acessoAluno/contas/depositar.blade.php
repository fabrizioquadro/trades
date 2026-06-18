@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Depositar: Conta {{ $conta->nrConta }} - {{ $conta->nmConta }}</h5>
            </div>
            <form action="{{ route('aluno.contas.deposito.insert') }}" method="post">
              @csrf
              <input type="hidden" name="id_conta" value='{{ $conta->id }}'>
              <div class="row mt-2 gy-4">
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="date" id="dtMovimento" name="dtMovimento" placeholder="Data Depósito"/>
                    <label for="dtMovimento">Data Depósito:</label>
                  </div>
                </div>
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="vlMovimento" name="vlMovimento" placeholder="Valor Depósito" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="vlMovimento">Valor Depósito:</label>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Depositar</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
