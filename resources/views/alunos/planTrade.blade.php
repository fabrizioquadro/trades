@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Plan Trade Aluno</h5>
            </div>
            @if($mensagem = Session::get('mensagem'))
              <div class="alert alert-success alert-dismissible" role="alert">
                {{ $mensagem }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
            <form action="{{ route('alunos.planTrade.set') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $aluno->id }}">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Plan 1</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">Ativo:</label>
                                <select name="plan1AtivoBase" class="form-control combobox">
                                    <option></option>
                                    @foreach($ativos as $ativo)
                                        <option @if($ativo->id == $aluno->plan1AtivoBase) selected @endif value="{{ $ativo->id }}">{{ $ativo->simbolo." - ".$ativo->nome." - ".$ativo->corretora() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Ganho Diário (%):</label>
                                <input type="text" name="plan1MetaGanhoDiario" value="{{ $aluno->plan1MetaGanhoDiario }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Pontos/Contrato Ativo:</label>
                                <input type="text" name="plan1PontosContratoAtivo" value="{{ $aluno->plan1PontosContratoAtivo }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Máxima Pontos Ativo:</label>
                                <input type="text" name="plan1MetaMaximaPontos" value="{{ $aluno->plan1MetaMaximaPontos }}"  class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 form-group">
                                <label for="">Fator Correção Garantia (%):</label>
                                <input type="text" name="plan1FatorCorrecaoGarantia" value="{{ $aluno->plan1FatorCorrecaoGarantia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Limite Ganho Dia (MB Ativo):</label>
                                <input type="text" name="plan1LimiteGanhoDia" value="{{ $aluno->plan1LimiteGanhoDia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Máximo Contratos/Máximo $ por Ponto:</label>
                                <input type="text" name="plan1MaximoContratos"  value="{{ $aluno->plan1MaximoContratos }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Plan 2</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">Ativo:</label>
                                <select name="plan2AtivoBase" class="form-control combobox">
                                    <option></option>
                                    @foreach($ativos as $ativo)
                                        <option @if($ativo->id == $aluno->plan2AtivoBase) selected @endif value="{{ $ativo->id }}">{{ $ativo->simbolo." - ".$ativo->nome." - ".$ativo->corretora() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Ganho Diário (%):</label>
                                <input type="text" name="plan2MetaGanhoDiario" value="{{ $aluno->plan2MetaGanhoDiario }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Pontos/Contrato Ativo:</label>
                                <input type="text" name="plan2PontosContratoAtivo" value="{{ $aluno->plan2PontosContratoAtivo }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Máxima Pontos Ativo:</label>
                                <input type="text" name="plan2MetaMaximaPontos" value="{{ $aluno->plan2MetaMaximaPontos }}"  class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 form-group">
                                <label for="">Fator Correção Garantia (%):</label>
                                <input type="text" name="plan2FatorCorrecaoGarantia" value="{{ $aluno->plan2FatorCorrecaoGarantia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Limite Ganho Dia:</label>
                                <input type="text" name="plan2LimiteGanhoDia" value="{{ $aluno->plan2LimiteGanhoDia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Máximo Contratos / Máximo $ por Pontos:</label>
                                <input type="text" name="plan2MaximoContratos"  value="{{ $aluno->plan2MaximoContratos }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Plan 3</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">Ativo:</label>
                                <select name="plan3AtivoBase" class="form-control combobox">
                                    <option></option>
                                    @foreach($ativos as $ativo)
                                        <option @if($ativo->id == $aluno->plan3AtivoBase) selected @endif value="{{ $ativo->id }}">{{ $ativo->simbolo." - ".$ativo->nome." - ".$ativo->corretora() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Ganho Diário (%):</label>
                                <input type="text" name="plan3MetaGanhoDiario" value="{{ $aluno->plan3MetaGanhoDiario }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Pontos/Contrato Ativo:</label>
                                <input type="text" name="plan3PontosContratoAtivo" value="{{ $aluno->plan3PontosContratoAtivo }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Máxima Pontos Ativo:</label>
                                <input type="text" name="plan3MetaMaximaPontos" value="{{ $aluno->plan3MetaMaximaPontos }}"  class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 form-group">
                                <label for="">Fator Correção Garantia(%):</label>
                                <input type="text" name="plan3FatorCorrecaoGarantia" value="{{ $aluno->plan3FatorCorrecaoGarantia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Limite Ganho Dia:</label>
                                <input type="text" name="plan3LimiteGanhoDia" value="{{ $aluno->plan3LimiteGanhoDia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Máximo Contratos / Máximo $ por Pontos:</label>
                                <input type="text" name="plan3MaximoContratos"  value="{{ $aluno->plan3MaximoContratos }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Plan 4</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">Ativo:</label>
                                <select name="plan4AtivoBase" class="form-control combobox">
                                    <option></option>
                                    @foreach($ativos as $ativo)
                                        <option @if($ativo->id == $aluno->plan4AtivoBase) selected @endif value="{{ $ativo->id }}">{{ $ativo->simbolo." - ".$ativo->nome." - ".$ativo->corretora() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Ganho Diário(%):</label>
                                <input type="text" name="plan4MetaGanhoDiario" value="{{ $aluno->plan4MetaGanhoDiario }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Pontos/Contrato Ativo:</label>
                                <input type="text" name="plan4PontosContratoAtivo" value="{{ $aluno->plan4PontosContratoAtivo }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Máxima Pontos Ativo:</label>
                                <input type="text" name="plan4MetaMaximaPontos" value="{{ $aluno->plan4MetaMaximaPontos }}"  class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 form-group">
                                <label for="">Fator Correção Garantia(%):</label>
                                <input type="text" name="plan4FatorCorrecaoGarantia" value="{{ $aluno->plan4FatorCorrecaoGarantia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Limite Ganho Dia:</label>
                                <input type="text" name="plan4LimiteGanhoDia" value="{{ $aluno->plan4LimiteGanhoDia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Máximo Contratos / Máximo $ por Pontos:</label>
                                <input type="text" name="plan4MaximoContratos"  value="{{ $aluno->plan4MaximoContratos }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="card-title">Plan 5</h5>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="">Ativo:</label>
                                <select name="plan5AtivoBase" class="form-control combobox">
                                    <option></option>
                                    @foreach($ativos as $ativo)
                                        <option @if($ativo->id == $aluno->plan5AtivoBase) selected @endif value="{{ $ativo->id }}">{{ $ativo->simbolo." - ".$ativo->nome." - ".$ativo->corretora() }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Ganho Diário(%):</label>
                                <input type="text" name="plan5MetaGanhoDiario" value="{{ $aluno->plan5MetaGanhoDiario }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Pontos/Contrato Ativo:</label>
                                <input type="text" name="plan5PontosContratoAtivo" value="{{ $aluno->plan5PontosContratoAtivo }}"  class="form-control">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="">Meta Máxima Pontos Ativo:</label>
                                <input type="text" name="plan5MetaMaximaPontos" value="{{ $aluno->plan5MetaMaximaPontos }}"  class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-4 form-group">
                                <label for="">Fator Correção Garantia(%):</label>
                                <input type="text" name="plan5FatorCorrecaoGarantia" value="{{ $aluno->plan5FatorCorrecaoGarantia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Limite Ganho Dia:</label>
                                <input type="text" name="plan5LimiteGanhoDia" value="{{ $aluno->plan5LimiteGanhoDia }}"  class="form-control">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="">Máximo Contratos / Máximo $ or Pontos:</label>
                                <input type="text" name="plan5MaximoContratos"  value="{{ $aluno->plan5MaximoContratos }}" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
window.addEventListener('load',()=>{
    $('.combobox').combobox();
});
</script>
@endsection
