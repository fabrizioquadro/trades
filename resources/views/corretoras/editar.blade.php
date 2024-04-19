@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Corretora</h5>
                </div>
            </div>
            <form action="{{ route('corretoras.update') }}" method="post">
              @csrf
              <input type="hidden" name="id" value="{{ $corretora->id }}">
              <div class="row mt-2 gy-4">
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="name" name="nome" placeholder="Nome" value="{{ $corretora->nome }}"/>
                    <label for="name">Nome:</label>
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
