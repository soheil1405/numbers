@extends('user.dashboard.master')


<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>






@section('title')
    داشبورد
@endsection

@section('content')
    <h4 class="text-center p-4">موتور جستجوی اول</h4>
    <h6> تاریخ تولد شما</h6>
    <hr>

    <form action="{{ route('user.search.submit') }}" method="post">
        @csrf
        <input required  value="{{old('date')}}" name="date" data-jdp class="form-control">
        <hr>


        <div class="Click-here" >
            تایید
        </div>


        @php
            $type = 'submit';
            $text = 'آیا از صحت تاریخ تولد خود اطمینان دارید؟';
        @endphp

        <x-submit :type='$type' :text='$text' />

        {{-- <input class="btn btn-success m-5" type="submit" value=""> --}}
    </form>
    <hr>



    <script>
        var date = jalaliDatepicker.startWatch();
    </script>
@endsection
