@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Adicionar Aluno</h5>
            </div>
            <form action="{{ route('alunos.insert') }}" method="post" enctype="multipart/form-data">
                @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmAluno" name="nmAluno" placeholder="Nome"/>
                    <label for="nmAluno">Nome:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dsEmail" name="dsEmail" placeholder="john.doe@example.com" />
                    <label for="dsEmail">E-mail:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="userTradingView" name="userTradingView" placeholder="User TradingView:" />
                    <label for="userTradingView">User TradingView:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-4 mt-3">
                    <div class="form-check form-check-primary mt-3">
                      <input class="form-check-input" type="checkbox" value="sim" name="enviarSenhaEmail" id="enviarSenhaEmail">
                      <label class="form-check-label" for="customCheckPrimary">Enviar Senha Email</label>
                    </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="password" id="dsSenha" name="dsSenha" minlength='6' placeholder="********" />
                    <label for="dsSenha">Senha:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="password" id="dsContraSenha" placeholder="********" />
                    <label for="dsContraSenha">Contra Senha:</label>
                  </div>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsEndereco" name="dsEndereco" placeholder="Endereço"/>
                    <label for="dsEndereco">Endereço:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrEndereco" name="nrEndereco" placeholder="Numero"/>
                    <label for="nrEndereco">Número:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsComplemento" name="dsComplemento" placeholder="Complemento"/>
                    <label for="dsComplemento">Complemento:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsBairro" name="dsBairro" placeholder="Bairro"/>
                    <label for="dsBairro">Bairro:</label>
                  </div>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nmCidade" name="nmCidade" placeholder="Cidade"/>
                    <label for="nmCidade">Cidade:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsEstado" name="dsEstado" placeholder="Estado"/>
                    <label for="dsEstado">Estado:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nmPais" name="nmPais" placeholder="Pais"/>
                    <label for="nmPais">País:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrCep" name="nrCep" placeholder="Código Postal"/>
                    <label for="nrCep">Código Postal:</label>
                  </div>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrTel" name="nrTel" placeholder="Telefone"/>
                    <label for="nrTel">Telefone:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="type" name='stAluno' class="select2 form-select">
                      <option value="">Opções</option>
                      <option value="Ativo">Ativo</option>
                      <option value="Inativo">Inativo</option>
                    </select>
                    <label for="type">Situação:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" id="imagem" name="imagem"/>
                    <label for="imagem">Imagem(Foto):</label>
                  </div>
                </div>
              </div>
              <div class="card mt-4">
                  <div class="card-body">
                    <h5 class="card-title">Tags</h5>
                    <div class="row">
                        @foreach($tags as $tag)
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="checkTag{{ $tag->id }}">
                                    <label class="form-check-label" for="checkTag{{ $tag->id }}"> {{ $tag->nmTag }} </label>
                                </div>
                            </div>
                        @endforeach
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
<script>
document.getElementById('enviarSenhaEmail').addEventListener('click', (e)=>{
    if(e.target.checked){
        document.getElementById('dsSenha').removeAttribute('required');
        document.getElementById('dsSenha').setAttribute('readonly','readonly');
        document.getElementById('dsContraSenha').removeAttribute('required');
        document.getElementById('dsContraSenha').setAttribute('readonly','readonly');
        document.getElementById('dsSenha').value = '';
        document.getElementById('dsContraSenha').value = '';
    }
    else{
        document.getElementById('dsSenha').setAttribute('required','required');
        document.getElementById('dsSenha').removeAttribute('readonly');
        document.getElementById('dsContraSenha').setAttribute('required','required');
        document.getElementById('dsContraSenha').removeAttribute('readonly');
    }
})
document.getElementById('dsContraSenha').addEventListener('blur', ()=>{
    if(document.getElementById('dsSenha').value != document.getElementById('dsContraSenha').value){
        alert('Senha e contra-senha não são iguais');
        document.getElementById('dsContraSenha').value = "";
        document.getElementById('dsSenha').value = "";
    }
})
</script>
@endsection
