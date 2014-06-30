@extends('layout')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1>Editar Ticket: {{ $ticket->id }}</h1>

            {{ Form::model($ticket, array('route'=> array('update-ticket',$ticket->id) , 'method' => 'PUT', 'role' => 'form', 'novalidate')) }}
            {{ Field::text('name_guest') }}

            {{ Field::text('room') }}

            {{ Field::select('category_id', $categories) }}

            {{ Field::text('request') }}

            {{ Field::text('report_by') }}

            {{ Field::text('attend_by') }} 

            <div class="form-group">
            {{ Form::label('status', 'Estado') }}
            {{ Form::select('status',array('en_proceso' => 'En Proceso', 'resuelto' => 'Resuelto'),$ticket->status,array('class' => 'form-control')) }}
            </div>

            {{-- Field::text('add_by') --}}

            <div class="form-group">
            {{ Form::label('add_by', 'Anexado Por') }}
            {{ Form::text('add_by', $user->username, array('placeholder' => 'usuario', 'class' => 'form-control')) }}
            </div>

            {{ Field::text('user_id') }}

            {{ Field::textarea('notes') }}

            <p>
              <input type="submit" value="Register" class="btn btn-success">
            </p>

            {{ Form::close() }}

        </div>
    </div>
</div>

@endsection 
            



