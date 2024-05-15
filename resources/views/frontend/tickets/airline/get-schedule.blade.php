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
@else
<form id="dataFormPageCekSche" action="{{ url('airlinee/get-schedule') }}" method="GET">
	{!! csrf_field() !!}

	@foreach($request->all() as $k => $value)
	@if(($k != 'airlineAccessCode1') && ($k != 'airlineAccessCode2'))
    <input type="hidden" name="{{ $k }}" value="{{ $value }}">
    @endif
	@endforeach

	@if($capthSche != null)
    <div class="col-md-6">
    	<label>silahkan coba lagi, code tidak tersedia saat ini</label><br>
        <img src="{{ $capthSche }}">
        <input type="text" name="airlineAccessCode2" class="form-control" placeholder="Re-Captcha">
    </div>
    @else
    <input type="hidden" name="airlineAccessCode2" value="{{ $request->airlineAccessCode2 }}">
    @endif

	<div class="col-md-12" style="padding-top: 5px">
		<div class="btn btn-primary pull-right cekSche">Submit</div>
	</div>
</form>
@endif