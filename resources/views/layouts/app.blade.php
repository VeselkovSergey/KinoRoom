<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>KinoRoom</title>

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
            background-color: whitesmoke;
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
        }

        .red-button-with-animate:hover {
            background: #e73737;
            box-shadow: 0 15px 20px rgb(229 46 95 / 40%);
            color: white;
            transform: translateY(-7px);
        }

        button a {
            text-decoration: unset;
            color: inherit;
        }
    </style>
</head>
<body>

    @include('layouts.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.footer')
</body>
</html>
