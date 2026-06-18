@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Adicionar Prontuário Aluno</h5>
            </div>
            <form action="{{ route('prontuarioAluno.insert') }}" method="post">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="">Aluno:</label>
                        <select name="aluno_id" class="form-control combobox" required>
                            <option></option>
                            @foreach($alunos as $aluno){
                                <option value="{{ $aluno->id }}">{{ $aluno->nmAluno }}</option>
                            }
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="">Aula:</label>
                        <input type="text" name='aula' class="form-control" required>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Data:</label>
                        <input required type="date" name="dtAula" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Hora Início:</label>
                        <input type="time" name="hrInc" class="form-control">
                    </div>
                    <div class="col-md-4 form-group">
                        <label for="">Hora Fim:</label>
                        <input type="time" name="hrFn" class="form-control">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Presença:</label>
                        <select name="presenca" class="form-control" required>
                            <option></option>
                            <option value="Presente">Presente</option>
                            <option value="Não Presente">Não Presente</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Permanência:</label>
                        <select name="permanencia" class="form-control" required>
                            <option></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Participação:</label>
                        <select name="participacao" class="form-control" required>
                            <option></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Atenção:</label>
                        <select name="atencao" class="form-control" required>
                            <option></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 form-group">
                        <label for="">Exercícios:</label>
                        <select name="exercicios" class="form-control" required>
                            <option></option>
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 form-group">
                        <label for="">Prontuário:</label>
                        <textarea name="descricao" class="form-control" id='editor'></textarea>
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
