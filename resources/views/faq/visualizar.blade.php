@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Visualizar Faq</h5>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-12 form-group">
                    <label for="pergunta">Pergunta:</label><br>
                    <b>{{ $faq->pergunta }}"</b>
                </div>
            </div>
            <div class="row mt-2 gy-4">
                <div class="col-md-12 form-group">
                    <label for="pergunta">Resposta:</label><br>
                    <b>{{ $faq->resposta }}"</b>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
