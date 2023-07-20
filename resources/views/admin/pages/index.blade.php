@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    {{ config('main.' . $routeName) }}
@endsection

@section('content')
    <a class="btn btn-success" href="{{ route('adminn.' . $routeName . '.create') }}">
        افزودن
    </a>

    <x-tables :trs="$items" :title="config('main.' . $routeName) . '('. count($items) . ')'" :routeName="$routeName" :headers="$headers" />




    {!! $items->links() !!}
@endsection

<script>
    function deleteee(id) {


        var answer = window.confirm("آیا میخواهید مورد" + id + "  را حذف کنید ؟");
        if (answer) {
            $('#Uid').val(id);

            $('#deleteForm').submit();


        } else {



        }

    }
</script>
