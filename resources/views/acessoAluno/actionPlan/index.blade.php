@extends('layoutAluno')

@section('conteudo')
@php
$aluno = session()->get('aluno');
@endphp
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
                                    <td><b>O quê?</b></td>
                                    <td><b>Quem?</b></td>
                                    <td><b>Como?</b></td>
                                    <td><b>Onde?</b></td>
                                    <td><b>Quanto?</b></td>
                                    <td><b>Situação</b></td>
                                </tr>
                            </thead>
                            @foreach($actions as $linha)
                              <tr style='cursor: pointer' onclick="abrirModalEditar({{ $linha->id }})">
                                  <td> <span style='display: none'>{{ strtotime($linha->quando) }}</span> {{ dataDbForm($linha->quando) }}</td>
                                  <td>{{ $linha->oque }}</td>
                                  <td>{{ $linha->quem == 'Aluno' ? $aluno->nmAluno : $linha->quem }}</td>
                                  <td>{{ $linha->como }}</td>
                                  <td>{{ $linha->onde }}</td>
                                  <td>{{ $linha->quanto }}</td>
                                  <td>{{ $linha->status }}</td>
                              </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de adicionar trade -->
<div class="modal fade" id="modalPlan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id='formulario' action="{{ route('aluno.actionPlan.insert') }}" method="post">
                @csrf
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h5 class='card-title'>Action Plan</h5>
                            <div class="row">
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">O quê?</label>
                                    <input type="text" required name="oque" id="oque" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quem?</label>
                                    <select required name="quem" id="quem" class="form-control">
                                        <option value=""></option>
                                        <option value="Aluno">{{ $aluno->nmAluno }}</option>
                                        <option value="Smart Money Makers">Smart Money Makers</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quando?</label>
                                    <input required type="date" name="quando" id="quando" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Como?</label>
                                    <input type="text" name="como" id="como" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Onde?</label>
                                    <input type="text" name="onde" id="onde" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quanto?</label>
                                    <input type="text" name="quanto" id="quanto" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
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

document.getElementById('botaoAdicionarPlan').addEventListener('click', ()=>{
    const myModal = new bootstrap.Modal(document.getElementById('modalPlan'));
    myModal.show();
})

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
})

</script>

<!-- modal de edição da plan -->
<div class="modal fade" id="modalPlanEditar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id='formulario' action="{{ route('aluno.actionPlan.update') }}" method="post">
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
                                    <label for="">O que?</label>
                                    <input type="text" required name="oque" id="editar_oque" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quem?</label>
                                    <select required name="quem" id="editar_quem" class="form-control">
                                        <option value=""></option>
                                        <option value="Aluno">{{ $aluno->nmAluno }}</option>
                                        <option value="Smart Money Makers">Smart Money Makers</option>
                                    </select>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quando?</label>
                                    <input required type="date" name="quando" id="editar_quando" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Como?</label>
                                    <input type="text" name="como" id="editar_como" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Onde?</label>
                                    <input type="text" name="onde" id="editar_onde" class="form-control">
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quanto?</label>
                                    <input type="text" name="quanto" id="editar_quanto" class="form-control">
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
                                    <button type="button" class="btn btn-danger" id="btnExcluirAction">Excluir</button>
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
        '{{ route("aluno.actionPlan.buscar") }}',{
            id : id
        },
        function(json){
            document.getElementById('editar_id').value = id;
            document.getElementById('editar_oque').value = json.oque;
            document.getElementById('editar_quem').value = json.quem;
            document.getElementById('editar_quando').value = json.quando;
            document.getElementById('editar_como').value = json.como;
            document.getElementById('editar_onde').value = json.onde;
            document.getElementById('editar_quanto').value = json.quanto;
            document.getElementById('editar_status').value = json.status;

            const myModal = new bootstrap.Modal(document.getElementById('modalPlanEditar'));
            myModal.show();
        }
    );
}

document.getElementById('btnExcluirAction').addEventListener('click', ()=>{
    if(confirm('Tem certeza que deseja excluir este action plan?')){
        id = document.getElementById('editar_id').value;

        window.location.href = "{{ route('aluno.actionPlan.delete') }}?id=" + id;
    }
})
</script>

@endsection
