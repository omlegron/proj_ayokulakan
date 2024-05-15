@foreach ($record as $item)
    <tr>
        <td>KLAK{{ $item->id }}</td>
        <td>{{ $item->name}}</td>
        <td>{{ $item->created_at }}</td>
        <td>{!! $item->getLabel() ?? '-' !!}</td>
        <td class="text-right">
            <a href="{{ url('admin/kaki-lima',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
            {{-- <span class="badge badge-danger">{{$item->verived or '-'}}</span> --}}
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="4">
        {!! $record->links() !!}
    </td>
</tr>