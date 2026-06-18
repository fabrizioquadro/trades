@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Adicionar Note</h5>
            </div>
            <form action="{{ route('aluno.notes.insert') }}" method="post">
                @csrf
                <div class="row mt-2 gy-4">
                    <div class="col-md-6 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input required class="form-control" type="datetime-local" id="mes" name="dtHrNote" placeholder="Data/Hora:"/>
                            <label for="mes">Data/Hora:</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 gy-4">
                    <div class="col-md-12 mt-3">
                        <div class="form-floating form-floating-outline">
                            <input required class="form-control" type="text" id="tema" name="tema" placeholder="Tema:"/>
                            <label for="tema">Tema:</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2 gy-4">
                    <div class="col-md-12 form-group">
                        <label for="">Descrição:</label>
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
