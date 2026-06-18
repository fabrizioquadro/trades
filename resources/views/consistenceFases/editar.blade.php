@extends('layoutAdmin')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-start align-items-center">
                <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                    <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
                </a>
                <h5 class="card-title">Editar Fase</h5>
            </div>
            <form action="{{ route('consistenceFases.update') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $fase->id }}">
                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="">Nome:</label>
                        <input type="text" required name="nmFase" class="form-control" value="{{ $fase->nmFase }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Início:</label>
                        <input type="number" required name="vlInc" class="form-control" value="{{ $fase->vlInc }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Fim:</label>
                        <input type="number" required name="vlFn" class="form-control" value="{{ $fase->vlFn }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="">Ícone:</label>
                        <input type="text" required name="icone" class="form-control" value="{{ $fase->icone }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12 form-group">
                        <label for="">Informação</label>
                        <textarea id="editor" name="descricao" class="form-control">{{ $fase->descricao }}</textarea>
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
