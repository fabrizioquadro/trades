@extends('layoutAluno')

@section('conteudo')
@php
$aluno = session()->get('aluno');
if($aluno->imagem == ""){
    $avatar = "/public/assets/img/avatars/1.png";
}
else{
    $avatar = "/public/img/alunos/".$aluno->imagem."?".date('YmdHis');
}
@endphp
<form method="POST" action='{{ route('aluno.perfil.update') }}' enctype="multipart/form-data">
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
                    <div class="col-md-6 mt-3">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="text" id="nmAluno" name="nmAluno" value="{{ $aluno->nmAluno }}" />
                        <label for="nmAluno">Nome:</label>
                      </div>
                    </div>
                    <div class="col-md-6 mt-3">
                      <div class="form-floating form-floating-outline">
                        <input disabled class="form-control" type="text" id="dsEmail" name="dsEmail" placeholder="john.doe@example.com" value="{{ $aluno->dsEmail }}">
                        <label for="dsEmail">E-mail:</label>
                      </div>
                    </div>
                  </div>
                  <div class="row mt-2 gy-4">
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="dsEndereco" name="dsEndereco" placeholder="Endereço" value="{{ $aluno->dsEndereco }}"/>
                          <label for="dsEndereco">Endereço:</label>
                        </div>
                      </div>
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="nrEndereco" name="nrEndereco" placeholder="Numero" value="{{ $aluno->nrEndereco }}"/>
                          <label for="nrEndereco">Numero:</label>
                        </div>
                      </div>
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="dsComplemento" name="dsComplemento" placeholder="Complemento" value="{{ $aluno->dsComplemento }}"/>
                          <label for="dsComplemento">Complemento:</label>
                        </div>
                      </div>
                  </div>
                  <div class="row mt-2 gy-4">
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="dsBairro" name="dsBairro" placeholder="Bairro" value="{{ $aluno->dsBairro }}"/>
                          <label for="dsBairro">Bairro:</label>
                        </div>
                      </div>
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="nmCidade" name="nmCidade" placeholder="Cidade" value="{{ $aluno->nmCidade }}"/>
                          <label for="nmCidade">Cidade:</label>
                        </div>
                      </div>
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="dsEstado" name="dsEstado" placeholder="Estado" value="{{ $aluno->dsEstado }}"/>
                          <label for="dsEstado">Estado:</label>
                        </div>
                      </div>
                  </div>
                  <div class="row mt-2 gy-4">
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="nmPais" name="nmPais" placeholder="Pais" value="{{ $aluno->nmPais }}"/>
                          <label for="nmPais">Pais:</label>
                        </div>
                      </div>
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="nrCep" name="nrCep" placeholder="Código Postal" value="{{ $aluno->nrCep }}"/>
                          <label for="nrCep">Código Postal:</label>
                        </div>
                      </div>
                      <div class="col-md-4 mt-3">
                        <div class="form-floating form-floating-outline">
                          <input class="form-control" type="text" id="nrTel" name="nrTel" placeholder="Telefone" value="{{ $aluno->nrTel }}"/>
                          <label for="nrTel">Telefone:</label>
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
