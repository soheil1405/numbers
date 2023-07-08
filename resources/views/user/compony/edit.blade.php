@extends('user.dashboard.master')


@section('headers')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection


@section('title')
    ویرایش شرکت
@endsection



@section('content')


<form action="{{ route('user.compony.update') }}" method="post">
    @csrf

    <div class="row">


        <div class="form-group  ">
            <label for="" class="iransansultralight">  نام شرکت </label>
            <input type="text" name="componyName" class="form-control" value="{{ Auth::user()->componyName}}" id="" class="iransanslight">


        </div>
        <input class="btn btn-info" type="submit" value="ویرایش ">

    </div>
</form>

@endsection


