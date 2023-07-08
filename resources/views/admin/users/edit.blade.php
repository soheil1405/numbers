@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
<div class="container-fluid background-math">
        <div class="headback rounded ">
    <h1 class = "iransansultralight">ویرایش اطلاعات کاربر ، {{ $user->firstname }} - {{ $user->lastname }} </h1>

    <form action="{{ route('adminn.usersupdate') }}" method="POST" class=""
        style="display: flex; flex-direction: column;">

        @csrf

       
<div class="container">
    <div class="row">
      
 
        <input type="hidden" name="userId" value="{{$user->id}}">

        <div class="">
            <label class = "iransansultralight" >
                نام
            </label>
            <input type="text" class="form-control" name="first_name" value="{{ $user->firstname }}" id="">




        </div>
        
        <div class="">
            <label class = "iransansultralight">
                نام خانوادگی
            </label>

            <input type="text"  class="form-control" class="form-control" name="last_name" value="{{ $user->lastname }}" id="">



        </div>
        <div class="">
            <label class = "iransansultralight">
                شماره تلفن
            </label>

            <input type="text" class="form-control" name="mobile" value="{{ $user->number }}" id="">


        </div>
        <div class="">
            <label class = "iransansultralight">
                ایمیل

            </label>
            <input type="email" class="form-control" name="email" value="{{ $user->email }}" id="">


        </div>
        <div class="form-group">
      <label class = "iransansultralight" >شهر را انتخاب کنید</label>
      <select class="form-control" name="city" id="" value="{{ old('city') }}">

        @foreach ($cities as $item)
                    <option value="{{ $item->id }}"
                        
                        
                        @if($user->city->id == $item->id)
                        
                        selected
                        
                        @endif
                        
                        
                        
                        
                        >{{ $item->name }}</option>
                @endforeach
      </select>
      </div>
      <div class="form-group">
      <label class = "iransansultralight">مقطع تحصیلی را انتخاب کنید</label>
      <select class="form-control" name="classLevel" id=""
            value="{{ old('classLevel') }}>

      @foreach ($class_levels as $item)
                <option value="{{ $item->id }}"
                  
                  
                    @if($user->classLevel->id == $item->id)
                        
                    selected
                    
                    @endif
                    
                    
                    
                    
                    >{{ $item->name }}</option>
            @endforeach
      </select>
      </div>

        
      <div class="form-group">
      <label class = "iransansultralight">رشته تحصیلی</label>
      <select class="form-control" name="Field_of_Study" id="" value="{{ old('Field_of_Study') }}" >

      @foreach ($fields_of_study as $item)
                    <option value="{{ $item->id }}"
                        
                        
                        
                                          
                    @if($user->filedOfStudy->id == $item->id)
                        
                    selected
                    
                    @endif
                    
                    
                        
                        
                        
                        
                        
                        
                        >{{ $item->name }}</option>
                @endforeach
      </select>
      </div>
 
</div>
</div>

<hr>
<div class="text-center">
        <button class="btn btn-info btn-block iransansultralight" type="submit" >ثبت ویرایش کاربر</button>
        </div>
        <hr>
        <div class="text-center">
        <a href="{{route('adminn.users.index')}}" class="btn btn-warning iransansultralight">بازگشت</a>
        </div>
        @if ($errors)
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    @endif


    </form>
    </div>
</div>
@endsection
