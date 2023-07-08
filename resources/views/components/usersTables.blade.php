
<tbody>
    @foreach ($trs as $item)
        <tr>
            <th>
                {{ $item->users->id }}
            </th>
            <th>
                {{ $item->users->firstname }} - {{ $item->users->lastname }}
            </th>
            <th>
                {{ $item->users->mobile }}
            </th>
            <th>
                {{ $item->users->created_at }}
            </th>
            <th>
                {{-- 
                <a class="btn btn-warning"
                    href="{{ route('adminn.users.edit', ['user' => $rol->users]) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                        <path
                            d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                        <path fill-rule="evenodd"
                            d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                    </svg><span class="p-3">ویرایش</span></a> --}}
                <button type="button" class="btn btn-danger" onclick="deleteee({{ $item->users->id }})">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path
                            d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8 2.146 2.854Z" />
                    </svg>
                    حذف
                </button>
                <a class="btn btn-info"
                    href="{{ route('adminn.users.show', ['user' => $item->users]) }}"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path
                            d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                    </svg><span class="p-3">{{config('main.show')}}</span>
                </a>
            </th>
            <form id="deleteForm" action="{{ route('adminn.users.destroy', ['user' => $item->users]) }}"
                method="post">
                @csrf
                @method('DELETE')
                <input type="hidden" name="Uid" id="Uid" value="{{ $item->users->id }}">
            </form>
        </tr>
    @endforeach
</tbody>