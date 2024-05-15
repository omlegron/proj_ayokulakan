@extends('layouts.scaffold')

@section('styles')
<meta name="asset-url" content="{{ config('app.url') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
@endsection

@section('scripts')
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script>
    $(document).ready(function() {
        checkReturnDate('#tripType');
        $('#tripType').click(function(){
            checkReturnDate(this);
        });

        $('.bots-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });

    function checkReturnDate(id) {
        if($(id).prop('checked') == true){
            $('#returnDate').val('').removeAttr('disabled');
        }
        else if($(id).prop('checked') == false){
            $('#returnDate').val('').attr('disabled', 'disabled');
        }
    }
</script>
@endsection

@section('content-frontend')
<div class="terms-conditions-page container" >
    <div class="body-content">
        <div class="container">
            <div class="checkout-box ">
                <div class="row">
                    <div class="col-md-8">
                        @if($result)
                            @if(!is_null($result->passengers) && count($result->passengers) > 0)
                                @foreach($result->passengers as $k => $value)
                                    <div class="panel-group checkout-steps" id="accordion">
                                        <div class="panel panel-default checkout-step-01">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseOne{{ $k+1 }}">
                                                      <span>{{ $k+1 }}</span>Passengers {{ $value->title }} {{ $value->firstName }} {{ $value->lastName }}
                                                  </a>
                                                </h4>
                                            </div>

                                            <div id="collapseOne{{ $k+1 }}" class="panel-collapse collapse" style="height: 0px;">
                                                <div class="panel-body">
                                                    <div class="row">       
                                                        <div class="col-md-6 col-sm-6 guest-login">
                                                            <h4 class="checkout-subtitle outer-top-vs">Data Pendaftar</h4>
                                                            <ul class="text instruction inner-bottom-30">
                                                                <li class="save-time-reg">Name : {{ $value->title }} {{ $value->firstName }} {{ $value->lastName }}</li>
                                                                <li>Phone : {{ $value->phone }}</li>
                                                                <li>Type : {{ $value->type }}</li>
                                                            </ul>
                                                        </div>
                                                    </div>          
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="checkout-progress-sidebar ">
                            <div class="panel-group">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="unicase-checkout-title">Detail Pesanan</h4>
                                    </div>
                                    <div class="">
                                        @if($result)
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            <li><a href="#">Jumlah Orang : {{ count($result->passengers) }}</a></li>
                                            <li><a href="#">Pesawat : {{ $result->airline }} {{ $result->airlineID }}</a></li>
                                            <li><a href="#">Kelas Penerbangan : {{ $result->flightClass }}</a></li>
                                            <li><a href="#">Kode Booking : {{ $result->bookingCode }}</a></li>
                                            <li><a href="#">Tanggal Booking : {{ $result->bookingDate }}</a></li>
                                            <li><a href="#">Keberangkatan : {{ $result->origin }}</a></li>
                                            <li><a href="#">Tujuan Keberangkatan : {{ $result->destination }}</a></li>
                                            <li><a href="#">Tanggal Keberangkatan : {{ $result->departDate }}</a></li>
                                            <li><a href="#">Tanggal Sampai : {{ $result->returnDate }}</a></li>
                                            <li><a href="#">Status Tiket: 
                                                @if($result->ticketStatus == 'HOLD')
                                                    <button type="submit" class="btn-upper btn btn-warning checkout-page-button">{{ $result->ticketStatus }}</button></a></li>
                                                @elseif($result->ticketStatus == 'SUCCESS')
                                                    <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ $result->ticketStatus }}</button></a></li>
                                                @else
                                                    <button type="submit" class="btn-upper btn btn-default checkout-page-button">{{ $result->ticketStatus }}</button>
                                                @endif
                                                </a>
                                            </li>
                                        </ul>       
                                        <hr>
                                        <ul class="nav nav-checkout-progress list-unstyled">
                                            <li><a href="#">Harga / Tiket : {{ moneyFormat($result->adminFee->salesPrice) }}</a></li>
                                            <li><a href="#">Total Harga : {{ moneyFormat($result->adminFee->ticketPriceIDR) }}</a></li>
                                        </ul>       
                                        @endif
                                    </div>
                                    @if(($result->status == 'SUCCESS') && ($result->ticketStatus != 'SUCCESS') && ($result->ticketStatus != 'Canceled'))
                                    <form id="dataFormPage" action="{{ url('airlinee/booking/'.$record->id) }}" method="POST">
                                        {!! csrf_field() !!}
                                      <button type="button" class="btn btn-success darma-save-transaksi-render btn-lg btn-block" data-form="#dataFormPage">Bayar</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div> 
                    </div>
                    @if(isset($request['pulang_data']))
                    <div class="terms-conditions-page" style="margin-top: 0;">
                        <h3 class="section-title">Pilih Jadwal Kepulangan</h3>
                        <div class="col-md-12">
                            <form action="{{ url('airlinee/schedule') }}" method="GET">
    
                                <div class="container">
                                    <div class="row">
                                        <div class="panel panel-default">
                                            <div class="panel-body">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Dari</label>
                                                        <select name="origin" class="form-control selectpicker" required="" data-live-search="true"
                                                            data-dropup-auto="false" data-size="10">
                                                            @foreach ($cities as $city)
                                                            <option value="{{ $city->airport_code }}">
                                                                {{ $city->country_name . ', ' . $city->location_name . ' - ' . $city->airport_name . ' ( ' . $city->airport_code . ' )' }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Ke</label>
                                                        <select name="destination" class="form-control selectpicker" required=""
                                                            data-live-search="true" data-dropup-auto="false" data-size="10">
                                                            @foreach ($cities as $city)
                                                            <option value="{{ $city->airport_code }}">
                                                                {{ $city->country_name . ', ' . $city->location_name . ' - ' . $city->airport_name . ' ( ' . $city->airport_code . ' )' }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>Kelas Kabin</label>
                                                        <select name="cabinClass" class="form-control selectpicker" required=""
                                                            data-live-search="true" data-dropup-auto="false" data-size="10">
                                                            <option value="ECONOMY">Economy</option>
                                                            <option value="BUSSINES">Bussines</option>
                                                            <option value="FIRST">First</option>
                                                        </select>
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Tanggal Kepulangan</label>
                                                        <input type="text" name="departDate" class="form-control bots-date"
                                                            placeholder="Tanggal Kepulangan">
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Dewasa(12+)</label>
                                                        <input type="number" min="1" name="paxAdult" class="form-control" value="1">
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Anak (&#60;12thn)</label>
                                                        <input type="number" min="0" name="paxChild" class="form-control" value="0">
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label>Bayi(&#60;2thn)</label>
                                                        <input type="number" min="0" name="paxInfant" class="form-control" value="0">
                                                    </div>
                                                </div>
                            
                                                <div class="col-md-4 col-md-offset-8">
                                                    <button type="submit" class="btn btn-primary btn-block">Lihat Jadwal Penerbangan</button>
                                                </div>
                            
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
