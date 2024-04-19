@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Ativos</h5>
                </div>
                @if(auth()->user()->tipo == "Administrador")
                    <div class="col-md-6" align='right'>
                        <a href="{{ route('ativos.adicionar')}}" class="dt-button add-new btn btn-primary" type="button">
                          <span>
                            <i class="mdi mdi-plus me-0 me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Add Ativo</span>
                          </span>
                        </a>
                        <a href="{{ route('ativos.importar')}}" class="dt-button add-new btn btn-secondary" type="button">
                          <span>
                            <span class="d-none d-sm-inline-block">Importar</span>
                          </span>
                        </a>
                    </div>
                @endif
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
                                    <th style="text-align:left !important">Nome</th>
                                    <th>Pais</th>
                                    <th>Tipo</th>
                                    <th>Exchange</th>
                                    <th>Simbolo</th>
                                    <th>Valor</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($ativos as $linha)
                              @php
                              $moeda = '';
                              if($linha->moedaAtivo == "BRL"){
                                  $moeda = "R$";
                              }
                              elseif($linha->moedaAtivo == "USD"){
                                  $moeda = "US$";
                              }
                              elseif($linha->moedaAtivo == "EUR"){
                                  $moeda = "€";
                              }
                              elseif($linha->moedaAtivo == "GBP"){
                                  $moeda = "£";
                              }
                              elseif($linha->moedaAtivo == "JPY"){
                                  $moeda = "¥$";
                              }
                              @endphp
                              <tr>
                                  <td style="text-align:left !important">{{ $linha->nome }}</td>
                                  <td>{{ $linha->pais }}</td>
                                  <td>{{ $linha->tipoAtivo }}</td>
                                  <td>{{ $linha->exchange }}</td>
                                  <td>{{ $linha->simbolo }}</td>
                                  <td>{{ $moeda." ".valorDbForm($linha->valor) }}</td>
                                  <td>{{ $linha->stAtivo }}</td>
                                  <td>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                          @if(auth()->user()->tipo == "Administrador")
                                              <a class="dropdown-item waves-effect" href="{{ route('ativos.editar', $linha->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                              <a class="dropdown-item waves-effect" href="{{ route('ativos.excluir', $linha->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
                                          @endif
                                          <a class="dropdown-item waves-effect" href="{{ route('ativos.visualizar', $linha->id) }}"><i class="mdi mdi-eye-outline me-1"></i> Visualizar</a>
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
