<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet">
</head>

<body style="margen: 0px; padding: 0px; background-color: #f3f3f3">
    <div style="
    display: block;
    max-width: 728px;
    margin: 0px auto;
    width: 60%">
        <img src="{{ url('/static/images/logo.png') }}" style="width: 100%; display: block">
        <div style="background-color: #fff;
        padding: 24px;">
            @yield('content')
            <div class="social" style="margin-top: 16px">
                <p> <strong>Encúentranos en nuestras redes sociales</strong></p>
                @if (config('localhost.social_facebook') != '')
                    <a href="{{ config('localhost.social_facebook') }}" target="_blank"
                        style="display: inline-block; margin-right: 6px;">
                        <img src="{{ url('static/images/facebook.png') }}" style="width: 36px;">
                    </a>
                @endif
                @if (config('localhost.social_instagram') != '')
                    <a href="{{ config('localhost.social_instagram') }}" target="_blank"
                        style="display: inline-block; margin-right: 6px;">
                        <img src="{{ url('static/images/instagram.png') }}" style="width: 36px;">
                    </a>
                @endif
                @if (config('localhost.social_youtube') != '')
                    <a href="{{ config('localhost.social_youtube') }}" target="_blank"
                        style="display: inline-block; margin-right: 6px;">
                        <img src="{{ url('static/images/youtube.png') }}" style="width: 36px;">
                    </a>
                @endif
                @if (config('localhost.social_twitter') != '')
                    <a href="{{ config('localhost.social_twitter') }}" target="_blank"
                        style="display: inline-block; margin-right: 6px;">
                        <img src="{{ url('static/images/twitter.png') }}" style="width: 36px;">
                    </a>
                @endif
                @if (config('localhost.social_whatsapp') != '')
                    <a href="{{ config('localhost.social_whatsapp') }}" target="_blank"
                        style="display: inline-block; margin-right: 6px;">
                        <img src="{{ url('static/images/whatsapp.png') }}" style="width: 36px;">
                    </a>
                @endif
<hr>
            <div class="load_more_products">
         
                <a href="{{url('/store')}}">Regresar a la tienda</a>
             </div>


            </div>

        </div>


    </div>
</body>

</html>
