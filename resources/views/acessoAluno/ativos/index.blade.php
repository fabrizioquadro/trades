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
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Ativos</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="table-index">
                            <thead>
                                <tr>
                                    <td><b>Favoritar<b></td>
                                    <td><b>Nome</b></td>
                                    <td><b>País</b></td>
                                    <td><b>Corretora</b></td>
                                    <td><b>Tipo</b></td>
                                    <td><b>Exchange</b></td>
                                    <td><b>Símbolo</b></td>
                                    <td><b>Valor</b></td>
                                    <td><b>Situação</b></td>
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

                            $color = 'yellow';
                            if(array_search($linha->id, $favoritos) === false){
                                $color = 'white';
                            }
                            @endphp
                              <tr>
                                  <td><span class="mdi mdi-star-circle-outline" id="estrela_{{ $linha->id }}" style="color:{{ $color }};" onclick="setarFavorito({{ $linha->id }})"></span></td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $linha->nome }}</td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $linha->pais }}</td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">
                                      @foreach($corretoras as $corretora)
                                          @php
                                          $checked = "";
                                          $controle = testaCorretoraAtivo($linha->id, $corretora->id);
                                          if($controle){
                                              @endphp
                                              {{ $corretora->nome }}
                                              @php
                                          }
                                          @endphp
                                      @endforeach
                                  </td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $linha->tipoAtivo }}</td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $linha->exchange }}</td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $linha->simbolo }}</td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $moeda." ".valorDbForm($linha->valor) }}</td>
                                  <td style='cursor: pointer' onclick="redireciona({{ $linha->id }})">{{ $linha->stAtivo }}</td>
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
function setarFavorito(ativo_id){
    $.getJSON(
        "{{ route('aluno.ativos.favorito') }}",
        {
            ativo_id : ativo_id
        },
        function(json){
            if(json.controle == "Inserido"){
                document.getElementById('estrela_' + ativo_id).style.color = 'yellow';
            }
            else{
                document.getElementById('estrela_' + ativo_id).style.color = 'white';
            }

        }
    );
}

window.addEventListener('load',()=>{
  $('#table-index').DataTable({
    order: [[1, 'asc']],
    lengthMenu: [
        [50, 100, -1],
        [50, 100, 'All']
    ],
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

function redireciona(id){
    window.location.href = "{{ route('aluno.ativos.visualizar') }}/" + id;
}

</script>

@endsection
