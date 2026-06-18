@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Editar Prontuário Aluno</h5>
            </div>
            <form action="{{ route('prontuarioAluno.update') }}" method="post">
                @csrf
                <input type="hidden" name="prontuario_id" value="{{ $prontuario->id }}">
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="">Aluno:</label>
                        <select name="aluno_id" class="form-control combobox" required>
                            <option></option>
                            @foreach($alunos as $aluno){
                                <option @if($aluno->id == $prontuario->aluno_id) selected @endif value="{{ $aluno->id }}">{{ $aluno->nmAluno }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Aula:</label>
                        <input type="text" name='aula' class="form-control" required value="{{ $prontuario->aula }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Data:</label>
                        <input required type="date" name="dtAula" class="form-control" value="{{ $prontuario->dtAula }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Hora Início:</label>
                        <input type="time" name="hrInc" class="form-control" value="{{ $prontuario->hrInc }}">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Hora Fim:</label>
                        <input type="time" name="hrFn" class="form-control" value="{{ $prontuario->hrFn }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Presença:</label>
                        <select name="presenca" class="form-control" required>
                            <option></option>
                            <option @if($prontuario->presenca == 'Presente') selected @endif value="Presente">Presente</option>
                            <option @if($prontuario->presenca == 'Não Presente') selected @endif value="Não Presente">Não Presente</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Permanência:</label>
                        <select name="permanencia" class="form-control" required>
                            <option></option>
                            <option @if($prontuario->permanencia == '0') selected @endif value="0">0</option>
                            <option @if($prontuario->permanencia == '1') selected @endif value="1">1</option>
                            <option @if($prontuario->permanencia == '2') selected @endif value="2">2</option>
                            <option @if($prontuario->permanencia == '3') selected @endif value="3">3</option>
                            <option @if($prontuario->permanencia == '4') selected @endif value="4">4</option>
                            <option @if($prontuario->permanencia == '5') selected @endif value="5">5</option>
                            <option @if($prontuario->permanencia == '6') selected @endif value="6">6</option>
                            <option @if($prontuario->permanencia == '7') selected @endif value="7">7</option>
                            <option @if($prontuario->permanencia == '8') selected @endif value="8">8</option>
                            <option @if($prontuario->permanencia == '9') selected @endif value="9">9</option>
                            <option @if($prontuario->permanencia == '10') selected @endif value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Participação:</label>
                        <select name="participacao" class="form-control" required>
                            <option></option>
                            <option @if($prontuario->participacao == '0') selected @endif value="0">0</option>
                            <option @if($prontuario->participacao == '1') selected @endif value="1">1</option>
                            <option @if($prontuario->participacao == '2') selected @endif value="2">2</option>
                            <option @if($prontuario->participacao == '3') selected @endif value="3">3</option>
                            <option @if($prontuario->participacao == '4') selected @endif value="4">4</option>
                            <option @if($prontuario->participacao == '5') selected @endif value="5">5</option>
                            <option @if($prontuario->participacao == '6') selected @endif value="6">6</option>
                            <option @if($prontuario->participacao == '7') selected @endif value="7">7</option>
                            <option @if($prontuario->participacao == '8') selected @endif value="8">8</option>
                            <option @if($prontuario->participacao == '9') selected @endif value="9">9</option>
                            <option @if($prontuario->participacao == '10') selected @endif value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Atenção:</label>
                        <select name="atencao" class="form-control" required>
                            <option></option>
                            <option @if($prontuario->atencao == '0') selected @endif value="0">0</option>
                            <option @if($prontuario->atencao == '1') selected @endif value="1">1</option>
                            <option @if($prontuario->atencao == '2') selected @endif value="2">2</option>
                            <option @if($prontuario->atencao == '3') selected @endif value="3">3</option>
                            <option @if($prontuario->atencao == '4') selected @endif value="4">4</option>
                            <option @if($prontuario->atencao == '5') selected @endif value="5">5</option>
                            <option @if($prontuario->atencao == '6') selected @endif value="6">6</option>
                            <option @if($prontuario->atencao == '7') selected @endif value="7">7</option>
                            <option @if($prontuario->atencao == '8') selected @endif value="8">8</option>
                            <option @if($prontuario->atencao == '9') selected @endif value="9">9</option>
                            <option @if($prontuario->atencao == '10') selected @endif value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Exercícios:</label>
                        <select name="exercicios" class="form-control" required>
                            <option></option>
                            <option @if($prontuario->exercicios == '0') selected @endif value="0">0</option>
                            <option @if($prontuario->exercicios == '1') selected @endif value="1">1</option>
                            <option @if($prontuario->exercicios == '2') selected @endif value="2">2</option>
                            <option @if($prontuario->exercicios == '3') selected @endif value="3">3</option>
                            <option @if($prontuario->exercicios == '4') selected @endif value="4">4</option>
                            <option @if($prontuario->exercicios == '5') selected @endif value="5">5</option>
                            <option @if($prontuario->exercicios == '6') selected @endif value="6">6</option>
                            <option @if($prontuario->exercicios == '7') selected @endif value="7">7</option>
                            <option @if($prontuario->exercicios == '8') selected @endif value="8">8</option>
                            <option @if($prontuario->exercicios == '9') selected @endif value="9">9</option>
                            <option @if($prontuario->exercicios == '10') selected @endif value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 form-group">
                        <label for="">Prontuário:</label>
                        <textarea name="descricao" class="form-control" id='editor'>{{ $prontuario->descricao }}</textarea>
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
window.addEventListener('load',()=>{
    $('.combobox').combobox();
});
</script>

<script type="importmap">
    {
        "imports": {
            "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.0/ckeditor5.js",
            "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.0/"
        }
    }
</script>
<script type="module">
      	import {
            ClassicEditor,
            Essentials,
            Bold,
            Italic,
            Font,
            Paragraph
        } from 'ckeditor5';

        ClassicEditor
            .create( document.querySelector( '#editor' ), {
                plugins: [ Essentials, Bold, Italic, Font, Paragraph ],
                toolbar: {
                    items: [
                        'undo', 'redo', '|', 'bold', 'italic', '|',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
                    ]
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection
