<div class="checkout-box ">
	<div class="row single-product">
	<div class="detail-block">
	<h3 class="section-title">Total Bus / Travel {{ count($result->schedules) }}</h3>
	<div class="row" style="max-height: 600px;overflow-y: scroll;overflow-x: scroll;">
		<div class="col-md-12">
			@if($result->status == 'SUCCESS')
			@if(count($result->schedules) > 0)
			@foreach($result->schedules as $k => $value)
			@if($value->isAllowChooseSeat == true)
				<div class="col-md-12" style="display: none">
					<input type="radio" name="directCode" class="directCodeClear directCode{{$k+1}}" value="{{ $value->directCode }}">
					<input type="radio" name="locationID" class="directCodeClear directCode{{$k+1}}" value="{{ $value->locationID }}">
				</div>
				<div class="panel-group checkout-steps" id="schedule">
				<div class="panel panel-default checkout-step-01">
					<div class="panel-heading">
						<h6 class="unicase-checkout-title">
							<a data-toggle="collapse" class="collapsed" data-parent="#schedule" href="#collapseSchedule{{ $k+1 }}" style="font-size: 11px">
								<span>{{ $k+1 }}</span>
								{{ $value->busType or '' }} - {{ $value->operatorName or '' }} {{ $value->busInfo or '' }}
							</a>
						</h6>
					</div>

					<div id="collapseSchedule{{ $k+1 }}" class="panel-collapse collapse">
						<div class="panel-body">
							<div class="row">       
								<div class="col-md-12 col-sm-12 already-registered-login">
									<div class="col-md-12">
										<div class="form-group">
											<label>Pilih Tempat Keberangkatan</label>
											<select name="departID" class="form-control">
												@if($value->departLocation)
												@if(count($value->departLocation) > 0)
												@foreach($value->departLocation as $k1 => $value1)
													<option value="{{ $value1->departID }}">{{ $value1->departAddress }} - {{ $value1->departTime }}</option>
												@endforeach
												@endif
												@endif
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Pilih Tempat Tujuan</label>
											<select name="arrivalID" class="form-control">
												@if($value->arrivalLocation)
												@if(count($value->arrivalLocation) > 0)
												@foreach($value->arrivalLocation as $k1 => $value1)
													<option value="{{ $value1->arrivalID }}">{{ $value1->arrivalAddress }} - {{ $value1->arrivalTime }}</option>
												@endforeach
												@endif
												@endif
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label>Total Kapasitas Tempat Duduk : {{ $value->capacity }} </label>
											<label><b><u>Pilih Tarif Kelas</u></b></label>
										</div>
									</div>
									@if($value->classes)
										@if(count($value->classes) > 0)
											@foreach($value->classes as $k1 => $value1)
												<div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" >
                                                            <input type="radio" class="subClassFare" name="subClassFare" value="{{ $value1->classFare }}" data-checked="directCode{{$k+1}}" style="transform: scale(1.4);">
                                                        </span>
                                                    </div>
                                                    <div class="panel panel-default panel panel-body">
                                                        <h6 class="">Harga - Tarif Dewasa : {{ moneyFormat($value1->adultSeatPrice) }}</h6>
                                                        <h6 class="">Harga - Tarif Anak : {{ moneyFormat($value1->childSeatPrice) }}</h6>
                                                        <h6 class="">Harga - Tarif Balita : {{ moneyFormat($value1->infantSeatPrice) }}</h6>
                                                    </div>
                                                </div>
											@endforeach
										@endif
									@endif
									
								</div><br>
							</div>          
						</div>
						<div class="panel-footer">
							<div class="row">
								<div class="col-md-12">
									<button type="submit" class="pull-right btn btn-success"><i class="ion-android-refresh"></i> Pesan Bus</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
			@endif
			@endforeach
			@else
			<div class="panel panel-default" style="padding: 20px; overflow: hidden;">
		        <div class="text-center">
		            <b>Upss... Maaf untuk saat ini jadwal tidak tersedia!</b>
		            <br>
		            Silahkan ulangi pencarian
		        </div>
		    </div>
			@endif
			@else
			<div class="panel panel-default" style="padding: 20px; overflow: hidden;">
		        <div class="text-center">
		            <b>Upss... Maaf untuk saat ini jadwal tidak tersedia!</b>
		            <br>
		            Silahkan ulangi pencarian
		        </div>
		    </div>
			@endif
		</div>
	</div>
	</div>
	</div>
</div>
