@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Importar Ativos</h5>
                </div>
            </div>
            <form action="{{ route('ativos.importar.insert') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="">Arquivo:</label>
                        <input type="file" name="arquivo"  class="form-control" accept=".xls, .xlsx">
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Importar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
