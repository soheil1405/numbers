<!DOCTYPE html>
<html lang="en">

<head>


    @yield('headers')


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{ asset('/asset/jquery.js') }}"></script>
    {{-- <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="{{ asset('asset/datepicker/datepicker.css') }}">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/main/css/responsive.css') }}" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    @include('admin.style.scripts')


    <title>bet Math | @yield('title')</title>
</head>
<style>
    body {
        background-image: url({{ asset('/asset/images/admin/pngtree-math-.jpg') }});

        background-size: cover;
    }

    .navbar-nav {
        float: right !important;
    }
</style>

<body dir="rtl">

    <nav class="navbar navbar-inverse  ">
        <div class="container-fluid">
            <div class="navbar-header ">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>
            <div class="collapse navbar-collapse  " id="myNavbar">
                <ul class="nav navbar-nav justify-content-center ">



                    <li><a href="{{ route('adminn.panel') }}">داشبرد </a></li>
                    <li><a href="{{ route('adminn.names.index') }}">مدیریت اسم ها</a></li>

                    <li><a href="{{ route('adminn.users.index') }}">مدیریت کاربران </a></li>


                    <li><a href="{{ route('adminn.orders.index') }}">تاریخچه پرداخت ها</a></li>
                    <li><a href="{{ route('adminn.setting.index') }}"> تنظیمات سایت</a></li>
                    <li><a href="{{ route('adminn.setting.s1') }}"> تنظیمات موتور جستجوی اول</a></li>
                    <li><a href="{{ route('adminn.setting.s2') }}"> تنظیمات موتور جستجوی دوم</a></li>
                    <li><a href="{{ route('adminn.setting.s3') }}"> تنظیمات موتور جستجوی سوم</a></li>
                    <li><a href="{{ route('adminn.setting.s4') }}"> تنظیمات موتور جستجوی چهارم</a></li>

                    <li><a href="{{ route('logout') }}">خروج</a></li>

                </ul>
            </div>
        </div>
    </nav>
    <div class="container">


        @include('components.CommonInBoth.alerts')


        <div class="container-fluid background-math">

            <div class="headback rounded">

                @yield('content')
            </div>
        </div>
    </div>
</body>

</html>



{{-- <script src="{{ asset('asset/datepicker/persiandate.js') }}"></script>
<script src="{{ asset('asset/datepicker/datepicker.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $(".example1").pDatepicker({
            autoClose: true,
            onSelect: function(unix) {
                // console.log('datepicker select : ' + unix);
                var day = new persianDate(unix).toDate();
                // console.log('day :' + day);
                var standard = new Date(day).toISOString();

                $('#date').val(standard);

                console.log($('#date').val());

            }
        });

        //     $(".example2").pDatepicker({
        //         autoClose: true,
        //         onSelect: function(unix) {
        //             // console.log('datepicker select : ' + unix);
        //             var day = new persianDate(unix).toDate();
        //             // console.log('day :' + day);
        //             var standard =  new Date(day).toISOString();


        //    $('#fromDate').val(standard);
        //         }
        //     });

    });
</script> --}}
