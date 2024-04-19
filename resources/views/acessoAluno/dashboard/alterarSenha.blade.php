@extends('layoutAluno')

@section('conteudo')
<form method="POST" action='{{ route('aluno.perfil.alterarSenha.update') }}'>
  @csrf
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
          <div class="col-md-12">
            <div class="card mb-4">
              <div class="card-body pt-2 mt-1">
                  <h4 class="card-header">Alterar Senha</h4>
                  <div class="row mt-2 gy-4">
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="password" id="password" name="password" />
                        <label for="password">Nova Senha:</label>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-floating form-floating-outline">
                        <input required class="form-control" type="password" id="passwordConfirmar" name="passwordConfirmar" />
                        <label for="passwordConfirmar">Confirmar Senha:</label>
                      </div>
                    </div>
                  </div>
                  <div class="mt-4">
                      <button type="submit" class="btn btn-primary me-2">Salvar</button>
                  </div>
              </div>
              <!-- /Account -->
            </div>
          </div>
        </div>
    </div>
</form>
<script>
document.getElementById('passwordConfirmar').addEventListener('blur', ()=>{
    if(document.getElementById('passwordConfirmar').value != document.getElementById('password').value){
        alert('Senhas não são iguais.');
        document.getElementById('passwordConfirmar').value = "";
        document.getElementById('password').value = "";
    }
})
</script>
@endsection
