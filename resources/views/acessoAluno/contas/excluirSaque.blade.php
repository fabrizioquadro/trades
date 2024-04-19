@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Excluir Saque: Conta {{ $conta->nrConta }} - {{ $conta->nmConta }}</h5>
                </div>
            </div>
            <form action="{{ route('aluno.contas.saque.delete') }}" method="post">
              @csrf
              <input type="hidden" name="id" value='{{ $saque->id }}'>
              <p>Tem certeza que deseja excluir o saque selecionado?</p>
              <div class="mt-4">
                  <button type="submit" class="btn btn-danger me-2">Excluir</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
