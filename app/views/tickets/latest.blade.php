@extends('layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
    <div class="container">
        <h1>Service Tracker</h1>
        <p>
            Nuestro sistema de seguimiento de incidentes, también conocido como Service Tracker, está diseñado para ayudar a registrar, dar seguimiento y finalmente solucionar todos los requerimientos que puedan llegar a surgir, garantizando la satisfacción de los huespedes.
        </p>
        @if (Auth::check())
       <p>
            <a href="{{ route('new-ticket') }}" class="btn btn-primary btn-lg" role="button">
                Nuevo Ticket &raquo;
            </a>
        </p>
        @endif
    </div>
</div>

@if (Auth::check())
<div class="container">
    <h1>Últimos Tickets</h1>

   @foreach ($latest_tickets as $tickets)
    <h2></h2>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Habitación</th>
            <th>Requerimiento</th>
            <th>Ver</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>{{ $ticket->room }}</td>
            <td>{{ $ticket->request }}</td>
            <td width="50">
                <a href="{{ route('ticket', [$ticket->id]) }}" class="btn btn-info">
                    Ver
                </a>
            </td>
        </tr>
        </tbody>
    </table>
    <p>
        <a href="#">
            texto sin sentido
        </a>
    </p>
    @endforeach




</div> <!-- /container -->
@endif

@stop