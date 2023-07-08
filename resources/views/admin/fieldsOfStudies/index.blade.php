@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    {{ config('main.' . $routeName) }}
@endsection

@section('content')
    <a href="{{ route('adminn.fieldsOfStudies.create') }}" class="btn btn-danger">افزودن رشته جدید</a>

    <x-tables :trs="$items" :title="config('main.' . $routeName) . count($items)" :routeName="$routeName" :headers="$headers" />



    {!! $items->links() !!}
@endsection
