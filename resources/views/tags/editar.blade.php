@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Editar Tag</h5>
            </div>
            <form action="{{ route('tags.update') }}" method="post">
              @csrf
              <input type="hidden" name="id_tag" value="{{ $tag->id }}">
              <div class="row mt-2 gy-4">
                  <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nome" name="nmTag" placeholder="Tag" value="{{ $tag->nmTag }}"/>
                        <label for="nome">Tag:</label>
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
