@extends('user.dashboard.master')




@section('headers')
    <style>
        @import url(https://fonts.googleapis.com/css?family=Dosis:700);

        body {
            font-family: "Dosis", Helvetica, Arial, sans-serif;
            background: #ecf0f1;
            color: #34495e;

            text-shadow: white 1px 1px 1px;
        }

        .value {
            border-bottom: 4px dashed #bdc3c7;
            text-align: center;
            font-weight: bold;
            font-size: 10em;
            width: 300px;
            height: 100px;
            line-height: 60px;
            margin: 40px auto;
            letter-spacing: -0.07em;
            text-shadow: white 2px 2px 2px;
        }

        input[type="range"] {
            display: block;
            -webkit-appearance: none;
            background-color: #bdc3c7;
            width: 300px;
            height: 5px;
            border-radius: 5px;
            margin: 0 auto;
            outline: 0;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            background-color: #e74c3c;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: 2px solid white;
            cursor: pointer;
            transition: .3s ease-in-out;
        }

        ​ input[type="range"]::-webkit-slider-thumb:hover {
            background-color: white;
            border: 2px solid #e74c3c;
        }

        input[type="range"]::-webkit-slider-thumb:active {
            transform: scale(1.6);
        }
    </style>
    <script>
        var elem = document.querySelector('input[type="range"]');

        var rangeValue = function() {
            var newValue = elem.value;
            var target = document.querySelector('.value');
            target.innerHTML = newValue;
        }

        elem.addEventListener("input", rangeValue);
    </script>
@endsection


@section('title')
    افزایش اعتبار
@endsection

@section('content')
    <div class="container">




        @if (Session::has('PaymentSuccess'))
            <div class="alert alert-success">
                {{ Session::get('PaymentSuccess') }}
            </div>
        @endif



        @if (Session::has('PaymentFail'))
            <div class="alert alert-danger">
                {{ Session::get('PaymentFail') }}
            </div>
        @endif


        @if (Auth::user()->mojoodi == 0)
            <div class="alert alert-danger">
                <h3 class="text-center">موجودی حساب شما برای شرکت در مسابقات کافی نیست</ا>
            </div>
        @endif


        قیمت هر سوال {{ $QuestionPay->pay }}ریال


        <form method="POST" action="{{ route('payment.post') }}" class="btn btn-success mx-auto" >
            @csrf


        <input type="number" name="count" value="5" min="5" id="">


            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-lg"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z" />
            </svg><input type="submit" value="افزایش اعتبار">



        </form>


        <table class="table table-hover table-striped table-bordered text-center">
            <thead>

                <th>
                    کد سفارش
                </th>

                <th>
                    تاریخ
                </th>

                <th>
                    تعداد
                </th>

                <th>
                    مبلغ کل
                </th>
                <th>
                    وضعیت
                </th>


                <th>شماره رهگیری</th>

            </thead>

            <tbody>

                @foreach ($payments as $payment)
                    @if (!is_null($payment->order))
                        <tr>
                            <td>
                                {{ $payment->id }}
                            </td>
                            <td>
                                {{ $payment->updated_at }}
                            </td>
                            <td>
                                {{ $payment->PaymentCount }}
                            </td>
                            <td>
                                {{ $payment->totalAmount }}
                            </td>
                            <td>

                                @if ($payment->order && $payment->order->status == 100)
                                    <span class="btn btn-success">موفق</span>
                                @else
                                    <span class="btn btn-danger">ناموفق</span>
                                @endif


                            </td>
                            <td>


                                {{ $payment->order->ref_id }}

                            </td>
                        </tr>
                    @endif
                @endforeach

            </tbody>

        </table>
    </div>
@endsection
