<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Elderly Care</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html {
                background: url(../img/care.jpg?) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            body {

                color: #363636;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            body::before {
                content: "";
                display: block;
                position: absolute;
                z-index: -1;
                width: 100%;
                height: 100%;
                background: #878f81;
                opacity: .5;
            }

            .full-height {
                height: 100vh;
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
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                width: 100%;
        
            }
            .title {
            width: 100%;
            -webkit-text-stroke: 2px #ffffff;
            background-color: rgba(229, 241, 229, 0.5);
            padding-top: 10px;
            padding-bottom: 3px;
        }

        .title::before {
            content: "";
            display: block;
            position: absolute;
            z-index: -2;

            height: 12vw;
            background: #494d4e;
            opacity: .5;
        }

      

            .links>a {
                color: #f7eded;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/dashboard') }}">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img style="width:70vw" src="{{ asset('dist/img/banner.png') }}"  title="Elderly CARE" Alt="Elderly CARE" />
                </div>

            </div>
        </div>
    </body>
</html>
