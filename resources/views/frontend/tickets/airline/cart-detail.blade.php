@if((count($seat) > 0) && isset($baggae->addOns[0]) && !is_null($baggae->addOns[0]->baggageInfos) && !is_null($baggae->addOns[0]->mealInfos))

<div class="checkout-box ">
	<div class="row" style="max-height: 500px;overflow-x: scroll;overflow-y: scroll;">
		@if($request->paxDetails)
		@foreach($request->paxDetails as $k => $value)
		
		@if(count($value) > 0)
		@foreach($value as $k1 => $value1)

		@php
		$no = $k1+1;
		@endphp
		<div class="col-md-12">
			<div class="panel-group checkout-steps" id="baggageMeal">
				<div class="panel panel-default checkout-step-01">
					<div class="panel-heading">
						<h4 class="unicase-checkout-title">
							<a data-toggle="collapse" class="" data-parent="#baggageMeal" href="#baggageMeal{{ $no }}">
								<span>{{ $no }}</span> {{ $value1['title'] or '' }} {{ $value1['firstName'] or '' }}
							</a>
						</h4>
					</div>

					<div id="baggageMeal{{ $no }}" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="row">   
								@if(isset($baggae->addOns[0]))
								@if(isset($baggae->addOns[0]->baggageInfos) && isset($baggae->addOns[0]->mealInfos))
								<div class="col-md-12" style="display: none">
									<input type="hidden" name="paxDetails[{{ $k }}][{{ $k1 }}][addOns][0][aoOrigin]" value="{{ $baggae->addOns[0]->origin }}">
									<input type="hidden" name="paxDetails[{{ $k }}][{{ $k1 }}][addOns][0][aoDestination]" value="{{ $baggae->addOns[0]->destination }}">
								</div>
								<div class="col-md-12 col-sm-12 guest-login">
									<div class="input-group">
										<span class="input-group-addon" >
											Baggage
										</span>
									</div>
									<div class="panel panel-default panel panel-body" style="">
										<div class="form-group">
											<label>Pilih Salah Satu</label>
											<select class="form-control" name="paxDetails[{{ $k }}][{{ $k1 }}][addOns][0][baggageString]">
												@if(count($baggae->addOns[0]->baggageInfos) > 0)
												@foreach($baggae->addOns[0]->baggageInfos as $k2 => $value2)
												<option value="{{ $value2->code }}">{{ $value2->desc or '' }} - {{ moneyFormat($value2->fare) }}</option>
												@endforeach
												@endif
											</select>
										</div>
									</div>
								</div>

								<div class="col-md-12 col-sm-12 guest-login">
									<div class="input-group">
										<span class="input-group-addon" >
											Meals
										</span>
									</div>
									<div class="panel panel-default panel panel-body" style="">
										<div class="form-group">
											<label>Pilih Salah Satu</label>
											<ul>

												@if(count($baggae->addOns[0]->mealInfos) > 0)
												@foreach($baggae->addOns[0]->mealInfos as $k2 => $value2)
												<li>
													<div class="input-group">
														<span class="input-group-addon">
															<input type="checkbox" aria-label="..." name="paxDetails[{{ $k }}][{{ $k1 }}][addOns][0][meals][]" value="{{ $value2->code }}">
														</span>
														<input type="text" readonly="" value="{{ $value2->desc or '' }} - {{ moneyFormat($value2->fare) }}">
													</div>
												</li>
												@endforeach
												@endif
											</ul>
											
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
		@endforeach
		@endif

		@endforeach
		@endif
	</div>
</div><br><br>

<div class="checkout-box ">
	<div class="row" style="">
		<div class="col-md-12">
			<div class="panel-group checkout-steps" id="seat">
				<div class="panel panel-default checkout-step-01">
					<div class="panel-heading">
						<h4 class="unicase-checkout-title">
							<a data-toggle="collapse" class="" data-parent="#seat" href="#seat">
								<span>1</span> Pilih Tempat
							</a>
						</h4>
					</div>
					<div id="seat" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="row">   
								<table class="table table-bordered table-responsive">
									<tbody>
										@foreach($seat as $k => $value)
										<tr valign="center">
											@if(count($value) > 0)
											@foreach($value as $k1 => $value1)
											@if($value1->isOpen == true)
											<td valign="center">
												<div class="custom-control custom-checkbox" style="display: none;">
													<input type="checkbox" class="custom-seat-compartment{{ $value1->seatDesignator }}" aria-checked="" tabindex="0"  name="seats[compartment][]" value="{{ $value1->compartment }}" >
													<label class="custom-control-label labels-custom label-custom-ready" for="customCheck"><span style="">{{ $value1->seatDesignator }}</span></label>
												</div>

												<div class="custom-control custom-checkbox">
													<input type="checkbox" class="custom-seat-airline" aria-checked="" tabindex="0"  name="seats[seat][]" value="{{ $value1->seatDesignator }}" data-compartment="custom-seat-compartment{{ $value1->seatDesignator }}">
													<label class="custom-control-label labels-custom label-custom-ready" for="customCheck"><span style="">{{ $value1->seatDesignator }} </span></label>
												</div>
												
											</td>
											@else
											<td valign="center">{{ $value1->seatDesignator }}</td>
											@endif
											@endforeach
											@endif
										</tr>
										@endforeach
									</tbody>
								</table>
								<div class="appendCompartment" style="display: none">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-12 ">
			<div class="btn btn-primary btn-block darma-save-render pull-right" data-form="#dataFormPage">
				Lanjutkan Booking
			</div>
		</div>
	</div>
</div><br>
@else
<!-- <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
	<div class="text-center">
		<b>Upss... Maaf untuk saat ini kursi tidak tersedia!</b>
		<br>
		Silahkan ulangi pencarian
	</div>
</div> -->
<div class="col-md-12 ">
	<div class="btn btn-primary btn-block darma-save-render pull-right" data-form="#dataFormPage">
		Lanjutkan Booking
	</div>
</div>
@endif

<script type="text/javascript">
	
</script>
