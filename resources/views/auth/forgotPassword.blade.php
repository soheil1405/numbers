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
                    <form 
                    {{-- action="{{route('auth.EnterResetPassCode')}}"\ --}}
                    
                    action="{{ route('auth.EnterResetPassCode') }}" method="post"
                    >
                        @csrf
                        <div class="form-group">
                            <input class="form-control" type="hidden" name="mobile" value="{{ $user->mobile }}">
                            <input type="number"   class="form-control"  name="authEmailcode" value="{{ old('authEmailcode') }}" required>
                        </div>
                        <div class="m-3">
                            <input type="submit" value=" ورود " class="btn btn-first w-100 mx-auto">
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
