@extends('layoutAdmin')

@section('conteudo')
@php
if(auth()->user()->imagem == ""){
    $avatar = "/public/assets/img/avatars/1.png";
}
else{
    $avatar = "/public/img/usuarios/".auth()->user()->imagem."?".date('YmdHis');
}
@endphp
<form method="POST" action="{{ route('perfil.update') }}" enctype="multipart/form-data">
  @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                  <img
                    src="{{ asset($avatar) }}"
                    alt="user-avatar"
                    class="d-block w-px-120 h-px-120 rounded"
                    id="uploadedAvatar" />
                  <div class="button-wrapper">
                    <h4 class="card-header">Perfil</h4>
                    <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                      <span class="d-none d-sm-block">Upload new photo</span>
                      <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                      <input type="file" onchange='submit()' id="upload" name='imagem' class="account-file-input" hidden accept="image/png, image/jpeg" />
                    </label>
                  </div>
                </div>
              </div>
              <div class="card-body pt-2 mt-1">
                  @if($mensagem = Session::get('mensagem'))
                      <div class="alert alert-solid-success" role="alert">
                          {{ $mensagem }}
                      </div>
                  @endif
                  <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="name" name="nome" value="{{ auth()->user()->nome }}" />
                        <label for="name">Nome:</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="email" name="email" value="{{ auth()->user()->email }}" placeholder="john.doe@example.com" />
                        <label for="email">E-mail:</label>
                      </div>
                    </div>
                    @php
                    $type = auth()->user()->tipo;
                    @endphp
                    @if(auth()->user()->tipo == "Administrador")
                        <div class="col-md-6">
                          <div class="form-floating form-floating-outline">
                            <select required id="type" name='tipo' class="select2 form-select">
                              <option value="">Opções</option>
                              <option @if( $type == 'Administrador') selected @endif value="Administrador">Administrador</option>
                              <option @if( $type == 'Usuário') selected @endif value="Usuário">Usuário</option>
                            </select>
                            <label for="type">Tipo de Usuário:</label>
                          </div>
                        </div>
                    @endif
                    @php
                    $moedaBase = auth()->user()->moedaBase;
                    @endphp
                    <div class="col-md-6 form-group">
                        <div class="form-floating form-floating-outline">
                            <select id="moedaBase" name="moedaBase" required="" class="select2 form-select">
                                <option value=''>Opções</option>
                                <option @if($moedaBase == "BRL") selected  @endif value="BRL">BRL</option>
                                <option @if($moedaBase == "USD") selected  @endif value="USD">USD</option>
                                <option @if($moedaBase == "EUR") selected  @endif value="EUR">EUR</option>
                                <option @if($moedaBase == "GBP") selected  @endif value="GBP">GBP</option>
                            </select>
                          <label for="moedaBase">Moeda Base:</label>
                        </div>
                    </div>
                  </div>
                  <div class="mt-4">
                      <button type="submit" class="btn btn-primary me-2">Salvar</button>
                  </div>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
    </div>
</form>
@endsection
