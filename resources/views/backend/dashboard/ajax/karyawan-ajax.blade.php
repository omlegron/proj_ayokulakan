@foreach ($record as $item)
    <tr>
        <td>{{ $item->nama }}</td>
        <td>{!! $item->getStatus() ?? '-' !!}</td>
        <td>{{ $item->created_at }}</td>
        <td>{{ $item->role or '-' }}</td>
        <td>
            <a href="javascript:void(0)" class="btn btn-sm mybtn" data-id="{{ $item->id }}"><i class="fas fa-eye"></i></a>
            <a href="" class="btn btn-sm btn-edit" data-id="{{ $item->id }}"><i class="fas fa-edit"></i></a>
            <a href="javascript:void(0)" class="btn btn-sm btn-dell" data-id="{{ $item->id }}"><i class="fas fa-trash text-danger"></i></a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="5"> {!! $record->links() !!}</td>
  </tr>