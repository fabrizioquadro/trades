@extends('layoutAluno')

@section('conteudo')
<style>
    tr, td, th{
        font-size: 12px !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            @if($mensagemAlerta = Session::get('mensagemAlerta'))
              <div class="alert alert-danger alert-dismissible" role="alert">
                {{ $mensagemAlerta }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="row mb-3">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <h5 class="card-title">Plan Trades</h5>
                    </div>
                    <div class="col-md-6" align='right'>
                        <div class="col-md-6">
                            <a href="{{ route('aluno.planTrade.adicionar') }}" class='btn btn-sm btn-primary' id='botaoAdicionarTrade'>Adicionar Plan</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="table-index">
                            <thead>
                                <tr>
                                    <td><b>Nome Plan</b></td>
                                    <td><b>Ativo</b></td>
                                    <td><b>Número Plan</b></td>
                                    <td><b>Data Início</b></td>
                                    <td><b>Valor Início</b></td>
                                </tr>
                            </thead>
                            @foreach($plans as $linha)
                              <tr style='cursor: pointer' onclick="acessarPlan({{ $linha->id }})">
                                  <td>{{ $linha->nmPlan }}</td>
                                  <td>{{ $linha->ativo->nome." - ".$linha->ativo->corretora() }}</td>
                                  <td>{{ $linha->nrPlan }}</td>
                                  <td>{{ dataDbForm($linha->dtInc) }}</td>
                                  <td>{{ valorDbForm($linha->vlInc) }}</td>
                                  {{--
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu" data-popper-placement="bottom-end">
                                          <a class="dropdown-item waves-effect" href="{{ route('aluno.planTrade.acessar', $linha->id) }}">
                                              <img src="{{ asset('/public//img/IconsPng/Visualizar.png') }}" height="35px" alt="" style="margin-right: 10px">
                                               Acessar
                                           </a>
                                          <a class="dropdown-item waves-effect" href="{{ route('aluno.planTrade.excluir', $linha->id) }}">
                                              <img src="{{ asset('/public//img/IconsPng/Excluir.png') }}" height="35px" alt="" style="margin-right: 10px">
                                              Excluir
                                          </a>
                                      </div>
                                    </div>
                                  </td>
                                  --}}
                              </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[0, 'asc']],
    "language": {
			"sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sInfoPostFix": "",
      "sInfoThousands": ".",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "Pesquisar",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    }
  });
})

function acessarPlan(id){
    window.location.href = "{{ route('aluno.planTrade.acessar') }}/" + id;
}

</script>

@endsection
