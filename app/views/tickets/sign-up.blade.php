@extends('layout')

@section('content')

@if (Auth::check())
<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Nuevo Ticket
                </div>
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
            </div>

            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('report_by', 'Reportado Por') }}
                    {{ Form::text('report_by', 'Huesped', array('placeholder' => '', 'class' => 'form-control')) }}
                    <p class="error_message">{{ $errors->first('report_by')}}</p>
                </div>
            </div>

            <div class="col-md-4">
                {{ Field::text('attend_by') }} 
            </div>

            <div class="col-md-4">
                {{ Field::text('notes') }}
            </div> 
            </div>


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
                    {{ Form::text('add_by', $user->username, array('placeholder' => '', 'class' => 'form-control')) }}
                    <p class="error_message">{{ $errors->first('add_by')}}</p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('user_id', 'Usuario') }}
                    {{ Form::text('user_id', $user->id, array('placeholder' => '', 'class' => 'form-control')) }}
                    <p class="error_message">{{ $errors->first('user_id')}}</p>
                </div>
            </div>
            </div>

             
             <div class="col-md-12">
                <div class="form-group">
                    <p>
                      <input type="submit" value="Register" class="btn btn-primary">
                    </p>
                </div>
            </div>

            {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endif

@endsection 
