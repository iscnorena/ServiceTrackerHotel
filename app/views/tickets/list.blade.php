@extends('layout')

@section('content')

@if (Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Listado
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>Id</th>
                                <th>Hab</th>
                                <th>Huesped</th>
                                <th>Requerimiento</th>
                                <th>Estado</th>
                                <th>Anexado</th>
                                <th>Atendido</th>
                                <th>Depto</th>
                                <th>Inicio</th>
                                <th>OK</th>
                                <th>Tiempo</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach ($all_tickets as $tickets)
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
                                <td>{{ $tickets->add_by }}</td>
                                <td>{{ $tickets->attend_by }}</td>
                                <td>{{ $tickets->category->name }}</td>
                                <td>{{ $tickets->created_at }}</td>
                                <td>{{ $tickets->resolved_by }}</td>
                                <td>{{ $tickets->minutes }}</td>
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
                                    @if ( Auth::user()->type==='superadmin' ||  Auth::user()->type==='admin' )
                                    <a href="#" data-id="{{ $tickets->id }}" class="btn btn-danger btn-delete">
                                        <span class="glyphicon glyphicon-remove"></span>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                    {{ $all_tickets->links() }}
                    {{ Form::open(array('route' => array('delete-ticket', 'TICKET_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
                    {{ Form::close() }}
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->                            
@endif

@stop