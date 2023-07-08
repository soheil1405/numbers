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
                    <h2 class="h4">ورود</h2>
                    <form action="{{ route('auth.login') }}" id="loginForm" method="post">


                        <input type="hidden" name="type" id="type" value="login">

                        @csrf

                        <div class="mb-3">
                            <label class="form-label"> شماره تلفن </label>
                            <input class="form-control" type="text" name="number" id="number"
                                value="{{ old('number') }}">


                            @if ($errors->has('number'))
                                <span class="text-danger">{{ $errors->first('number') }}</span>
                            @endif


                            <span class="text-danger" id="shomareAjax"></span>

                            
                        </div>

                        
                        @if (Session::has('customError'))
                            <span class="text-danger">{{ Session::get('customError') }}</span>
                        @endif





                        <div class="mb-3">



                            <input class="btn btn-first w-100 mx-auto" type="submit" value=" ورود ">

                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-6">


                            <input type="hidden" name="number" id="forgotPNumber">
                            <span class="btn btn-warning w-100 mb-3" onclick="sendForgotPassCode()" type="button"
                                value="">فراموشی رمز

                            </span>
                        </div>

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
@endsection
