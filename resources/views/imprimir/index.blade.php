@extends('layoutImprimir')

@section('conteudo')
    <div class="row justify-content-between">
        <div class="col">
            <h6>{{ $titulo }}</h6>
        </div>
        <div class="col" align='right'>
            <span>Gerado em: {{ date('d/m/Y H:i:s') }}</span>
        </div>
    </div>
    <div>
        {!! $dados !!}
    </div>
@endsection
