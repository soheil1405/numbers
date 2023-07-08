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
    <form method="post"action="{{ route('adminn.names.update', ['name' => $name]) }}">

        @csrf

        <div class="form-group p-3">
            <label for="">{{ config('main.persian_name_label') }}</label>
            <input type="text" name="persian_name" value="{{ $name->persian_name }}" class="form-control" required>
        </div>


        <div class="form-group p-3">
            <label for="">{{ config('main.english_name_label') }}</label>
            <input type="text" name="english_name" value="{{ $name->english_name }}" class="form-control" required>
        </div>


        <a href="{{ route('adminn.names.index') }}" class="btn btn-danger p-3">
            {{ config('main.back') }}</a>

        <input type="submit" value="{{ config('main.save') }}" class="btn btn-success p-3">


    </form>
@endsection
