@extends('user.dashboard.master')

@section('headers')
@endsection


@section('title')
    باشگاه مشتریان
@endsection

@section('content')

<h4>
    باشگاه مشتریان
</h4>

    @if ($user->isIncustomerClub == 3)
        <div class="accordion" id="accordionExample">

            @foreach ($data as $key => $value)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne_{{ $key }}" aria-expanded="true"
                            aria-controls="collapseOne">
                            {{ str_replace("<br/>" , " " ,  substr($data[0] , 0 , 132)) }}
                        </button>
                    </h2>
                    <div id="collapseOne_{{ $key }}"
                        class="accordion-collapse collapse" 
                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body" style="justify-content: right;">
                            {!! $value !!}
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    @else
        <div class="alert alert-danger">
            برای عضویت در باشگاه مشتریان باید حداقل 3 آنالیز در سایت داشته باشید
        </div>
    @endif
@endsection
