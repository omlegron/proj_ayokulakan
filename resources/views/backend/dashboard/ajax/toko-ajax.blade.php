@foreach ($record as $item)
    <tr>
        <td>TAK{{ $item->id }}</td>
        <td>{{ $item->nama_lapak }}</td>
        <td>{{ $item->created_at }}</td>
        <td><span>
            <i class="fa fa-star" style="color:#ff7429;"></i>
            <i class="fa fa-star" style="color:#ff7429;"></i>
            <i class="fa fa-star" style="color:#ff7429;"></i>
            <i class="fa fa-star" style="color:#ff7429;"></i>
            <i class="fa fa-star" style="color:#ff7429;"></i>
        </span></td>
        <td>
            <a href="{{ route('admin.user.show',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
        </td>
    </tr>
@endforeach
<tr>
    <td colspan="5"> {!! $record->links() !!}</td>
</tr>