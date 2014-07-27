@extends('layout')

@section('content')

@if (Auth::check())
<div class="container">
   <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading"> Editar </div>
                <div class="panel-body">

                    {{ Form::model($ticket, array('route'=> array('update-ticket',$ticket->id) , 'method' => 'PUT', 'role' => 'form', 'novalidate')) }}

                    <div class="row">
                        <div class="col-md-3">
                            {{ Field::text('name_guest') }}
                        </div>

                        <div class="col-md-2">
                            {{ Field::text('room') }}
                        </div>

                        <div class="col-md-3">
                            {{ Field::text('group') }}
                        </div>                   

                        <div class="col-md-4">
                            {{ Field::text('request') }}
                        </div>
                    </div> <!-- class="row" -->

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('report_by', 'Reportado Por') }}
                                {{ Form::text('report_by', $ticket->report_by, array('placeholder' => '', 'class' => 'form-control')) }}
                                <p class="error_message">{{ $errors->first('report_by')}}</p>
                            </div>
                        </div>

                        <div class="col-md-4">
                            {{ Field::text('attend_by') }} 
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('status', 'Estado') }}
                                {{ Form::select('status',array('en_proceso' => 'En Proceso', 'resuelto' => 'Resuelto'),$ticket->status,array('class' => 'form-control')) }}
                                <p class="error_message">{{ $errors->first('status')}}</p>
                            </div>
                        </div>
                        
                    </div><!-- class="row" -->


                    <div class="row">
                        <div class="col-md-4">
                            {{ Field::select('category_id', $categories) }}
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                {{ Form::label('updated_by', 'Actualizado Por') }}
                                {{ Form::text('update_by', $user->username, array('placeholder' => '', 'class' => 'form-control', 'readonly')) }}
                                <p class="error_message">{{ $errors->first('add_by')}}</p>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                {{ Form::label('add_by', 'Anexado por') }}
                                {{ Form::text('add_by', $ticket->add_by, array('placeholder' => '', 'class' => 'form-control', 'readonly')) }}
                                <p class="error_message">{{ $errors->first('user_id')}}</p>
                            </div>
                        </div>

                        <div class="col-md-2">
                             <div class="form-group">
                                {{ Form::label('minutes', 'Minutos') }}
                                {{ Form::text('minutes', $ticket->minutes, array('class' => 'form-control', 'readonly')) }}
                                <p class="error_message">{{ $errors->first('user_id')}}</p>
                            </div>
                        </div>
                        
                    </div> <!-- class="row" -->

                    <div class="row">
                        <div class="col-md-5">
                            {{ Field::textarea('notes') }}
                        </div> 
                    </div>
                    <div class="row">
                         <div class="col-md-12">
                            <div class="form-group">
                                <p>
                                  <input type="submit" value="Guardar" class="btn btn-primary">
                                </p>
                            </div>
                        </div>
                    </div> <!-- class="row" -->
                    {{ Form::close() }}
                </div><!--  class="panel-body" -->
            </div> <!-- class="panel panel-primary" -->
        </div> <!-- class="col-md-12" -->
    </div> <!--  class="row" -->
</div> <!-- class="container" -->
@endif

@endsection 
            



