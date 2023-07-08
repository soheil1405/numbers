@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
     {{ config('main.' . $routeName) }}
@endsection

@section('content')
    <div class="container-fluid background-math">
        <div class="headback rounded">

            
           <x-tables :trs="$items" :title="config('main.' . $routeName) . ( count($items) )" :routeName="$routeName" :headers="$headers" />
            
        </div>
    </div>

    
{!! $items->links() !!}

@endsection

<script>
    function deleteee(id) {


        var answer = window.confirm("آیا میخواهید مورد"+id+"  را حذف کنید ؟");
        if (answer) {
            $('#Uid').val(id);

            $('#deleteForm').submit();


        } else {



        }

    }
</script>
