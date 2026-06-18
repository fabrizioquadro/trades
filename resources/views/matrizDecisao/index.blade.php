@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Matrizes de Decição</h5>
                </div>
            </div>
            {!! $filtro !!}
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="tabela-index" id="table-index">
                            <thead>
                                <tr>
                                    <th style="text-align:left !important">Aluno</th>
                                    <th style="text-align:left !important">Ativo</th>
                                    <th>Data</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($matrizes as $linha)
                              @php
                              $data = explode(' ', $linha->dtHrCadastro);
                              $data = dataDbForm($data[0])." ".$data[1];
                              @endphp
                              <tr>
                                  <td style="text-align:left !important">{{ $linha->nmAluno }}</td>
                                  <td style="text-align:left !important">{{ $linha->nome }}</td>
                                  <td>{{ $data }}</td>
                                  <td>
                                    @if(auth()->user()->tipo == "Administrador")
                                        <div class="dropdown">
                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                                <i class="mdi mdi-dots-vertical"></i>
                                            </button>
                                            <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                                <a class="dropdown-item waves-effect" href="{{ route('matrizDecisao.visualizar', $linha->id) }}">
                                                    <img src="{{ asset('/public//img/IconsPng/Visualizar.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                    Visualizar
                                                </a>
                                            </div>
                                        </div>
                                    @endif
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
    order: [[1, 'asc']],
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

  $('#div_filtro_pagina_2').hide();

})
</script>

@endsection
