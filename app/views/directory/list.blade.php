@extends('layout')

@section('content')

@if (Auth::check())
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    Listado de Telefonos
                </div>
                <div class="panel-body">
@if ($user->type==='superadmin' || $user->type==='admin' || $user->type==='usuario')
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-condensed">
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Area</th>
                                <th>Extensión</th>
                                <th>Numero Directo</th>
                                <th>Depto</th>
                                <th>Acciones</th>
                            </tr>
                            @foreach ($tel_all as $tel)
                            <tr>
                                <td>{{ $tel->id }}</td>
                                <td>{{ $tel->full_name }}</td>
                                <td>{{ $tel->area }}</td>
                                <td>{{ $tel->ext }}</td>
                                <td>{{ $tel->direct }}</td>
                                <td>{{ $tel->depto }}</td>                                
                                <td >
                                    <a href="{{ route('edit-tel', [$tel->id]) }}" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-pencil"></span>
                                    </a>                                 
                                </td>
                            </tr>
                             @endforeach
                        </table>
                    </div>
                    {{ $tel_all->links() }}
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