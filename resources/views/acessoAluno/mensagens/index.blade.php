@extends('layoutAluno')

@section('conteudo')
@php
$aluno = session()->get('aluno');
if($aluno->imagem == ""){
    $avatar = "/public/assets/img/avatars/1.png";
}
else{
    $avatar = "/public/img/alunos/".$aluno->imagem."?".date('YmdHis');
}
@endphp
<link rel="stylesheet" href="{{ asset('/public/assets/vendor/css/pages/app-chat.css') }}" />
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="app-chat card overflow-hidden mt-3">
        <div class="sidebar-body">
            <!-- Chat History -->
            <div class="col app-chat-history">
                <div class="chat-history-wrapper">
                    <div class="chat-history-header border-bottom">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex overflow-hidden align-items-center">
                                <i class="mdi mdi-menu mdi-24px cursor-pointer d-lg-none d-block me-3" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-contacts"></i>
                                <div class="flex-shrink-0 avatar avatar-online">
                                    <img src="{{ asset($avatar) }}" alt="Avatar" class="rounded-circle" data-bs-toggle="sidebar" data-overlay data-target="#app-chat-sidebar-right" />
                                </div>
                                <div class="chat-contact-info flex-grow-1 ms-3">
                                    <h6 class="m-0">{{ $aluno->nmAluno }}</h6>
                                    <span class="user-status">Mensagens</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-history-body">
                        <ul class="list-unstyled chat-history">
                            @foreach($mensagens as $mensagem)
                                @if($mensagem->emissor == "Aluno")
                                    <li class="chat-message">
                                        <div class="d-flex overflow-hidden">
                                            <div class="user-avatar flex-shrink-0 me-3">
                                                <div class="avatar avatar-sm">
                                                    <img src="{{ asset($avatar) }}" alt="Avatar" class="rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="chat-message-wrapper flex-grow-1">
                                                <div class="chat-message-text">
                                                    <p class="mb-0">{{ $mensagem->dsMensagem }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                                @if($mensagem->emissor == "Adm")
                                    <li class="chat-message chat-message-right">
                                        <div class="d-flex overflow-hidden">
                                            <div class="chat-message-wrapper flex-grow-1">
                                                <div class="chat-message-text">
                                                    <p class="mb-0">{{ $mensagem->dsMensagem }}</p>
                                                </div>
                                            </div>
                                            <div class="user-avatar flex-shrink-0 ms-3">
                                                <div class="avatar avatar-sm">
                                                    <img src="{{ asset('/public/img/IconsPng/Tickets.png') }}" alt="Avatar" class="rounded-circle" />
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- Chat message form -->
                    <div class="chat-history-footer">
                        <form action="{{ route('aluno.mensagens.insert') }}" class="form-send-message d-flex justify-content-between align-items-center" method="post">
                            @csrf
                            <input required name='dsMensagem' class="form-control message-input me-3 shadow-none" placeholder="Envie sua dúvida." />
                            <div class="message-actions d-flex align-items-center">
                                <button type='submit' class="btn btn-primary d-flex send-msg-btn">
                                    <span class="align-middle">Enviar</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Chat History -->
        </div>
    </div>
</div>
<script src="{{ asset('/public/assets/js/app-chat.js') }}"></script>
@endsection
