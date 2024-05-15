@extends('layouts.scaffold')

@section('styles')
<meta name="asset-url" content="{{ config('app.url') }}">
<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">

@endsection

@section('scripts')
{{-- <script src="{{ asset('js/vueapp.js') }}" defer></script> --}}
<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script>
    $(document).ready(function() {
        $('.bots-date').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
        });
    });
</script>
@endsection

@section('content-frontend')
{{-- <div id="vueapp">
    <passenger-component :passengers="{
        adult: 1,
        child: 0,
        infant: 0
    }"></passenger-component>
</div> --}}

<div class="terms-conditions-page container" >
    @if (($prices->status === 'FAILED') && ($schedule->status == 'FAILED'))
        <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
            @if(($capthPrice == null) && ($capthSche == null))
            <div class="text-center">
                <b>Upss... Maaf untuk saat ini penerbangan tidak tersedia!</b>
                <br>
                Silahkan ulangi pencarian
            </div>
            @else
            <form action="{{ url('airlinee/cart-schedule/' . $request->accessToken) }}" method="POST">
            {!! csrf_field() !!}
            
            @foreach($request->all() as $k => $value)
            <input type="hidden" name="{{ $k }}" value="{{ $value }}">
            @endforeach

            @if($capthPrice != null)
            <div class="col-md-6">
                <img src="{{ $capthPrice }}">
                <input type="text" name="airlineAccessCode1" class="form-control" placeholder="Re-Captcha">
            </div>
            @else
            <input type="hidden" name="airlineAccessCode1" value="{{ $request->airlineAccessCode1 }}">
            @endif

            @if($capthSche != null)
            <div class="col-md-6">
                <img src="{{ $capthSche }}">
                <input type="text" name="airlineAccessCode2" class="form-control" placeholder="Re-Captcha">
            </div>
            @else
            <input type="hidden" name="airlineAccessCode2" value="{{ $request->airlineAccessCode2 }}">
            @endif

            <div class="col-md-12" style="padding-top: 5px">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
            </div>
            </form>
            @endif
        </div>
    @else
    <form id="dataFormPage" action="{{ url('airlinee/price-booking') }}" method="POST" >
        {!! csrf_field() !!}
        <input type="hidden" name="accessToken" value="{{ $accessToken }}">
        <input type="hidden" name="airlineID" value="{{ $request->airlineID }}">
        <input type="hidden" name="origin" value="{{ $request->origin }}">
        <input type="hidden" name="destination" value="{{ $request->destination }}">
        <input type="hidden" name="tripType" value="{{ $request->tripType }}">
        <input type="hidden" name="departDate" value="{{ $request->departDate }}">
        <input type="hidden" name="returnDate" value="{{ $request->returnDate }}">
        <input type="hidden" name="paxAdult" value="{{ $request->paxAdult }}">
        <input type="hidden" name="paxChild" value="{{ $request->paxChild }}">
        <input type="hidden" name="paxInfant" value="{{ $request->paxInfant }}">
        <input type="hidden" name="pulang_data" value="{{ $request->pulang_data }}">
        <input type="hidden" name="pulang_pergi" value="{{ $request->pulang_pergi }}">

        <input type="hidden" name="schDeparts[0][airlineCode]" value="{{ $request->airlineCode }}">
        <input type="hidden" name="schDeparts[0][flightNumber]" value="{{ $request->flightNumber }}">
        <input type="hidden" name="schDeparts[0][flightClass]" value="{{ $request->flightClass }}">
        <input type="hidden" name="schDeparts[0][schOrigin]" value="{{ $request->origin }}">
        <input type="hidden" name="schDeparts[0][schDestination]" value="{{ $request->destination }}">
        <input type="hidden" name="schDeparts[0][detailSchedule]" value="{{ $request->schDepart }}">
        <input type="hidden" name="schDeparts[0][schDepartTime]" value="{{ $request->departTime }}">
        <input type="hidden" name="schDeparts[0][schArrivalTime]" value="{{ $request->arrivalTime }}">
        <input type="hidden" name="schDeparts[0][garudaNumber]" value="{{ isset($prices->priceDepart[0]) ? $prices->priceDepart[0]->garudaNumber : ' ' }}">
        <input type="hidden" name="schDeparts[0][garudaAvailability]" value="{{ isset($prices->priceDepart[0]) ? $prices->priceDepart[0]->garudaNumber : ' ' }}">
        <!-- PILIH PENERBANGAN -->
        <div class="checkout-box ">
            <div class="row" style="max-height: 500px;overflow-x: scroll;overflow-y: scroll;">
                @if($schedule->status != 'FAILED')
                @if(count($schedule->journeyDepart) > 0)
                @foreach ($schedule->journeyDepart as $k => $depart)
                @if(count($depart->segment) == 1)
                <div class="col-md-12">
                    <div class="panel-group checkout-steps" id="accordion">
                        <div class="panel panel-default checkout-step-01">
                            <div class="panel-heading">
                              <h4 class="unicase-checkout-title">
                                <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne{{ $k+1 }}">
                                  <span>{{ $k+1 }}</span> {{ \Carbon\Carbon::parse($depart->jiDepartTime)->format('Y-m-d H:i:s') }} - {{ \Carbon\Carbon::parse($depart->jiArrivalTime)->format('Y-m-d H:i:s') }} ( {{ $depart->jiOrigin }} - {{ $depart->jiDestination }} )
                                </a>
                              </h4>
                            </div>

                            <div id="collapseOne{{ $k+1 }}" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <div class="row">   
                                        <div class="col-md-12 col-sm-12 guest-login">
                                        @if(count($depart->segment) > 0)
                                        @foreach($depart->segment as $k1 => $value1)
                                        <div class="input-group">
                                          <span class="input-group-addon" >
                                            {{ (count($depart->segment) > 1) ? '<h5>TRANSIT</h5>' : '' }}
                                          </span>
                                        </div>
                                        <div class="panel panel-default panel panel-body" style="">
                                            @if(count($value1->flightDetail) > 0)
                                            @foreach($value1->flightDetail as $k2 => $value2)
                                                <ul>
                                                    <li>Kode Penerbangan : {{ $value2->airlineCode or '' }}</li>
                                                    <li>Nomor Penerbangan : {{ $value2->flightNumber or '' }}</li>
                                                    <li>Waktu Keberangkatan : {{ \Carbon\Carbon::parse($value2->fdDepartTime)->format('Y-m-d H:i:s') }}</li>
                                                    <li>Waktu Tiba : {{ \Carbon\Carbon::parse($value2->fdArrivalTime)->format('Y-m-d H:i:s') }}</li>
                                                    <li>Info Rute : {{ $value2->routeInfo or '' }}</li>
                                                </ul>
                                            @endforeach
                                            @endif
                                            <!-- Available -->
                                            @if(count($value1->availableDetail) > 0)
                                            @foreach($value1->availableDetail as $k2 => $value2)
                                            @if((int)$value2->availabityStatus > 0)
                                            <div class="col-md-6 col-sm-6 guest-login" style="margin-top: 10px;">
                                                <div class="input-group">
                                                  <span class="input-group-addon" >
                                                    <input type="radio" class="" name="schDepart" style="transform: scale(1.4);" value="{{ $value2->subClass or '' }}" data-flight="{{ $value2->flightClass }}" data-depart="{{ \Carbon\Carbon::parse($depart->jiDepartTime)->format('Y-m-d H:i:s') }}" data-arrival="{{ \Carbon\Carbon::parse($depart->jiArrivalTime)->format('Y-m-d H:i:s') }}">
                                                  </span>
                                                </div>
                                                <div class="panel panel-default panel panel-body" style="">
                                                    <ul>
                                                        <li>Sisa Tempat : {{ $value2->availabityStatus or '-' }}</li>
                                                        <li>Kelas Penerbangan : {{ $value2->flightClass or '-' }}</li>
                                                        <li>Sub Kelas : {{ $value2->subClass or '-' }}</li>
                                                        <li>Kabin : {{ $value2->cabin or '-' }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                            @endforeach
                                            @endif
                                        </div>
                                        @endforeach
                                        @endif     
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                @endif
                @endif
            </div>
        </div>
        <!-- DATA DIRI PEMESAN -->
        <div class=" outline-top">
            <div class="row">
                <div class="col-md-8">

                    <div class="panel panel-default">
                        <div class="panel-body">
                            <h4>Detail Pemesan</h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-2">
                                    <select class="form-control" name="contactTitle">
                                        <option value="MR">MR</option>
                                        <option value="MRS">MRS</option>
                                        <option value="MISS">MISS</option>
                                        <option value="MSTR">MSTR</option>
                                    </select>
                                </div>

                                <div class="col-md-5">
                                    <input required type="text" placeholder="Nama Depan" name="contactFirstName"
                                        class="form-control" value="">
                                </div>

                                <div class="col-md-5">
                                    <input required type="text" placeholder="Nama Belakang" name="contactLastName"
                                        class="form-control" value="">
                                </div>
                            </div>

                            @auth
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-6">
                                    <input required type="email" placeholder="Alamat Email" name="contactEmail"
                                        class="form-control" value="{{ auth()->user()->email ?: '' }}">
                                </div>

                                <div class="col-md-6">
                                    <input required type="text" placeholder="No Telepon" name="contactRemainingPhoneNo"
                                        class="form-control" value="{{ auth()->user()->hp ?: '' }}" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                                    format telepon : 085212341234
                                </div>
                            </div>
                            @else
                            <div class="row" style="margin-top: 10px;">
                                <div class="col-md-6">
                                    <input required type="email" placeholder="Alamat Email" name="contactEmail"
                                        class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <input required type="text" placeholder="No Telepon" name="contactRemainingPhoneNo"
                                        class="form-control" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
                                    format telepon : 085212341234
                                </div>
                            </div>
                            @endauth
                        </div>
                    </div>

                    <!-- Penumpang Dewasa -->
                    @for ($i = 0; $i < $request->paxAdult; $i++)
                        <div class="panel panel-default" style="margin-top: 20px">
                            <div class="panel-body">
                                <h4>Penumpang Dewasa {{ $i+1 }}</h4>

                                <input type="hidden" name="paxDetails[adult][{{ $i }}][IDNumber]" value="{{ mt_rand() }}">

                                @if ($i == 0)
                                {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Sama dengan pemesan
                                    </label>
                                </div> --}}
                                @endif

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select required class="form-control" name="paxDetails[adult][{{ $i }}][title]">
                                            <option value="MR">MR</option>
                                            <option value="MRS">MRS</option>
                                            <option value="MISS">MISS</option>
                                            <option value="MSTR">MSTR</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Depan"
                                            name="paxDetails[adult][{{ $i }}][firstName]" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Belakang"
                                            name="paxDetails[adult][{{ $i }}][lastName]" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <select name="paxDetails[adult][{{ $i }}][gender]" class="form-control">
                                            <option value="Male">Laki - Laki</option>
                                            <option value="Female">Perempuan</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-6">
                                        <input type="text" name="paxDetails[adult][{{ $i }}][birthDate]"
                                            class="form-control bots-date" placeholder="Tanggal Lahir" />
                                    </div>
                                </div>

                                <input type="hidden" name="paxDetails[adult][{{ $i }}][nationality]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][birthCountry]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][parent]" value="" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][passportNumber]" value="" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][passportIssuedCountry]" value="" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][passportIssuedDate]" value="" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][passportExpiredDate]" value="" />
                                <input type="hidden" name="paxDetails[adult][{{ $i }}][type]" value="Adult">

                            </div>
                        </div>
                    @endfor

                    <!-- Penumpang Anak -->
                    @for ($i = 0; $i < $request->paxChild; $i++)
                        <div class="panel panel-default" style="margin-top: 20px">
                            <div class="panel-body">
                                <h4>Penumpang Anak {{ $i+1 }}</h4>

                                <input type="hidden" name="paxDetails[child][{{ $i }}][IDNumber]" value="{{ mt_rand() }}">

                                @if ($i == 0)
                                {{-- <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> Sama dengan pemesan
                                    </label>
                                </div> --}}
                                @endif

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select required class="form-control" name="paxDetails[child][{{ $i }}][title]">
                                            <option value="MR">MR</option>
                                            <option value="MRS">MRS</option>
                                            <option value="MISS">MISS</option>
                                            <option value="MSTR">MSTR</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Depan"
                                            name="paxDetails[child][{{ $i }}][firstName]" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Belakang"
                                            name="paxDetails[child][{{ $i }}][lastName]" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <select name="paxDetails[child][{{ $i }}][gender]" class="form-control">
                                            <option value="Male">Laki - Laki</option>
                                            <option value="Female">Perempuan</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-6">
                                        <input type="text" name="paxDetails[child][{{ $i }}][birthDate]"
                                            class="form-control bots-date" placeholder="Tanggal Lahir" />
                                        Penumpang anak harus berusia di bawah 12 tahun.
                                    </div>
                                </div>

                                <input type="hidden" name="paxDetails[child][{{ $i }}][nationality]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][birthCountry]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][parent]" value="" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][passportNumber]" value="" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][passportIssuedCountry]" value="" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][passportIssuedDate]" value="" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][passportExpiredDate]" value="" />
                                <input type="hidden" name="paxDetails[child][{{ $i }}][type]" value="Child">

                            </div>
                        </div>
                    @endfor

                    <!-- Penumpang Bayi -->
                    @for ($i = 0; $i < $request->paxInfant; $i++)
                        <div class="panel panel-default" style="margin-top: 20px">
                            <div class="panel-body">
                                <h4>Penumpang Bayi {{ $i+1 }}</h4>

                                <input type="hidden" name="paxDetails[infant][{{ $i }}][IDNumber]" value="{{ mt_rand() }}">

                                @if ($i == 0)
                                {{-- <div class="checkbox">
                                        <label>
                                            <input type="checkbox"> Sama dengan pemesan
                                        </label>
                                    </div> --}}
                                @endif

                                <hr>
                                <div class="row">
                                    <div class="col-md-3">
                                        <select required class="form-control" name="paxDetails[infant][{{ $i }}][title]">
                                            <option value="MR">MR</option>
                                            <option value="MRS">MRS</option>
                                            <option value="MISS">MISS</option>
                                            <option value="MSTR">MSTR</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Depan"
                                            name="paxDetails[infant][{{ $i }}][firstName]" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <input required type="text" placeholder="Nama Belakang"
                                            name="paxDetails[infant][{{ $i }}][lastName]" class="form-control">
                                    </div>

                                    <div class="col-md-3">
                                        <select name="paxDetails[infant][{{ $i }}][gender]" class="form-control">
                                            <option value="Male">Laki - Laki</option>
                                            <option value="Female">Perempuan</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row" style="margin-top:20px">
                                    <div class="col-md-6">
                                        <input type="text" name="paxDetails[infant][{{ $i }}][birthDate]"
                                            class="form-control bots-date" placeholder="Tanggal Lahir" />
                                        Penumpang bayi harus berusia di atas 3 bulan dan di bawah 2 tahun.
                                    </div>
                                    <div class="col-md-6">
                                        <select name="paxDetails[infant][{{ $i }}][parent]" class="form-control">
                                            @for ($j = 0; $j < $request->paxAdult; $j++)
                                                <option value="{{ $j }}">Penumpang Dewasa {{ $j + 1 }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                </div>

                                <input type="hidden" name="paxDetails[infant][{{ $i }}][nationality]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="paxDetails[infant][{{ $i }}][birthCountry]"
                                    value="{{ $visitor->geoplugin_countryCode }}" />
                                <input type="hidden" name="paxDetails[infant][{{ $i }}][passportNumber]" value="" />
                                <input type="hidden" name="paxDetails[infant][{{ $i }}][passportIssuedCountry]" value="" />
                                <input type="hidden" name="paxDetails[infant][{{ $i }}][passportIssuedDate]" value="" />
                                <input type="hidden" name="paxDetails[infant][{{ $i }}][passportExpiredDate]" value="" />
                                <input type="hidden" name="paxDetails[infant][{{ $i }}][type]" value="Infant">

                                

                            </div>
                        </div>
                    @endfor

                    <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-12 ">
                            <div class="btn btn-primary btn-block checkBeaggeMeal pull-right">
                                Lanjutkan Booking
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 appendPrices">
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
                            @if(isset($prices->priceDepart[0]))
                            @foreach ($prices->priceDepart[0]->priceDetail as $price)

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
                            <b>Total Pembayaran</b> Rp. {{ number_format($prices->sumFare, 2) }}
                        </div>
                    </div>
                </div>
                <div class="col-md-12 formAppend">
                            
                </div>
            </div>
        </div>
    </form>
    @endif
</div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).on('change','input[name="schDepart"]',function(){
            console.log('asd',$(this).data('flight'))
            $("input[name='schDeparts[0][detailSchedule]']").val($(this).val());
            $("input[name='schDeparts[0][flightClass]']").val($(this).data('flight'));
            $("input[name='schDeparts[0][schDepartTime]']").val($(this).data('depart'));
            $("input[name='schDeparts[0][schArrivalTime]']").val($(this).data('arrival'));
        });

        $(document).on('click','.checkBeaggeMeal',function(){
            $('.loadings').show();
            $('#dataFormPage').ajaxSubmit({
                url:"{{ url('airlinee/baggaeMeal') }}",
                // data:$('#dataFormPageCekHotel').serialize(),
                method:"POST",
                success: function(resp){
                  $('.loadings').hide();
                  $('.formAppend').html(resp);
                },error: function(resp){
                  $('.loadings').hide();
                  if(resp.responseJSON.check){
                    swal(
                      'Gagal',
                      ''+resp.responseJSON.message,
                      'error'
                    );
                  }else{
                    swal(
                      'Gagal',
                      showBoxValidation(resp),
                      'error'
                    );
                  }
                  showFormErrorDarma(resp,'dataFormPage');
                }
            });
        });

        $(document).on('click','.custom-seat-airline',function(e){
        var totalAwal = parseInt("{{ $request->paxAdult }}") + parseInt("{{ $request->paxChild }}");
        var total = $('.custom-seat-airline:checked').length;
        var compartment = $(this).data('compartment');
        // console.log('total',total)
        if(total > totalAwal){
            e.preventDefault();
            swal(
                'Gagal',
                `<div class="sidebar-widget wow fadeInUp outer-top-vs animated" style="visibility: visible; animation-name: fadeInUp;">
                    <h3 class="section-title text-warning">Total Data Tidak Boleh Melebihi Dari `+totalAwal+` Pesanan</h3>
                    <div class="sidebar-widget-body" >
                        <div class="compare-report">
                        <ul class="list text-left bold" style="font-size:16px;list-style:inside;">
                        <li><small>Data Orang Dewasa : {{ $request->paxAdult }}</small></li>
                        <li><small>Data Anak : {{ $request->paxChild }}</small></li>
                        </ul>
                        </div>
                    </div>
                </div>`,
                'warning'
            )
        }else{
            // console.log('aaa',$('.'+compartment).is(':checked'))
            if($('.'+compartment).is(':checked') == false){
                // console.log('check')
                $('.'+compartment).attr('checked','checked');
            }else{
                // console.log('uncheck')
                $('.'+compartment).attr('checked','');
                $('.'+compartment).attr('checked',false);
            }
        }
    });

    $(document).on('click','.checkPrice',function(){
        $('.loadings').show();
        $('#dataFormPage').ajaxSubmit({
            url:"{{ url('airlinee/checkPrice') }}",
            // data:$('#dataFormPageCekHotel').serialize(),
            method:"POST",
            success: function(resp){
              $('.loadings').hide();
              $('.appendPrices').html(resp);
            },error: function(resp){
              $('.loadings').hide();
              if(resp.responseJSON.check){
                swal(
                  'Gagal',
                  ''+resp.responseJSON.message,
                  'error'
                );
              }else{
                swal(
                  'Gagal',
                  showBoxValidation(resp),
                  'error'
                );
              }
              showFormErrorDarma(resp,'dataFormPage');
            }
        });
    });
    </script>
@endsection