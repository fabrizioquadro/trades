@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Alunos</h5>
                </div>
                @if(auth()->user()->tipo == "Administrador")
                    <div class="col-md-6" align='right'>
                        <a href="{{ route('alunos.adicionar')}}" class="dt-button add-new btn btn-primary" type="button">
                          <span>
                            <i class="mdi mdi-plus me-0 me-sm-1"></i>
                            <span class="d-none d-sm-inline-block">Add Aluno</span>
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
                                    <th></th>
                                    <th style="text-align:left !important">Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Pais</th>
                                    <th>User TV</th>
                                    <th>Situação</th>
                                    <th>Tags</th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach($alunos as $aluno)
                              @php
                              if($aluno->imagem == ""){
                                  $avatar = '/public/assets/img/avatars/1.png';
                              }
                              else{
                                  $avatar = '/public/img/alunos/'.$aluno->imagem."?".date('Ymdhis');
                              }
                              $tags = buscaTagsStringAluno($aluno->id);
                              @endphp
                              <tr>
                                  <td> <img src="{{ $avatar }}" style='height:40px; border-radius: 20px' alt=""> </td>
                                  <td style="text-align:left !important">{{ $aluno->nmAluno }}</td>
                                  <td>{{ $aluno->dsEmail }}</td>
                                  <td>{{ $aluno->nrTel }}</td>
                                  <td>{{ $aluno->nmPais }}</td>
                                  <td>{{ $aluno->userTradingView }}</td>
                                  <td>{{ $aluno->stAluno }}</td>
                                  <td>{{ $tags }}</td>
                                  <td>
                                    @if(auth()->user()->tipo == "Administrador")
                                        <div class="dropdown">
                                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow show" data-bs-toggle="dropdown" aria-expanded="true">
                                            <i class="mdi mdi-dots-vertical"></i>
                                          </button>
                                          <div class="dropdown-menu" data-popper-placement="bottom-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate(-101.111px, 134.444px);">
                                              <a class="dropdown-item waves-effect" href="{{ route('alunos.editar', $aluno->id) }}">
                                                  <img src="{{ asset('/public//img/IconsPng/Editar.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                  Editar
                                              </a>
                                              <a class="dropdown-item waves-effect" href="{{ route('alunos.excluir', $aluno->id) }}">
                                                  <img src="{{ asset('/public//img/IconsPng/Excluir.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                  Excluir
                                              </a>
                                              <a class="dropdown-item waves-effect" href="{{ route('alunos.visualizar', $aluno->id) }}">
                                                  <img src="{{ asset('/public//img/IconsPng/Visualizar.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                  Visualizar
                                              </a>
                                              <a class="dropdown-item waves-effect" href="{{ route('alunos.alterarSenha', $aluno->id) }}">
                                                  <img src="{{ asset('/public//img/IconsPng/Alterar Senha.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                  Alterar Senha
                                              </a>
                                              <a class="dropdown-item waves-effect" href="{{ route('mensagens.aluno', $aluno->id) }}">
                                                  <img src="{{ asset('/public//img/IconsPng/Mensagens.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                  Mensagens
                                              </a>
                                              <a class="dropdown-item waves-effect" href="{{ route('alunos.planTrade', $aluno->id) }}">
                                                  <img src="{{ asset('/public//img/IconsPng/Plano de Trade.png') }}" height="35px" alt="" style="margin-right: 10px">
                                                  Plan Trade
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
})

</script>

@endsection
