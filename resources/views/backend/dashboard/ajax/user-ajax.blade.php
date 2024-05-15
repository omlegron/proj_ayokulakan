@foreach ($record as $item)
    <tr>
        <td>UAK{{ $item->id }}</td>
        <td>{{ $item->username }}</td>
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
<div class="pull-right">
    {!! $record->links() !!}
</div>