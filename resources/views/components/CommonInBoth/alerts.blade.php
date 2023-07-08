@if ($errors->has('created'))
    <span class="text-danger">{{ $errors->first('created') }}</span>
@endif




@if (Session::has('created'))
    <div class="alert alert-success">
        {{ Session::get('created') }}

    </div>
@endif

@if (Session::has('deleteStatus'))
    <div class="alert alert-success">
        {{ Session::get('deleteStatus') }}

    </div>
@endif


@if (Session::has('edited'))
    <div class="alert alert-success">
        {{ Session::get('edited') }}

    </div>
@endif


@if (Session::has('error'))
    <div class="alert alert-danger">
        {{ Session::get('error') }}
    </div>
@endif


@if ($errors->any())

    @foreach ($errors->all() as $item)
        <div class="alert alert-danger">
            {{ $item }}
        </div>
    @endforeach

@endif
