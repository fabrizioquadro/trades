@extends('layoutAluno')

@section('conteudo')
<style media="screen">
    tr, td, th{
        font-size: 12px !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Contas</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <a href="{{ route('aluno.contas.adicionar')}}" class="dt-button add-new btn btn-primary" type="button">
                      <span>
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Add Conta</span>
                      </span>
                    </a>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="datatables-basic table" id="table-index">
                            <thead>
                                <tr>
                                    <th>Numero</th>
                                    <th>Nome</th>
                                    <th>Corretora</th>
                                    <th>Moeda</th>
                                    <th>Valor Inicial</th>
                                    <th>Descrição</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($contas as $conta)
                              <tr>
                                  <td>{{ $conta->nrConta }}</td>
                                  <td>{{ $conta->nmConta }}</td>
                                  <td>{{ $conta->nome }}</td>
                                  <td>{{ $conta->moeda }}</td>
                                  <td>R$ {{ valorDbForm($conta->vlContaInc) }}</td>
                                  <td>{{ $conta->dsConta }}</td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                          <a class="dropdown-item waves-effect" href="{{ route('aluno.contas.editar', $conta->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                          <a class="dropdown-item waves-effect" href="{{ route('aluno.contas.excluir', $conta->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
                                          <a class="dropdown-item waves-effect" href="{{ route('aluno.contas.deposito', $conta->id) }}"><i class="mdi mdi-cash-plus me-1"></i> Depósitos</a>
                                          <a class="dropdown-item waves-effect" href="{{ route('aluno.contas.saque', $conta->id) }}"><i class="mdi mdi-cash-minus me-1"></i> Saques</a>
                                      </div>
                                    </div>
                                  </td>
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

</script>

@endsection
