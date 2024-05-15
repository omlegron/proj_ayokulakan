@extends('layouts.scaffold')

@section('css')
<style>
    /*.outline-top {
        margin-top: 20px;
    }

    @media (max-width: 500px) {
        .outline-top {
            margin-top: 299px;
        }
        }*/
    </style>
    @endsection

    @section('content-frontend')

    <form id="dataFormPage" action="{{ url('bus/booking') }}" method="POST">
    	{!! csrf_field() !!}
    	<div class="container outer-top">
    		<div class="row">
    			<div class="col-md-12">
    				<input type="hidden" name="accessToken" value="{{ $request->accessToken }}">
    				<input type="hidden" name="bus" value="{{ $request->bus }}">
    				<input type="hidden" name="originTerminal" value="{{ $request->originTerminal }}">
    				<input type="hidden" name="destinationTerminal" value="{{ $request->destinationTerminal }}">
    				<input type="hidden" name="directCode" value="{{ $request->directCode }}">
    				<input type="hidden" name="locationID" value="{{ $request->locationID }}">
    				<input type="hidden" name="departDate" value="{{ $request->departDate }}">
    				<input type="hidden" name="paxAdult" value="{{ $request->paxAdult }}">
    				<input type="hidden" name="paxChild" value="{{ $request->paxChild }}">
    				<input type="hidden" name="paxInfant" value="{{ $request->paxInfant }}">
    				<input type="hidden" name="subClassFare" value="{{ $request->subClassFare }}">
    				<input type="hidden" name="departID" value="{{ $request->departID }}">
    				<input type="hidden" name="arrivalID" value="{{ $request->arrivalID }}">
    			</div>
    			<div class="panel panel-default">
    				<div class="panel-body">
    					<div class="row">

    						<div class="col-md-12">
    							<div class="panel-body">
    								<div class="row"> 
    									<h5>Pilih Tempat</h5>  
    									<table class="table table-bordered">
    										<tbody>
    											@if($result->status == 'SUCCESS')

    											@if(count($resReal) > 0)
    											@foreach($resReal as $k => $value)
    											<tr valign="center">
    												@if(count($value) > 0)
    												@foreach($value as $k1 => $value2)
    												@if($value2->isAvailaible == true)
    												<td valign="center">

    													<div class="custom-control custom-checkbox">
    														<input type="checkbox" class="custom-seat-bus" aria-checked="" tabindex="0"  name="choosedSeat[]" value="{{ $value2->seatNumber }}" >
    														<label class="custom-control-label labels-custom label-custom-ready" for="customCheck"><span style="">{{ $value2->seatNumber }} - {{ $value2->column+1 }} </span></label>
    													</div>

    												</td>
    												@else
    												<td valign="center">{{ $value2->seatNumber }} - {{ $value2->column+1 }}</td>
    												@endif
    												@endforeach
    												@endif
    											</tr>
    											@endforeach
    											@endif

    											@else
    											<div class="panel panel-default" style="padding: 20px; overflow: hidden;">
    												<div class="text-center">
    													<b>Upss... Maaf untuk saat ini data kursi tidak ditemukan!</b>
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
    														<span>-</span> Adult
    													</a>
    												</h4>
    											</div>

    											<div id="collapseAdult" class="panel-collapse collapse in">
    												<div class="panel-body">
    													<div class="row">   
    														@for($i=0; $i < $request->paxAdult; $i++)
    														@php
    														$no++;
    														@endphp
    														<input type="hidden" name="passengers[{{ $no }}][paxType]" value="Adult">
    														<input type="hidden" name="passengers[{{ $no }}][parent]" value="">
    														<input type="hidden" name="passengers[{{ $no }}][identityType]" value="KTP">
    														<div class="panel panel-default checkout-step-01">
    															<div class="panel-heading">
    																<h4 class="unicase-checkout-title">
    																	<a href="javascipt:void(0)">
    																		<span>{{ $i+1 }}</span> Adult
    																	</a>
    																</h4>
    															</div>
    															<div class="panel-body">
    																<div class="col-md-6">
    																	<label>Title</label>
    																	<div class="form-group">
    																		<select required class="form-control" name="passengers[{{ $no }}][title]">
    																			<option value="MR">MR</option>
    																			<option value="MRS">MRS</option>
    																			<option value="MISS">MISS</option>
    																			<option value="MSTR">MSTR</option>
    																		</select>
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>First Name</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][firstName]" class="form-control" placeholder="First Name">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Last Name</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][lastName]" class="form-control" placeholder="Last Name">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>KTP</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][identity]" class="form-control" placeholder="KTP">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>No Tlp</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][phone]" class="form-control" placeholder="No Tlp">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Alamat</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][address]" class="form-control" placeholder="Alamat">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Email</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][email]" class="form-control" placeholder="Email">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Tanggal Lahir</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][birthDate]" class="form-control bots-date" placeholder="Tanggal Lahir">
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

    									<div class="panel-group checkout-steps" id="child">
    										<div class="panel panel-default checkout-step-01">
    											<div class="panel-heading">
    												<h4 class="unicase-checkout-title">
    													<a data-toggle="collapse" class="" data-parent="#child" href="#collapseChild">
    														<span>-</span> Child
    													</a>
    												</h4>
    											</div>

    											<div id="collapseChild" class="panel-collapse collapse in">
    												<div class="panel-body">
    													<div class="row">   
    														@for($i=0; $i < $request->paxChild; $i++)
    														@php
    														$no++;
    														@endphp
    														<input type="hidden" name="passengers[{{ $no }}][paxType]" value="Child">
    														<input type="hidden" name="passengers[{{ $no }}][parent]" value="">
    														<input type="hidden" name="passengers[{{ $no }}][identityType]" value="KTP">
    														<div class="panel panel-default checkout-step-01">
    															<div class="panel-heading">
    																<h4 class="unicase-checkout-title">
    																	<a href="javascipt:void(0)">
    																		<span>{{ $i+1 }}</span> Adult
    																	</a>
    																</h4>
    															</div>
    															<div class="panel-body">
    																<div class="col-md-6">
    																	<label>Title</label>
    																	<div class="form-group">
    																		<select required class="form-control" name="passengers[{{ $no }}][title]">
    																			<option value="MR">MR</option>
    																			<option value="MRS">MRS</option>
    																			<option value="MISS">MISS</option>
    																			<option value="MSTR">MSTR</option>
    																		</select>
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>First Name</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][firstName]" class="form-control" placeholder="First Name">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Last Name</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][lastName]" class="form-control" placeholder="Last Name">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>KTP</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][identity]" class="form-control" placeholder="KTP">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>No Tlp</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][phone]" class="form-control" placeholder="No Tlp">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Alamat</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][address]" class="form-control" placeholder="Alamat">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Email</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][email]" class="form-control" placeholder="Email">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Tanggal Lahir</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][birthDate]" class="form-control bots-date" placeholder="Tanggal Lahir">
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

    									<div class="panel-group checkout-steps" id="infant">
    										<div class="panel panel-default checkout-step-01">
    											<div class="panel-heading">
    												<h4 class="unicase-checkout-title">
    													<a data-toggle="collapse" class="" data-parent="#infant" href="#collapseInfant">
    														<span>-</span> Infant
    													</a>
    												</h4>
    											</div>

    											<div id="collapseInfant" class="panel-collapse collapse in">
    												<div class="panel-body">
    													<div class="row">   
    														@for($i=0; $i < $request->paxInfant; $i++)
    														@php
    														$no++;
    														@endphp
    														<input type="hidden" name="passengers[{{ $no }}][paxType]" value="Infant">
    														<input type="hidden" name="passengers[{{ $no }}][parent]" value="">
    														<input type="hidden" name="passengers[{{ $no }}][identityType]" value="">
    														<input type="hidden" name="passengers[{{ $no }}][identity]" value="">
    														<div class="panel panel-default checkout-step-01">
    															<div class="panel-heading">
    																<h4 class="unicase-checkout-title">
    																	<a href="javascipt:void(0)">
    																		<span>{{ $i+1 }}</span> Adult
    																	</a>
    																</h4>
    															</div>
    															<div class="panel-body">
    																<div class="col-md-6">
    																	<label>Title</label>
    																	<div class="form-group">
    																		<select required class="form-control" name="passengers[{{ $no }}][title]">
    																			<option value="MR">MR</option>
    																			<option value="MRS">MRS</option>
    																			<option value="MISS">MISS</option>
    																			<option value="MSTR">MSTR</option>
    																		</select>
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>First Name</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][firstName]" class="form-control" placeholder="First Name">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Last Name</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][lastName]" class="form-control" placeholder="Last Name">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>No Tlp</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][phone]" class="form-control" placeholder="No Tlp">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Alamat</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][address]" class="form-control" placeholder="Alamat">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Email</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][email]" class="form-control" placeholder="Email">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label>Tanggal Lahir</label>
    																	<div class="form-group">
    																		<input type="text" name="passengers[{{ $no }}][birthDate]" class="form-control bots-date" placeholder="Tanggal Lahir">
    																	</div>
    																</div>
    																<div class="col-md-6">
    																	<label></label>
    																	<div class="form-group">
    																		<select name="passengers[{{ $no }}][parent]" class="form-control">
    																			@for ($j = 0; $j < $request->paxAdult; $j++)
    																			<option value="{{ $j }}">Penumpang Dewasa {{ $j + 1 }}</option>
    																			@endfor
    																		</select>
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
    		var totalAwal = parseInt("{{ !is_null($request->paxAdult) ? $request->paxAdult : 0 }}") + parseInt("{{ !is_null($request->paxChild) ? $request->paxChild : 0 }}");
    		var total = $('.custom-seat-bus:checked').length;
    		var compartment = $(this).data('compartment');
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
        		<li><small>Data Orang Dewasa : {{ $request->paxAdult }}</small></li>
        		<li><small>Data Anak : {{ $request->paxChild }}</small></li>
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
