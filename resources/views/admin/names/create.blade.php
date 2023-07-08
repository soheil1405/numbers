@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    {{ config('main.' . $routeName) }}
@endsection

@section('content')
    <h1>
        {{ config('main.' . $routeName) }}
    </h1>
    <form action="{{ route('adminn.names.store') }}" method="post">

        @csrf


        <div class="form-group p-3">
            <label for="">{{ config('main.persian_name_label') }}</label>
            <input type="text" name="persian_name" class="form-control" required>
        </div>


        <div class="form-group p-3">
            <label for="">{{ config('main.english_name_label') }}</label>
            <input type="text" name="english_name" class="form-control" required>
        </div>

        <select name="type" class="form-control" id="">

            @foreach (config('main.nameType') as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
            @endforeach

        </select>

        <a href="{{ route('adminn.names.index') }}" class="btn btn-danger p-3">
            {{ config('main.back') }}</a>
        <input type="submit" value="{{ config('main.save') }}" class="btn btn-success p-3">

    </form>
@endsection
