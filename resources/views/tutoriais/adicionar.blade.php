@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Tutorial</h5>
                </div>
            </div>
            <form action="{{ route('tutoriais.insert') }}" method="post">
              @csrf
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nmTutorial" placeholder="Nome Tutorial"/>
                        <label for="nome">Nome Tutorial:</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                          <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" name='dsTutorial' placeholder="Descrição"></textarea>
                          <label for="exampleFormControlTextarea1">Descrição</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="video" name="dsVideo" placeholder="Video"/>
                        <label for="video">Video:</label>
                      </div>
                  </div>
              </div>
              <div class="row mt-2 gy-4">
                  <div class="col-md-4">
                      <div class="form-floating form-floating-outline">
                        <input class="form-control" type="text" id="tag" name="tag" placeholder="Tag"/>
                        <label for="tag">Tag:</label>
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
