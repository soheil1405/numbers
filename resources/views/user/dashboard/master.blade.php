<!DOCTYPE html>
<html lang="en">

<head>
    @yield('headers')
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('/asset/bootstrap/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/asset/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <link href="{{ asset('/asset/main/css/style.css') }}" rel="stylesheet">

    <script src="{{ asset('/asset/jquery.js') }}"></script>



    <title>موتور  آنالیزگر اول | @yield('title')</title>


</head>

<body dir="rtl">


    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0  ">

                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.search.s1') }}"> موتور  آنالیزگر اول</a>
                    </li>

                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.search.s2') }}"> موتور  آنالیزگر دوم</a>
                    </li>

                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.search.s3') }}"> موتور  آنالیزگر سوم</a>
                    </li>

                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.search.s4') }}"> موتور  آنالیزگر چهارم</a>
                    </li>


                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.history') }}">تاریخچه جستجو</a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('user.orders.index') }}">تاریخچه پرداخت ها</a>
                    </li>
                    <li class="nav-item iransansmedium">
                        <a class="nav-link" href="{{ route('logout') }}">خروج</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>





    @if (Session::has('CustomError'))
        <div class="alert alert-success">
            {{ Session::get('CustomError') }}
        </div>
    @endif
    </div>

    <div class="container">

        @if ($errors->any())

            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endforeach

        @endif

        <div class="container-fluid background-math">
            <div class="headback rounded">


                @yield('content')
            </div>
        </div>
    </div>
</body>



<script src="{{ asset('/asset/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/asset/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</html>
