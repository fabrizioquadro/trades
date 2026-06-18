@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Excluir Prontuário Aluno</h5>
            </div>
            <form action="{{ route('prontuarioAluno.delete') }}" method="post">
                <input type="hidden" name="prontuario_id" value="{{ $prontuario->id }}">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-12 form-group">
                        <p>Tem certeza que deseja excluir o prontuario de aula {{ $prontuario->aula }} do aluno {{ $prontuario->aluno->nmAluno }}?</p>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-danger me-2">Excluir</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
    $('.combobox').combobox();
});
</script>
@endsection
