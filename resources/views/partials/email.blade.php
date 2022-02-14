<!DOCTYPE html>
<html lang="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{__('Registro')}}</title>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            @if(isset($error))
                Error al guardar<br>
                @if(is_array($error))
                    @foreach($error as $camp => $text)
                        {{$camp.": ".$text}}<br>
                    @endforeach
                @endif
            @elseif(isset($user) && isset($password))
                Usuario: {{$user}}
                Contraseña: {{$password}}
            @endif
        </div>
    </body>
</html>
