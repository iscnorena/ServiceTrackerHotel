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
                        <div class="form-group">
                            {{ Form::label('campo', 'Top') }}
                            {{ Form::select('campo',array('requerimiento' => 'Requerimiento', 'category_id'=> 'Departamento'),'Requerimiento',array('class' => 'form-control')) }}
                            <p class="error_message">{{ $errors->first('campo')}}</p>
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
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>#</th>
                                <th>Campo</th>
                                <th>Cantidad</th>
                                <th>Ver</th>
                            </tr>
                            @foreach ($top_tickets as $row)
                            <tr>
                                <td>{{ $row->request }}</td>
                                <td>{{ $row->solicitudes }}</td>
                                <td>{{ $row->solicitudes }}</td>
                                    <a href="{{ route('ticket') }}" class="btn btn-info">
                                        <span class="glyphicon glyphicon-search"></span> 
                                    </a>
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->                            

@endsection 

