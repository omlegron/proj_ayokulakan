@extends('layouts.scaffold')

@section('css')
<style type="text/css">
  /* CHECKED STYLES */
input[type=checkbox]:checked ~ img {
  outline: 2px solid blue;
}
</style>
@endsection

@section('content-frontend')

<form id="dataFormPage" action="{{ url('travel/booking') }}" method="POST">
  {!! csrf_field() !!}
  <div class="container outer-top">
    <div class="row">
      <div class="col-md-12">
        <input type="hidden" name="accessToken" value="{{ $request->accessToken }}">
        <input type="hidden" name="shuttleID" value="{{ $request->shuttleID }}">
        <input type="hidden" name="departDate" value="{{ $request->departDate }}">
        <input type="hidden" name="directionID" value="{{ $request->directionID }}">
        <input type="hidden" name="scheduleCode" value="{{ $request->scheduleCode }}">
        <input type="hidden" name="totalTicket" value="{{ $request->totalTicket }}">
        <input type="hidden" name="specialLayoutID" value="{{ $request->specialLayoutID }}">

      </div>
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-5">
              <ul>
                <li>
                  <img src="{{ asset('Kursi-Kosong.png') }}" style="cursor: pointer;">
                  : Kosong
                </li>
                <li>
                  <img src="{{ asset('Kursi-Terisi.png') }}" style="cursor: pointer;">
                  : Terisi
                </li>
                <li>
                  <img src="{{ asset('Kursi-Kosong.png') }}" style="cursor: pointer;outline: 2px solid blue;">
                  : Kursi Anda
                </li>
              </ul>
            </div>
            <div class="col-md-7">
              <div class="panel-body">
                <div class="row"> 
                  <h5>Pilih Tempat</h5>  
                  <table class="">
                    <tbody>
                      @if($result->status == 'SUCCESS')

                      @if(count($resReal) > 0)
                      @foreach($resReal as $k => $value)
                      <tr valign="center">
                        @if(count($value) > 0)
                        @foreach($value as $k1 => $value2)
                        @if($value2->isAvailaible == true)
                        <td valign="center" style="text-align: right;width: 65px">

                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-seat-bus" aria-checked="" tabindex="0"  name="seats[]" value="{{ $value2->seatNumber }}" style="position: absolute;transform: scale(2.4);position: relative;right:15px;top:20px" >
                            <img src="{{ asset('Kursi-Kosong.png') }}" style="cursor: pointer;">
                            <!-- <label class="custom-control-label labels-custom label-custom-ready" for="customCheck"><span style="">{{ $value2->seatNumber }} - {{ $value2->column+1 }} </span></label> -->
                          </div>

                        </td>
                        @else
                        <td valign="center" style="text-align: right;width: 65px">
                          <img src="{{ asset('Kursi-Terisi.png') }}">
                        </td>
                        @endif
                        @endforeach
                        @endif
                      </tr>
                      @endforeach
                      @endif

                      @else
                      <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                        <div class="text-center">
                          <b>Upss... Maaf untuk saat ini data kursi tidak ditemukan / Sudah Penuh!</b>
                          <br>
                          Silahkan ulangi pencarian
                        </div>
                      </div>
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>
            </div>  

            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">
                    <h4>Detail Pemesan</h4>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <input required type="text" placeholder="Full Name" name="contactName"
                                class="form-control" value="{{ (\Auth::check()) ? auth()->user()->nama : '' }}">
                        </div>

                        <div class="col-md-6">
                            <input required type="text" placeholder="No Telepon" name="contactPhone"
                                class="form-control" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" value="{{ (\Auth::check()) ? auth()->user()->hp : '' }}">
                            format telepon : 085212341234
                        </div>

                        <div class="col-md-6">
                            <input required type="email" placeholder="Alamat Email" name="contactEmail"
                                class="form-control" value="{{ (\Auth::check()) ? auth()->user()->email : '' }}">
                        </div>

                        <div class="col-md-6">
                            <input required type="text" placeholder="Alamat Rumah" name="contactAddress"
                                class="form-control" value="{{ (\Auth::check()) ? auth()->user()->alamat : '' }}">
                        </div>
                    </div>
                </div>
              </div>
              @php
              $no = -1;
              @endphp
              <div class="checkout-box ">
                <div class="row" >
                  <div class="panel-group checkout-steps" id="adult">
                    <div class="panel panel-default checkout-step-01">
                      <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                          <a data-toggle="collapse" class="" data-parent="#adult" href="#collapseAdult">
                            <span>-</span> Penumpang
                          </a>
                        </h4>
                      </div>

                      <div id="collapseAdult" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">   
                            @for($i=0; $i < $request->totalTicket; $i++)
                            @php
                            $no++;
                            @endphp
                            <div class="panel panel-default checkout-step-01">
                              <div class="panel-heading">
                                <h4 class="unicase-checkout-title">
                                  <a href="javascipt:void(0)">
                                    <span>{{ $i+1 }}</span> 
                                  </a>
                                </h4>
                              </div>
                              <div class="panel-body">
                                
                                <div class="col-md-6">
                                  <label>Full Name</label>
                                  <div class="form-group">
                                    <input type="text" name="paxNames[{{ $no }}]" class="form-control" placeholder="Full Name">
                                  </div>
                                </div>

                              </div>
                            </div>
                            @endfor
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
        <div class="row">
          <div class="col-md-12">
            <div class="btn btn-primary btn-block darma-save-render pull-right" data-form="#dataFormPage">
              Lanjutkan Booking
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

@section('js')
<script type="text/javascript">
  $(document).on('click','.custom-seat-bus',function(e){
    var totalAwal = parseInt("{{ !is_null($request->totalTicket) ? $request->totalTicket : 0 }}");
    var total = $('.custom-seat-bus:checked').length;

    console.log('totalAwal',totalAwal)
    console.log('total',total)
    if(total > totalAwal){
      e.preventDefault();
      swal(
        'Gagal',
        `<div class="sidebar-widget wow fadeInUp outer-top-vs animated" style="visibility: visible; animation-name: fadeInUp;">
        <h3 class="section-title text-warning">Total Data Tidak Boleh Melebihi Dari `+totalAwal+` Pesanan</h3>
        <div class="sidebar-widget-body" >
        <div class="compare-report">
        <ul class="list text-left bold" style="font-size:16px;list-style:inside;">
        <li><small>Total Penumpang / Seat Harus : {{ $request->totalTicket }}</small></li>
        </ul>
        </div>
        </div>
        </div>`,
        'warning'
        )
    }
  });
</script>
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
  $('.bots-month').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'MM',
    language:'id'
  });
  $('.bots-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
  });
  var date = new Date();
  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

  $('.start-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,
  }).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.end-date').datepicker('setStartDate', minDate);
  });

  $('.end-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
  }).on('changeDate', function (selected) {
    var maxDate = new Date(selected.date.valueOf());
    $('.start-date').datepicker('setEndDate', maxDate);
  });
  $('.input-daterange').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,

  });
</script>
@endsection
