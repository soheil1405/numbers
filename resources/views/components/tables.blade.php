
<div class="container">
    <div class="row">
        <h2 class="text-center iransansultralight">

            {{ $title }}
        </h2>
    </div>
</div>

<div class="row bg-white rounded">
    <div class="col-md-12 divmain p-5">
        <div class="row">
            <table class="table table-hover table-striped table-bordered text-center">
                <thead>
                    @foreach ($headers as $item)
                        <th>
                            {{ $item }}
                        </th>
                    @endforeach
                </thead>

                @switch($routeName)
                    @case('users')
                        <x-usersTables :trs="$trs" />
                    @break

                    @case('names')
                        <x-names :trs="$trs" />
                        
                    @case('orders')
                    <x-orders :trs="$trs" />
                    @break

                    @default
                @endswitch
            </table>
        </div>
    </div>
</div>

