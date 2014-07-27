@extends('layout')

@section('content')
<div class="col-md-12">
    <div class="container">
      <div class="panel panel-primary">
        <div class="panel-heading"> Información </div>
        <div class="panel-body">  

          <h1>Habitación: {{ $ticket->room }}</h1>
           <p><strong> ID Ticket: </strong>
                 {{ $ticket->id }} 
          </p>
          <p><strong>Requerimiento:</strong>
                 {{ $ticket->request }} 
          </p>
          <p><strong>Nombre Huesped:</strong>
                 {{ $ticket->name_guest }} 
          </p>
          <p><strong>Grupo:</strong>
                 {{ $ticket->group }} 
          </p>
          <p><strong>Departamento:</strong>
              {{ $ticket->category->name }}
          </p>  
          <p><strong>Piso:</strong>
              {{ $ticket->floor }}
          </p>  
          <p><strong>Reportado Por:</strong>
                 {{ $ticket->report_by }}
          </p>        
          <p><strong>Atendido Por:</strong>
                 {{ $ticket->attend_by }}
          </p>        
          <p><strong>Estado:</strong>
                 {{ $ticket->status }}
          </p>
          <p><strong>Creado:</strong>
                 {{ $ticket->created_at }}
          </p>
          <p><strong>Resuelto:</strong>
                 {{ $ticket->resolved_at }}
          </p>
          <p><strong>Minutos:</strong>
                 {{ $ticket->minutes }}
          </p>
          <p><strong>Anexado Por:</strong>
                 {{ $ticket->add_by }}
          </p>
          <p><strong>Actualizado Por:</strong>
                 {{ $ticket->update_by }}
          </p>
          <p><strong>Observaciones:</strong>
                 {{ $ticket->notes }}
          </p>        
           <a href="{{ route('home') }}">Regresar a Home</a>
        <div> <!-- class="panel-body" -->
      </div> <!-- class="panel panel-primary" -->
    </div> <!-- /container -->
</div>


@endsection 