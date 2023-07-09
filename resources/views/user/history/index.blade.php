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
                <div class="headback rounded text-center">


                    <h4>
                        تاریخچه جستجو
                    </h4>


                </div>
            </div>
            <div class="row bg-white rounded">

                {{-- <form action="" method="get" id="showByForm">
                    <select name="showBy" onchange="$('#showByForm').submit()">
                        <option value="all" @if (request()->has('showBy') && request('showBy') == 'all') selected @endif>همه سوالات</option>
                        <option value="wins" @if (request()->has('showBy') && request('showBy') == 'wins') selected @endif>برنده شده </option>
                        <option value="corrects" @if (request()->has('showBy') && request('showBy') == 'corrects') selected @endif>جواب درست
                        </option>
                        <option value="wrongs" @if (request()->has('showBy') && request('showBy') == 'wrongs') selected @endif>جواب غلط </option>
                    </select>
                </form> --}}
                {{-- <canvas id="myChart" style="max-width:500px;"></canvas> --}}

                <div class="col-md-12 divmain p-5">
                    <div class="row">
                        <table class="table table-hover table-striped table-bordered text-center">



                            <thead>

                                <th>
                                    آیدی
                                </th>

                                <th>
                                    تاریخ جستجو
                                </th>

                                <th>
                                    تعداد جستجو

                                </th>
                                
                                <th>
                                    نوع جستجو
                                </th>
                                <th>
                                    وضعیت پرداخت
                                </th>
                                <th>

                                </th>

                            </thead>


                            <tbody>

                                @foreach ($history as $item)
                                    <tr>
                                        <td>
                                            {{ $item->id }}
                                        </td>

                                        <td>
                                            {{ $item->created_at }}
                                        </td>
                                        <td>
                                            {{ $item->resultCount }}
                                        </td>
                                        <td>
                                            {{ $item->searchEnginType }}
                                        </td>

                                        <td>
                                            @if ($item->status == '100')
                                                <span class="text-success">
                                                    پرداخت شده
                                                </span>
                                            @else
                                                <span class="text-danger"> در انتظار پرداخت </span>
                                            @endif
                                        </td>


                                        <td>
                                            <a class="btn btn-success"
                                                href="{{ route('user.search.show', ['id' => $item->id]) }}">
                                                مشاهده
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>






                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>
    {{-- <script>
            var xValues = ["پاسخ اشتباه", "پاسخ درست"];


            var yValues = [{{ $user->WrongAnwers_count }}, {{ $user->CurrectAnwers_count }}];
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
                        text: "تعداد کل پاسخ ها : " + {{ $user->WrongAnwers_count + $user->CurrectAnwers_count }}
                    }
                }
            });
        </script> --}}
@endsection
