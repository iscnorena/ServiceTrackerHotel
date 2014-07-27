<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Datos SEO -->
    <meta name="description" content="Seguimientos de Requerimientos Hotel">
    <meta name="keywords" content="hotel, tickets, requerimientos, quejas, opera">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    

    <title>Service Tracker</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <!-- Custom styles for datepicker -->
    <link href="{{ asset('bootstrap/css/datepicker.css') }}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top navbar-static-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ route('home') }}">Home</a>
        </div>
        <div class="navbar-collapse collapse">
            @if (Auth::check())
            <ul class="nav navbar-nav pull-right">
                <!-- usuarios -->
                @if ( Auth::user()->type==='superadmin' )
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="icon icon-wh i-profile"></span> Usuarios <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('sign_up') }}">Nuevo</a></li>
                        <li><a href="{{ route('list-user') }}">Ver</a></li>
                    </ul>
                </li>
                @endif

                @if ( Auth::user()->type==='superadmin' ||  Auth::user()->type==='admin' ||  Auth::user()->type==='usuario' )                
                <!-- Tickets -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="icon icon-wh i-profile"></span> Tickets <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('home') }}">Nuevo</a></li>
                        <!-- <li><a href="{{ route('new-ticket') }}">Nuevo</a></li> -->
                        <li><a href="{{ route('search-ticket') }}">Buscar</a></li>
                        <!--<li><a href="{{ route('list-ticket') }}">Lista</a></li>-->
                        <!-- <li><a href="{{ route('recents-ticket') }}">Ultimos</a></li> -->
                        <li><a href="{{ route('reports-ticket') }}">Reportes</a></li>
                        <!-- <li><a href="{{ route('top-ticket') }}">TOP</a></li> -->
                    </ul>
                </li>
                @endif
                
                <!-- perfil -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <span class="icon icon-wh i-profile"></span> {{ Auth::user()->username }}  <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('account') }}">Editar usuario</a></li>
                        <li><a href="{{ route('logout') }}">Salir</a></li>
                    </ul>
                </li>
            </ul>
        @else
            {{ Form::open(['route' => 'login', 'method' => 'POST', 'role' => 'form', 'class' => 'navbar-form navbar-right']) }}
             @if (Session::has('login_error'))
                    <span class="label label-danger">Credenciales no válidas</span>
                @endif
                <div class="form-group">
                    {{ Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Usuario']) }}
                </div>
                <div class="form-group">
                    {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) }}
                </div>
                <div class="checkbox">
                    <label class="remember-me">
                        {{ Form::checkbox('remember') }} Recordarme
                    </label>
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            {{Form::close()}}
            @endif
        </div><!--/.navbar-collapse -->
    </div>
</div>

<div class="row">
<p>
</p>
</div>

@yield('content')

<div class="container">
    <hr>

    <footer>
        <p>&copy; Hotel 2014</p>
    </footer>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>

<script src="{{ asset('bootstrap/js/admin.js') }}"></script>

<script src="{{ asset('bootstrap/js/typeahead.jquery.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/autocomplete.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap-datepicker.js') }}"></script>
<script>
$('#dp1').datepicker({
                format: 'yyyy-mm-dd'
            });
$('#dp2').datepicker({
                format: 'yyyy-mm-dd'
            });
</script>

@yield ('scripts')
</body>
</html>