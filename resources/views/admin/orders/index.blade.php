@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    لیست پرداخت ها
@endsection

@section('content')
    <div class="row">
        <div class="headback rounded">
            <h4 class="text-center iransansultralight">

                لیست پرداخت ها
                ({{ count($payments) }})



                <form action="{{ route('adminn.setting.editPay') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="iransansultralight">مبلغ هر سوال</label>
                        <input type="text" name="pay" value="{{ $setting->pay }}" id="" class="iransanslight">
                        ريال
                        <input class="btn btn-info" type="submit" value="تغییر مبلغ">
                    </div>
                </form>
            </h4>

            <p>تعداد پرداخت های امروز : {{ $todaysCount }}
            </p>
            <p>مبلغ کل پرداخت شده در امروز : {{ $todasyPay }} ریال
            </p>
            <p>تعداد سوالات خریداری شده در امروز : {{ $todaysBuys }}
            </p>
            <hr>

            <p>تعداد کل پرداخت ها تا کنون : {{ $allpaysCount }}
            </p>
            <p>مبلغ کل پرداخت شده تا کنون : {{ $allpays }} ریال
            </p>
            <p>تعداد کل سوالات خریداری شده تا کنون : {{ $allBuys }}
            </p>




        </div>
    </div>
    <div class="headback rounded ">
        <div class="row bg-white rounded">

            <div class="col-md-12 divmain p-5">
                <div class="row">
                    <table class="table table-bordered text-center table-striped  ">
                        <thead>

                            <th>
                                شناسه پرداخت
                            </th>

                            <th>
                                نام کاربری
                            </th>
                            <th>
                                تاریخ پرداخت
                            </th>
                            <th>
                                تعداد
                            </th>
                            <th>
                                مبلغ کل
                            </th>
                            <th>
                                کد پرداخت
                            </th>
                            <th>
                                وضعیت
                            </th>

                        </thead>

                        <tbody>

                            @foreach ($payments as $payment)
                                <tr>

                                    <th>

                                        {{ $payment->id }}

                                    </th>

                                    <th>

                                        <a href="{{ route('adminn.users.show', ['user' => $payment->users]) }}">

                                            {{ $payment->users->firstname }} - {{ $payment->users->lastname }}

                                        </a>

                                    </th>

                                    <th>
                                        {{ $payment->created_at }}
                                    </th>

                                    <th>

                                        {{ $payment->PaymentCount }}
                                    </th>
                                    <th>
                                        {{ $payment->totalAmount }}
                                    </th>

                                    <th>

                                        @if ($payment->order)
                                            {{ $payment->order->ref_id }}
                                        @endif


                                    </th>

                                    <th>

                                        @if ($payment->order && $payment->order->status == 100)
                                            <span class="btn btn-success">موفق</span>
                                        @else
                                            <span class="btn btn-danger">ناموفق</span>
                                        @endif

                                    </th>

                                </tr>
                            @endforeach
                        </tbody>









                    </table>
                </div>
            </div>
        </div>

    </div>
@endsection
