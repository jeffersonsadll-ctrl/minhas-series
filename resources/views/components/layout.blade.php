<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $titleProcessada ?? '' }}</title>
        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="bg-light">
        <main class="container py-4">
            <h1 class="mb-4">{{ $titleProcessada ?? '' }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{ $slot }}
        </main>

    </body>
</html>