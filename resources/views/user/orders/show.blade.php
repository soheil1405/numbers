@extends('user.dashboard.master')




@section('headers')
@endsection


@section('title')
    سفارش-{{ $order->id }}
@endsection

@section('content')
    <div class="col-md-6 m-auto" style="border: 1px solid gray; padding:15px;">


        <form id="orderSubmit" action="{{ route('user.payment.pay') }}" method="post">

            @csrf

            <label for="">
                نام شرکت/شخص : {{ $order->componyOrUserName }}
            </label>


            <hr>


            <label for="">
                @if ($order->searchType != 'increaseCredit')
                    نوع آنالیزگر : {{ $order->searchType }}
                @else
                    افزایش حساب کاربری
                @endif
            </label>
            <hr>


            <label for="">
                مبلغ قابل پرداخت : {{ $order->totalAmount }}
            </label>
            ریال

            <hr>

            <a href="{{ route('user.orders.index') }}" class="btn btn-secondary">بازگشت</a>


            <span onclick="confirmForm()" class="btn btn-success">
                تایید و پرداخت
            </span>



        </form>
        @if (
            $order->resultCount == 1 &&
                $order->searchType != 'increaseCredit' &&
                Auth::user()[$order->searchType . 'CreditCount'] > 0)
            <form action="{{ route('user.payment.payFromCredit') }}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{ $order->id }}">
                <input class="btn btn-primary" type="submit" value="پرداخت از طریق کیف پول">
            </form>
        @endif
    </div>
@endsection


<script>
    function confirmForm() {


        var r = confirm("آیا از اطلاعات وارد شده اطمینان دارید؟");

        if (r == true) {

            $('#orderSubmit').submit();
        }
    }
</script>
