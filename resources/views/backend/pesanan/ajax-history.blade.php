@if ($record->count() > 0)
    <?php $no = 1; ?>
    @foreach ($record as $item)
        <tr>
            <td>{{ $no }}</td>
            <td>{{ $item->user->nama or '' }}</td>
            {{-- <td>{{ $item-> }}</td> --}}
            <td>{{ $item->order_id or '' }}</td>
            <td><span class="badge badge-pill badge-warning">{{ $item->status }}</span></td>
            <td>{{ $item->created_at }}</td>
            <td><a href="{{ url("history-trans/$item->id/detail") }}" data-toggle="tooltip" data-placement="" title="Proses Data" data-id="{{ $item->id }}" class="ui mini btn btn-sm btn-success button"><i class="fa fa-eye"></i></a></td>
        </tr>
        <?php $no++ ?>
    @endforeach
    @else
    <tr>
        <td colspan="6">
            <center>Data Tidak ditemukan</center>
        </td>
    </tr>
@endif