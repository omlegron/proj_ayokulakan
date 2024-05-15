@extends('layouts.scaffold')

@section('styles')
<style>
   
</style>
@endsection

@section('scripts')

@endsection

@section('content-frontend')
<main class="outer-top"></main>
<div class="container outline-top">
    <div class="row">
        @if ($schedules->status === 'FAILED')
        <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
            <div class="text-center">
                <b>Upss... Maaf untuk saat ini jadwal tidak tersedia!</b>
                <br>
                Silahkan ulangi pencarian
            </div>
        </div>
        @else
        <div>

            

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                    <div class="col-md-2 col-md-offset-1 text-center">
                        <b>No Penerbangan</b>
                    </div>

                    <div class="col-md-3 text-center">
                        <b>Dari</b>
                    </div>

                    <div class="col-md-3 text-center">
                        <b>Ke</b>
                    </div>

                    <div class="col-md-2 text-center">
                        <b>Harga</b>
                    </div>
                </div>
                <div role="tabpanel" id="depart" class="tab-pane fade in active">
                    @foreach ($departs as $depart)
                    <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                        <form action="{{ url('airlinee/cart/' . $schedules->accessToken) }}" method="POST">

                            {!! csrf_field() !!}

                            <input type="hidden" name="journeyDepartReference" value="{{ $depart->journeyReference }}">

                            <div class="col-md-1">
                                <img src="{{ asset('img/airline/' . $depart->airlineID . '.jpg') }}" alt="" width="50">
                                <input type="hidden" name="airlineID" value="{{ $depart->airlineID }}">
                                <input type="hidden" name="paxAdult" value="{{ $request->paxAdult }}">
                                <input type="hidden" name="paxChild" value="{{ $request->paxChild }}">
                                <input type="hidden" name="paxInfant" value="{{ $request->paxInfant }}">
                                <input type="hidden" name="tripType" value="{{ $request->tripType }}">
                                <input type="hidden" name="departDate" value="{{ $request->departDate }}">
                                <input type="hidden" name="returnDate" value="{{ $request->returnDate }}">
                                <input type="hidden" name="pulang_data" value="{{ $request->pulang_data }}">
                                <input type="hidden" name="pulang_tanggal" value="{{ $request->pulang_tanggal }}">
                            </div>

                            <div class="col-md-2 text-center">
                                <b>{{ $depart->airlineID or '' }}</b>
                                @foreach ($depart->segment as $segment)
                                @if (isset($segment->availableDetail[0]))
                                @if ($segment->availableDetail[0]->price > 0)
                                <div style="margin-bottom: 50px;">
                                    <input type="hidden" name="flightNumber"
                                        value="{{ $segment->flightDetail[0]->flightNumber }}">
                                    <input type="hidden" name="airlineCode"
                                        value="{{ $segment->flightDetail[0]->airlineCode }}">
                                    <b>{{ $segment->flightDetail[0]->airlineCode . ' ' . $segment->flightDetail[0]->flightNumber }}</b>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>

                            <div class="col-md-3 text-center">
                                @foreach ($depart->segment as $segment)
                                @if (isset($segment->availableDetail[0]))
                                @if ($segment->availableDetail[0]->price > 0)
                                <div style="margin-bottom: 30px;">
                                    <input type="hidden" name="origin"
                                        value="{{ $segment->flightDetail[0]->fdOrigin }}">
                                    <input type="hidden" name="departTime"
                                        value="{{ $segment->flightDetail[0]->fdDepartTime }}">
                                    <b>{{ $segment->flightDetail[0]->fdOrigin }}</b>
                                    <br>
                                    {{ $segment->flightDetail[0]->fdDepartTime }}
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>

                            <div class="col-md-3 text-center">
                                @foreach ($depart->segment as $segment)
                                @if (isset($segment->availableDetail[0]))
                                @if ($segment->availableDetail[0]->price > 0)
                                <div style="margin-bottom: 30px;">
                                    <input type="hidden" name="destination"
                                        value="{{ $segment->flightDetail[0]->fdDestination }}">
                                    <input type="hidden" name="arrivalTime"
                                        value="{{ $segment->flightDetail[0]->fdArrivalTime }}">
                                    <b>{{ $segment->flightDetail[0]->fdDestination }}</b>
                                    <br>
                                    {{ $segment->flightDetail[0]->fdArrivalTime }}
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>

                            <div class="col-md-2 text-center">
                                @foreach ($depart->segment as $segment)
                                @if (isset($segment->availableDetail[0]))
                                @if ($segment->availableDetail[0]->price > 0)
                                <div style="margin-bottom: 50px;">
                                    <b>Rp. {{ number_format($segment->availableDetail[0]->price, 2) }}/pax</b>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>

                            <div class="col-md-1 text-center">
                                @foreach ($depart->segment as $segment)
                                @if (isset($segment->availableDetail[0]))
                                @if ($segment->availableDetail[0]->price > 0)
                                <input type="hidden" name="flightClass"
                                    value="{{ $segment->availableDetail[0]->flightClass }}">
                                <div style="margin-bottom: 35px;">
                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                </div>
                                @endif
                                @endif
                                @endforeach
                            </div>
                        </form>
                    </div>
                    @endforeach
                </div>

               
            </div>

        </div>
        @endif
    </div>
</div>
@endsection
