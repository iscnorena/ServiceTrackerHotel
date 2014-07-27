@extends('layout')

@section('content')

@if (Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Listado de Usuarios
                </div>
                <div class="panel-body">
@if ($user->type==='superadmin' || $user->type==='admin')
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Creado</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td >
                            
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                    {{ $users->links() }}
@else
            <div class="row">
                <div class="col-md-6">
                    <strong><h1>Acceso No autorizado</h1></strong>
                </div>
            </div>
@endif
                </div> 
            </div>       
        </div> <!-- /class="col-md-12"  -->       
    </div> 
</div> <!-- /container -->
@endif

@stop