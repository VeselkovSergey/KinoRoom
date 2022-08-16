<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>NeonFilms</title>

    <link href="{{asset('assets/styles/helpers.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('assets/img/logo.png')}}" type="image/x-icon">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        button {
            border: unset;
        }

        input {
            width: 100%;
            padding: 15px 20px;
            border: unset;
            outline: unset;
            border-radius: 5px;
        }

        input:focus {
            outline: 2px solid #e73737;
        }

        body {
            background-color: black;
        }

        img {
            width: 100%;
            height: 100%;
        }

        main {
            min-height: calc(100vh - 60px);
            max-width: 1440px;
            margin: auto;
        }

    </style>

    <style>
        .red-button-with-animate {
            padding: 20px;
            border-radius: 5px;
            font-size: 20px;
            letter-spacing: 3px;
            font-weight: 600;
            color: #524f4e;
            background: white;
            box-shadow: 0 8px 15px rgb(0 0 0 / 25%);
            transition: .3s;
            cursor: pointer;
            min-width: 350px;

            display: inline-block;
            text-align: center;
            text-decoration: unset;

            width: 220px;
            border: solid 1px #4950b0;
            outline: none;
            color: #fff;
            background: #111;
            cursor: pointer;
            position: relative;
            z-index: 0;
            border-radius: 10px;
            box-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
            text-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
        }

        .red-button-with-animate:before {
            content: '';
            background: linear-gradient(45deg,#00f6ff, #0ab4ff, #007dc9, #0039ff, #3804ca, #8d6ce8, #d800ff, #ff00c8, #f3e5f5);
            position: absolute;
            top: -2px;
            left: -2px;
            background-size: 400%;
            z-index: -1;
            filter: blur(5px);
            width: calc(100% + 4px);
            height: calc(100% + 4px);
            animation: glowing 20s linear infinite;
            opacity: 0;
            transition: opacity .3s ease-in-out;
            border-radius: 10px;
        }

        .red-button-with-animate:after {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #111;
            left: 0;
            top: 0;
            border-radius: 10px;
        }

        .red-button-with-animate:active {
            color: #000
        }

        .red-button-with-animate:active:after {
            background: transparent;
        }

        .red-button-with-animate:hover:before {
            opacity: 1;
        }

        .red-button-with-animate:after {
            z-index: -1;
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            background: #111;
            left: 0;
            top: 0;
            border-radius: 10px;
        }

        @keyframes glowing {
            0% { background-position: 0 0; }
            50% { background-position: 400% 0; }
            100% { background-position: 0 0; }
        }

        /*.red-button-with-animate:hover {*/
        /*    background: #e73737;*/
        /*    box-shadow: 0 15px 20px rgb(229 46 95 / 40%);*/
        /*    color: white;*/
        /*    transform: translateY(-7px);*/
        /*}*/

        button a {
            text-decoration: unset;
            color: inherit;
        }
        body {
            background-image: url("{{asset('neon/assets/img/bg.png')}}");
            background-size: cover;
            background-attachment: fixed;
        }
        input {
            box-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
        }
        .neon-text {
            text-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472;
        }
    </style>
</head>
<body>

    @include('neon.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('neon.layouts.footer')
</body>
</html>
