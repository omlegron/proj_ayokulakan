<div class="panel panel-default">
    <div class="panel-body">
        <h4>Penerbangan</h4>
        <b>
            {{ $cityOrigin->location_name or '' }} -
            {{ $cityDestination->location_name or '' }}
        </b> <br>
        <img src="{{ asset('img/airline/' . $request->airlineID . '.jpg') }}" alt="" width="50">
        {{ $request->origin }} - {{ $request->destination }}
        @php
        $date = date_create($request->departTime);
        @endphp
        {{ date_format($date, '- D, d-m-Y') }}
        <br><br><br>
        
        <p><b>Detail Harga</b></p>
        @if(isset($cekPrice->priceDepart[0]))
        @foreach ($cekPrice->priceDepart[0]->priceDetail as $price)

        @if($price->paxType == 'Adult')
        <b>{{ $price->paxType . ' x' . $request->paxAdult }}</b> <br>
        {{ 'Harga Pokok'  }} Rp {{ number_format($price->baseFare, 2) }}<br>
        {{ 'Pajak' }} Rp {{ number_format($price->tax, 2) }}<br>
        <b>{{ 'Jumlah' }}</b> Rp {{ number_format($price->totalFare, 2) }}<br><br>
        @endif

        @if($price->paxType == 'Child')
        <b>{{ $price->paxType . ' x' . $request->paxChild }}</b> <br>
        {{ 'Harga Pokok' }} Rp {{ number_format($price->baseFare, 2) }}<br>
        {{ 'Pajak'  }} Rp {{ number_format($price->tax, 2) }}<br>
        <b>{{ 'Jumlah' }}</b> Rp {{ number_format($price->totalFare, 2) }}<br><br>
        @endif

        @if($price->paxType == 'Infant')
        <b>{{ $price->paxType . ' x' . $request->paxInfant }}</b> <br>
        {{ 'Harga Poko' }} Rp {{ number_format($price->baseFare, 2) }}<br>
        {{ 'Pajak' }} Rp {{ number_format($price->tax, 2) }}<br>
        <b>{{ 'Jumlah' }}</b> Rp {{ number_format($price->totalFare, 2) }}<br><br>
        @endif
        @endforeach
        @endif
        <br><br><br>
        <hr>
        <b>Total Pembayaran</b> Rp. {{ number_format($cekPrice->sumFare, 2) }}
    </div>
</div>