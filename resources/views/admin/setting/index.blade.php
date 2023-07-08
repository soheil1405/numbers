@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    لیست پرداخت ها
@endsection

@section('content')
    <h4 class="text-center iransansultralight">


        تنظیمات سایت

    </h4>


    <div class="row">

        <div class="col-md-3">تعداد پرداخت های امروز : {{ $todaysCount }}
        </div>
        <div class="col-md-3">مبلغ کل پرداخت شده در امروز : {{ $todasyPay }} ریال
        </div>
        <div class="col-md-3">تعداد سوالات خریداری شده در امروز : {{ $todaysBuys }}
        </div>
    </div>

    <hr>
    <div class="row">


        <div class="col-md-3">تعداد کل پرداخت ها تا کنون : {{ $allpaysCount }}
        </div>
        <div class="col-md-3">مبلغ کل پرداخت شده تا کنون : {{ $allpays }} ریال
        </div>
        <div class="col-md-3">تعداد کل سوالات خریداری شده تا کنون : {{ $allBuys }}
        </div>

    </div>


    <form action="{{ route('adminn.setting.editPay') }}" method="post">
        @csrf

        <div class="row">

            <div class="form-group">
                <label for="" class="iransansultralight"> موتور جستجوی اول </label>
                <input type="text" name="pay" value="" id="" class="iransanslight">
                ريال
            </div>

            <div class="form-group">
                <label for="" class="iransansultralight"> موتور جستجوی دوم </label>
                <input type="text" name="pay" value="" id="" class="iransanslight">
                ريال
            </div>
            <div class="form-group">
                <label for="" class="iransansultralight"> موتور جستجوی سوم </label>
                <input type="text" name="pay" value="" id="" class="iransanslight">
                ريال
            </div>
            <div class="form-group">
                <label for="" class="iransansultralight"> موتور جستجوی چهارم </label>
                <input type="text" name="pay" value="" id="" class="iransanslight">
                ريال
            </div>
            <input class="btn btn-info" type="submit" value="تغییر مبلغ">
        </div>
    </form>
@endsection
