@extends('user.dashboard.master')




@section('headers')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

@endsection


@section('title')
    داشبورد
@endsection

@section('content')
    <div class="container-fluid background-math">

        <div class="container">
            <div class="row">
                <div class="headback rounded">

                    @if ($user->id == Auth::user()->id)
                    <h2 class="text-center"> لیست سوالاتی که من شرکت کرده ام</h2>

                    @else

                    <h2 class="text-center"> لیست سوالاتی که {{ $user->firstname }} -  {{  $user->lastname }} شرکت کرده است</h2>


                    @endif





                </div>
            </div>
            <div class="row bg-white rounded">

                <form action="" method="get" id="showByForm">
                    <select name="showBy" onchange="$('#showByForm').submit()">
                        <option value="all" @if (request()->has('showBy') && request('showBy') == 'all') selected @endif>همه سوالات</option>
                        <option value="wins" @if (request()->has('showBy') && request('showBy') == 'wins') selected @endif>برنده شده </option>
                        <option value="corrects" @if (request()->has('showBy') && request('showBy') == 'corrects') selected @endif>جواب درست
                        </option>
                        <option value="wrongs" @if (request()->has('showBy') && request('showBy') == 'wrongs') selected @endif>جواب غلط  </option>
                    </select>
                </form>
                <canvas id="myChart" style="max-width:500px;"></canvas>

                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered text-center">



                            <thead>

                                <th>
                                    کد سوال
                                </th>

                                <th>
                                    تاریخ سوال
                                </th>

                                <th>
                                    تعداد شرکت کنندگان
                                </th>
                                <th>
                                    تعداد جواب های درست
                                </th>

                                <th>
                                    تعداد جواب های غلط
                                </th>


                                <th>

                                    پاسخ شما

                                </th>


                                <th>
                                    اقدمات
                                </th>

                            </thead>


                            <tbody>

                                @if(request()->has('showBy') && request('showBy') == "wins")

                                @foreach ($wins as $win)
                                    <tr>

                                        <th>

                                            {{ $win->question->id }}

                                        </th>

                                        <th>

                                            {{ $win->question->time }}
                                        </th>

                                        <th>

                                            {{ $win->question->allAnswersCount }}
                                        </th>
                                        <th>

                                            {{ $win->question->CurrectAnswersCount }}
                                        </th>

                                        <th>

                                            {{ $win->question->WrongAnswersCount }}

                                        </th>

                                        <th>
                                                <span class="btn btn-info">برنده</span>
                                        </th>


                                        <th>



                                            <a class="btn btn-info"
                                                href="{{ route('user.questions.show', ['id' => $win->question]) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg><span class="p-3">مشاهده سوال</span>
                                            </a>
                                        </th>
                                    </tr>
                                @endforeach




                                @else
                                @foreach ($userAnsers as $userAnswer)
                                    <tr>

                                        <th>

                                            {{ $userAnswer->question->id }}

                                        </th>

                                        <th>

                                            {{ $userAnswer->question->time }}
                                        </th>

                                        <th>

                                            {{ $userAnswer->question->allAnswersCount }}
                                        </th>
                                        <th>

                                            {{ $userAnswer->question->CurrectAnswersCount }}
                                        </th>

                                        <th>

                                            {{ $userAnswer->question->WrongAnswersCount }}

                                        </th>

                                        <th>

                                            @if($userAnswer->choiced_answer_item == $userAnswer->question->cucrrect_answer_item)
                                                <span class="btn btn-success">درست</span>
                                            @else
                                                <span class="btn btn-danger">غلط</span>
                                            @endif





                                        </th>


                                        <th>



                                            <a class="btn btn-info"
                                                href="{{ route('user.questions.show', ['id' => $userAnswer->question]) }}"><svg
                                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                                    <path
                                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                                    <path
                                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                                </svg><span class="p-3">مشاهده سوال</span>
                                            </a>
                                        </th>
                                    </tr>
                                @endforeach
                                @endif
                            </tbody>






                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <script>
        var xValues = ["پاسخ اشتباه", "پاسخ درست"];


        var yValues = [{{$user->WrongAnwers_count}}, {{$user->CurrectAnwers_count}}];
        var barColors = [
            "#b91d47",
            "#1e7145"
        ];

        new Chart("myChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                title: {
                    display: true,
                    text: "تعداد کل پاسخ ها : "+{{ $user->WrongAnwers_count + $user->CurrectAnwers_count }}
                }
            }
        });
    </script>
@endsection
