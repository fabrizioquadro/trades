@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Visualizar Fase</h5>
            </div>
            <div class="row">
                <div class="col-md-3 form-group">
                    <label for="">Nome:</label><br>
                    <b>{{ $fase->nmFase }}</b>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Início:</label><br>
                    <b>{{ $fase->vlInc }}</b>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Fim:</label><br>
                    <b>{{ $fase->vlFn }}</b>
                </div>
                <div class="col-md-3 form-group">
                    <label for="">Ícone:</label><br>
                    <b>{{ $fase->icone }}</b>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12 form-group">
                    <label for="">Informação</label><br>
                    {!! $fase->descricao !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
