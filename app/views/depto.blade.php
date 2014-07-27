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


@if (Auth::check())

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
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
                                <th>Estado</th>
                                <th>Atendido Por</th>
                                <th>Departamento</th>
                                <th>Tiempo</th>
                                <th></th>
                            </tr>
                            @foreach ($onecategory_tickets as $tickets)
                            @if ($tickets->status==='resuelto')
                            <tr class="success">
                            @elseif ($tickets->status==='en_proceso')
                            <tr class="warning">
                            @else
                            <tr>
                            @endif
                                <td>{{ $tickets->id }}</td>
                                <td>{{ $tickets->room }}</td>
                                <td>{{ $tickets->request }}</td>
                                <td>{{ $tickets->status }}</td>
                                <td>{{ $tickets->attend_by }}</td>
                                <td>{{ $tickets->category->name }}</td>
                                <td>{{ $tickets->minutes }}</td>
                                <td >
                                    <a href="{{ route('ticket', [$tickets->id]) }}" class="btn btn-info">
                                        <span class="glyphicon glyphicon-search"></span> 
                                    </a>
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                    {{ $onecategory_tickets->links() }}
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->
@endif

@stop