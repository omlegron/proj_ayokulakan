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
<form id="dataFormPage" action="{{ url('kapal/bayar/'.$record->id) }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Booking Kapal 
          @php
            $first = \Carbon\Carbon::now();
            $second = ($record->transaksi) ? \Carbon\Carbon::parse($record->transaksi->transaction_time_expiry) : \Carbon\Carbon::now();
            $last = $second->diffInMinutes($first);
            $lastTime = date('H:i:s', $last);

            // booked
            $third = ($record->issuedDateTimeLimit) ? \Carbon\Carbon::parse($record->issuedDateTimeLimit) : \Carbon\Carbon::now();
            $lastBooked = $third->diffInMinutes($first);

          @endphp
          @if($getBooking->ticketStatus && ($getBooking->ticketStatus != 'Ticketed'))
            @if($record->transaksi)
              @if($record->transaksi->transaction_status == '-')
                @if($first < $second)
                  | Limit waktu pembayaran : <small id="limitWaktu"></small>
                @else
                  | Limit waktu pembayaran : <small>Transaksi DiBatalkan</small>
                @endif
              @endif
            @else
            | Limit waktu pembayaran : <small id="limitWaktuBookings"></small>
            @endif
          @endif
        </h2>
        <div class="container">
          <div class="checkout-box ">
            <div class="row">
              <div class="col-md-8">
                @if($getBooking)
                @if($getBooking->status == 'SUCCESS')
                <div class="col-md-12">
                  <input type="hidden" name="originPort" value="{{ $getBooking->originPort or '' }}">
                  <input type="hidden" name="originCall" value="{{ $getBooking->originCall or '' }}">
                  <input type="hidden" name="destinationPort" value="{{ $getBooking->destinationPort or '' }}">
                  <input type="hidden" name="destinationCall" value="{{ $getBooking->destinationCall or '' }}">
                  <input type="hidden" name="shipNumber" value="{{ $getBooking->shipNumber or '' }}">
                  <input type="hidden" name="departDate" value="{{ \Carbon\Carbon::parse($getBooking->departDateTime)->format('Y-m-d') }}">
                  <input type="hidden" name="accessToken" value="{{ $getBooking->accessToken or '' }}">
                </div>
                <div class="panel-group checkout-steps" id="accordion">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                          <span>1</span> {{ $getBooking->shipName }}  - {{ $getBooking->shipNumber }}
                        </a>
                      </h4>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div class="row">       
                          <div class="col-md-12 col-sm-12 guest-login">
                            <h4 class="checkout-subtitle outer-top-vs">Detail Kapal</h4>
                            <ul class="text instruction inner-bottom-30">
                              <li class="save-time-reg">- Nama Kapal : {{ $getBooking->shipName or '-' }}</li>
                              <li>- Nomor Kapal :{{ $getBooking->shipNumber or '-' }}</li>
                              <li>- Keberangkatan :{{ ($origin) ? $origin->originName : '-' }}</li>
                              <li>- Tujuan Keberangkatan : {{ ($deperature) ? $deperature->originName : '-' }}</li>
                              <li>- Waktu Keberangkatan : {{ $getBooking->departDateTime or '-' }}</li>
                              <li>- Waktu Tiba : {{ $getBooking->arrivalDateTime or '-' }}</li>
                            </ul>

                          </div>
                          @if($getBooking)
                            @if($getBooking->status == 'SUCCESS')
                            <div class="col-md-12">
                              @if(count($getBooking->paxBookingDetails) > 0)
                                @foreach($getBooking->paxBookingDetails as $k => $value)
                                <div class="col-md-6" style="padding-bottom: 10px">
                                  <div class="input-group">
                                      <span class="input-group-addon" >
                                        Detail Penumpang {{ $k+1 }}
                                      </span>
                                  </div>
                                  <div class="panel panel-default panel panel-body">
                                      <ul>
                                        <li>- Nama : {{ $value->paxName or '' }}</li>
                                        <li>- Tipe : {{ $value->paxType or '' }}</li>
                                        <li>- Jenis Kelamin : {{ ($value->paxGender == 'M') ? 'Laki - laki' : 'Perempuan' }}</li>
                                        <li>- Tanggal Kelahiran : {{ $value->birthDate or '' }}</li>
                                        <li>- Nomor Telp / Hp : {{ $value->phone or '' }}</li>
                                        <li>- Deck : {{ $value->deck or '' }}</li>
                                        <li>- Kabin : {{ $value->cabin or '' }}</li>
                                        <li>- Bed : {{ $value->bed or '' }}</li>
                                        <li>- Harga Tiket : {{ moneyFormat($value->fare) }}</li>
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
                                    
                                    <button type="button" class="btn btn-warning btn-lg btn-block">Total Harga : {{ moneyFormat($getBooking->ticketPrice) }}</button>
                                    <button type="button" class="btn {{ $btn }} btn-lg btn-block">Status Tiket: {{ $getBooking->ticketStatus }}</button>
                                    
                                    @if($getBooking->ticketStatus != 'Ticketed')
                                      <button type="button" class="btn btn-success darma-save-dynamic btn-lg btn-block" data-form="#dataFormPage">Bayar</button>
                                      <!-- <button type="button" class="btn btn-success darma-save-transaksi-render btn-lg btn-block" data-form="#dataFormPage">Bayar</button> -->
                                    @endif
                                    
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
@if($record->transaksi)
<script>
// Set the date we're counting down to

var countDownDate = new Date('{{ \Carbon\Carbon::now() }}');
var cekExpy = new Date('{{ ($record->transaksi) ? \Carbon\Carbon::parse($record->transaksi->transaction_time_expiry) : \Carbon\Carbon::now() }}');
console.log('cekExpy',cekExpy)
console.log('countDownDate',countDownDate)
countDownDate.setMinutes("{{ $last }}");
countDownDate.getTime();

// Update the count down every 1 second
var x = setInterval(function() {

  // Get today's date and time
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("limitWaktu").innerHTML = days + "d " + hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("limitWaktu").innerHTML = "0 Menit Waktu Habis.";
  }
}, 1000);
</script>
@else
<script>
// Set the date we're counting down to

var countDownDateBooked = new Date('{{ \Carbon\Carbon::now() }}');
var cekExpyBooked = new Date('{{ isset($record->issuedDateTimeLimit) ? \Carbon\Carbon::parse($record->issuedDateTimeLimit) : \Carbon\Carbon::now() }}');
console.log('cekExpyBooking',cekExpyBooked)
console.log('countDownDateBooking',countDownDateBooked)
countDownDateBooked.setMinutes("{{ $lastBooked }}");
countDownDateBooked.getTime();

// Update the count down every 1 second
var xBooked = setInterval(function() {

  // Get today's date and time
  var nowBooked = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distanceBooked = countDownDateBooked - nowBooked;
    
  // Time calculations for days, hours, minutes and seconds
  var daysBooked = Math.floor(distanceBooked / (1000 * 60 * 60 * 24));
  var hoursBooked = Math.floor((distanceBooked % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutesBooked = Math.floor((distanceBooked % (1000 * 60 * 60)) / (1000 * 60));
  var secondsBooked = Math.floor((distanceBooked % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  console.log('celBooked',daysBooked + "d " + hoursBooked + "h "
  + minutesBooked + "m " + secondsBooked + "s ")
  document.getElementById("limitWaktuBookings").innerHTML = daysBooked + "d " + hoursBooked + "h "
  + minutesBooked + "m " + secondsBooked + "s ";
    
  // If the count down is over, write some text 
  if (distanceBooked < 0) {
    clearInterval(xBooked);
    document.getElementById("limitWaktuBookings").innerHTML = "0 Menit Waktu Habis.";
  }
}, 1000);
</script>
@endif
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
