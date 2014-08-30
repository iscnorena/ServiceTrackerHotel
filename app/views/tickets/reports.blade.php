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

                {{ Form::open(['url' => 'reports/tickets', 'method' => 'POST', 'role' => 'form', 'novalidate']) }}

                <div class="row">
                    <div class="col-md-2">
                        {{ Field::text('room') }}
                    </div>
                    <div class="col-md-2">
                        {{ Field::text('name_guest') }}
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('status', 'Estado') }}
                            {{ Form::select('status',array('en_proceso' => 'En Proceso', 'resuelto' => 'Resuelto', 'todos'=> 'Todos'),'todos',array('class' => 'form-control')) }}
                            <p class="error_message">{{ $errors->first('status')}}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('datei', 'Fecha Inicio') }}
                                {{ Form::text('datei', null, array('class' => 'form-control','id' => 'dp1','data-date-format' => 'yyyy-mm-dd')) }}
                                <p class="error_message">{{ $errors->first('datei')}}</p>
                            </div>
                    </div>

                    <div class="col-md-2">
                            <div class="form-group">
                                {{ Form::label('datef', 'Fecha Fin') }}
                                {{ Form::text('datef', null, array('class' => 'form-control','id' => 'dp2','data-date-format' => 'yyyy-mm-dd')) }}
                                <p class="error_message">{{ $errors->first('datef')}}</p>
                            </div>
                        </div>

                </div>

                 <div class="row">
                     <div class="col-md-1">
                        <div class="form-group">
                            <p>
                              <input type="submit" name="buscar" value="Buscar" class="btn btn-primary">
                            </p>
                        </div>

                     </div>

                      <div class="col-md-1">
                        <div class="form-group">
                            <p>
                              <input type="submit" name="pdf" value="PDF" class="btn btn-danger">
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
                            @foreach ($reports_tickets as $tickets)
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
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                    {{ $reports_tickets->links() }}
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->

@endsection 

