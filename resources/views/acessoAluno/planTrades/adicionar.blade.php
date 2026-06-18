@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Plan Trade</h5>
                </div>
            </div>
            <form action="{{ route('aluno.planTrade.insert') }}" method="post">
                @csrf
                <div class="row align-items-end">
                    <div class="col-md-6 form-group">
                        <label for="">Nome:</label>
                        <input type="text" required name="nmPlan" class="form-control">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Número Plan:</label>
                        <select required name="nrPlan" class="form-control">
                            <option></option>
                            @if($ativo1)<option value="1">Plan 1 - {{ $ativo1->nome." - ".$ativo1->corretora() }}</option>@endif
                            @if($ativo2)<option value="2">Plan 2 - {{ $ativo2->nome." - ".$ativo2->corretora() }}</option>@endif
                            @if($ativo3)<option value="3">Plan 3 - {{ $ativo3->nome." - ".$ativo3->corretora() }}</option>@endif
                            @if($ativo4)<option value="4">Plan 4 - {{ $ativo4->nome." - ".$ativo4->corretora() }}</option>@endif
                            @if($ativo5)<option value="5">Plan 5 - {{ $ativo5->nome." - ".$ativo5->corretora() }}</option>@endif
                        </select>
                    </div>
                    <div class="col-md-4 form-group mt-5">
                        <label for="">Data Início:</label>
                        <input required type="date" name="dtInc" class="form-control">
                    </div>
                    <div class="col-md-4 form-group mt-5">
                        <label for="">Valor Início:</label>
                        <input required class="form-control" type="text" name="vlInc" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    </div>
                    <div class="col-md-4 form-group mt-5">
                        <button type="submit" class="btn btn-primary me-2">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
