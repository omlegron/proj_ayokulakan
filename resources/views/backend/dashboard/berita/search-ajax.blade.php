@foreach ($record as $item)
    <tr>
        <td>{{ $item->creator->nama }}</td>
        <td>{{ $item->created_at->format('d -M -Y') }}</td>
        <td>{{ $item->judul }}</td>
        <td><a href="{{ url('admin/berita',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
        <a href="{{ url("admin/berita/$item->id/edit") }}" class="btn btn-sm"><i class="fas fa-edit"></i></a>
        </td>
    </tr>
@endforeach
    <tr>
        <td colspan="5">
            <div class="pull-right">
                {!! $record->links() !!}
            </div>
        </td>
    </tr>