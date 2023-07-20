<tbody>
    @foreach ($trs as $item)
        <tr>
            <th>
                {{ $item->id }}
            </th>
            <th>
                @if ($item->payment)
                    {{ $item->payment->ref_id }}
                @endif
            </th>

            <th>
                {{ $item->ComponyOrUser }}
            </th>

            <th>
                {{ $item->componyOrUserName }}
            </th>

            <th>
                {{ $item->searchType }}
            </th>

            <th>
                {{ $item->resultCount }}
            </th>

            <th>

                {{ $item->totalAmount }}

            </th>

            <th>

                {{ $item->created_at }}

            </th>

            <th>
                {{ $item->type }}
            </th>

            <th>



                @if ($item->payment && $item->payment->ref_id && $item->status == 100)
                    <span class="btn btn-success">موفق</span>
                @else
                    <span class="btn btn-danger">ناموفق</span>
                @endif


                
            </th>


            <form id="deleteForm" href="{{ route('adminn.names.destroy', ['name' => $item]) }}" method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="Uid" id="Uid">
            </form>
        </tr>
    @endforeach
</tbody>
