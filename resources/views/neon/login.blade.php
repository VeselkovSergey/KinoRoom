@extends('neon.layouts.app')

@section('content')

    <div class="flex-center" style="min-height: inherit;">
        <div class="flex-column-center border-radius-20 w-100" style="box-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472; padding: 60px;">
            <div class="mb-60 color-white neon-text" style="font-size: 50px;">ВХОД</div>
            <div class="w-40">
                <input name="login" type="text" placeholder="ЛОГИН" class="text-center mb-60">
            </div>
            <div class="w-40">
                <input name="password" type="password" placeholder="ПАРОЛЬ" class="text-center mb-60">
            </div>
            <div class="flex">
                <div class="mr-10">
                    <button class="red-button-with-animate" onclick="login()">ВОЙТИ</button>
                </div>
                <div>
                    <a class="red-button-with-animate" href="{{route('registration')}}">РЕГИСТРАЦИЯ</a>
                </div>
            </div>
        </div>
    </div>

    <script>

        function login() {

            if (document.body.querySelector('input[name="login"]').value.length < 3 || document.body.querySelector('input[name="password"]').value.length < 3) {
                return alert('Укажите логин и/или пароль!');
            }

            fetch("{{route('login')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({
                    login: document.body.querySelector('input[name="login"]').value,
                    password: document.body.querySelector('input[name="password"]').value,
                }),
            })
                .then((response) => {
                    if (response.status === 200) {
                        location.href = "{{route('home')}}";
                    } else {
                        alert('Ошибка авторизации!');
                    }
                });
        }

    </script>

@endsection