@extends('auth.authMaster')

@section('title')
ورود
@endsection
@section('headers')
@endsection





@section('content')
  
    <form action="{{ route('verifyEmail') }}" method="post">

        @csrf
    
       کد اعتبار سنجی به ایمیل شما ارسال شده است

        <div>
            
            <input type="number" name="authEmailcode" value="{{ old('authEmailcode') }}">
            @if ($errors->has('authEmailcode'))
                <span class="text-danger">{{ $errors->first('authEmailcode') }}</span>
            @endif

            
        </div>

        @if (Session::has('customError'))
            <p class="alert alert-info">{{ Session::get('customError') }}</p>
        @endif
        <div class="">

        <input type="submit" value=" ورود " >

        </div>
    </form>

    <a href="{{}}">بازگشت</a>
@endsection
