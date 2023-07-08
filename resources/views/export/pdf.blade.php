@extends('user.dashboard.master')


<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>






@section('title')
    داشبورد
@endsection

@section('content')



    {{ $inputed }}


    <hr>


    @if (isset($data))
        @for ($i = 0; $i < count($data); $i++)
            {{ $headers[$i] }}

            <hr>

            {{ $data[$i] }}
     
            <hr>

            @endfor
    @else
        <p class="p">

            {{ $newData }}
        </p>
    @endif

@endsection
