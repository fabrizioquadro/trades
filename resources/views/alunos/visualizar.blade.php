@extends('layoutAdmin')

@section('conteudo')
@php
if($aluno->imagem == ""){
    $avatar = "/public/img/IconsPng/Usuarios.png";
}
else{
    $avatar = "/public/img/alunos/".$aluno->imagem."?".date('YmdHis');
}
@endphp
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Visualizar Aluno</h5>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <!-- User Card -->
                    <div class="card mb-4">
                        <div class="card-body">
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
                            <h5 class="pb-3 border-bottom mb-3">Details</h5>
                            <div class="info-container">
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Email:</span>
                                        <span>{{ $aluno->dsEmail }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Telefone:</span>
                                        <span>{{ $aluno->nrTel }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Status:</span>
                                        <span class="badge bg-label-{{ $aluno->stAluno == 'Ativo' ? 'success' : 'danger' }} rounded-pill">{{ $aluno->stAluno }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Endereço:</span>
                                        <span>{{ $aluno->dsEndereco }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Numero:</span>
                                        <span>{{ $aluno->nrEndereco }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Complemento:</span>
                                        <span>{{ $aluno->dsComplemento }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Bairro:</span>
                                        <span>{{ $aluno->dsBairro }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Cidade:</span>
                                        <span>{{ $aluno->nmCidade }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Estado:</span>
                                        <span>{{ $aluno->dsEstado }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Pais:</span>
                                        <span>{{ $aluno->nmPais }}</span>
                                    </li>
                                    <li class="mb-3">
                                        <span class="fw-medium text-heading me-2">Cep:</span>
                                        <span>{{ $aluno->nrCep }}</span>
                                    </li>
                                </ul>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('alunos.editar', $aluno->id) }}" class="btn btn-primary">Editar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /User Card -->
                </div>
                <div class="col-md-6">
                    <!-- tags -->
                    <div class="card mb-4">
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
                                    @if($check == "checked")
                                    <div class="col-md-3">
                                        <div class="form-check">
                                            <label class="form-check-label" for="checkTag{{ $tag->id }}"> {{ $tag->nmTag }} </label>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- tags -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
