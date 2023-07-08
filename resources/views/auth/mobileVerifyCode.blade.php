@section('content')

    @extends('auth.authMaster')

@section('title')
    ورود
@endsection
@section('headers')
@endsection





@section('content')





    <div class="container-fluid p-0 ">
        <div class="container-fluid bg-admin">
            <div class="container">
                <div class="row">
                    <div class="nav pt-4 pb-4">




                        <div class="" style="display: flex; width:100% ; justify-content: space-around;">
                            {{-- <a href="{{ route('home') }}">صفحه اصلی</a> --}}
                            @if (Session::has('wellcome'))
                                {{ Session::get('wellcome') }}
                            @endif








                        </div>


                    </div>

                </div>

            </div>
        </div>
        <section class="container">

            <h1 class="text-center pt-4 h3">BET MATH</h1>
            <div class="row bg-white">
                <div class="col-md-6 h-400px divvorod mt-4 ">
                    <h2 class="h4">رمز ارسال شده را وارد کنید</h2>


                    <form action="{{ route('checkMobileVerify') }}" method="post">

                        @csrf

                        کد اعتبار سنجی برای شما ارسال شده است

                        <div class="m-2">

                            <input class="form-control" type="number" name="mobileVerifyCode"
                                value="{{ old('mobileVerifyCode') }}">
                            @if ($errors->has('mobileVerifyCode'))
                                <span class="text-danger">{{ $errors->first('mobileVerifyCode') }}</span>
                            @endif


                        </div>

                        @if (Session::has('customError'))
                            <p class="alert alert-info">{{ Session::get('customError') }}</p>
                        @endif
                        <div class="">

                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <input type="submit" class="btn btn-first w-100 mx-auto" value=" ورود ">

                        </div>
                    </form>



                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="mb-3">
                                <a class="btn btn-outline-info w-100" href="{{ route('home') }}">بازگشت</a>
                            </div>
                        </div>



                    </div>

                </div>
                <div class="col-md-6 h-400px">
                    <img src="{{ asset('/asset/images/Studying Concept Illustration.svg') }}" alt="">
                </div>
            </div>

        </section>
    </div>



    @if ($errors->has('authEmailcode'))
        <span class="text-danger">{{ $errors->first('authEmailcode') }}</span>
    @endif


    @if (Session::has('userNotFound'))
        <p class="alert alert-info">{{ Session::get('userNotFound') }}</p>
    @endif
    @if (Session::has('wrongCode'))
        <p class="alert alert-info">{{ Session::get('wrongCode') }}</p>
    @endif
    @if (Session::has('sendEmailAgain'))
        <p class="alert alert-info">{{ Session::get('sendEmailAgain') }}</p>
    @endif

    @if (Session::has('sendEmailError'))
        <p class="alert alert-info">{{ Session::get('sendEmailError') }}</p>
    @endif


@endsection
