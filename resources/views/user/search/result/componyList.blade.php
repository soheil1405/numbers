@extends('user.dashboard.master')




@section('headers')
@endsection


@section('title')
    افزایش اعتبار
@endsection

@section('content')
    <div class="container">


        <h4 class="text-center">

            {{ $order->created_at }} - {{$order->componyOrUserName}}
        </h4>


        <table class="table table-hover table-striped table-bordered text-center">
            <thead>

                <th>
                    # </th>

                <th>
             
                    مقدار ورودی
                </th>

                <th>
                    جنسیت
                </th>

                <th></th>


            </thead>

            <tbody>

                @foreach ($data as $key => $value)
                    <tr>
                        <td>
                            {{ $key }}
                        </td>

                        <td>
                            {{ $value['inputed'] }}
                        </td>

                        <td>
                            {{ $value['sex'] }}
                        </td>

                        <td>
                            <a class="btn btn-success"
                                href="{{ route('user.search.showItem', ['id' => $order->id, 'index' => $key]) }}">مشاهده</a>
                        </td>
                    </tr>
                @endforeach

            </tbody>

        </table>
    </div>
@endsection
