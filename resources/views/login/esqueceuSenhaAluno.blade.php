@extends('layoutLoginAluno')

@section('conteudo')

<div class="row">
    <div class="col-md-12">
        <div class="p-4">
            <div class="text-center mb-4">
                <img class="imgLogin" src="{{ asset('/public/img/logoNaoCompleto.png') }}" alt="">
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    @if($mensagem = Session::get('mensagem'))
                        <div class="alert alert-solid-danger" role="alert">
                            {{ $mensagem }}
                        </div>
                    @endif
                    <h1 class="mb-3 colorAmarelo">Recuperar Senha</h1>
                    <p class="colorBranco">Você receberá uma nova senha no seu email.</p>
                    <form id="formAuthentication" class="mb-3" action="{{ route('aluno.recuperarSenha') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="colorBranco">Email:</label>
                            <input class="form-control form-control-rounded" required name="email" type="email">
                        </div>
                        <button class="btn btn-rounded btn-warning btn-block mt-2">Recuperar Senha</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{--
<div class="card-body mt-2">
  <h4 class="mb-2">Recuperar Senha do Aluno</h4>
  <p class="mb-4">Você receberá uma nova senha no seu email.</p>
  @if($mensagem = Session::get('mensagem'))
      <div class="alert alert-solid-danger" role="alert">
          {{ $mensagem }}
      </div>
  @endif
  <form id="formAuthentication" class="mb-3" action="{{ route('aluno.recuperarSenha') }}" method="POST">
    @csrf
    <div class="form-floating form-floating-outline mb-3">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus />
      <label for="email">Email</label>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary d-grid w-100" type="submit">Recuperar Senha</button>
    </div>
  </form>
</div>
--}}
@endsection
