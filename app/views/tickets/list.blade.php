@extends('layout')

@section('content')

<!-- Main jumbotron for a primary marketing message or call to action -->

<div class="container">
    <h1>Listado de Tickets</h1>

  
<table class="table table-striped">
    <tr>
        <th>Id</th>
        <th>Habitaci&oacute;n</th>
        <th>Requerimiento</th>
        <th>Estado</th>
        <th>Atendido Por</th>
        <th>Departamento</th>
        <th>Acciones</th>
    </tr>
    @foreach ($tickets as $ticket)
    <tr>
        <td>{{ $ticket->id }}</td>
        <td>{{ $ticket->room }}</td>
        <td>{{ $ticket->request }}</td>
        <td>{{ $ticket->status }}</td>
        <td>{{ $ticket->attend_by }}</td>
        <td>{{ $ticket->category->name }}</td>
        <td>
          <a href="{{ route('ticket', [$ticket->id]) }}" class="btn btn-info">
              Ver
          </a>
          <a href="{{ route('edit-ticket', [$ticket->id]) }}" class="btn btn-primary">
            Editar
          </a>
          <a href="{{ route('resolved-ticket', [$ticket->id]) }}" class="btn btn-success">
              ok
          </a>
          <a href="#" data-id="{{ $ticket->id }}" class="btn btn-danger btn-delete">
             Eliminar
          </a>
        </td>
    </tr>
    @endforeach
  </table>
{{ $tickets->links() }}
{{ Form::open(array('route' => array('delete-ticket', 'TICKET_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
{{ Form::close() }}

</div> <!-- /container -->

@endsection
