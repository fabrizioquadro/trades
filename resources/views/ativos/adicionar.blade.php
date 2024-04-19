@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Ativo</h5>
                </div>
            </div>
            <form action="{{ route('ativos.insert') }}" method="post">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_tipoAtivo" name='tipoAtivo' class="select2 form-select">
                      <option value="">Opções</option>
                      <option value="Índices">Índices</option>
                      <option value="CFDs">CFDs</option>
                      <option value="Ações">Ações</option>
                      <option value="Forex">Forex</option>
                      <option value="Cryptos">Cryptos</option>
                      <option value="Financeiros">Financeiros</option>
                      <option value="ADRs">ADRs</option>
                      <option value="BDRs">BDRs</option>
                      <option value="ETFs">ETFs</option>
                      <option value="Fundos">Fundos</option>
                      <option value="Energéticos">Energéticos</option>
                      <option value="Metais">Metais</option>
                      <option value="Grãos">Grãos</option>
                      <option value="Carne">Carne</option>
                      <option value="Softs">Softs</option>
                    </select>
                    <label for="id_tipoAtivo">Tipo de Ativo:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_pais" name='pais' class="select2 form-select">
                      <option value="">Opções</option>
                      <option value="BRA">BRA</option>
                      <option value="EUA">EUA</option>
                      <option value="EUR">EUR</option>
                      <option value="UK">UK</option>
                      <option value="Cryptos">Cryptos</option>
                    </select>
                    <label for="id_pais">País:</label>
                  </div>
                </div>
                <div class="col-md-3 form-group">
                    <div class="form-floating form-floating-outline">
                        <select id="moedaBase" name="moedaAtivo" required="" class="select2 form-select">
                            <option value=''>Opções</option>
                            <option value="BRL">BRL</option>
                            <option value="USD">USD</option>
                            <option value="EUR">EUR</option>
                            <option value="GBP">GBP</option>
                        </select>
                      <label for="moedaBase">Moeda Ativo:</label>
                    </div>
                </div>
                <div class="col-md-3 form-group">
                    <div class="form-floating form-floating-outline">
                        <select id="stAtivo" name="stAtivo" required="" class="select2 form-select">
                            <option value=''>Opções</option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                      <label for="stAtivo">Situação:</label>
                    </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="nome" name="nome" placeholder="Nome"/>
                    <label for="nome">Nome:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <select id="tipoCusto" name='tipoCusto' class="select2 form-select">
                        <option value="">Opções</option>
                        <option value="Spread">Spread</option>
                        <option value="Valor Fixo">Valor Fixo</option>
                        <option value="Percentual">Percentual</option>
                    </select>
                    <label for="tipoCusto">Tipo de Custo:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="exchange" name="exchange" placeholder="Exchange"/>
                    <label for="exchange">Exchange:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="simbolo" name="simbolo" placeholder="Símbolo"/>
                    <label for="simbolo">Símbolo:</label>
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="cqgSimbolo" name="cqgSimbolo" placeholder="CQG Símbolo"/>
                    <label for="cqgSimbolo">CQG Símbolo:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="tamanhoContrato" name="tamanhoContrato" placeholder="Tamanho Contrato"/>
                    <label for="tamanhoContrato">Tamanho Contrato:</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="meses" name="meses" placeholder="Meses"/>
                    <label for="meses">Meses:</label>
                  </div>
                </div>
              </div>
              <div class="row mt-2 gy-4">
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="valor" name="valor" placeholder="Valor" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="valor">Valor:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="tick" name="tick" placeholder="Tick" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="tick">Tick:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="swing" name="swing" placeholder="Margem de Garantia Swing " onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="swing">Margem de Garantia Swing:</label>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-floating form-floating-outline">
                    <input required class="form-control" type="text" id="dayTrading" name="dayTrading" placeholder="Margem de Garantia Day Trading" onkeypress="return(MascaraMoeda(this,'.',',',event))"/>
                    <label for="dayTrading">Margem de Garantia Day Trading:</label>
                  </div>
                </div>
              </div>
              <div class="card mt-3">
                  <div class="card-body">
                    <h6 class="card-title">Corretoras</h6>
                    <table class='table table-sm'>
                        <thead>
                            <tr>
                                <th> <input type="checkbox" id='checkAll'> All</th>
                                <th>Nome</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($corretoras as $corretora)
                                <tr>
                                    <td> <input type="checkbox" class="corretoras" name='corretora_{{ $corretora->id }}' value="Sim"></td>
                                    <td>{{ $corretora->nome }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                  </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Salvar</button>
              </div>
            </form>
        </div>
    </div>
</div>
<script>
document.getElementById('checkAll').addEventListener('click', (e)=>{
    if(e.target.checked){
        inputs = document.querySelectorAll('input.corretoras');
        [].forEach.call(inputs, function(input) {
            input.checked = true;
        });
    }
    else{
        inputs = document.querySelectorAll('input.corretoras');
        [].forEach.call(inputs, function(input) {
            input.checked = false;
        });
    }
})
</script>
@endsection
