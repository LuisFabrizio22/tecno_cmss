<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <title>@yield('title')-TecnoMuebles</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="routeName" content="{{ Route::currentRouteName() }}">
    <meta name="currency" content="{{ Config::get('localhost.currency') }}">
    <meta name="auth" content="{{ Auth::check() }}">
    
    @yield('custom_meta')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <link rel="stylesheet" type="text/css" href="{{ url('/static/css/style.css?v' . time()) }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,500;1,700&display=swap"
        rel="stylesheet">
    <script src="https://kit.fontawesome.com/b0d8aefb17.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
   {{--  <script src="{{ url('/static/libs/ckeditor/ckeditor.js') }}"></script>  --}}
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="{{ url('/static/js/mdslider.js?v' . time()) }}"></script>
    <script src="{{ url('/static/js/site.js?v' . time()) }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip()
        });
    </script>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow">
        <div class="container">

            <a class="navbar-brand" href="{{ url('/') }}"><img src="/static/images/image4.png"></a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navigationMain"
                aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navigationMain">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link lk-home"><i class="fas fa-home"></i>
                            <span>Inicio</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/store') }}"
                            class="nav-link lk-store lk-store_category lk-product_single"><i
                                class="fas fa-store-alt"></i> <span>Tienda</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-id-card-alt"></i>
                            <span>Sobre Nosotros</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('/') }}" class="nav-link"><i class="fas fa-envelope-open"></i>
                            <span>Contacto</span></a>
                    </li>
                   
                    <li class="nav-item">
                        <a href="{{ url('/cart') }}" class="nav-link lk-cart"><i
                                class="fas fa-shopping-cart"></i><span class="carnumber"> 
                           
                                     
                              
                    
                            
                    </li>
               
                    @if (Auth::guest())

                        <li class="nav-item link-acc">
                            <a href="{{ url('/login') }}" class="nav-link btn"><i
                                    class="fas fa-fingerprint"></i>Ingresar</a>
                            <a href="{{ url('/register') }}" class="nav-link btn"><i
                                    class="far fa-user-circle"></i>Crear cuenta</a>
                        </li>
                    @else
                        <li class="nav-item link-acc link-user dropdown">
                            <a href="{{ url('/login') }}" class="nav-link btn dropdown-toggle" id="navbarDropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if (is_null(Auth::user()->avatar))
                                    <img src="{{ url('/static/images/avatar_default.png') }}">
                                @else
                                    <img src="{{ url('/uploads_users/' . Auth::id() . '/av_' . Auth::user()->avatar) }}"
                                        class="circle">
                                @endif
                                Hola: {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @if (Auth::user()->role == '1')
                                    <li> <a class="dropdown-item" href="{{ url('/admin') }}"><i
                                                class="fas fa-chalkboard-teacher"></i> Administración </a></li>
                                @endif
                                @if (Auth::user()->role == '2')
                                    <li> <a class="dropdown-item" href="{{ url('/admin/material') }}"><i
                                                class="fas fa-chalkboard-teacher"></i> Bodega </a></li>
                                @endif
                                @if (Auth::user()->role == '3')
                                    <li> <a class="dropdown-item" href="{{ url('/admin/production') }}"><i
                                                class="fas fa-chalkboard-teacher"></i> Producción </a></li>
                                @endif

                                 <li> <a class="dropdown-item" href="{{ url('/account/history/orders') }}"><i
                                            class="fas fa-history"></i> Historial de compras
                                    </a>
                                </li>
                                <li> <a class="dropdown-item" href="{{ url('/account/address') }}"><i
                                            class="fas fa-map-marker-alt"></i> Direcciones de entrega
                                    </a>
                                </li>
                                <li> <a class="dropdown-item" href="{{ url('/account/favorites') }}"><i
                                            class="fas fa-heart"></i> Favoritos
                                    </a>
                                </li>
                                <li> <a class="dropdown-item" href="{{ url('/account/edit') }}"><i
                                            class="fas fa-address-card"></i> Editar mi perfil
                                    </a></li>
                                <li> <a class="dropdown-item" href="{{ url('/logout') }}"><i
                                            class="fas fa-sign-out-alt"></i>Salir </a></li>


                            </ul>

                        </li>

                    @endif

                </ul>

            </div>
        </div>
    </nav>
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



    <div class="wrapper">
        <div class="container">
            @yield('content')


        </div>
    </div>

</body>

</html>
