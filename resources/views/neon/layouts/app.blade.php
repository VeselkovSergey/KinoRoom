<!DOCTYPE html>
<html lang="ru-RU">
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

        video {
            width: 100%;
        }

        main {
            min-height: calc(100vh - 126px);
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

    <style>
        .loader {
            width: 100%;
            height: 100%;
        }
        .lds-ring {
            /*
              <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
              */
            /*display: inline-block;*/
            /*position: relative;*/
            /*width: 80px;*/
            /*height: 80px;*/
            background-color: rgba(0, 0, 0, 0.8);
            /*position: fixed;*/
            /*z-index: 10000;*/
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            /*height: 100vh;*/
            height: 100%;
        }
        .lds-ring div {
            box-sizing: border-box;
            display: block;
            position: absolute;
            width: 64px;
            height: 64px;
            margin: 8px;
            border: 8px solid;
            border-radius: 50%;
            animation: lds-ring 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
            border-color: #fff transparent transparent transparent;
        }
        .lds-ring div:nth-child(1) {
            animation-delay: -0.45s;
        }
        .lds-ring div:nth-child(2) {
            animation-delay: -0.3s;
        }
        .lds-ring div:nth-child(3) {
            animation-delay: -0.15s;
        }
        @keyframes lds-ring {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }
        /* rings */
        .lds-spinner {
            /*
              <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
              */
            /*display: inline-block;*/
            /*position: relative;*/
            /*width: 80px;*/
            /*height: 80px;*/
            background-color: rgba(0, 0, 0, 0.8);
            position: fixed;
            z-index: 10000;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        .lds-spinner div {
            transform-origin: 40px 40px;
            animation: lds-spinner 1.2s linear infinite;
        }
        .lds-spinner div:after {
            content: " ";
            display: block;
            position: absolute;
            top: 3px;
            left: 37px;
            width: 6px;
            height: 18px;
            border-radius: 20%;
            background: #fff;
        }
        .lds-spinner div:nth-child(1) {
            transform: rotate(0deg);
            animation-delay: -1.1s;
        }
        .lds-spinner div:nth-child(2) {
            transform: rotate(30deg);
            animation-delay: -1s;
        }
        .lds-spinner div:nth-child(3) {
            transform: rotate(60deg);
            animation-delay: -0.9s;
        }
        .lds-spinner div:nth-child(4) {
            transform: rotate(90deg);
            animation-delay: -0.8s;
        }
        .lds-spinner div:nth-child(5) {
            transform: rotate(120deg);
            animation-delay: -0.7s;
        }
        .lds-spinner div:nth-child(6) {
            transform: rotate(150deg);
            animation-delay: -0.6s;
        }
        .lds-spinner div:nth-child(7) {
            transform: rotate(180deg);
            animation-delay: -0.5s;
        }
        .lds-spinner div:nth-child(8) {
            transform: rotate(210deg);
            animation-delay: -0.4s;
        }
        .lds-spinner div:nth-child(9) {
            transform: rotate(240deg);
            animation-delay: -0.3s;
        }
        .lds-spinner div:nth-child(10) {
            transform: rotate(270deg);
            animation-delay: -0.2s;
        }
        .lds-spinner div:nth-child(11) {
            transform: rotate(300deg);
            animation-delay: -0.1s;
        }
        .lds-spinner div:nth-child(12) {
            transform: rotate(330deg);
            animation-delay: 0s;
        }
        @keyframes lds-spinner {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }
    </style>

    <script>
        function LoaderShow(parent = null) {
            let loader = document.createElement("div");
            loader.className = 'loader';
            loader.innerHTML = '<div class="lds-ring"><div></div><div></div><div></div><div></div></div>';
            parent ? parent.append(loader) : document.body.prepend(loader);
        }

        function LoaderHide() {
            const loader = document.body.querySelector('.loader');
            if (loader) {
                loader.remove();
            }
        }
    </script>
</head>
<body>

    @include('neon.layouts.header')

    <main>
        @yield('content')
    </main>

    @include('neon.layouts.footer')
</body>
</html>
