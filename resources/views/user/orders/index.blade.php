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



        <div class="row " style="justify-content: space-around">

            <div
                class="alert  col-md-2
            @if (Auth::user()->s1CreditCount == 0) alert-danger @else alert-success @endif
                
                ">
                <small class="text-center">
                    <small>

                        موجودی موتور آنالیز اول
                        :
                    </small>
                    {{ Auth::user()->s1CreditCount }}
                </small>
            </div>


            <div
                class="alert  col-md-2
            @if (Auth::user()->s2CreditCount == 0) alert-danger @else alert-success @endif
                
                ">
                <small class="text-center">
                    <small>
                        موجودی موتور آنالیز دوم

                        :
                    </small>
                    {{ Auth::user()->s2CreditCount }}
                </small>
            </div>

            <div
                class="alert  col-md-2
            @if (Auth::user()->s3CreditCount == 0) alert-danger @else alert-success @endif
                
                ">
                <small class="text-center">
                    <small>

                        موجودی موتور آنالیز سوم
                        :
                    </small>
                    {{ Auth::user()->s3CreditCount }}
                </small>
            </div>

            <div
                class="alert  col-md-2
            @if (Auth::user()->s4CreditCount == 0) alert-danger @else alert-success @endif
                
                ">
                <small class="text-center">

                    <small>موجودی موتور آنالیز چهارم
                        :</small>

                    {{ Auth::user()->s4CreditCount }}
                </small>
            </div>

        </div>


        <form action="{{ route('user.payment.increaseCredit') }}" method="post">
            @csrf
            <div class="d-flex">

                <div class="" style="display:flex; width:100%;">

                    <input required type="number" class="form-control" style="width: 20%;"  style="" name="pay" min="2"
                        id="">عدد

                        <input class="btn btn-success" type="submit" value="افزایش موحودی">
                    <small>
                        قیمت هر شارژحساب کاربری ({{ $setting->searchEnginOncePay }})تومان
                    </small>

                </div>

            </div>


        </form>


        @if (Auth::user()->isIncustomerClub == 3)

        <div class="alert alert-success">

            شما عضو باشگاه مشتریان هستید  &#x1F60D;

            <a href="{{route('user.customerClub')}}">مزایای عضویت در باشگاه مشتریان</a>

        </div>
        
        @else

        <div class="alert alert-danger">
            درصورتی که شما 3 آنالیز دیگر در سایت انجام دهید ، عضو باشگاه مشتریان خواهید شد
            
            
            <a href="{{route('user.customerClub')}}">مزایای عضویت در باشگاه مشتریان</a>
        </div>
        @endif


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
                    پرداخت کننده
                </th>

                <th>
                    نوع موتور جستجو
                </th>
                <th>
                    وضعیت
                </th>


            </thead>

            <tbody>

                @foreach ($orders as $order)
                    <tr>
                        <td>
                            {{ $order->id }}
                        </td>

                        <td>
                            {{ miladiToShamsi($order->created_at) }}
                        </td>

                        <td>
                            {{ $order->resultCount }}
                        </td>

                        <td>
                            {{ $order->totalAmount }}
                        </td>

                        <td>
                            {{ $order->componyOrUserName }}
                        </td>


                        <td>
                            {{ $order->searchType }}
                        </td>

                        <td>
                            @if ($order->payment && $order->payment->status == (100 || 101))
                                <a href="{{ route('user.search.show', ['id' => $order->id]) }}"
                                    class="btn btn-success">موفق</a>
                            @else
                                <span class="btn btn-danger">ناموفق</span>
                            @endif
                        </td>

                        <td>
                            {{ $order->ref_id }}
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
@endsection
