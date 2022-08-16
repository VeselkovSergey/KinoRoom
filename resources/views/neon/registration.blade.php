@extends('neon.layouts.app')

@section('content')

    <div class="flex-center" style="min-height: inherit;">
        <div class="flex-column-center border-radius-20 w-100" style="box-shadow: 0 0 1em #338fee, 0 0 0.5em #b625c5, 0 0 0.1em #300472; padding: 60px;">
            <div class="mb-60 color-white neon-text" style="font-size: 50px;">РЕГИСТРАЦИЯ</div>
            <div class="w-40">
                <input type="text" placeholder="ЛОГИН" class="text-center mb-60">
            </div>
            <div class="w-40">
                <input type="password" placeholder="ПАРОЛЬ" class="text-center mb-60">
            </div>
            <div class="w-40">
                <input type="password" placeholder="ПОВТОРИТЕ ПАРОЛЬ" class="text-center mb-60">
            </div>
            <div>
                <button class="red-button-with-animate">ЗАРЕГИСТРИРОВАТЬСЯ</button>
            </div>
        </div>
    </div>

@endsection