@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Editar Faq</h5>
            </div>
            <form action="{{ route('faq.update') }}" method="post">
              @csrf
              <input type="hidden" name="id_faq" value="{{ $faq->id }}">
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="pergunta" name="pergunta" placeholder="Pergunta" value="{{ $faq->pergunta }}"/>
                        <label for="pergunta">Pergunta:</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="resposta" name="resposta" placeholder="Resposta" value="{{ $faq->resposta }}"/>
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
