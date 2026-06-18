@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <img src="{{ asset('/public/img/IconsPng/Perguntas Frequentes.png') }}" height="50px" alt="">
                <h5 style="margin-left: 20px; margin-top: 0px; margin-bottom: 0px" class="card-title">FAQ</h5>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="accordion mt-3" id="accordionExample">
                        @foreach($faqs as $faq)
                            @php
                            $i++;
                            $numero = $faq->numero + 1;
                            @endphp
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $i }}">
                                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion{{ $i }}" aria-expanded="false" aria-controls="accordion{{ $i }}">
                                        {{ $numero." - ".$faq->pergunta }}
                                    </button>
                                </h2>

                                <div id="accordion{{ $i }}" class="accordion-collapse collapse" data-bs-parent="#accordionExample" style="">
                                    <div class="accordion-body">
                                        {{ $faq->resposta }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                  </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-3">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <div class="d-flex justify-content-start align-items-center">
                        <img src="{{ asset('/public/img/IconsPng/Tickets.png') }}" height="50px" alt="">
                        <h5 style="margin-left: 20px; margin-top: 0px; margin-bottom: 0px" class="card-title">Tickets</h5>
                    </div>
                </div>
                <div class="col-md-6" align='right'>
                    <div class="col-md-6">
                        <a href="{{ route('aluno.faq.ticket.adicionar') }}" class="btn btn-primary">Abrir Ticket</a>
                    </div>
                </div>
            </div>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th></th>
                        <th>Data Ticket</th>
                        <th>Assunto</th>
                        <th>Descrição</th>
                        <th>Situação</th>
                    </tr>
                </thead>
                <tbody>
                    @if($tickets->count() == 0)
                        <tr>
                            <td colspan="5">Não há tickets para este aluno</td>
                        </tr>
                    @else
                        @foreach($tickets as $ticket)
                            @php
                            $var = explode(' ', $ticket->dtHrTicket);
                            $dtHrTicket = dataDbForm($var[0])." ".$var[1];
                            @endphp
                            <tr style='cursor: pointer' onclick='acessaTicket({{ $ticket->id }})'>
                                <td>
                                    @if($ticket->stLidoAluno == "Não")
                                        <img title="Novas Mensagens" src="{{ asset('/public/img/IconsPng/Mensagens.png') }}" alt="" height="40px">
                                    @endif
                                </td>
                                <td>{{ $dtHrTicket }}</td>
                                <td>{{ $ticket->dsAssunto }}</td>
                                <td>{{ $ticket->dsTicket }}</td>
                                <td>{{ $ticket->stTicket }}</td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
function acessaTicket(id){
    window.location.href = "{{ route('aluno.faq.ticket.acessar') }}/" + id;
}
</script>
@endsection
