@extends('user.dashboard.master')


<link rel="stylesheet" href="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.css">
<script type="text/javascript" src="https://unpkg.com/@majidh1/jalalidatepicker/dist/jalalidatepicker.min.js"></script>






@section('title')
    داشبورد
@endsection

@section('content')
    {{ $inputed }}


    <hr>

    @if (isset($order) && $order->status != '100')
        <div class="alert alert-danger">
            پرداخن نشده


            <a href="{{ route('user.orders.show', ['order' => $order]) }}">
                پرداخت و مشاهده نسخه کامل
            </a>
        </div>

        <div class="accordion" id="accordionExample">

            @foreach ($data as $key => $value)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne_{{ $key }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            {{ config('main.persianNames')[$key] }}
                        </button>
                    </h2>
                    <div id="collapseOne_{{ $key }}"
                        class="accordion-collapse collapse 
                    
                    @if ($key == 'birthday') show @endif

                    "
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="justify-content: right;">


                            @foreach ($value as $item)
                                {{ Str::limit($item, strlen($item) / 5) }}
                                <hr>
                            @endforeach



                            <a href="{{ route('user.orders.show', ['order' => $order]) }}">
                                پرداخت و مشاهده نسخه کامل
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="accordion" id="accordionExample">

            @foreach ($data as $key => $value)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne_{{ $key }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            {{ config('main.persianNames')[$key] }}
                        </button>
                    </h2>
                    <div id="collapseOne_{{ $key }}"
                        class="accordion-collapse collapse 
                    
                    @if ($key == 'birthday') show @endif

                    "
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="justify-content: right;">


                            @foreach ($value as $item)
                                {{ $item }}
                                <hr>
                            @endforeach



                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @endif


@endsection
