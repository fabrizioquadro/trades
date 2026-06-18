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
                    <h5 class="card-title">Notes</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <a href="{{ route('aluno.notes.adicionar')}}" class="dt-button add-new btn btn-primary" type="button">
                      <span>
                        <i class="mdi mdi-plus me-0 me-sm-1"></i>
                        <span class="d-none d-sm-inline-block">Add</span>
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
                                    <th>Data/Hora</th>
                                    <th>Tema</th>
                                </tr>
                            </thead>
                            @foreach($notes as $linha)
                            @php
                            $var = explode(' ', $linha->dtHrNote);
                            $data = dataDbForm($var[0])." ".$var[1];
                            @endphp
                              <tr style='cursor: pointer' onclick="acessarNote({{ $linha->id }})">
                                  <td><span style='display:none'>{{ strtotime($linha->dtHrNote) }}</span>{{ $data }}</td>
                                  <td>{{ $linha->tema }}</td>
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

function acessarNote(id){
    window.location.href = "{{ route('aluno.notes.editar') }}/" + id;
}

</script>

@endsection
