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
                        <p>É a Moeda que todas as Contas e Trades serão convertidos para que a consolidação dos valores dos saldos e cálculos sejam uniformizados e compatíveis. Esta Moeda pode ser mudada a qualquer momento.</p>
                        <div class="row align-items-center mt-4">
                            <div class="col-md-10 form-group">
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
                            <div class="col-md-2 form-group">
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
                        <p class="mb-2">Este intervalo é considerado Neutro e os trades que estiverem dentro deste intervalo não serão considerados nem Lucro e nem Prejuízo. Estes parâmetros podem ser mudados a qualquer momento, porém só serão considerados nos novos Trades lançados a partir do momento que foram alterados. Para que os valores anteriores sejam reparametrizados, é necessário entrar em todos os Trades e Salvá-los novamente, um-a-um.</p>
                        <div class="row align-items-center mt-4">
                            <div class="col-md-5 form-group">
                                <div class="form-floating form-floating-outline">
                                  <input required class="form-control" type="text" id="porcentagemPrejuizo" name="porcentagemPrejuizo" placeholder="Porcentagem Prejuizo" value='{{ valorDbForm($aluno->porcentagemPrejuizo) }}' onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                                  <label for="porcentagemPrejuizo">Porcentagem Prejuízo:</label>
                                </div>
                            </div>
                            <div class="col-md-5 form-group">
                                <div class="form-floating form-floating-outline">
                                  <input required class="form-control" type="text" id="porcentagemLucro" name="porcentagemLucro" placeholder="Porcentagem Lucro" value='{{ valorDbForm($aluno->porcentagemLucro) }}' onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                                  <label for="porcentagemLucro">Porcentagem Lucro:</label>
                                </div>
                            </div>
                            <div class="col-md-2 form-group">
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
