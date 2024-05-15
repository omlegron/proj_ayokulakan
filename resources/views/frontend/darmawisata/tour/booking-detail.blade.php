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
<form id="dataFormPage">
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Detail Booking Kapal</h2>
        <div class="container">
          <div class="checkout-box ">
            <div class="row">
              <div class="col-md-8">
                @if($getBooking)
                @if($getBooking->status == 'SUCCESS')
                
                <div class="panel-group checkout-steps" id="accordion">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                          <span>1</span> {{ $getBooking->TourName }} 
                        </a>
                      </h4>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div class="row">       
                          <div class="col-md-12 col-sm-12 guest-login">
                            <h4 class="checkout-subtitle outer-top-vs">Detail Tour</h4>
                            <ul class="text instruction inner-bottom-30">
                              <li class="save-time-reg">- Nama Tour : {{ $getBooking->TourName or '-' }}</li>
                              <li>- Tanggal Booking :{{ $getBooking->BookingDate or '-' }}</li>
                              <li>- Tanggal Keberangkatan : {{ $getBooking->DepartDate or '-' }}</li>
                              <li>- Package Tour Name : {{ $getBooking->PackageTourName or '-' }}</li>
                              <li>- Durasi : {{ $getBooking->Duration or '-' }}</li>
                              <li>- Variasi Tour : {{ $getBooking->TourVariant or '-' }}</li>
                              <li>- Total Harga : {{ moneyFormat($getBooking->TotalPrice) }}</li>
                              <li>- Total DP : {{ moneyFormat($getBooking->DPAmount) }}</li>
                            </ul>

                          </div>
                          @if($getBooking)
                            @if($getBooking->status == 'SUCCESS')
                            <div class="col-md-12">
                              @if($getBooking->Pax && count($getBooking->Pax) > 0)
                                @foreach($getBooking->Pax as $k => $value)
                                <div class="col-md-6" style="padding-bottom: 10px">
                                  <div class="input-group">
                                      <span class="input-group-addon" >
                                        Detail Penumpang {{ $k+1 }}
                                      </span>
                                  </div>
                                  <div class="panel panel-default panel panel-body">
                                      <ul>
                                        <li>- Title : {{ $value->Title or '' }}</li>
                                        <li>- Nama : {{ $value->Name or '' }}</li>
                                      </ul>
                                  </div>
                                </div>
                                @endforeach
                              @endif
                            </div>
                            @else
                            <div class="col-md-12">
                              <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="unicase-checkout-title">Detail Pemesan</h4>
                                    </div>
                                    <div class="">
                                      <center>Data Pemesan Tidak Diketahui. Silahkan Pesan Ulang Kembali</center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endif
                          @else
                            <div class="col-md-12">
                              <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="unicase-checkout-title">Detail Pemesan</h4>
                                    </div>
                                    <div class="">
                                      <center>Data Pemesan Tidak Diketahui. Silahkan Pesan Ulang Kembali</center>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          @endif
                        </div>          
                      </div>
                    </div>
                  </div>
                </div>
                @else
                <div class="col-md-12">
                  <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                      <div class="text-center">
                          <b>Upss... sepertinya anda tidak menemukan apa2 disini!</b>
                          <br>
                          Maaf Data Pesanan Anda Telah Kadaluarsa
                      </div>
                  </div>
                </div>
                @endif
                @else
                <div class="col-md-12">
                  <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                      <div class="text-center">
                          <b>Upss... sepertinya anda tidak menemukan apa2 disini!</b>
                          <br>
                          Maaf Data Pesanan Anda Telah Kadaluarsa
                      </div>
                  </div>
                </div>
                @endif
              </div>
              <div class="col-md-4">
                <div class="checkout-progress-sidebar ">
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="unicase-checkout-title">Data Akun Pemesan</h4>
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
                      @if($getBooking)
                      @if($getBooking->status == 'SUCCESS')
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="order-button-payment">
                                    <button type="button" class="btn btn-warning btn-lg btn-block">Total DP : {{ moneyFormat($getBooking->DPAmount) }}</button>
                                    <button type="button" class="btn btn-warning btn-lg btn-block">Total Harga : {{ moneyFormat($getBooking->TotalPrice) }}</button>
                                    <button type="button" class="btn btn-warning btn-lg btn-block">Status Tiket: {{ $getBooking->TicketStatus }}</button>
                                    
                                </div>
                            </div>
                        </div>
                      @endif
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
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
months = [ "January", "February", "March", "April", "May", "June",
"July", "August", "September", "October", "November", "December" ];
$.fn.datepicker.dates['id'] = {
    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    today: "Today",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
};

$('.bots-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
});
</script>
@endsection
