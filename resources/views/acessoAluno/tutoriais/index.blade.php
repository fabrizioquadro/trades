@extends('layoutAluno')

@section('conteudo')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card p-0 mb-4">
        <div class="card-body d-flex flex-column flex-md-row justify-content-between p-0 pt-4">
            <div class="app-academy-md-50 card-body d-flex align-items-md-center flex-column text-md-center mb-4">
                <span class="card-title mb-3 lh-lg px-md-5 display-6 text-heading">
                    Tutoriais
                </span>
                <p class="mb-3 px-2">
                    Encontre aqui a tutorial que necessita.
                </p>
                <form action="{{ route('aluno.tutoriais') }}" method="post">
                    @csrf
                    <input type="hidden" name="controle" value="pesquisar">
                    <div class="d-flex align-items-center justify-content-between app-academy-md-80">
                        <input type="search" placeholder="Pesquisar" name="pesquisar" class="form-control me-2">
                        <button type="submit" class="btn btn-primary btn-icon waves-effect waves-light"><i class="mdi mdi-magnify"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row justify-content-end mb-3">
                <div class="col-md-3 form-group">
                    <form action="{{ route('aluno.tutoriais') }}" method="post">
                        @csrf
                        <input type="hidden" name="controle" value='tag'>
                        <label for="tag" style="text-a">Tags:</label>
                        <select onchange='submit()' required id="tag" name='tag' class="form-control">
                            <option value="All">All</option>
                            @foreach($tags as $linha)
                                <option @if($linha->tag == $tag) selected @endif value="{{ $linha->tag }}">{{ $linha->tag }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
            <div class="row">
                @php
                foreach($tutoriais as $tutorial){
                    @endphp
                    <div class="col-md-4 col-lg-4 col-sm-12 mt-3">
                        <div class="card shadow-none border h-100">
                            @php echo $tutorial->dsVideo; @endphp
                            <div class="card-body">
                                <span class="badge rounded-pill bg-label-info">{{ $tutorial->tag }}</span>
                                <h5 class="card-title mt-2">{{ $tutorial->nmTutorial }}</h5>
                                <p class="card-text">
                                    {{ $tutorial->dsTutorial }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @php
                }
                @endphp
            </div>
        </div>
    </div>
</div>

@endsection
