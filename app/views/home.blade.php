@extends('layout')

@section('content')

@if (Auth::guest())
<div class="jumbotron">
    <div class="container">
        <h1>Service Tracker</h1>
        <p>
            Nuestro sistema de seguimiento de incidentes, también conocido como Service Tracker, está diseñado para ayudar a registrar, dar seguimiento y finalmente solucionar todos los requerimientos que puedan llegar a surgir, garantizando la satisfacción de los huespedes.
        </p>
        
       <p>
        </p>
    </div>
</div>
@endif




<div class="container">
@if (Auth::check())
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"> Crear Ticket </div>
                <div class="panel-body">

                    {{ Form::open(['route' => 'register-ticket', 'method' => 'POST', 'role' => 'form', 'novalidate']) }}

                    <div class="row">
                        <div class="col-md-3">
                            {{ Field::text('name_guest') }}
                        </div>

                        <div class="col-md-2">
                            {{ Field::text('room') }}
                        </div>

                        <div class="col-md-3">
                            {{ Field::select('category_id', $categories) }}
                        </div>
                        
                         <div class="col-md-4">
                            {{ Field::text('request') }}
                        </div>
                    </div> <!-- class="row" -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('report_by', 'Reportado Por') }}
                                {{ Form::text('report_by', 'Huesped', array('class' => 'form-control')) }}
                                <p class="error_message">{{ $errors->first('report_by')}}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            {{ Field::text('attend_by') }} 
                        </div>

                        <div class="col-md-4">
                            {{ Field::text('notes') }}
                        </div> 
                    </div><!-- class="row" -->


                    <div class="row">
                        {{-- Field::select('status', array('en_proceso' => 'En Proceso', 'resuleto' => 'Resuelto')) --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('status', 'Estado') }}
                                {{ Form::select('status',array('en_proceso' => 'En Proceso', 'resuleto' => 'Resuelto'),'en_proceso',array('class' => 'form-control')) }}
                                <p class="error_message">{{ $errors->first('status')}}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('add_by', 'Anexado Por') }}
                                {{ Form::text('add_by', $user->username, array('placeholder' => '', 'class' => 'form-control','readonly')) }}
                                <p class="error_message">{{ $errors->first('add_by')}}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <p>
                                    <input type="submit" value="Guardar" class="btn btn-primary btn-lg">
                                </p>
                            </div>
                        </div>

                    </div><!-- class="row" -->        
                    {{ Form::close() }}
                </div> <!-- class="panel-body" -->
            </div> <!-- class="panel panel-primary" -->
        </div> <!-- class="col-md-12" -->
    </div> <!-- class="row" -->
</div> <!-- class="container" -->

<div class="container"  >
    <div class="row">
        <div class="col-md-12" >
            <div class="panel panel-primary" >
                <div class="panel-heading">
                    Recientes
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>Id</th>
                                <th>Hab</th>
                                <th>Requerimiento</th>
                                <th>Por</th>
                                <th>Atendido</th>
                                <th>Depto</th>
                                <th>Notas</th>
                                <th>Inicio</th>
                                <th>Tiempo</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach ($recents_tickets as $tickets)
                            @if ($tickets->status==='resuelto')
                            <tr class="success">
                            @elseif ($tickets->status==='en_proceso')
                                @if(strlen($tickets->notes)==0)
                                    <tr class="warning">
                                @else
                                    <tr class="danger">
                                @endif
                            @else
                            <tr>
                            @endif
                                <td>{{ $tickets->id }}</td>
                                <td>{{ $tickets->room }}</td>
                                <td>{{ $tickets->request }}</td>
                                <td>{{ $tickets->add_by }}</td>
                                <td>{{ $tickets->attend_by }}</td>
                                <td>{{ $tickets->category->slug }}</td>
                                <td>{{ $tickets->notes }}</td>
                                <td>{{ $tickets->created_at }}</td>
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