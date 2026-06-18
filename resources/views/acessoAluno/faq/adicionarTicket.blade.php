@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="card-title">Adicionar Ticket</h5>
                </div>
            </div>
            <form action="{{ route('aluno.faq.ticket.insert') }}" method="post">
                @csrf
                <div class="row mt-2 gy-4">
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline">
                            <input required class="form-control" type="text" id="dsAssunto" name="dsAssunto" placeholder="Assunto:"/>
                            <label for="dsAssunto">Assunto:</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 gy-4">
                    <div class="col-md-12">
                        <div class="form-floating form-floating-outline mb-4">
                            <textarea class="form-control h-px-100" id="dsTicket" name='dsTicket' placeholder="Descrição ..."></textarea>
                            <label for="dsConta">Descrição:</label>
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
@endsection
