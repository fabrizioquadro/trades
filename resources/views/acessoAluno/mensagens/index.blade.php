@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">Enviar Mensagem</h5>
                </div>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form action="{{ route('aluno.mensagens.insert') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-100" id="exampleFormControlTextarea1" name='dsMensagem' placeholder="Mensagem"></textarea>
                            <label for="exampleFormControlTextarea1">Mensagem</label>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary me-2">Salvar</button>
            </form>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <h5 class="card-title">Histórico de Mensagens</h5>
            @if(count($mensagens) == 0)
                <p>Não há mensagens!!!</p>
            @endif
            @foreach($mensagens as $mensagem)
                @php
                $var = explode(' ', $mensagem->dtHrMensagem);
                $dtHrMensagem = dataDbForm($var[0])." ".$var[1];
                @endphp

                @if($mensagem->emissor == "Aluno")
                    <div class="row justify-content-start">
                        <div class="col-8">
                            <div class="card bg-secondary text-white mb-1">
                                <div class="card-header text-white">
                                    {{ $aluno->nmAluno." - ".$dtHrMensagem }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $mensagem->dsMensagem }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="row justify-content-end">
                        <div class="col-8">
                            <div class="card bg-info text-white mb-1">
                                <div class="card-header text-white">
                                    {{ "Administrativo - ".$dtHrMensagem }}
                                </div>
                                <div class="card-body">
                                    <p class="card-text">{{ $mensagem->dsMensagem }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

@endsection
