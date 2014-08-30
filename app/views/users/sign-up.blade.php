@extends('layout')

@section('content')


<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Nuevo Usuario
                </div>
                <div class="panel-body">
@if ($user->type==='superadmin')
            {{ Form::open(['route' => 'register', 'method' => 'POST', 'role' => 'form', 'novalidate']) }}
            
            <div class="row">
                <div class="col-md-3">
                    {{ Field::text('full_name') }}
                </div>

                <div class="col-md-2">
                    {{ Field::text('username') }}
                </div>

                <div class="col-md-3">
                    {{ Field::email('email') }}
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('view', 'Departamento') }}
                        {{ Form::select('view',array('ALLAVES' => 'Ama de Llaves', 'AP' => 'Areas Publicas', 'AYB' => 'AyB', 'MANTTO' => 'Mantenimiento', 'REC' => 'Recepción', 'SIS' => 'Sistemas', 'TEL' => 'Telefonos'),'ALLAVES',array('class' => 'form-control')) }}
                        <p class="error_message">{{ $errors->first('view')}}</p>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('type', 'Tipo') }}
                        {{ Form::select('type',array('superadmin' => 'Superadmin', 'admin' => 'Admin', 'usuario' => 'Usuario', 'depto' => 'Departamento'),'usuario',array('class' => 'form-control')) }}
                        <p class="error_message">{{ $errors->first('type')}}</p>
                    </div>
                </div>
            </div>

            <div class="row">
                

                
            </div>

            <div class="row">
                <div class="col-md-6">
                     {{ Field::password('password') }} 
                </div>

                <div class="col-md-6">
                    {{ Field::password('password_confirmation', ['placeholder' => 'Repite tu clave']) }}
                </div> 
            </div>
             
             <div class="col-md-12">
                <div class="form-group">
                    <p>
                      <input type="submit" value="Registrar" class="btn btn-primary">
                    </p>
                </div>
            </div>

            {{ Form::close() }}
@else
            <div class="row">
                <div class="col-md-6">
                    <strong><h1>Acceso No autorizado</h1></strong>
                </div>
            </div>
@endif
                </div>
            </div>
        </div>
    </div>
</div>

             
