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
<div class="row justify-content-md-center">
    <div class="col-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-header text-center">Perfil</h5>
                <div class="user-avatar-section">
                    <div class="d-flex align-items-center flex-column">
                        <img
                        class="img-fluid rounded mb-3 mt-4"
                        src="{{ asset($avatar) }}"
                        height="120"
                        width="120"
                        alt="User avatar" />
                        <div class="user-info text-center">
                            <h4>{{ $aluno->nmAluno }}</h4>
                        </div>
                    </div>
                </div>
                <hr>
                <h5 class="text-center pb-3 border-bottom mb-3">Detalhes</h5>
                <form method="POST" action='{{ route('aluno.perfil.update') }}' enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-2 gy-4">
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input required class="form-control" type="text" id="nmAluno" name="nmAluno" value="{{ $aluno->nmAluno }}" />
                                <label for="nmAluno">Nome:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input disabled class="form-control" type="text" id="dsEmail" name="dsEmail" placeholder="john.doe@example.com" value="{{ $aluno->dsEmail }}">
                                <label for="dsEmail">E-mail:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="userTradingView" name="userTradingView" placeholder="User TradingView:" value="{{ $aluno->userTradingView }}">
                                <label for="userTradingView">User TradingView:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="dsEndereco" name="dsEndereco" placeholder="Endereço" value="{{ $aluno->dsEndereco }}"/>
                                <label for="dsEndereco">Endereço:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="nrEndereco" name="nrEndereco" placeholder="Numero" value="{{ $aluno->nrEndereco }}"/>
                                <label for="nrEndereco">Numero:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="dsComplemento" name="dsComplemento" placeholder="Complemento" value="{{ $aluno->dsComplemento }}"/>
                                <label for="dsComplemento">Complemento:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="dsBairro" name="dsBairro" placeholder="Bairro" value="{{ $aluno->dsBairro }}"/>
                                <label for="dsBairro">Bairro:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="nmCidade" name="nmCidade" placeholder="Cidade" value="{{ $aluno->nmCidade }}"/>
                                <label for="nmCidade">Cidade:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="dsEstado" name="dsEstado" placeholder="Estado" value="{{ $aluno->dsEstado }}"/>
                                <label for="dsEstado">Estado:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="nmPais" name="nmPais" placeholder="Pais" value="{{ $aluno->nmPais }}"/>
                                <label for="nmPais">Pais:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="nrCep" name="nrCep" placeholder="Código Postal" value="{{ $aluno->nrCep }}"/>
                                <label for="nrCep">Código Postal:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="text" id="nrTel" name="nrTel" placeholder="Telefone" value="{{ $aluno->nrTel }}"/>
                                <label for="nrTel">Telefone:</label>
                            </div>
                        </div>
                        <div class="col-md-12 mt-3">
                            <div class="form-floating form-floating-outline">
                                <input class="form-control" type="file" id="imagem" name="imagem" placeholder="Imagem"/>
                                <label for="imagem">Imagem:</label>
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
</div>
@endsection
