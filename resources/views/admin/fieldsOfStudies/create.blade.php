@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    {{ config('main.' . $routeName) }}
@endsection

@section('content')
    <form action="{{route('adminn.fieldsOfStudies.store')}}" method="post">

        @csrf


        <div class="form-group p-3">
            <label for="">{{ config('main.Fileds_of_studys_name') }}</label>
            <input type="text" name="name" class="form-control">
        </div>


        <div class="form-group p-3">
            <label for="">{{ config('main.parent_Fileds_of_studys') }}</label>
            <select name="parent_id" id="" class="form-control">

                @foreach (config('main.Fileds_of_studys') as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group p-3">
            <label for="">{{ config('main.rate') }}</label>
            <select name="rate" id="" class="form-control">

                @foreach (config('main.rates') as $key => $value)
                    <option value="{{ $key }}">
                        {{ $value }}
                    </option>
                @endforeach

            </select>
        </div>
        <input type="submit" value="{{ config('main.save') }}" class="btn btn-success p-3">

    </form>
    <a href="{{ route('adminn.fieldsOfStudies.index') }}" class="btn btn-danger p-3">  {{ config('main.back') }}</a>
@endsection
