@extends('layout')

@section('content')

@if (Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Listado de Tickets Recientes
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>Id</th>
                                <th>Habitaci&oacute;n</th>
                                <th>Huesped</th>
                                <th>Requerimiento</th>
                                <th>Estado</th>
                                <th>Atendido Por</th>
                                <th>Departamento</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach ($recents_tickets as $tickets)
                            @if ($tickets->status==='resuelto')
                            <tr class="success">
                            @elseif ($tickets->status==='en_proceso')
                            <tr class="warning">
                            @else
                            <tr>
                            @endif
                                <td>{{ $tickets->id }}</td>
                                <td>{{ $tickets->room }}</td>
                                <td>{{ $tickets->name_guest }}</td>
                                <td>{{ $tickets->request }}</td>
                                <td>{{ $tickets->status }}</td>
                                <td>{{ $tickets->attend_by }}</td>
                                <td>{{ $tickets->category->name }}</td>
                                <td >
                                    <a href="{{ route('ticket', [$tickets->id]) }}" class="btn btn-info">
                                        <span class="glyphicon glyphicon-search"></span> 
                                    </a>
                                    <a href="{{ route('edit-ticket', [$tickets->id]) }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>
                                    <a href="{{ route('resolved-ticket', [$tickets->id]) }}" class="btn btn-success">
                                        <span class="glyphicon glyphicon-ok"></span>
                                    </a>
                                    <a href="#" data-id="{{ $tickets->id }}" class="btn btn-danger btn-delete">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                    {{ $recents_tickets->links() }}
                    {{ Form::open(array('route' => array('delete-ticket', 'TICKET_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
                    {{ Form::close() }}
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->
@endif

@stop