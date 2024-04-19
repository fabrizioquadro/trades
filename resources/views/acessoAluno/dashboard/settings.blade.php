@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Settings</h5>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible mt-3 mb-3" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <div class="card">
                <form action="{{ route('aluno.setarMoedaBase') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-6 form-group">
                                <div class="form-floating form-floating-outline">
                                    <select id="moedaBase" name="moedaBase" required="" class="select2 form-select">
                                        <option value=''>Opções</option>
                                        <option @if($aluno->moedaBase == "BRL") selected  @endif value="BRL">BRL</option>
                                        <option @if($aluno->moedaBase == "USD") selected  @endif value="USD">USD</option>
                                        <option @if($aluno->moedaBase == "EUR") selected  @endif value="EUR">EUR</option>
                                        <option @if($aluno->moedaBase == "GBP") selected  @endif value="GBP">GBP</option>
                                    </select>
                                  <label for="moedaBase">Moeda Base:</label>
                                </div>
                            </div>
                            <div class="col-md-6 form-group">
                                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card mt-3">
                <form action="{{ route('aluno.setarPorcentagemLucroPrejuizo') }}" method="post">
                    @csrf
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-md-4 form-group">
                                <div class="form-floating form-floating-outline">
                                  <input required class="form-control" type="text" id="porcentagemPrejuizo" name="porcentagemPrejuizo" placeholder="Porcentagem Prejuizo" value='{{ valorDbForm($aluno->porcentagemPrejuizo) }}' onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                                  <label for="porcentagemPrejuizo">Porcentagem Prejuizo:</label>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <div class="form-floating form-floating-outline">
                                  <input required class="form-control" type="text" id="porcentagemLucro" name="porcentagemLucro" placeholder="Porcentagem Lucro" value='{{ valorDbForm($aluno->porcentagemLucro) }}' onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                                  <label for="porcentagemLucro">Porcentagem Lucro:</label>
                                </div>
                            </div>
                            <div class="col-md-4 form-group">
                                <button type="submit" class="btn btn-primary me-2">Salvar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
