<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME')}} - {{__("Login")}}</title>
    <link href='{{asset("css/bootstrap-4.6.0/bootstrap.css")}}' rel='stylesheet'>
    <link href='{{asset("css/fontawesome/css/fontawesome.css")}}' rel='stylesheet'>
    <link href='{{asset("css/public.css")}}' rel='stylesheet'>
</head>
<body>
@yield('content')
<footer class="footer" style="background-color: #0e1220">
    <div class="container">
        <span class="text-muted">© PAR Servicios Integrales S.A. Todos los derechos reservados 2021.</span>
    </div>
</footer>

<script type="text/javascript" src='{{asset('js/jquery/jquery.js')}}'></script>
<script type="text/javascript" src='{{asset('js/bootstrap-4.6.0/bootstrap.js')}}'></script>
</body>
</html>
