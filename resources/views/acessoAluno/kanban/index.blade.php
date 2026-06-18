@extends('layoutAluno')

@section('conteudo')
<style media="screen">
.info {
    background: #2a92bf;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
            <div class="app-kanban">
                <!-- Kanban Wrapper -->
                <div class="kanban-wrapper"></div>

                <div id='offCanvasDiv' class="offcanvas offcanvas-end kanban-update-item-sidebar">
                    <div class="offcanvas-header bg-lighter py-3">
                        <h5 class="offcanvas-title">Card</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body pt-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="h5 card-title">Detalhes Card</div>
                                <form action="{{ route('aluno.kanban.update') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="kanban_id" id="offCanvas_kanban_id">
                                    <div class="row">
                                        <div class="col-md-12 form-group mt-4">
                                            <label for="">Prioridade:</label>
                                            <select name="prioridade" id="offCanvas_prioridade" class="form-control">
                                                <option value=""></option>
                                                <option value="Baixa">Baixa</option>
                                                <option value="Média">Média</option>
                                                <option value="Alta">Alta</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group mt-4">
                                            <label for="">Nome:</label>
                                            <input type="text" name="nmKanban" id="offCanvas_nmKanban" class="form-control">
                                        </div>
                                        <div class="col-md-12 form-group mt-4">
                                            <label for="">Descrição:</label>
                                            <textarea name="dsKanban" id='offCanvas_dsKanban' class="form-control"></textarea>
                                        </div>
                                        <div class="col-md-12 form-group mt-4">
                                            <label for="">Situação:</label>
                                            <select name="stKanban" id="offCanvas_stKanban" class="form-control">
                                                <option value=""></option>
                                                <option value="Atrasado">Atrasado</option>
                                                <option value="Não Inicido">Não Inicido</option>
                                                <option value="Andamento">Andamento</option>
                                                <option value="Concluído">Concluído</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 form-group mt-4">
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                            <button type="button" id="btnExcluirCard" class="btn btn-danger">Excluir</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>
<script>

document.getElementById('btnExcluirCard').addEventListener('click', ()=>{
    if(confirm('Tem certeza que deseja excluir o card?')){
        id = document.getElementById('offCanvas_kanban_id').value;
        window.location.href = "{{ route('aluno.kanban.excluir') }}?id=" + id;
    }
})

document.addEventListener('DOMContentLoaded', function () {

    const kanbanOffcanvas = new bootstrap.Offcanvas(document.getElementById('offCanvasDiv'));

    const kanban = new jKanban({
        element: '.kanban-wrapper',
        gutter: '15px',
        widthBoard: '250px',
        dragItems: true,
        dragBoards: false,
        addItemButton: true,
        buttonContent: '+ Add Item',
        itemAddOptions: {
            enabled: true, // add a button to board for easy item creation
            content: '+ Add New Item', // text or html content of the board button
            class: 'kanban-title-button btn btn-default btn-md shadow-none text-capitalize fw-normal', // default class of the button
            footer: false // position the button on footer
        },
        boards: [
            {
                id: "board-segunda",
                title: "Seg",
                item: [
                    @foreach($segunda as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleSeg)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleSeg = true;
                        @endphp
                    @endforeach
                ]
            },
            {
                id: "board-terca",
                title: "Ter",
                item: [
                    @foreach($terca as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleTer)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleTer = true;
                        @endphp
                    @endforeach
                ]
            },
            {
                id: "board-quarta",
                title: "Qua",
                item: [
                    @foreach($quarta as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleQua)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleQua = true;
                        @endphp
                    @endforeach
                ]
            },
            {
                id: "board-quinta",
                title: "Qui",
                item: [
                    @foreach($quinta as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleQui)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleQui = true;
                        @endphp
                    @endforeach
                ]
            },
            {
                id: "board-sexta",
                title: "Sex",
                item: [
                    @foreach($sexta as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleSex)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleSex = true;
                        @endphp
                    @endforeach
                ]
            },
            {
                id: "board-sabado",
                title: "Sab",
                item: [
                    @foreach($sabado as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleSab)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleSab = true;
                        @endphp
                    @endforeach
                ]
            },
            {
                id: "board-domingo",
                title: "Dom",
                item: [
                    @foreach($domingo as $linha)
                        @php
                        if($linha->prioridade == 'Baixa'){
                            $bedge = 'info';
                        }
                        elseif($linha->prioridade == 'Média'){
                            $bedge = 'warning';
                        }
                        else{
                            $bedge = 'danger';
                        }
                        @endphp
                        @if($controleDom)
                            ,
                        @endif
                        {
                            id: '{{ $linha->id }}',
                            title: '{{ $linha->nmKanban }}',
                            badge: '{{ $bedge }}',
                            situacao: '{{ $linha->stKanban }}',
                            badgetext: '{{ $linha->prioridade }}'
                        }
                        @php
                        $controleDom = true;
                        @endphp
                    @endforeach
                ]
            }
        ],
        buttonClick: function (el, boardId) {
            const addNew = document.createElement('form');
            addNew.setAttribute('class', 'new-item-form');
            addNew.setAttribute('action', '{{ route("aluno.kanban.insert") }}');
            addNew.setAttribute('method', 'post');
            addNew.innerHTML =
                ' @csrf ' +
                '<input type="hidden" name="dia" value="'+ boardId +'">' +
                '<div class="mb-3">' +
                    '<select required class="form-control add-new-item" name="prioridade">' +
                        '<option value="">Prioridade</option>' +
                        '<option value="Baixa">Baixa</option>' +
                        '<option value="Média">Média</option>' +
                        '<option value="Alta">Alta</option>' +
                    '</select>' +
                '</div>' +
                '<div class="mb-3">' +
                    '<input type="text" required class="form-control add-new-item" name="nmKanban" placeholder="Nome">' +
                '</div>' +
                '<div class="mb-3">' +
                    '<textarea required name="dsKanban" class="form-control add-new-item" rows="3" placeholder="Conteúdo" autofocus required></textarea>' +
                '</div>' +
                '<div class="mb-3">' +
                    '<button type="submit" class="btn btn-primary btn-sm me-2">Add</button>' +
                    '<button type="button" class="btn btn-outline-secondary btn-sm cancel-add-item">Cancel</button>' +
                '</div>';
            kanban.addForm(boardId, addNew);

            // Remove form on clicking cancel button
            addNew.querySelector('.cancel-add-item').addEventListener('click', function (e) {
              addNew.remove();
            });
        },
        click: function (el) {
            id = el.getAttribute('data-eid');

            $.getJSON(
                '{{ route("aluno.kanban.buscar") }}',
                {
                    id : id
                },
                function(json){
                    document.getElementById('offCanvas_kanban_id').value = id;
                    document.getElementById('offCanvas_prioridade').value = json.prioridade;
                    document.getElementById('offCanvas_nmKanban').value = json.nmKanban;
                    document.getElementById('offCanvas_dsKanban').value = json.dsKanban;
                    document.getElementById('offCanvas_stKanban').value = json.stKanban;

                    kanbanOffcanvas.show();
                }
            );
        },
        dropEl: function(el, target){
            border_dia = target.parentElement.getAttribute('data-id');
            id = el.getAttribute('data-eid');

            $.getJSON(
                "{{ route('aluno.kanban.mudar.dia') }}",
                {
                    id : id,
                    border_dia : border_dia
                },
                function(){

                }
            );
        }
    });

    function renderHeader(color, text) {
        return (
            "<div class='d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1'>" +
                "<div class='item-badges d-flex'> " +
                    "<div class='badge rounded-pill bg-label-" + color + "'> " +
                        text +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    }

    function renderFooter(text) {
        return (
            "<div class='d-flex justify-content-between flex-wrap align-items-center mb-2 pb-1'>" +
                "<div class='item-badges d-flex'> " +
                    "<div class='badge rounded-pill bg-label-secondary mt-5'> " +
                        text +
                    '</div>' +
                '</div>' +
            '</div>'
        );
    }



    const kanbanContainer = document.querySelector('.kanban-container'),
        kanbanTitleBoard = [].slice.call(document.querySelectorAll('.kanban-title-board')),
        kanbanItem = [].slice.call(document.querySelectorAll('.kanban-item'));

        // Render custom items
        if (kanbanItem) {
            kanbanItem.forEach(function (el) {
                const element = "<span class='kanban-text'>" + el.textContent + '</span>';
                let img = '';
                el.textContent = '';
                if (el.getAttribute('data-badge') !== undefined && el.getAttribute('data-badgeText') !== undefined) {
                    el.insertAdjacentHTML('afterbegin', renderHeader(el.getAttribute('data-badge'), el.getAttribute('data-badgetext')) + img + element);
                }
                if (el.getAttribute('data-situacao') !== undefined) {
                    el.insertAdjacentHTML('beforeend', renderFooter(el.getAttribute('data-situacao')));
                }
            });
        }

});
</script>
@endsection
