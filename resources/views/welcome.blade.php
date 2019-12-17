<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
               /* min-height:100%;box-sizing:border-box;min-width:1366px !important;*/
            }

            .full-height {
                height: 40vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                margin-top: 50px;
                position: absolute;
                align-content: center;
                top: 18px;
                height:70px;


            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                border: 1px solid #ffffff;

                background-color: #a4aaae;
                padding: 0 75px;
                font-size: 22px;
                font-weight: 600;
                letter-spacing: .2rem;
                text-decoration: none;
                text-transform: uppercase;
                color: #1c6d3a;
                border-radius: 5px;
                border-color:#a0dd9f;
                text-shadow: -1px 0 white, 0 1px white, 1px 0 white, 0 -1px white;

            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .welcome
            {
                margin-left:auto;
                margin-right: auto;
                margin-top: 10px;
                font: bold  110% serif;
                font-size: 350%;
                background-color: darkgrey;
                border-radius: 40px  40px 10px 10px;
                color: #a0dd9f;
                text-shadow: -1px 0 green, 0 1px black, 1px 0 black, 0 -1px #5e5e5d;

            }
            .info
            {
                font-stretch: ultra-expanded;
                padding: 20px;
                text-align: center;
                font:  100% serif;
                background-color:#a0dd9f;
                font-size: 28px;
                margin-left:auto;
                margin-right: auto;
                border-radius: 0 0 50px 50px;
                color:#565e59;
                text-shadow: -1px 0 #444444, 0 1px #444444, 1px 0 #444444, 0 -1px #444444;
                border-bottom-width: 3px; /* Толщина линии внизу */
                border-bottom-style: solid; /* Стиль линии внизу */
                border-bottom-color: darkgrey; /* Цвет линии внизу */
            }

            .content
            {
                padding-top: 30px;
                background-image: url({{url("img/back2.png")}});

            }


        </style>
    </head>
    <body>
<div>
            <div class="content">
                <img src="{{asset('img/pic2.png')}}" alt="profile Pic" height="250" width="250">
            <div class="welcome">Вітаємо на сторінці</div>

                <div class="info">Для заповнення заяви зареєструйтеся або авторизуйтеся.</div>

                <div class="content2">
                <div class="flex-center position-ref full-height">
                    @if (Route::has('login'))
                        <div class="top-right links">
                            @auth
                                @if(Auth::user()->role = "admin")
                                    <a href="{{ url('admin/home') }}">Home</a>
                                @elseif(Auth::user()->role = "users")
                                <a href="{{ url('/home') }}">Home</a>
                                    @endif
                            @else

                                <a href="{{ route('login') }}">Авторизація</a>
                                <a href="{{ route('register') }}">Реєстрація</a>

                            @endauth
                        </div>
                    @endif

                </div>
        </div>
                <div>

    </body>
</html>
