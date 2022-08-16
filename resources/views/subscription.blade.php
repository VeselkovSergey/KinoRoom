@extends('layouts.app')

@section('content')

    <style>
        input[type="radio"]:checked.subscription-button + span {
            background-color: darkred;
        }

        .subscription-buttons-container span {
            padding: 5px 20px;
        }

        .subscription-buttons-container label > span {
            border: 1px solid darkred;
            border-radius: 10px;
            cursor: pointer;
            width: 100%;
            display: inline-block;
            text-align: center;
            padding: 20px;
        }

        .subscription-buttons-container input {
            display: none;
        }
    </style>


    <div class="flex-center bg-black" style="min-height: inherit;">
        <div class="flex-column-center border-radius-20 w-100" style="border: 2px solid darkred; padding: 60px;">
            <div class="mb-60 color-white" style="font-size: 50px;">ПОДПИСКА</div>

            <div class="subscription-buttons-container flex-space-evenly mb-60 color-white w-80">
                <div class="w-33 flex-center">
                    <label for="type" class="w-100">
                        <input class="subscription-button" type="radio" checked name="type" id="type" data-type="30">
                        <span style="font-size: 25px">месяц: 100 ₽</span>
                    </label>
                </div>
                <div class="w-33 flex-center">
                    <label for="type1" class="w-100">
                        <input class="subscription-button" type="radio" name="type" id="type1" data-type="365">
                        <span style="font-size: 25px">год: 599 ₽</span>
                    </label>
                </div>
            </div>

            <div>
                <button class="payment-button red-button-with-animate">ОПЛАТИТЬ</button>
            </div>
        </div>
    </div>

    <script>
        document.body.querySelector('.payment-button').addEventListener('click', () => {
            const subscriptionType = document.body.querySelector('.subscription-buttons-container input:checked').dataset.type;
            fetch("{{route('subscription-request')}}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json;charset=utf-8',
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                body: JSON.stringify({
                    type: subscriptionType,
                }),
            })
                .then((response) => {
                    if (response.status === 200) {
                        location.href = "{{route('profile')}}";
                    } else {
                        alert('Ошибка оплаты!');
                    }
                });
        });
    </script>

@endsection