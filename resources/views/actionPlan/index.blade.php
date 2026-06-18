@extends('layoutAdmin')

@section('conteudo')
<style>
    tr, td, th{
        font-size: 12px !important;
    }
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            {!! $filtro !!}
            <form action="" method="get">
                <div class="row mt-3">
                    <div class="col-md-3 form-group">
                        <label for="">Início:</label>
                        <input onchange="submit()" type="date" name="dtInc" class="form-control" value="{{ $GET['dtInc'] }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Fim:</label>
                        <input onchange="submit()" type="date" name="dtFn" class="form-control" value="{{ $GET['dtFn'] }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Quem:</label>
                        <select onchange="submit()" name="dsQuem" class="form-control">
                            <option></option>
                            <option @if($GET['dsQuem'] == 'Aluno') selected @endif value="Aluno">Aluno</option>
                            <option @if($GET['dsQuem'] == 'Smart Money Makers') selected @endif value="Smart Money Makers">Smart Money Makers</option>
                        </select>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Situação:</label>
                        <select onchange="submit()" name="situacao" class="form-control">
                            <option></option>
                            <option @if($GET['situacao'] == "Não Iniciado") selected @endif value="Não Iniciado">Não Iniciado</option>
                            <option @if($GET['situacao'] == "Em Andamento") selected @endif value="Em Andamento">Em Andamento</option>
                            <option @if($GET['situacao'] == "Atrasado") selected @endif value="Atrasado">Atrasado</option>
                            <option @if($GET['situacao'] == "Concluído") selected @endif value="Concluído">Concluído</option>
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Action Plan</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <div class="col-md-6">
                        <button type="button" class='btn btn-sm btn-primary' id='botaoAdicionarPlan'>Adicionar Plan</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table class="table" id="table-index">
                            <thead>
                                <tr>
                                    <td><b>Quando?<b></td>
                                    <td><b>Aluno<b></td>
                                    <td><b>O quê?</b></td>
                                    <td><b>Quem?</b></td>
                                    <td><b>Como?</b></td>
                                    <td><b>Onde?</b></td>
                                    <td><b>Quanto?</b></td>
                                    <td><b>Situação</b></td>
                                </tr>
                            </thead>
                            @foreach($actions as $linha)
                                @php
                                $color = "";
                                if($linha->quem == "Smart Money Makers"){
                                    $color = "white";
                                }
                                @endphp
                              <tr @if($linha->quem == 'Smart Money Makers') style='cursor: pointer' onclick="abrirModalEditar({{ $linha->id }})" @endif>
                                  <td style="color: {{ $color }}"> <span style='display: none'>{{ strtotime($linha->quando) }}</span> {{ dataDbForm($linha->quando) }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->nmAluno }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->oque }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->quem == 'Aluno' ? $linha->nmAluno : 'Smart Money Makers' }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->como }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->onde }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->quanto }}</td>
                                  <td style="color: {{ $color }}">{{ $linha->status }}</td>
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
  $('#div_filtro_pagina_2').hide();
})

</script>

<!-- modal de edição da plan -->
<div class="modal fade" id="modalPlanEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id='formulario' action="{{ route('actionPlan.update') }}" method="post">
                @csrf
                <input type="hidden" name="id", id="editar_id">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class='card-title'>Editar Action Plan</h5>
                            <div class="row">
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">O que?</label><br>
                                    <b id='editar_oque'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quem?</label><br>
                                    <b id='editar_quem'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quando?</label><br>
                                    <b id='editar_quando'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Como?</label><br>
                                    <b id='editar_como'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Onde?</label><br>
                                    <b id='editar_onde'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quanto?</label><br>
                                    <b id='editar_quanto'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Status?</label>
                                    <select required name="status" id="editar_status" class="form-control">
                                        <option value=""></option>
                                        <option value="Não Iniciado">Não Iniciado</option>
                                        <option value="Em Andamento">Em Andamento</option>
                                        <option value="Atrasado">Atrasado</option>
                                        <option value="Concluído">Concluído</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" id="btnExcluirAction" class="btn btn-danger">Excluir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
function abrirModalEditar(id){
    $.getJSON(
        '{{ route("actionPlan.buscar") }}',{
            id : id
        },
        function(json){
            document.getElementById('editar_id').value = id;
            document.getElementById('editar_oque').innerHTML = json.oque;
            document.getElementById('editar_quem').innerHTML = json.quem;
            document.getElementById('editar_quando').innerHTML = json.quando;
            document.getElementById('editar_como').innerHTML = json.como;
            document.getElementById('editar_onde').innerHTML = json.onde;
            document.getElementById('editar_quanto').innerHTML = json.quanto;
            document.getElementById('editar_status').value = json.status;

            const myModal = new bootstrap.Modal(document.getElementById('modalPlanEditar'));
            myModal.show();
        }
    );
}

document.getElementById('btnExcluirAction').addEventListener('click', ()=>{
    if(confirm('Tem certeza que deseja excluir este action plan?')){
        id = document.getElementById('editar_id').value;

        window.location.href = "{{ route('actionPlan.delete') }}?id=" + id;
    }
})
</script>

@endsection
