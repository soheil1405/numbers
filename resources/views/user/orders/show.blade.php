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
                نوع آنالیزگر : {{ $order->searchEnginType }}
            </label>
            <hr>

            <label for="">
                تعداد جسجتجو : {{ $order->resultCount }}
            </label>
            <hr>

            <label for="">
                مبلغ هر کدام :
                <br>
                برای اشخاص حقیقی
                (
                {{ $setting->searchEnginOncePay }}
                )
                ،
                برای ارگانها ،شرکت ها و سازمان ها
                (
                {{ $setting->searchEnginMoreThanOne }}
                )

                ریال


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
