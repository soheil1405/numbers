@extends('admin.dashboard.master')




@section('headers')
@endsection


@section('title')
    تنظیمات موتور  آنالیزگر {{ $sCount }}
@endsection

@section('content')
    <h4>

        تنظیمات موتور  آنالیزگر {{ $sCount }}

    </h4>





    <ul>

        

        <form action="{{route('adminn.setting.EditPdfs')}}" method="post" enctype="multipart/form-data">


            @csrf

            <input type="submit" value="ثبت" class="btn btn-success">

            @foreach (config('main.searchEngin' . $sCount) as $key => $value)
                <hr>

                <h5>

                    {{ config('main.persianNames')[$key] . $key }}
                </h5>


                <ul class="row">
                    @foreach (config('main.searchEngin' . $sCount)[$key] as $itemm => $item)

                    {{-- @dd($itemm); --}}
                    
                    <li class="col-2">

                            <label for="{{ $key . '[' . $itemm . ']' }}">{{ $item }}</label>
                            
                            
                            
                            <input type="file" name="{{ $key . '[' . $itemm . ']' }}" class="form-control"
                                id="{{ $key . '[' . $itemm . ']' }}" accept=".pdf">


                                @if (Storage::disk('public')->exists("s".$sCount . "/" . $key . '/' . $itemm .".docx"))

                                
                                <a href="{{Storage::disk('public')->url("s".$sCount . "/" . $key . '/' . $itemm .".docx")}}">{{url(env('SEARCH_ENGIN_'.config('main.numberToEnglish')[$sCount]."_".$key).$item)}}</a>

                                @else


                                no file
                                @endif


                        </li>
                    @endforeach


                </ul>
            @endforeach




        </form>
    </ul>


@endsection
