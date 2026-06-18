@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Tickets</h5>
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
                        <table class="tabela-index" id="table-index">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Data/Hora</th>
                                    <th>Aluno</th>
                                    <th>Assunto</th>
                                    <th>Situação</th>
                                </tr>
                            </thead>
                            @foreach($tickets as $ticket)
                              @php
                              $var = explode(' ', $ticket->dtHrTicket);
                              $dtHrTicket = dataDbForm($var[0])." ".$var[1];
                              @endphp
                              <tr style='cursor: pointer' onclick='acessaTicket({{ $ticket->id }})'>
                                  <td>
                                      @if($ticket->stLidoAdm == "Não")
                                          <img title="Novas Mensagens" src="{{ asset('/public/img/IconsPng/Mensagens.png') }}" alt="" height="40px">
                                      @endif
                                  </td>
                                  <td>{{ $dtHrTicket }}</td>
                                  <td>{{ $ticket->aluno->nmAluno }}</td>
                                  <td>{{ $ticket->dsAssunto }}</td>
                                  <td>{{ $ticket->stTicket }}</td>
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

function acessaTicket(id){
    window.location.href = "{{ route('tickets.acessar') }}/" + id;
}

</script>

@endsection
