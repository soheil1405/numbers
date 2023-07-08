@extends('auth.authMaster')

@section('title')
بازیابی رمز
@endsection
@section('headers')
@endsection





@section('content')
  
    <form action="{{ route('user.EnterNewPass') }}" method="post">

        @csrf
    
        <h1>پسورد جدید خود را وارد کنید</h1>
        
        <div>
            

            <input type="text" name="newPass" value="{{ old('newPass') }}">
          
            <input type="text" name="newPassVerify" value="{{ old('newPassVerify') }}">
     
          
          
            @if ($errors->has('authEmailcode'))
                <span class="text-danger">{{ $errors->first('authEmailcode') }}</span>
            @endif

            
        </div>

        @if (Session::has('customError'))
            <p class="alert alert-info">{{ Session::get('customError') }}</p>
        @endif







        @if ($errors)
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach
        @endif






        <div class="">

        <input type="submit" value=" ورود " >

        </div>
    </form>


    @endsection
