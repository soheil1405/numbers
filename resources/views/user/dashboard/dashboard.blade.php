@extends('user.dashboard.master')




@section('headers')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
@endsection


@section('title')
    داشبورد
@endsection

@section('content')








    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <div class="container-fluid background-math">

        <div class="container">
            <div class="d-flex justify-content-between">
                <div class="headback rounded">

                    <h5>
                        سلام {{ Auth::user()->firstname }}
                    </h5>



                </div>
                <div class="headback rounded">
                    <div class="my-1 text-center">
                        <div class="text-center my-1">


                            <h5 class="text-center">

                                امروز
                            </h5>


                            <h5>
                                دوشنبه


                                {{ \Morilog\Jalali\Jalalian::now() }}

                                {{-- {{\Morilog\Jalali\Jalalian::now()}} --}}
                            </h5>


                            @if (Session::has('notAvailable'))
                                <div class="alert alert-danger">
                                    {{ Session::get('notAvailable') }}
                                </div>
                            @endif


                            @if (Session::has('passEdited'))
                                <div class="alert alert-success">
                                    {{ Session::get('passEdited') }}
                                </div>
                            @endif

                            @if (Session::has('answered'))
                                <div class="alert alert-success">
                                    {{ Session::get('answered') }}
                                </div>
                            @endif





                        </div>


                        {{-- <h4>به وب سایت <strong class="text-first">QUIZMATH</strong> خوش آمدید</h4> --}}

                    </div>
                </div>

            </div>
            <div class="row bg-white rounded">
                <div class="col-md-6">

        

                    <div class="text-center">
                        <img class="img-fluid w-40" src="{{ 'asset/images/Cat with a witch hat-cuate.svg' }}"
                            alt="">
                    </div>
                </div>
                {{-- <canvas id="myChart2" style="max-width:500px;"></canvas> --}}

                <div class="col-md-6 text-center">
                    <img class="img-fluid w-75" src="{{ 'asset/images/Mathematics-cuate.svg' }}" alt="">
                </div>


            </div>
            <canvas id="myChart" style="max-width:500px;"></canvas>

        </div>


    </div>
@endsection
