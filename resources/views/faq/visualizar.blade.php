@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Visualizar Faq</h5>
                </div>
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
