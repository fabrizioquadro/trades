@extends('layoutAdmin')

@section('conteudo')
<form method="POST" action="{{ route('consistence.update') }}">
  @csrf
  <input type="hidden" name="controle" value="gainsLosses">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-start align-items-center">
            <a href="javascript:history.back()" title="Voltar" style="margin-right: 20px">
                <img src="{{ asset('/public/img/IconsPng/Voltar.png') }}" height="50px" alt="">
            </a>
            <h5 class="card-title">Gains X Losses</h5>
        </div>
        <div class="card mb-4">
            <div class="card-body pt-2 mt-1">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <textarea id="editor" name="gainsLosses" class="form-control">{{ $info->gainsLosses }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary me-2">Salvar</button>
                </div>
          </div>
          <!-- /Account -->
        </div>
    </div>
</form>
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
