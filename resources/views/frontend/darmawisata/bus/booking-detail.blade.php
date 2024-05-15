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
<form id="dataFormPage" action="{{ url('bus/payment/'.$record->id) }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Detail Booking Bus / Travel</h2>
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
                            <span>1</span> {{ $getBooking->operatorName }}
                          </a>
                        </h4>
                      </div>

                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">       
                            <div class="col-md-12 col-sm-12 guest-login">
                              <h4 class="checkout-subtitle outer-top-vs">Detail Booking</h4>
                              <ul class="text instruction inner-bottom-30">
                                <li class="save-time-reg">- Tipe : {{ $getBooking->bus or '-' }}</li>
                                <li>- Bus / Travel : {{ $getBooking->operatorName or '-' }}</li>
                                <li>- Booking Code : {{ $getBooking->bookingCode or '-' }}</li>
                                <li>- Booking Date : {{ $getBooking->bookingDate or '-' }}</li>
                                <li>- Terminal Keberangkatan : {{ $getBooking->originTerminal or '-' }}</li>
                                <li>- Terminal Kesampaian : {{ $getBooking->destinationTerminal or '-' }}</li>
                                <li>- Waktu Keberangkatan : {{ $getBooking->departTime or '-' }}</li>
                                <li>- Total Pesanan Tiket : {{ $getBooking->totalTicket or '-' }}</li>
                                <li>- Harga Tiket : {{ $getBooking->ticketPrice or '-' }}</li>
                                <li>- Status Tiket : {{ $getBooking->ticketStatus or '-' }}</li>
                              </ul>

                            </div>
                            @if(($getBooking->status == 'SUCCESS') && !is_null($getBooking->passengers) && (count($getBooking->passengers) > 0))
                            @foreach($getBooking->passengers as $k => $value)
                            <div class="col-md-12">
                              <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="unicase-checkout-title">Detail Booking</h4>
                                    </div>
                                    <div class="">
                                      <ul>
                                        <li>- Title : {{ $value->title or '-' }}</li>
                                        <li>- First Name : {{ $value->firstName or '-' }}</li>
                                        <li>- Last Name : {{ $value->lastName or '-' }}</li>
                                        <li>- Type Identity : {{ $value->identityType or '-' }}</li>
                                        <li>- Identity : {{ $value->identity or '-' }}</li>
                                        <li>- phone : {{ $value->phone or '-' }}</li>
                                        <li>- email : {{ $value->email or '-' }}</li>
                                        <li>- Type : {{ $value->paxType or '-' }}</li>
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
                          <li><a>Nama : {{ $user->nama }}</a></li>
                          <li><a>Negara : {{ ($user->negara) ? $user->negara->negara : '' }}</a></li>
                          <li><a>Provinsi : {{ ($user->provinsi) ? $user->provinsi->provinsi : '' }}</a></li>
                          <li><a>Kabupaten : {{ ($user->kota) ? $user->kota->kota : '' }}</a></li>
                          <li><a>Kecamatan : {{ ($user->kecamatan) ? $user->kecamatan->kecamatan : '' }}</a></li>
                          <li><a>Alamat : {{ $user->alamat }}</a></li>
                          <li><a>Kode : {{ $user->kode_pos }}</a></li>
                          <li><a>Email : {{ $user->email }}</a></li>
                          <li><a>No : {{ $user->hp }}</a></li>
                        </ul>    
                        <textarea name="alamat" readonly="" style="display: none">{{ $user->alamat or '' }}</textarea>
                      </div>
                      
                      <div class="payment-method">
                          <div class="payment-accordion">
                              <div class="order-button-payment">
                                  @php
                                    $btn = 'btn-success';
                                    if($getBooking->ticketStatus == 'HOLD'){
                                      $btn = 'btn-danger';
                                    }elseif($getBooking->ticketStatus == 'Canceled'){
                                      $btn = 'btn-warning';
                                    }elseif($getBooking->ticketStatus == 'Processed'){
                                      $btn = 'btn-primary';
                                    }elseif($getBooking->ticketStatus == 'Ticketed'){
                                      $btn = 'btn-success';
                                    } 
                                  @endphp
                                  
                                  <button type="button" class="btn {{ $btn }} btn-lg btn-block">Status Tiket: {{ $getBooking->ticketStatus }}</button>

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
