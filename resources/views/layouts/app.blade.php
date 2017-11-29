<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font_awersome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{asset('js/jquery.js')}}"></script>
    @yield('style')
</head>
<body>
    <div id="app">
      @if (session('message'))
      <script>
        $(document).ready(function(){
          var mensaje = {!! Session::get('message') !!};
          $.notify({
              // options
              icon: 'fa fa-check',
              title: '<strong>' + mensaje.title + '</strong><br>',
              message: mensaje.msg,
              target: '_blank'
          },
          {
            type: "success",
            delay: 3000,
            placement: {
          		from: "top",
          		align: "center"
          	}
          });
        });
      </script>
      @endif
        <nav class="navbar navbar-inverse navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" style="background-image: url({{ asset('images/Logo.png') }});" href="{{ url('/') }}">
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size: 40px; margin-top: -10px;">PetSell</span>
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        <form class="navbar-form navbar-left" method="get" action="{{ url('buscar') }}">
                            <div class="form-group">
                                <input type="text" class="form-control" name="busqueda" id="busqueda" placeholder="Buscar...">
                            </div>
                            <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                        </form>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registrar</a></li>
                        @else
                            <li>
                              <li class="dropdown notification-container">
                                  <!-- Icono y contador de mensajes -->
                                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="fa fa-comments"></i></a>
                                  <span class="notification-counter"><div class="cant-msj">  </div></span>
                                  <!-- Dropdown -->
                                  <ul class="dropdown-menu notify-drop">
                                    <div class="notify-drop-title">
                                    	<div class="row">
                                    		<div class="col-md-6 col-sm-6 col-xs-6">Mensajes (<b><div class="cant-msj"> </div></b>)</div>
                                    	</div>
                                    </div>
                                    <div class="drop-content">
                                    	<li>
                                    		<div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div>
                                    		<div class="col-md-9 col-sm-9 col-xs-9 pd-l0">Admin: El aviso: <div><> necesita edición <a href="">Editar Aviso</a>
                                    		<hr><p class="time">13:44</p>
                                    		</div>
                                    	</li>
                                    </div>
                                    <div class="notify-drop-footer text-center">
                                    	<a href='{{ url('user/avisos') }}'><i class="fa fa-envelope-o"> Mostrar Todos</i></a>
                                    </div>
                                  </ul>
                              </li>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    Bienvenido: {{ Auth::user()->name }} <span class="glyphicon glyphicon-menu-hamburger"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('home') }}">Home</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/info') }}">Mi Perfil</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @yield('carrusel')
        @yield('content')
        <div style="margin-bottom: 50px"></div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
    <script type="text/javascript">
    $(document).ready(function(){
        getNotificaciones();
    });

    var notificaciones;

    function getNotificaciones(){
      $.ajax({
          url: "{{ URL::to('user/notificaciones') }}",
          type: 'GET',
          success: function(data){
            if ( JSON.stringify(notificaciones) === JSON.stringify(data)   ) {
                // Sin cambios
            }
            else{
              // Cambio la data
              notificaciones = data;
              console.log(notificaciones);
              cambiarMensajes();
            }
            // Intervalo de la llamada
            setTimeout(getNotificaciones, 30000);
          },
          error: function(data){
            console.log("error");
            setTimeout(getNotificaciones, 30000);
          }
      });
    }

    function cambiarMensajes(){
      var replaceHTML = '';
      // Cambia la cantidad de notificaciones
      $('.cant-msj').replaceWith(  notificaciones.length );
      // Genera el html de cada notification
      $.each( notificaciones, function( i, item ) {
        var urlAviso = "{{ URL::to('avisos') }}/" + item.id + "/edit";
        var hora = "";
        var template = '<li><div class="col-md-3 col-sm-3 col-xs-3"><div class="notify-img"><img src="http://placehold.it/45x45" alt=""></div></div><div class="col-md-9 col-sm-9 col-xs-9 pd-l0">El aviso: ' + item.titulo + ' necesita edición por:<br>'+ item.comentario +'<br><a href="' + urlAviso + '">Editar Aviso</a><hr><p class="time">' + hora + '</p></div></li>';
        replaceHTML += template;
      });
      // Reemplaza el contenido del dropdown
      $('.drop-content').html( replaceHTML );
    }
</script>

    @yield('javascript1')
    @yield('javascript2')
</body>
<footer>
<div class="navbar navbar-default navbar-fixed-bottom">
   <div class="container">
     <p class="navbar-text pull-left">© 2017 - PetSell Chile ltda.</p>

     <a href="#" class="navbar-btn btn-primary btn pull-right">
     <span class="fa fa-facebook-official"></span>  Siguenos en Facebook</a>
   </div>
</footer>
</html>
