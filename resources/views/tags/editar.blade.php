@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Tag</h5>
                </div>
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
