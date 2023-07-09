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
            @for ($i = 0; $i < count($data); $i++)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne_{{ $i }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            {{ $headers[$i] }}
                        </button>
                    </h2>
                    <div id="collapseOne_{{ $i }}"
                        class="accordion-collapse collapse 
                    
                    @if ($i == 0) show @endif

                    "
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="justify-content: right;">

                            {{ Str::limit($data[$i], strlen($data[$i]) / 5) }}
                            <a href="{{ route('user.orders.show', ['order' => $order]) }}">
                                پرداخت و مشاهده نسخه کامل
                            </a>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    @else
        <div class="accordion" id="accordionExample">
            @for ($i = 0; $i < count($data); $i++)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne_{{$i}}" aria-expanded="true" aria-controls="collapseOne">
                            {{ $headers[$i] }}
                        </button>
                    </h2>
                    <div id="collapseOne_{{$i}}"
                        class="accordion-collapse collapse 
                    @if ($i == 0) show @endif"
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                            {{ $data[$i] }}
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    @endif


@endsection
