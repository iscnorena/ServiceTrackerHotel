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
            {{ Form::model($user_edit, array('route'=> array('update-user',$user_edit->id) , 'method' => 'PUT', 'role' => 'form', 'novalidate')) }}
            
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
                      <input type="submit" value="Guardar" class="btn btn-primary">
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

             
