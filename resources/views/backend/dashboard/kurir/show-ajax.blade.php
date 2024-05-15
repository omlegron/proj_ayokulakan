@foreach ($record as $item)
    <tr>
        <td>KAK{{ $item->id }}</td>
        <td>{{ $item->namadepan .' '. $item->namabelakang}}</td>
        <td>{{ $item->created_at }}</td>
        <td class="text-right">
            <a href="{{ route('admin.kurir.show',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
            <span class="badge badge-danger">{{$item->verived or '-'}}</span>
        </td>
    </tr>
@endforeach