<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>@yield('title')-TecnoMuebles</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ url('/static/css/admin.css?v' . time()) }}">

    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
    </script>

    <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>

    <script src="{{ url('/static/js/admin.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()




        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="col1">@include('produccion.sidebar')</div>
        <div class="col2"></div>
        <nav class="navbar navbar-expand-lg shadow">
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav">
                    <liv class="nav item">
                        <a href="{{ url('/produccion') }}" class="nav-link"><i class="fas fa-home"></i>Dashboard</a>

                    </liv>
                </ul>
            </div>
        </nav>
        <div class="page">

            <div class="container-fluid">
                <nav aria-label="breadcrumb shadow">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/produccion') }}"><i class="fas fa-home"></i>Dashboard </a>
                        </li>
                        @section('breadcrumb')
                        @show
                    </ol>
                </nav>
            </div>

            @if (Session::has('message'))
                <div class="container">
                    <div class="alert alert-{{ Session::get('typealert') }}" style="display: none;">
                        {{ Session::get('message') }}
                        @if (count($errors) > 0)
                            <ul>
                                @foreach ($errors->all() as $error)


                                    <li>
                                        {{ $error }}

                                    </li>

                                @endforeach
                            </ul>
                        @endif
                        <script>
                            $('.alert').slideDown();
                            setTimeout(function() {
                                $('.alert').slideDown();
                            }, 10000);
                        </script>

                    </div>
                </div>
            @endif

            @section('content')
            @show

        </div>
    </div>

</body>

</html>
