@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Mensagens</h5>
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
                                    <th style="text-align:left !important">Data</th>
                                    <th style="text-align:left !important">Nome</th>
                                </tr>
                            </thead>
                            @foreach($mensagens as $mensagem)
                              @php
                              $var = explode(' ',$mensagem->dtHrMensagem);
                              $dtHrMensagem = dataDbForm($var[0])." ".$var[1];
                              @endphp
                              <tr style='cursor: pointer' onclick="abrirMensagem({{ $mensagem->id_aluno }})">
                                  <td>
                                      @if($mensagem->stViewAdm == "Não")
                                          <span style='display:none'>AA</span>
                                          <img src="{{ asset('/public/img/IconsPng/Notificacoes.png') }}" height="25px" alt="">
                                      @else
                                          <span style='display:none'>ZZ</span>
                                      @endif


                                  </td>
                                  <td style="text-align:left !important"> <span style='display:none'>{{ strtotime($mensagem->dtHrMensagem) }}</span> {{ $dtHrMensagem }}</td>
                                  <td style="text-align:left !important">{{ $mensagem->nmAluno }}</td>
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
    order: [[0, 'asc'],[1, 'desc'],[2, 'asc']],
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

function abrirMensagem(aluno_id){
    window.location.href = "{{ route('mensagens.aluno') }}/" + aluno_id;
}

</script>

@endsection
