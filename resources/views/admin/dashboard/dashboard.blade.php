@extends('admin.dashboard.master')




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
                    <h2 class="text-center iransansultralight">داشبورد ادمین</h2>



                    <form action="" id="filterForm" class="row">

                        <div class="col-3">
                            <select class="form-control" name="filter" onchange="$('#filterForm').submit();" id="">
                                <option @if (Request()->has('filter') && request('filter') == 'all') selected @endif value="all">آمار کلی</option>
                                <option @if (Request()->has('filter') && request('filter') == 'today') selected @endif value="today">آمار امروز</option>
                                <option @if (Request()->has('filter') && request('filter') == 'thisWeek') selected @endif value="thisWeek">آمار این هفته
                                </option>
                                <option @if (Request()->has('filter') && request('filter') == 'thisMonth') selected @endif value="thisMonth">آمار این ماه
                                </option>
                                <option @if (Request()->has('filter') && request('filter') == 'thisYear') selected @endif value="thisYear">آمار امسال
                                </option>
                            </select>

                        </div>


                        <canvas id="myChart" style="max-width: 500px;"></canvas>
                        <canvas id="myChart2"style="max-width: 500px;"></canvas>

                    </form>
                </div>




            </div>
        </div>
    </div>

    <script>
        var xValues = ["تعداد پاسخ های درست", "تعداد پاسخ های غلط"];


        var yValues = [{{ 10 ,  50 }}];
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
                    text: "تعداد کل پاسخ ها :" + {{ 10+50 }}
                }
            }
        });




        var xValues = ["تعداد کل شرکت کنندگان", "تعداد پاسخ های درست", "تعداد پاسخ های غلط" , " "];
        var yValues = [ {{ 10+20 }}, {{ 10  }}, {{50}}, 0];
        var barColors = ["blue", "green", "red"];

        new Chart("myChart2", {
            type: "bar",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                legend: {
                    display: false
                },
                title: {
                    display: true,
                    text: "آمار کل "
                },

                interaction: {
                    mode: 'index',
                    axis: 'y'
                },


            }

        });
    </script>
@endsection
