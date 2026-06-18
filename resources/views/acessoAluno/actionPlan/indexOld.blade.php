@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Action Plan</h5>
                </div>
                <div class="col-md-6" align='right'>
                    <button class="btn btn-primary btn-toggle-sidebar waves-effect waves-light" data-bs-toggle="offcanvas" data-bs-target="#offCanvasDiv" aria-controls="offCanvasDiv">
                        <i class="mdi mdi-plus me-1"></i>
                        <span class="align-middle">Add Plan</span>
                    </button>
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
                    @if(count($actions) > 0)
                        <ul class="list-group list-group-flush" id="listaPerguntas">
                            @foreach($actions as $linha)
                                <li data-id_action='{{ $linha->id }}' class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="d-flex justify-content-between align-items-center">
                                        <i class="drag-handle cursor-move mdi mdi-menu align-text-bottom me-2"></i>
                                        <span>{{ $linha->oque."  -  ".dataDbForm($linha->quando)."  -  ".$linha->quem."  -  ".$linha->status }}</span>
                                    </span>
                                    <div class="dropdown">
                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                        <i class="mdi mdi-dots-vertical"></i>
                                      </button>
                                      <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                          <a class="dropdown-item waves-effect" onclick='editarCard({{ $linha->id }})'><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                          <a class="dropdown-item waves-effect" onclick='visualizarCard({{ $linha->id }})'><i class="mdi mdi-eye-outline me-1"></i> Visualizar</a>
                                      </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>Não há faqs registradas</p>
                    @endif
                </div>
            </div>
            {{-- inicio do canvas --}}
            <div id='offCanvasDiv' class="offcanvas offcanvas-end kanban-update-item-sidebar">
                <div class="offcanvas-header bg-lighter py-3">
                    <h5 class="offcanvas-title">Card</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('aluno.actionPlan.insert') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12 form-group mt-4">
                                        <label for="">O que?</label>
                                        <input type="text" required name="oque" id="oque" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <label for="">Quem?</label>
                                        <select required name="quem" id="quem" class="form-control">
                                            <option value=""></option>
                                            <option value="Aluno">Aluno</option>
                                            <option value="SmartMakers">SmartMakers</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <label for="">Quando?</label>
                                        <input type="date" name="quando" id="quando" class="form-control">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fim do canvas --}}
            {{-- inicio do canvas editar --}}
            <div id='offCanvasDivEditar' class="offcanvas offcanvas-end kanban-update-item-sidebar">
                <div class="offcanvas-header bg-lighter py-3">
                    <h5 class="offcanvas-title">Card Editar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-3">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('aluno.actionPlan.update') }}" method="post">
                                @csrf
                                <input type="hidden" name="id", id="editar_id">
                                <div class="row">
                                    <div class="col-md-12 form-group mt-4">
                                        <label for="">O que?</label>
                                        <input type="text" required name="oque" id="editar_oque" class="form-control">
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <label for="">Quem?</label>
                                        <select required name="quem" id="editar_quem" class="form-control">
                                            <option value=""></option>
                                            <option value="Aluno">Aluno</option>
                                            <option value="SmartMakers">SmartMakers</option>
                                        </select>
                                    </div>
                                    <div class="col-md-12 form-group mt-4">
                                        <label for="">Quando?</label>
                                        <input type="date" name="quando" id="editar_quando" class="form-control">
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fim do canvas editar --}}
            {{-- inicio do canvas visualizar --}}
            <div id='offCanvasDivVisualizar' class="offcanvas offcanvas-end kanban-update-item-sidebar">
                <div class="offcanvas-header bg-lighter py-3">
                    <h5 class="offcanvas-title">Card Visualizar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body pt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">O que?</label><br>
                                    <b id='visualizar_oque'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quem?</label><br>
                                    <b id='visualizar_quem'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quando?</label><br>
                                    <b id='visualizar_quando'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Como?</label><br>
                                    <b id='visualizar_como'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Onde?</label><br>
                                    <b id='visualizar_onde'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Quanto?</label><br>
                                    <b id='visualizar_quanto'></b>
                                </div>
                                <div class="col-md-12 form-group mt-4">
                                    <label for="">Status?</label><br>
                                    <b id='visualizar_status'></b>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fim do canvas visualizar --}}
        </div>
    </div>
</div>
<script>

document.getElementById('btnExcluirAction').addEventListener('click', ()=>{
    if(confirm('Tem certeza que deseja excluir este action plan?')){
        id = document.getElementById('editar_id').value;

        window.location.href = "{{ route('aluno.actionPlan.delete') }}?id=" + id;
    }
})

function editarCard(id){
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

            canvasEditar = new bootstrap.Offcanvas(document.getElementById('offCanvasDivEditar'));

            canvasEditar.show();
        }
    );
}

function visualizarCard(id){
    $.getJSON(
        '{{ route("aluno.actionPlan.buscar") }}',{
            id : id
        },
        function(json){
            document.getElementById('visualizar_oque').innerHTML = json.oque;
            document.getElementById('visualizar_quem').innerHTML = json.quem;
            document.getElementById('visualizar_quando').innerHTML = json.quando;
            document.getElementById('visualizar_como').innerHTML = json.como;
            document.getElementById('visualizar_onde').innerHTML = json.onde;
            document.getElementById('visualizar_quanto').innerHTML = json.quanto;
            document.getElementById('visualizar_status').innerHTML = json.status;

            canvasVisualizar = new bootstrap.Offcanvas(document.getElementById('offCanvasDivVisualizar'));

            canvasVisualizar.show();
        }
    );
}



const listaPerguntas = document.getElementById('listaPerguntas');
Sortable.create(listaPerguntas, {
    animation: 150,
    group: 'listaPerguntas',
    handle: '.drag-handle',
    onEnd: function (/**Event*/evt) {
		var itemEl = evt.item;  // dragged HTMLElement

        document.getElementById('listaPerguntas').style.cursor = 'wait';
        $.getJSON(
            "{{ route('aluno.actionPlan.ordenar') }}",
            {
                action_id : itemEl.dataset.id_action,
                nrOrigem : evt.oldIndex,
                nrDestino : evt.newIndex
            },
            function(json){
                console.log(json);
                if(json.controle == 'true'){
                    document.getElementById('listaPerguntas').style.cursor = '';
                }
            }
        );
    },
});
</script>
@endsection
