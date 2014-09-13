@extends('layout')

@section('content')


<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Editar Numero Telefono
                </div>
                <div class="panel-body">
@if ($user->type==='superadmin' || $user->type==='admin' || $user->type==='usuario')
            {{ Form::model($tel, array('route'=> array('update-tel',$tel->id) , 'method' => 'PUT', 'role' => 'form', 'novalidate')) }}
            
            <div class="row">
                <div class="col-md-3">
                    {{ Field::text('full_name') }}
                </div>

                <div class="col-md-2">
                    {{ Field::text('area') }}
                </div>

                <div class="col-md-1">
                    {{ Field::text('ext') }}
                </div>

                <div class="col-md-3">
                     {{ Field::text('direct') }} 
                </div>

                <div class="col-md-3">
                     {{ Field::text('depto') }} 
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

             
