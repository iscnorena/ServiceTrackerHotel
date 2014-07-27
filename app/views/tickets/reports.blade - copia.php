@extends('layout')

@section('content')

<div class="container">

       <div class="row">
            <div class="col-md-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Buscar
                    </div>
                    <div class="panel-body">

                {{ Form::open(['route' => 'reportsview-ticket', 'method' => 'POST', 'role' => 'form', 'novalidate']) }}

                <div class="row">
                    <div class="col-md-2">
                        {{ Field::text('room') }}
                    </div>
                    <div class="col-md-2">
                        {{ Field::text('name_guest') }}
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('status', 'Estado') }}
                            {{ Form::select('status',array('en_proceso' => 'En Proceso', 'resuelto' => 'Resuelto', 'todos'=> 'Todos'),'todos',array('class' => 'form-control')) }}
                            <p class="error_message">{{ $errors->first('status')}}</p>
                        </div>
                    </div>
                </div>

                 <div class="row">
                     <div class="col-md-12">
                        <div class="form-group">
                            <p>
                              <input type="submit" value="Buscar" class="btn btn-primary">
                            </p>
                        </div>
                    </div>

                    {{ Form::close() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Recientes
                </div>
                <div class="panel-body">
                     <a href="{{ route('reports-pdf')}}" class="btn btn-info">PDF</a>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
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
                            @foreach ($reports_tickets as $tickets)
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
                    {{ $reports_tickets->links() }}
                    {{ Form::open(array('route' => array('delete-ticket', 'TICKET_ID'), 'method' => 'DELETE', 'role' => 'form', 'id' => 'form-delete')) }}
                    {{ Form::close() }}
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->

@endsection 

