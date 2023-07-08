@extends('user.dashboard.master')




@section('headers')
    <link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
    <script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <h4 class="text-center p-4">موتور جستجوی سوم</h4>
    <form action="{{ route('user.search.submit') }}" method="post">

        @csrf


        <div class="row">
            
        <div class="col-md-6">

            <div class="form-group">
                <label for="">تاریخ تولد شما</label>
                <hr>
                <input class="form-control" required name="date1" data-jdp>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group">

                <label for="">تاریخ تولد شخص دوم</label>
                <hr>

                <input class="form-control" required name="date2" data-jdp>

            </div>

        </div>

    </div>

    <hr>
    
    

    <div class="Click-here" >
        تایید
    </div>


    @php
        $type = 'submit';
        $text = 'آیا از صحت تاریخ های تولد اطمینان دارید؟';
    @endphp

    <x-submit :type='$type' :text='$text' />


    </form>


    <hr>

    <script>
        var date = jalaliDatepicker.startWatch();
    </script>
@endsection
