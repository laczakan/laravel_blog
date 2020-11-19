<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title') - Blog v7</title>

        <!-- Bootstrap core CSS -->
        <link href="{{ url('css/bootstrap.min.css')  }}" rel="stylesheet"
              integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <!-- Favicons -->
        <meta name="theme-color" content="#563d7c">
        <!-- Custom styles for this template -->
        <link href="{{ url('css/style.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('css/ekko-lightbox.css') }}"/>
    </head>

    <body>

        @include('partials.header')
            <main role="main" class="flex-shrink-0">
                <div class="container">
                    @include('partials.messages')
                    @yield('content')
                </div>
            </main>
        @include('partials.footer')

        <script src="{{ url('js/jquery-3.5.1.slim.min.js') }}"
                integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
                crossorigin="anonymous"></script>
        <script src="{{ url('js/bootstrap.bundle.min.js') }}"
                integrity="sha384-1CmrxMRARb6aLqgBO7yyAxTOQE2AKb9GfXnEo760AUcUmFx3ibVJJAzGytlQcNXd"
                crossorigin="anonymous"></script>
        <script src="{{ url('js/ekko-lightbox.js') }}"></script>
        <script src="{{ url('js/script.js') }}"></script>
    </body>
</html>
