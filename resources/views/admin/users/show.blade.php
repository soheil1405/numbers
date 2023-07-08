@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <div class="container-fluid background-math">
        <div class="headback rounded opacity-100">
            <div class="container">
                <div class="row">

                    <label for="" class="p-2">
                        اطلاعات کاربری :
                    </label>
                    <span>

                        آیدی کاربر
                    </span>

                    <span>

                        {{ $user->id }}
                    </span>
                    <div class="">
                        <span class="p-2">
                            نام
                        </span>

                        <span>
                            {{ $user->firstname }}
                        </span>

                    </div>
                    <div class="">
                        <span class="p-2">
                            نام خانوادگی
                        </span>

                        <span>
                            {{ $user->lastname }}
                        </span>

                    </div>
                    <div class="">
                        <span class="p-2">
                            شماره تلفن
                        </span>

                        <span>
                            {{ $user->mobile }}
                        </span>

                    </div>
                    <div class="">
                        <span class="p-2">

                            تعداد جستجو های انجام شده
                        </span>


                        <span>
                        </span>

                    </div>


                    <div class="">
                        <span class="p-2">
                            تاریخ عضویت در سایت
                        </span>


                        <span>
                            {{ $user->created_at }}
                        </span>

                    </div>
                    <div class="">
                        <span class="p-2">

                            کل مبلغ پرداخت شده در سایت :
                        </span>


                        <span>

                        </span>

                    </div>


                    <div class="">
                        <h4>تاریخچه جستجو های کاربر </h4>

                        
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
