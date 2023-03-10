@extends('layout')
@section('content')
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ver cita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="inline"><strong>Mascota:</strong></div>
                    <div id="eventDetails" class="inline"></div>
                    <p class="mb-0"><strong>Inicio:</strong></p>
                    <div id="fechaInicio"></div>
                    <p class="mb-0"><strong>Fin:</strong></p>
                    <div id="fechaFin"></div>
                    <p class="mb-0"><strong>Fecha y hora de reserva:</strong></p>
                    <div id="reserva"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="alert alert-info">Para ver la hora de la reserva de cada cliente, haga clic en una cita</div>

    <div>
        <label for="vista">Vista</label>
        <select name="vista" id="vista">
            <option value="dia">Día</option>
            <option value="mes">Mes</option>
        </select>
    </div>



    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.4/index.global.min.js'></script>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay',
                locale: "es",
                events: "/fullcalendar",

                eventClick: function(info) {
                    // Función que se ejecuta cuando se hace clic en un evento
                    $('#eventModal').modal('show'); // Mostrar el modal
                    $('#eventDetails').html(info.event
                        .title); // Mostrar el título del evento en el modal
                    $('#fechaInicio').html(info.event
                        .start);
                    $('#fechaFin').html(info.event
                        .end);
                    $('#reserva').html(info.event.id.slice(0, 16));
                }
            });
            calendar.render();

            const selectElement = document.querySelector('#vista');
            selectElement.addEventListener('change', (event) => {
                event.target.value === "dia" ? calendar.changeView('timeGridDay') : calendar.changeView(
                    'dayGridMonth');
            });

        });
    </script>




    <div id='calendar'></div>
@endsection
