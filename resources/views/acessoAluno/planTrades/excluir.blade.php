@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Excluir Plan Trade</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('aluno.planTrade.delete') }}" method="post">
                        @csrf
                        <input type="hidden" name="planTrade_id" value="{{ $plan->id }}">
                        <div class="row">
                            <div class="col-md-12">
                                <p>Tem certeza que deseja excluir a Trade Plan de nome {{ $plan->nmPlan }}?</p>
                                <button type="submit" class="btn btn-danger mt-3">Excluir</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
