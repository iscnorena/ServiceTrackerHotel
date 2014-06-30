@extends('layout')

@section('content')

<div class="container">
    <h1>{{ $category->name }}</h1>

    <table class="table table-striped">
        <tr>
            <th>Anexado por</th>
            <th>Habitacion</th>
            <th>Requerimiento</th>
            <th>Ver</th>
        </tr>
        @foreach ($category->paginate_tickets as $ticket)
        <tr>
            <td>{{ $ticket->user->username }}</td>
            <td>{{ $ticket->room }}</td>
            <td>{{ $ticket->request }}</td>
            <td width="50">
                <a href="{{ route('ticket', [$ticket->id]) }}" class="btn btn-info">
                    Ver
                </a>
            </td>
        </tr>
        @endforeach


    </table>

    {{ $category->paginate_tickets->links() }}

</div> <!-- /container -->

@endsection 