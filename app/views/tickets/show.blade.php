@extends('layout')

@section('content')
<div class="col-md-12">
    <div class="container">

        <h1>Habitación: {{ $ticket->room }}</h1>

         <p>
            <strong>ID Ticket:</strong>
               {{ $ticket->id }} 
        </p>

        <p>
            <strong>Requerimiento:</strong>
               {{ $ticket->request }} 
        </p>

        <p>
            <strong>Nombre Huesped:</strong>
               {{ $ticket->name_guest }} 
        </p>
        
        <p>
            <strong>Departamento:</strong>
            {{ $ticket->category->name }}
        </p>
        
        <p>
            <strong>Observaciones:</strong>
               {{ $ticket->notes }}
        </p>
        
        <p>
            <strong>Reportado Por:</strong>
               {{ $ticket->report_by }}
        </p>
        
        <p>
            <strong>Atendido Por:</strong>
               {{ $ticket->attend_by }}
        </p>
        
        <p>
            <strong>Estado:</strong>
               {{ $ticket->status }}
        </p>

        <p>
            <strong>Anexado Por:</strong>
               {{ $user->username }}
        </p>
     
        
    {{ Form::model($ticket, array('route' => array('delete-ticket', $ticket->id), 'method' => 'DELETE'), array('role' => 'form')) }}
      {{ Form::submit('Eliminar Ticket', array('class' => 'btn btn-danger')) }}
    {{ Form::close() }}

    </div> <!-- /container -->
</div>


@endsection 