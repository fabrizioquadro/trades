@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Faq</h5>
                </div>
            </div>
            <form action="{{ route('faq.insert') }}" method="post">
              @csrf
              {{--
              <div class="row mt-2 gy-4">
                  <div class="col-md-3">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="numero" name="numero" placeholder="Numero"/>
                        <label for="numero">Numero:</label>
                      </div>
                  </div>
              </div>
              --}}
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="pergunta" name="pergunta" placeholder="Pergunta"/>
                        <label for="pergunta">Pergunta:</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="resposta" name="resposta" placeholder="Resposta"/>
                        <label for="resposta">Resposta:</label>
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
