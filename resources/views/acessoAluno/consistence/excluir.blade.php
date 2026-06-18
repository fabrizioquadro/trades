@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Excluir Diamond</h5>
            </div>
            <form action="{{ route('aluno.consistence.delete') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $diamante->id }}">
              <div class="row mt-2 gy-4">
                <div class="col-md-12 mt-3">
                  <p>Tem certeza que deseja excluir o Consistency Diamond?</p>
                </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-danger me-2">Excluir</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
