<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>PDF</title>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
    <h1>Reporte</h1>        
    <table  BORDER="1" CELLSPACING="0" align="center">
        <tr align="center">
           <!--  <th>i</th> -->
            <th>Id</th>
            <th>Hab</th>
            <th>Requerimiento</th>
            <th>Estado</th>
            <th>Anexado</th>
            <th>Atendido</th>
            <th>Depto</th>
            <th>Inicio</th>
            <th>Tiempo</th>
        </tr>
        <?php   $i=1;      ?>
        @foreach ($reports_tickets as $tickets)
        <tr align="center">
            <!-- <td>{{$i}}</td> -->
            <td>{{ $tickets->id }}</td>        
            <td>{{ $tickets->room }}</td>
            <td>{{ $tickets->request }}</td>
            <td>{{ $tickets->status }}</td>
            <td>{{ $tickets->add_by }}</td>
            <td>{{ $tickets->attend_by }}</td>
            <td>{{ $tickets->category->name }}</td>
            <td>{{ $tickets->created_at }}</td>
            <td>{{ $tickets->minutes }}</td>
        </tr>
                <?php
                //$i++;
                //echo 'incrementa i: '.$i;
                if ($i==30)
                {

                    echo "</table> <div style='page-break-before: always;'></div><table  BORDER='1' CELLSPACING='0' align='center'>
        <tr align='center'>
            <th>Id</th>
            <th>Hab</th>
            <th>Requerimiento</th>
            <th>Estado</th>
            <th>Anexado</th>
            <th>Atendido</th>
            <th>Depto</th>
            <th>Inicio</th>
            <th>Tiempo</th>
        </tr>";
                    $i=1;
                }
            ?>
        <?php   $i++;      ?>
         @endforeach
    </table> 

    <div class="container">
        <hr>

        <footer>
            <p>&copy; Service Tracker</p>
        </footer>
    </div> <!-- /container -->

</body>
</html>