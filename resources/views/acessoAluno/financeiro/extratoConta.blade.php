@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Extrato Conta</h5>
                </div>
            </div>
            <form action="{{ route('aluno.financeiro.extratoConta.gerar') }}" method="post">
              @csrf
              <div class="row mt-2 gy-4">
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <select required id="id_conta" name='id_conta' class="select2 form-select">
                        <option value="">Opções</option>
                        @foreach($contas as $conta)
                            <option value="{{ $conta->id }}">{{ $conta->nrConta }} - {{ $conta->nmConta }}</option>
                        @endforeach
                    </select>
                    <label for="id_conta">Conta:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="date" id="dtIncExtrato" name="dtIncExtrato" placeholder="Início Extrato:"/>
                    <label for="dtIncExtrato">Início Extrato:</label>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-floating form-floating-outline">
                    <input class="form-control" type="date" id="dtFnExtrato" name="dtFnExtrato" placeholder="Fim Extrato:"/>
                    <label for="dtFnExtrato">Fim Extrato:</label>
                  </div>
                </div>
              </div>
              <div class="mt-4">
                  <button type="submit" class="btn btn-primary me-2">Gerar</button>
              </div>
            </form>
        </div>
    </div>
</div>
@endsection
