@if( !empty($data) )
    @foreach( $data as $record )
        <tr class="bg-aff">
            <td class="border-right border-left padding-1">{{ $record->name }}</td>
            <td class="border-right padding-1">{{ $record->email }}</td>
            <td class="padding-1">
            <div class="d-flex align-items-center justify-content-between ">
                <p class="font-14">Free 1-month has been added to the subscription period.</p>
            </div>
            </td>
        </tr>
    @endforeach
@else
    <tr class="bg-aff">
        <td colspan="3">No Data Found</td>
    </tr>
@endif
