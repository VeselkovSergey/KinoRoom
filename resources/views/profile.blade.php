@extends('layouts.app')

@section('content')

    <style>
        .font-size-20 {
            font-size: 20px;
        }
    </style>

    <div class="flex-center bg-black" style="min-height: inherit;">
        <div class="flex-column-center border-radius-20 w-100" style="border: 2px solid darkred; padding: 60px;">
            <div class="mb-60 color-white" style="font-size: 50px;">ПРОФИЛЬ</div>
            <div class="color-white flex-column-center font-size-20">
                <div class="mb-60">Дата оформления подписки: "{{auth()->user()->subscription_start_date}}"</div>
                <div class="mb-60 @if(!auth()->user()->checkSubscription()) color-red @endif">Истечение срока подписки: "{{auth()->user()->subscription_end_date}}"</div>
            </div>
            <div>
                <a class="red-button-with-animate" href="{{route('subscription')}}">ОФОРМИТЬ</a>
            </div>
        </div>
    </div>

@endsection