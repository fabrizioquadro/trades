@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5 class="card-title">FAQ</h5>
                </div>
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
</div>

@endsection
