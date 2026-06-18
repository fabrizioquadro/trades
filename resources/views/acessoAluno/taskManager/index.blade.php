@extends('layoutAluno')

@section('conteudo')
<style media="screen">
table, tr, td, th{
    border: 1px solid #505050 !important;
    border-collapse: collapse !important;
}
</style>
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <div class="card-body">
            <div class="card app-calendar-wrapper">
                <div class="row g-0">
                    <!-- Calendar Sidebar -->
                    <div class="col app-calendar-sidebar border-end" id="app-calendar-sidebar">
                        <div class="p-4">
                            <!-- Filter -->
                            <div class="mb-4">
                                <small class="text-small text-muted text-uppercase align-middle">Filter</small>
                            </div>
                            <div class="app-calendar-events-filter">
                                <form action="" method="post">
                                    @csrf
                                    <div class="form-check form-check-danger mb-3">
                                        <input class="form-check-input input-filter" type="checkbox" id="controleFinalizados" name='controleFinalizados' value='sim' {{ $controleFinalizados }} onclick="submit()" />
                                        <label class="form-check-label" for="controleFinalizados">Cumpridos</label>
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input input-filter" type="checkbox" id="controleNaoFinalizados" name="controleNaoFinalizados" value="sim" {{ $controleNaoFinalizados }} onclick="submit()" />
                                        <label class="form-check-label" for="controleNaoFinalizados">Não Cumpridos</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar Sidebar -->

                    <!-- Calendar & Modal -->
                    <div class="col app-calendar-content">
                        <div class="card shadow-none border-0">
                            <div class="card-body pb-0">
                                <!-- FullCalendar -->
                                <div id="calendar"></div>
                            </div>
                        </div>
                        <div class="app-overlay"></div>
                        <!-- FullCalendar Offcanvas -->
                        <div class="offcanvas offcanvas-end event-sidebar" tabindex="-1" id="addEventSidebar" aria-labelledby="addEventSidebarLabel">
                            <div class="offcanvas-header border-bottom">
                                <h5 class="offcanvas-title" id="addEventSidebarLabel">Detalhes</h5>
                                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                            </div>
                            <div class="offcanvas-body">
                                <form action="{{ route('aluno.taskManager.insert') }}" method="post" class="event-form pt-0">
                                    @csrf
                                    <div class="form-floating form-floating-outline mb-4">
                                        <input type="date" name="dtTask" id="dtTask" readonly class="form-control" placeholder="Data:">
                                        <label for="dtTask">Data:</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4 select2-primary">
                                        <select class="select2 form-select" id="stTask" name="stTask">
                                            <option value=""></option>
                                            <option value="Finalizado">Cumprido</option>
                                            <option value="Não Finalizado">Não Cumprido</option>
                                        </select>
                                        <label for="stTask">Situação:</label>
                                    </div>
                                    <div class="form-floating form-floating-outline mb-4">
                                        <textarea class="form-control" rows="3" name="dsTask" id="dsTask"></textarea>
                                        <label for="dsTask">Observação:</label>
                                    </div>
                                    <div class="mb-3 d-flex justify-content-sm-between justify-content-start my-4 gap-2">
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-primary btn-add-event me-sm-2 me-1">Salvar</button>
                                            <button type="reset" class="btn btn-outline-secondary btn-cancel me-sm-0 me-1" data-bs-dismiss="offcanvas">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /Calendar & Modal -->
                </div>
            </div>
        </div>
    </div>
</div>
<script>

const events = [
    @foreach($eventos as $evento)
        @if($controleVirgula)
            ,
        @endif
        {
            id : "{{ $evento['url'] }}",
            title : "{{ $evento['title'] }}",
            start : "{{ $evento['start'] }}",
            end : "{{ $evento['end'] }}",
            allDay : "{{ $evento['allDay'] }}"
        }
        @php
        $controleVirgula = true;
        @endphp
    @endforeach
];

function buscaDadosTaskManager(data){
    $.getJSON(
        "{{ route('aluno.taskManager.buscar') }}",
        {
            data : data,
            aluno_id : {{ $aluno->id }}
        },
        function(json){
            document.getElementById('dtTask').value = json.dtTask;
            document.getElementById('stTask').value = json.stTask;
            document.getElementById('dsTask').value = json.dsTask;
        }
    );
}

document.addEventListener('DOMContentLoaded', function () {
    const bsAddEventSidebar = new bootstrap.Offcanvas(document.getElementById('addEventSidebar'));

    let calendar = new Calendar(document.getElementById('calendar'), {
        initialView: 'dayGridMonth',
        events: events,
        plugins: [dayGridPlugin, interactionPlugin, listPlugin, timegridPlugin],
        editable: true,
        dragScroll: true,
        dayMaxEvents: 2,
        headerToolbar: {
            start: 'prev,next, title',
            end: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        direction: 'ltr',
        initialDate: new Date(),
        navLinks: true, // can click day/week names to navigate views
        eventClassNames: function ({ event: calendarEvent }) {
            const colorName = calendarEvent._def.publicId;
            // Background Color
            console.log(colorName);
            return ['fc-event-' + colorName];
        },
        dateClick: function (info) {
            console.log(info);
            let data = moment(info.date).format('YYYY-MM-DD');
            console.log(data);
            buscaDadosTaskManager(data);

            bsAddEventSidebar.show();
        },
        eventClick: function (info) {
            data = info.event.start;
            data = data.toISOString();
            varData = data.split('T');

            data = varData[0];

            buscaDadosTaskManager(data);

            bsAddEventSidebar.show();
        }
    });

    // Render calendar
    calendar.render();
});

</script>
@endsection
