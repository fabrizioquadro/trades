@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Adicionar Prontuário Turma</h5>
            </div>
            <form action="{{ route('prontuarioTurma.insert') }}" method="post">
                @csrf
                <div class="row mt-3">
                    <div class="col-md-6 form-group">
                        <label for="">Turma:</label>
                        <select name="tag" class="form-control combobox" required>
                            <option></option>
                            @foreach($tags as $tag){
                                <option value="{{ $tag->nmTag }}">{{ $tag->nmTag }}</option>
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
                    <div class="col-md-12 form-group">
                        <label for="">Prontuário:</label>
                        <textarea id='editor' name="descricao" class="form-control"></textarea>
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
