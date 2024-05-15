<div class="checkout-box ">
	<div class="row" style="max-height: 600px;overflow-y: scroll;overflow-x: inherit;">
		<div class="col-md-12">
		@if($result)
			@if(isset($result))
				@if($result->status == 'SUCCESS')
				    <div class="col-md-12" style="display: none">
				    	<input type="hidden" name="originPort" value="{{ $request->originPort }}">
				    	<input type="hidden" name="destinationPort" value="{{ $request->destinationPort }}">
				    	<input type="hidden" name="accessToken" value="{{ $result->accessToken }}">
				    	<input type="hidden" name="kelasKapal" value="">
				    </div>
					@if(count($result->schedules) > 0)
						@foreach($result->schedules as $k => $value)
							<span class="input-group-addon" style="display: none">
				        		<input type="radio" class="clearshipID shipID{{$k+1}}" name="originCall" value="{{ $value->originCall }}">
				        		<input type="radio" class="clearshipID shipID{{$k+1}}" name="destinationCall" value="{{ $value->destCall }}">
				        		<input type="radio" class="clearshipID shipID{{$k+1}}" name="shipNumber" value="{{ $value->shipNumber }}">
				    			<input type="radio" class="clearshipID shipID{{$k+1}}" name="departDate" value="{{ Carbon\Carbon::parse($value->departDateTime)->format('Y-m-d') }}">

				      		</span>
							<div class="panel-group checkout-steps" id="accordion">
				                <div class="panel panel-default checkout-step-01">
				                    <div class="panel-heading">
				                        <h4 class="unicase-checkout-title">
				                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseOne{{ $k+1 }}">
				                              <span>{{ $k+1 }}</span>
				                              {{ $value->shipNumber }} - {{ $value->shipName }}
				                          </a>
				                        </h4>
				                    </div>

				                    <div id="collapseOne{{ $k+1 }}" class="panel-collapse collapse" style="height: 0px;">
				                        <div class="panel-body">
				                            <div class="row">       
				                                <div class="col-md-6 col-sm-6 guest-login">
				                                    <h4 class="checkout-subtitle outer-top-vs">Detail Kapal</h4>
				                                    <ul class="text instruction inner-bottom-30">
														<li class="save-time-reg">- Nama Kapal : {{ $value->shipNumber }} - {{ $value->shipName }}</li>
														<li>- Tanggal Keberangkatan : {{ $value->departDateTime or '-' }}</li>
														<li>- Tanggal Tiba : {{ $value->arrivalDateTime or '-' }}</li>
														<li>- Route : {{ $value->routeInfo or '-' }}</li>
													</ul>
				                                </div>
				                                <div class="col-md-12 col-sm-6 already-registered-login">
													<h4 class="checkout-subtitle">Pilih Kelas Kapal</h4>
													@if($value->scheduleFares)
														@if(count($value->scheduleFares) > 0)
															@foreach($value->scheduleFares as $k1 => $value1)
																<div class="col-md-4">
		                                                            <div class="input-group">
		                                                                <span class="input-group-addon" >
		                                                                    <input type="radio" class="shipID" data-key="shipID{{$k+1}}" name="subClass" aria-label="..." value="{{ $value1->subClass }}" data-kelas="{{ $value1->class }} - {{ $value1->subClass }}" style="transform: scale(1.4);">
		                                                                </span>
		                                                            </div>
		                                                            <div class="panel panel-default panel panel-body">
		                                                                <h4 class="heading-title">{{ $value1->class }} - ({{ $value1->subClass }})</h4>
		                                                                <h6 class="">Harga - Tarif Dewasa : {{ moneyFormat($value1->adultFare) }}</h6>
		                                                                <h6 class="">Harga - Tarif Anak : {{ moneyFormat($value1->childFare) }}</h6>
		                                                                <h6 class="">Harga - Tarif Bayi : {{ moneyFormat($value1->infantFare) }}</h6>
		                                                            </div>
		                                                        </div>
															@endforeach
														@endif
													@endif
												</div><br>
												<div class="col-md-12">
						                          <button type="button" class="pull-right btn btn-success pesanKapal" data-hotelid="hotelID{{$k+1}}" data-form="dataFormPageCekHotel" data-append="formAppend"><i class="ion-android-refresh"></i> Pesan Kapal</button>
						                        </div>
				                            </div>          
				                        </div>
				                    </div>
				                </div>
				            </div>
						@endforeach
					@endif
				@endif
			@endif
		@endif
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).on('change','.shipID',function(){
		var kelas = $(this).data('kelas');
		$('input[name="kelasKapal"]').val(kelas);
	});
</script>