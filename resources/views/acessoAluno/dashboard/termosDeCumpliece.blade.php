@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card bg-secondary text-white mb-3">
        <div class="card-header text-center">
            <img src="{{ asset($logo) }}" height="80px" alt="">
        </div>
        <div class="card-body">
            <p class="card-text">{!!$dados !!}</p>
            <div class="row mt-5">
                <div class="col-md-12">
                    <p class="card-text">Data Aceite: {{ $log }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
