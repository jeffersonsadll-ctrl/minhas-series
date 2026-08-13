<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        @vite(['resources/css/app.scss', 'resources/js/app.js'])
    </head>
    <body class="bg-light min-vh-100 d-flex align-items-center justify-content-center">
        <main class="w-100">
            <div class="container">
              @if( $mensagem = session('mensagem.sucesso') )
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="alert alert-success">
                            {{ $mensagem }}
                        </div>
                    </div>
                </div>
              @elseif( $errors->any() )
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
              @endif
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </body>
</html>
