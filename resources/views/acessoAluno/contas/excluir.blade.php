@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Excluir Conta</h5>
                </div>
            </div>
            <form action="{{ route('aluno.contas.delete') }}" method="post">
              <input type="hidden" name="id" value="{{ $conta->id }}">
              @csrf
              <div class="row mt-2 gy-4">
                <p>Tem certeza que deseja excluir a conta {{ $conta->nmConta }}?</p>
                <p>A exclusão dessa conta levará a exclusão de todas as trades linkadas a esta conta.</p>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-danger me-2">Excluir</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
