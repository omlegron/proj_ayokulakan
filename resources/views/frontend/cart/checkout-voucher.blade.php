@if ($record->count() > 0)
        <div class="panel-body" style="background-color: #ffffff !important">
            <table class="table">
                @foreach ($record as $item)
                <tr>
                    <td><p style="font-size: 14px">{{ $item->desc_voucher or '' }}</p>
                        <span>Rp {{ number_format($item->nominal_voucher,0 ,',', '.') ?? '' }}</span>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn-sm btn-warning btn-claim" data-id="{{ $item->id or '' }}" data-price="{{ $item->nominal_voucher }}" style="line-height: 100px">Claim</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    @else
    <center><h3>Data Belum Tersedia / Voucher Sudah Exp</h3></center>
@endif