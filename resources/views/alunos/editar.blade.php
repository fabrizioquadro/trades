@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Editar Aluno</h5>
                </div>
            </div>
            <form action="{{ route('alunos.update') }}" method="post" enctype="multipart/form-data">
              @csrf
              <input type="hidden" name="id" value="{{ $aluno->id }}">
              <div class="row mt-2 gy-4">
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nmAluno" name="nmAluno" placeholder="Nome" value="{{ $aluno->nmAluno }}">
                    <label for="nmAluno">Nome:</label>
                  </div>
                </div>
                <div class="col-md-6 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dsEmail" name="dsEmail" placeholder="john.doe@example.com" value="{{ $aluno->dsEmail }}">
                    <label for="dsEmail">E-mail:</label>
                  </div>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsEndereco" name="dsEndereco" placeholder="Endereço" value="{{ $aluno->dsEndereco }}"/>
                    <label for="dsEndereco">Endereço:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrEndereco" name="nrEndereco" placeholder="Numero" value="{{ $aluno->nrEndereco }}"/>
                    <label for="nrEndereco">Numero:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsComplemento" name="dsComplemento" placeholder="Complemento" value="{{ $aluno->dsComplemento }}"/>
                    <label for="dsComplemento">Complemento:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsBairro" name="dsBairro" placeholder="Bairro" value="{{ $aluno->dsBairro }}"/>
                    <label for="dsBairro">Bairro:</label>
                  </div>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nmCidade" name="nmCidade" placeholder="Cidade" value="{{ $aluno->nmCidade }}"/>
                    <label for="nmCidade">Cidade:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="dsEstado" name="dsEstado" placeholder="Estado" value="{{ $aluno->dsEstado }}"/>
                    <label for="dsEstado">Estado:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nmPais" name="nmPais" placeholder="Pais" value="{{ $aluno->nmPais }}"/>
                    <label for="nmPais">Pais:</label>
                  </div>
                </div>
                <div class="col-md-3 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrCep" name="nrCep" placeholder="Código Postal" value="{{ $aluno->nrCep }}"/>
                    <label for="nrCep">Código Postal:</label>
                  </div>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="text" id="nrTel" name="nrTel" placeholder="Telefone" value="{{ $aluno->nrTel }}"/>
                    <label for="nrTel">Telefone:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="type" name='stAluno' class="select2 form-select">
                      <option value="">Opções</option>
                      <option @if($aluno->stAluno == "Ativo") selected @endif value="Ativo">Ativo</option>
                      <option @if($aluno->stAluno == "Inativo") selected @endif value="Inativo">Inativo</option>
                    </select>
                    <label for="type">Situação:</label>
                  </div>
                </div>
                <div class="col-md-4 mt-3">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="file" id="imagem" name="imagem"/>
                  </div>
                </div>
              </div>
              <div class="card mt-4">
                  <div class="card-body">
                    <h5 class="card-title">Tags</h5>
                    <div class="row">
                        @foreach($tags as $tag)
                            @php
                            $check = "";
                            foreach($alunoTags as $linha){
                                if($linha->id_tag == $tag->id){
                                    $check = 'checked';
                                }
                            }
                            @endphp
                            <div class="col-md-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="tags[]" value="{{ $tag->id }}" id="checkTag{{ $tag->id }}" {{ $check }}>
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
@endsection
