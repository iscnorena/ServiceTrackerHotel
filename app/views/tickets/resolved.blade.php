@extends('layout')

@section('content')

<div class="container">

    <h1>{{ $ticket->room }}</h1>

    <p>
        Ticket Resuelto:
    </p>

    <p>
        Habitacion:
        <a href="#">
           {{ $ticket->room }}
        </a>
    </p>

    <h4>Requerimiento</h4>

    <p>{{ $ticket->request }}</p>
{{ Form::model($ticket, array('route' => array('delete-ticket', $ticket->id), 'method' => 'DELETE'), array('role' => 'form')) }}
  {{ Form::submit('Eliminar Ticket', array('class' => 'btn btn-danger')) }}
{{ Form::close() }}

</div> <!-- /container -->



@endsection 