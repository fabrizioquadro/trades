@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Faq</h5>
                </div>
                @if(auth()->user()->tipo == "Administrador")
                    <div class="col-md-6" align='right'>
                        <a href="{{ route('faq.adicionar')}}" class="dt-button add-new btn btn-primary" type="button">
                          <span>
                            <i class="mdi mdi-plus me-0 me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Add FAQ</span>
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
                    @if(count($faqs) > 0)
                        <ul class="list-group list-group-flush" id="listaPerguntas">
                            @foreach($faqs as $linha)
                            <li data-id_faq='{{ $linha->id }}' class="list-group-item d-flex justify-content-between align-items-center">
                                <span class="d-flex justify-content-between align-items-center">
                                    <i class="drag-handle cursor-move mdi mdi-menu align-text-bottom me-2"></i>
                                    <span>{{ $linha->pergunta }}</span>
                                </span>
                                <div class="dropdown">
                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                    <i class="mdi mdi-dots-vertical"></i>
                                  </button>
                                  <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                      <a class="dropdown-item waves-effect" href="{{ route('faq.editar', $linha->id) }}"><i class="mdi mdi-pencil-outline me-1"></i> Editar</a>
                                      <a class="dropdown-item waves-effect" href="{{ route('faq.excluir', $linha->id) }}"><i class="mdi mdi-trash-can-outline me-1"></i> Excluir</a>
                                      <a class="dropdown-item waves-effect" href="{{ route('faq.visualizar', $linha->id) }}"><i class="mdi mdi-eye-outline me-1"></i> Visualizar</a>
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
        </div>
    </div>
</div>
<script>
const listaPerguntas = document.getElementById('listaPerguntas');
Sortable.create(listaPerguntas, {
    animation: 150,
    group: 'listaPerguntas',
    handle: '.drag-handle',
    onEnd: function (/**Event*/evt) {
		var itemEl = evt.item;  // dragged HTMLElement

        document.getElementById('listaPerguntas').style.cursor = 'wait';

        $.getJSON(
            "{{ route('faq.ordenar') }}",
            {
                id_faq : itemEl.dataset.id_faq,
                nrOrigem : evt.oldIndex,
                nrDestino : evt.newIndex
            },
            function(json){
                if(json.controle == 'true'){
                    document.getElementById('listaPerguntas').style.cursor = '';
                }
            }
        );
    },
});
</script>
@endsection
