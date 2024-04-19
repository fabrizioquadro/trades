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
                    @if($mensagem = Session::get('erro'))
                        <div class="alert alert-solid-danger" role="alert">
                            {{ $mensagem }}
                        </div>
                    @endif
                    @if($mensagem = Session::get('mensagem'))
                        <div class="alert alert-solid-success" role="alert">
                            {{ $mensagem }}
                        </div>
                    @endif
                    <h1 class="mb-3 colorAmarelo">Login</h1>
                    <form id="formAuthentication" class="mb-3" action="{{ route('aluno.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email" class="colorBranco">Email:</label>
                            <input class="form-control form-control-rounded" required name="email" type="email">
                        </div>
                        <div class="form-group">
                            <label for="password" class="colorBranco">Senha:</label>
                            <input class="form-control form-control-rounded" required name="password" type="password">
                        </div>
                        <button class="btn btn-rounded btn-warning btn-block mt-2">Login</button>
                    </form>
                    <div class="mt-3 text-center">
                        <a class="text-muted colorBranco" href="{{ route('aluno.esqueceuSenha') }}">
                            <u>Esqueceu a Senha?</u>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{--
<div class="card-body mt-2">
  <h5 class="mb-2">Bem Vindo a Smart Money Makers! 👋</h5>
  <p class="mb-4">Alunos - Sistema Online.</p>
  @if($mensagem = Session::get('erro'))
      <div class="alert alert-solid-danger" role="alert">
          {{ $mensagem }}
      </div>
  @endif
  @if($mensagem = Session::get('mensagem'))
      <div class="alert alert-solid-success" role="alert">
          {{ $mensagem }}
      </div>
  @endif
  <form id="formAuthentication" class="mb-3" action="{{ route('aluno.login') }}" method="POST">
    @csrf
    <div class="form-floating form-floating-outline mb-3">
      <input type="email" class="form-control" id="email" name="email" placeholder="Email" autofocus />
      <label for="email">Email</label>
    </div>
    <div class="mb-3">
      <div class="form-password-toggle">
        <div class="input-group input-group-merge">
          <div class="form-floating form-floating-outline">
            <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="Senha" />
            <label for="password">Senha</label>
          </div>
          <span class="input-group-text cursor-pointer"><i class="mdi mdi-eye-off-outline"></i></span>
        </div>
      </div>
    </div>
    <div class="mb-3 d-flex justify-content-between">
      <a href="{{ route('aluno.esqueceuSenha') }}" class="float-end mb-1">
        <span>Esqueceu a Senha?</span>
      </a>
    </div>
    <div class="mb-3">
      <button class="btn btn-primary d-grid w-100" type="submit">Entrar</button>
    </div>
  </form>
</div>
--}}
@endsection
