@extends('layouts.scaffold')

@section('css')
<style>
  .outline-top {
    margin-top: 20px;
  }

  @media (max-width: 500px) {
    .outline-top {
      margin-top: 299px;
    }
  }
</style>
@endsection

@section('content-frontend')
<form id="dataFormPage" action="{{ url('travel/payment/'.$record->id) }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Detail Booking Travel</h2>
        <div class="container">
          <div class="checkout-box ">
            <div class="row">
              <div class="col-md-8">
                @if($getBooking && $getBooking->status == 'SUCCESS')
                  <div class="panel-group checkout-steps" id="accordion">
                    <div class="panel panel-default checkout-step-01">
                      <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                          <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                            <span>1</span> {{ $getBooking->origin or '' }} Ke {{ $getBooking->destination or ''  }}
                          </a>
                        </h4>
                      </div>

                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">       
                            <div class="col-md-12 col-sm-12 guest-login">
                              <h4 class="checkout-subtitle outer-top-vs">Detail Booking</h4>
                              <ul class="text instruction inner-bottom-30">
                                <li>- Travel ID : {{ $getBooking->shuttleID or '-' }}</li>
                                <li>- Booking Code : {{ $getBooking->bookingCode or '-' }}</li>
                                <li>- Booking Date : {{ $getBooking->bookingDate or '-' }}</li>
                                <li>- Keberangkatan : {{ $getBooking->origin or '-' }} - {{ $getBooking->originCity or '-' }}</li>
                                <li>- Tempat Keberangkatan : {{ $getBooking->originAddress or '-' }} </li>
                                <li>- Kedatangan : {{ $getBooking->destination or '-' }} - {{ $getBooking->destinationCity or '-' }}</li>
                                <li>- Tempat Kedatangan : {{ $getBooking->destinationAddress or '-' }}</li>
                                <li>- Total Pesanan Tiket : {{ $getBooking->totalTicket or '-' }}</li>
                                <li>- Harga Tiket : {{ moneyFormat($getBooking->ticketPrice) or '-' }}</li>
                                <li>- Status Tiket : {{ $getBooking->ticketStatus or '-' }}</li>
                                <li>- KODE OTP : {{ $getBooking->OTPCode or '-' }}</li>
                              </ul>

                            </div>
                            @if(($getBooking->status == 'SUCCESS') && ($getBooking->passengerInfos != null) && (count($getBooking->passengerInfos) > 0))
                            @foreach($getBooking->passengerInfos as $k => $value)
                            <div class="col-md-12">
                              <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="unicase-checkout-title">Detail Booking</h4>
                                    </div>
                                    <div class="">
                                      <ul>
                                        <li>- Full Name : {{ $value->name or '-' }}</li>
                                        <li>- Nomor Tempat Duduk : {{ $value->seatNo or '-' }}</li>
                                        <li>- Nomor Tiket : {{ $value->ticketNo or '-' }}</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                            @endif
                          </div>          
                        </div>
                      </div>
                    </div>
                  </div>
                @else
                <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                    <div class="text-center">
                        <b>Upss... Maaf data pesanan anda telah kadaluarsa!</b>
                        <br>
                        Silahkan pesan kembali
                    </div>
                </div>
                @endif
              </div>
              <div class="col-md-4">
                <div class="checkout-progress-sidebar ">
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="unicase-checkout-title">Data Diri Pemesan</h4>
                      </div>
                      <div class="">
                        <ul class="nav nav-checkout-progress list-unstyled">
                          <li><a>Nama : {{ $getBooking->contactName }}</a></li>
                          <li><a>No Tlp : {{ $getBooking->contactPhone }}</a></li>
                          <li><a>Alamat : {{ $getBooking->contactAddress }}</a></li>
                        </ul>    
                      </div>
                      
                      <div class="payment-method">
                          <div class="payment-accordion">
                              <div class="order-button-payment">
                                  <button type="button" class="btn btn-warning btn-lg btn-block">Status Tiket: {{ $getBooking->ticketStatus }}</button>

                                  @if($getBooking && ($getBooking->status == 'SUCCESS') && ($getBooking->ticketStatus != 'Ticketed') || ($getBooking->ticketStatus != 'Success') || ($getBooking->ticketStatus != 'SUCCESS'))
                                  <button type="button" class="btn btn-success btn-lg btn-block darma-save-transaksi-render" data-form="#dataFormPage">Bayar</button>
                                  @endif
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                </div> 

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('js')

@endsection
