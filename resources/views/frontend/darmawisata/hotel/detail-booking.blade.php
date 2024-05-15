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
<form id="dataFormPage" action="{{ url('hotel/bayar/'.$record->id) }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Detail Booking Hotel</h2>
        <div class="container">
          <div class="checkout-box ">
            <div class="row">
              <div class="col-md-8">
               
                <div class="col-md-12">
                 
                </div>
                <div class="panel-group checkout-steps" id="accordion">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                          <span>1</span> {{ $record->hotelName }}
                        </a>
                      </h4>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div class="row">       
                          <div class="col-md-12 col-sm-12 guest-login">
                            <h4 class="checkout-subtitle outer-top-vs">Detail Hotel</h4>
                            <ul class="text instruction inner-bottom-30">
                              <li class="save-time-reg">- Nama Hotel : {{ $record->hotelName or '-' }}</li>
                              <li>- Deskripsi Hotel :<p>{!! $getHotel->description or '-' !!}</p></li>
                              <li>
                                - Rating Hotels : 
                                @if($record->rating && $getHotel->rating && $getHotel->rating > 0)
                                @php
                                $totalStar = $getHotel->rating;
                                $cekStar = 5 - $totalStar;
                                @endphp
                                @for($i = 0; $i < $totalStar; $i++)
                                <span><i class="fa fa-star" style="color:#ff7429;"></i></span>
                                @endfor

                                @for($i1 = 0; $i1 < $cekStar; $i1++)
                                <span><i class="fa fa-star-o"></i></span>
                                @endfor

                                @else
                                @for($i = 0; $i < 5; $i++)
                                <span ><i class="fa fa-star-o" ></i></span>
                                @endfor
                                @endif
                              </li>
                              <li>- Email Hotel : {{ $record->email or '-' }}</li>
                              <li>- Alamat Hotel : {{ $record->alamat or '-' }}</li>
                              <li>- Pesan : {!! $record->message or '-' !!}</li>
                              <li>- No Telp : {{ $record->phone or '-' }}</li>
                              <li>- Website : {{ $record->website or '-' }}</li>
                            </ul>

                          </div>
                          <div class="col-md-12">
                            <div class="checkout-progress-sidebar ">
                              <div class="panel-group">
                                <div class="panel panel-default">
                                  <div class="panel-heading">
                                    <h4 class="unicase-checkout-title">Detail Booking</h4>
                                  </div>
                                  <div class="">
                                    <ul>
                                      <li>- Tanggal Boking : {{ $record->created_at or '' }}</li>
                                      <li>- ID Ruangan / Kamar : {{ $record->roomID or '' }}</li>
                                      <li>- Check In : {{ $record->checkInDate or '' }}</li>
                                      <li>- Check Out : {{ $record->checkOutDate or '' }}</li>
                                    </ul>
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
                      @if($getBooking->status == 'SUCCESS')
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="order-button-payment">
                                    @php
                                      $btn = 'btn-success';
                                      if($getBooking->bookingDetail->bookingStatus == 'Failed'){
                                        $btn = 'btn-danger';
                                      }elseif($getBooking->bookingDetail->bookingStatus == 'Pending'){
                                        $btn = 'btn-warning';
                                      }elseif($getBooking->bookingDetail->bookingStatus == 'Accept'){
                                        $btn = 'btn-success';
                                      } 
                                    @endphp
                                    
                                    <button type="button" class="btn btn-warning btn-lg btn-block">{{ moneyFormat($record->price) }}</button>
                                    
                                    <button type="button" class="btn {{ $btn }} btn-lg btn-block">Status Tiket: {{ $getBooking->bookingDetail->bookingStatus }}</button>

                                    @if($getBooking->bookingDetail && ($record->bookingStatus != 'Accept'))
                                    <button type="button" class="btn btn-success btn-lg btn-block darma-save-transaksi-render" data-form="#dataFormPage">Bayar</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                      @else
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="order-button-payment">
                                    @php
                                      $btn = 'btn-success';
                                      if($record->bookingStatus == 'Failed'){
                                        $btn = 'btn-danger';
                                      }elseif($record->bookingStatus == 'Pending'){
                                        $btn = 'btn-warning';
                                      }elseif($record->bookingStatus == 'Accept'){
                                        $btn = 'btn-success';
                                      } else{
                                        $btn = 'btn-warning';
                                      }
                                    @endphp
                                    
                                    <button type="button" class="btn btn-warning btn-lg btn-block">{{ moneyFormat($record->price) }}</button>
                                    
                                    <button type="button" class="btn {{ $btn }} btn-lg btn-block">Status Tiket: {{ ($getBooking->bookingDetail) ? $getBooking->bookingDetail->bookingStatus : ($record->bookingStatus) ? $record->bookingStatus : 'Pending' }}</button>

                                    @if($record && ($record->bookingStatus != 'Accept'))
                                    <button type="button" class="btn btn-success btn-lg btn-block darma-save-transaksi-render" data-form="#dataFormPage">Bayar</button>
                                    @endif
                                </div>
                            </div>
                        </div>

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
</form>
@endsection

@section('js')

@endsection
