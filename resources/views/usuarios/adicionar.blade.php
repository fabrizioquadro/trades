@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Usuário</h5>
                </div>
            </div>
            <form action="{{ route('usuarios.insert') }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="name" name="nome" placeholder="Nome"/>
                    <label for="name">Nome:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="email" name="email" placeholder="john.doe@example.com" />
                    <label for="email">E-mail:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <select required id="type" name='tipo' class="select2 form-select">
                      <option value="">Opções</option>
                      <option value="Administrador">Administrador</option>
                      <option value="Usuário">Usuário</option>
                    </select>
                    <label for="type">Tipo de Usuário:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="password" id="password" name="password" placeholder="********" />
                    <label for="password">Senha:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" id="imagem" name="imagem"/>
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
