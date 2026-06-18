@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Visualizar Prontuário Aluno</h5>
            </div>
            <div class="row mt-3">
                <div class="col-md-6 form-group">
                    <label for="">Aluno:</label><br>
                    <b>{{ $prontuario->aluno->nmAluno }}</b>
                </div>
                <div class="col-md-6 form-group">
                    <label for="">Aula:</label><br>
                    <b>{{ $prontuario->aula }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 form-group">
                    <label for="">Data:</label><br>
                    <b>{{ dataDbForm($prontuario->dtAula) }}</b>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Hora Início:</label><br>
                    <b>{{ $prontuario->hrInc }}</b>
                </div>
                <div class="col-md-4 form-group">
                    <label for="">Hora Fim:</label><br>
                    <b>{{ $prontuario->hrFn }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 form-group">
                    <label for="">Presença:</label><br>
                    <b>{{ $prontuario->presenca }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 form-group">
                    <label for="">Permanência:</label><br>
                    <b>{{ $prontuario->permanencia }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 form-group">
                    <label for="">Participação:</label><br>
                    <b>{{ $prontuario->participacao }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 form-group">
                    <label for="">Atenção:</label><br>
                    <b>{{ $prontuario->atencao }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-4 form-group">
                    <label for="">Exercícios:</label><br>
                    <b>{{ $prontuario->exercicios }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 form-group">
                    <label for="">Prontuário:</label><br>
                    <b>{!! $prontuario->descricao !!}</b>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
