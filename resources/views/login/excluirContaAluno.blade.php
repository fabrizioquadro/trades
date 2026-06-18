@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('aluno.excluirContaDelete') }}" method="post">
                        @csrf
                        <p>Você tem certeza que deseja excluir sua conta da plataforma Smart Money Metrics? <br> *Estq ação não poderá ser revertida.</p>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="submit" name="acao" value="Excluir" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
