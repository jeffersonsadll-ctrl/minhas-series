<html>
    <head>
        <title>{{ $titleProcessada ?? '' }}</title>
    </head>
    <body>
        <h1>{{ $titleProcessada ?? '' }}</h1>
        
        {{ $slot }}

    </body>
</html>