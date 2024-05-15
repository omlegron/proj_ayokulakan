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
<form id="dataFormPage" action="{{ url('kapal/booking') }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Booking Kapal | Limit waktu booking : 
          @if($resRoom->bookTimeLimit > 0)
            <small id="limitWaktu"></small>
          @else
            <small>0 Menit Waktu Habis.</small>
          @endif
        </h2>
        <div class="container">
          <div class="checkout-box ">
            <div class="row">
              <div class="col-md-8">
                @if($resAvail)
                @if($resAvail->status == 'SUCCESS')
                <div class="col-md-12">
                  <input type="hidden" name="originPort" value="{{ $resAvail->originPort or '' }}">
                  <input type="hidden" name="originCall" value="{{ $resAvail->originCall or '' }}">
                  <input type="hidden" name="destinationPort" value="{{ $resAvail->destinationPort or '' }}">
                  <input type="hidden" name="destinationCall" value="{{ $resAvail->destinationCall or '' }}">
                  <input type="hidden" name="shipNumber" value="{{ $resAvail->shipNumber or '' }}">
                  <input type="hidden" name="departDate" value="{{ \Carbon\Carbon::parse($resAvail->departDate)->format('Y-m-d') }}">
                  <input type="hidden" name="accessToken" value="{{ $resAvail->accessToken or '' }}">
                  <input type="hidden" name="kelasKapal" value="{{ $request->kelasKapal }}">
                </div>
                <div class="panel-group checkout-steps" id="accordion">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                          <span>1</span> Nomor Kapal {{ $resAvail->shipNumber }} - Sub Class {{ $resAvail->subClass }}
                        </a>
                      </h4>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div class="row">       
                          <div class="col-md-12 col-sm-12 guest-login">
                            <h4 class="checkout-subtitle outer-top-vs">Detail Kapal</h4>
                            <ul class="text instruction inner-bottom-30">
                              <li class="save-time-reg">- Nama Kapal : {{ $resAvail->shipNumber or '-' }}</li>
                              <li>- Keberangkatan :{{ ($origin) ? $origin->originName : '-' }}</li>
                              <li>- Tujuan Keberangkatan : {{ ($deperature) ? $deperature->originName : '-' }}</li>
                              <li>- Tanggal Keberangkatan : {{ $resAvail->departDate or '-' }}</li>
                              <li>- Nomor Kapal : {{ $resAvail->shipNumber or '-' }}</li>
                              <li>- Sub Class : {{ $resAvail->subClass or '-' }}</li>
                              <li>- Info Lainnya : {{ $resAvail->availabilityInfo or '-' }}</li>
                            </ul>

                          </div>
                          @if($resRoom)
                            @if($resRoom->status == 'SUCCESS')
                            <input type="hidden" name="numCode" value="{{ $resRoom->numCode or '' }}">
                            <div class="col-md-12">
                              <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="unicase-checkout-title">Detail Pemesan</h4>
                                    </div>
                                    <div class="">
                                      <ul>
                                        <li>- Nama Pemesan : {{ $resRoom->ticketBuyerName or '' }}</li>
                                        <li>- Email Pemesan : {{ $resRoom->ticketBuyerEmail or '' }}</li>
                                        <li>- Alamat Pemesan : {{ $resRoom->ticketBuyerAddress or '' }}</li>
                                        <li>- Nomor Tlp Pemesan : {{ $resRoom->ticketBuyerPhone or '' }}</li>
                                      </ul>
                                    </div><br>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="col-md-12">
                              @if(count($resRoom->rooms) > 0)
                                @foreach($resRoom->rooms as $k => $value)
                                <div class="col-md-4" style="padding-bottom: 10px">
                                  <div class="input-group">
                                      <span class="input-group-addon" >
                                        Penempatan {{ $k+1 }}
                                      </span>
                                  </div>
                                  <div class="panel panel-default panel panel-body">
                                      <h6 class="">Deck : {{ $value->deck }}</h6>
                                      <h6 class="">Kabin : {{ $value->cabin }}</h6>
                                      <h6 class="">Bed : {{ $value->bed }}</h6>
                                  </div>
                                </div>
                                @endforeach
                              @endif
                            </div>
                            <div class="col-md-12" style="max-height: 500px;overflow-y: scroll;overflow-x: visible;">
                              @php
                                $pax = -1;
                              @endphp
                              @if($request->pax)
                                @if(count($request->pax) > 0)
                                  @foreach($request->pax as $k => $value)
                                    @if((int)$value['paxTotal'] > 0)
                                      @for($i = 0; $i < (int)$value['paxTotal']; $i++)
                                        @php
                                          $pax++;
                                        @endphp

                                        <div class="col-md-12" style="padding-bottom: 10px">
                                          <div class="input-group">
                                              <span class="input-group-addon" >
                                                Penumpang {{ $value['paxType'] }}
                                              </span>
                                          </div>
                                          <div class="panel panel-default panel panel-body" >
                                              <div class="row">
                                                <div class="col-md-6">
                                                  <label>First Name</label>  
                                                  <input type="text" name="paxDetails[{{ $pax }}][firstName]" class="form-control" placeholder="First Name">
                                                </div>
                                                <div class="col-md-6">
                                                  <label>Last Name</label>  
                                                  <input type="text" name="paxDetails[{{ $pax }}][lastName]" class="form-control" placeholder="Last Name">
                                                </div>
                                                <div class="col-md-6">
                                                  <label>Phone</label>  
                                                  <input type="text" name="paxDetails[{{ $pax }}][phone]" class="form-control" placeholder="Phone" minlength="12" maxlength="13" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                                                </div>
                                                <div class="col-md-6">
                                                  <label>Birth Date</label>  
                                                  <input type="text" name="paxDetails[{{ $pax }}][birthDate]" class="form-control bots-date" placeholder="Birth Date">
                                                </div>
                                                <input type="hidden" name="paxDetails[{{ $pax }}][ID]" value="{{ str_random(6) }}">
                                                <input type="hidden" name="paxDetails[{{ $pax }}][paxType]" value="{{ $value['paxType'] }}">
                                                <input type="hidden" name="paxDetails[{{ $pax }}][paxGender]" value="{{ $value['paxGender'] }}">
                                              </div>
                                          </div>
                                        </div>
                                      @endfor
                                    @endif
                                  @endforeach
                                @endif
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
                          Silahkan ulangi pencarian
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
                          Silahkan ulangi pencarian
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
                      @if($resRoom)
                      @if($resRoom->status == 'SUCCESS')
                        <div class="payment-method">
                            <div class="payment-accordion">
                                <div class="order-button-payment">
                                   
                                    <button type="button" class="btn btn-success darma-save-render btn-lg btn-block" data-form="#dataFormPage">Pesan</button>
                                    
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

<script>
// Set the date we're counting down to
var countDownDate = new Date();
countDownDate.setMinutes("{{$resRoom->bookTimeLimit}}");
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
