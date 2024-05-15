<div class="row">
    @foreach ($record as $e)
    <div class="col-md-3">
        <div class="card">
            @if($e->attachments->count() > 0)
                <img src="{{ url('storage/'.$e->attachments->first()->url) }}" class="card-img-top" style="max-height: 150px" alt="" >
                @else
                <img src="{{ asset('img/no-images.png') }}" style="max-height: 150px" alt="" >
            @endif
           {{-- <img class="card-img-top" src="..." alt="Card image cap">  --}}
           <div class="card-body text-center">
                <p class="card-text">{{ $e->nama_barang or '-' }}</p>
                <p class="">Rp. {{ number_format($e->harga_barang,0,',','.') }}</p>
                </div>
        </div>
    </div>
    @endforeach 
</div>
{!! $record->links() !!}