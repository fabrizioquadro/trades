@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Excluir Tag</h5>
                </div>
            </div>
            <form action="{{ route('tags.delete') }}" method="post">
              @csrf
              <input type="hidden" name="id_tag" value="{{ $tag->id }}">
              <div class="row mt-2 gy-4">
                  <div class="col-md-12">
                      <p>Tem certeza que excluir a tag {{ $tag->nmTag }}</p>
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
