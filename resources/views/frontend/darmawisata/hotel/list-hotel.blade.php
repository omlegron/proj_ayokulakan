<div class="checkout-box ">
	<div class="row" style="max-height: 600px;overflow-y: scroll;overflow-x: inherit;">
		<div class="col-md-12">
		@if($result)
			@if(isset($result))
				@if($result->status == 'SUCCESS')
				    <input type="hidden" class="" name="paxPassport" value="{{ isset($result->paxPassport) ? $result->paxPassport : null }}">
				    <input type="hidden" class="" name="accessToken" value="{{ isset($result->accessToken) ? $result->accessToken : null }}">
					@if(count($result->hotels) > 0)
						@foreach($result->hotels as $k => $value)
							@if($value->availabilityStatus == true)
								<span class="input-group-addon" style="display: none">
					        		<input type="radio" class="hotelID{{$k+1}}" name="hotelID" value="{{ $value->ID }}">
					        		<input type="radio" class="hotelID{{$k+1}}" name="internalCode" value="{{ $value->internalCode }}">
					      		</span>
								<div class="panel-group checkout-steps" id="accordion">
					                <div class="panel panel-default checkout-step-01">
					                    <div class="panel-heading">
					                        <h4 class="unicase-checkout-title">
					                            <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseOne{{ $k+1 }}">
					                              <span>{{ $k+1 }}</span>
					                              {{ $value->name }}
					                          </a>
					                        </h4>
					                    </div>

					                    <div id="collapseOne{{ $k+1 }}" class="panel-collapse collapse" style="height: 0px;">
					                        <div class="panel-body">
					                            <div class="row">       
					                                <div class="col-md-6 col-sm-6 guest-login">
					                                    <h4 class="checkout-subtitle outer-top-vs">Detail Hotel</h4>
					                                    <ul class="text instruction inner-bottom-30">
															@if(isset($value->logo))
																@if(file_exists($value->logo) || is_file($value->logo))
																	<li class="save-time-reg">
																		<img src="{{ $value->logo }}" style="max-width: 80px;">
																	</li>
																@endif
															@endif
															<li class="save-time-reg">- Nama Hotel : {{ $value->name or '-' }}</li>
															<li>
																- Rating Hotels : 
																@if($value->rating > 0)
						                                            @php
						                                            $totalStar = $value->rating;
						                                            $cekStar = 5 - $totalStar;
						                                            @endphp
						                                            @for($i = 0; $i < $totalStar; $i++)
						                                            <span><i class="fa fa-star" style="color:#ff7429;"></i></span>
						                                            @endfor

						                                            @for($i1 = 0; $i1 < $cekStar; $i1++)
						                                            <span><i class="fa fa-star-o"></i></span>
						                                            @endfor

						                                        @else
						                                            <p>
						                                            @for($i = 0; $i < 5; $i++)
						                                            <span ><i class="fa fa-star-o" ></i></span>
						                                            @endfor
					                                            @endif
															</li>
															<li>- Email Hotel : {{ $value->email or '-' }}</li>
															<li>- Alamat Hotel : {{ $value->address or '-' }}</li>
															<li>- Availability : {{ ($value->availabilityStatus == true) ? 'Tersedia' : 'Tidak Tersedia' }}</li>
															<li>- Pesan : {!! $value->message or '-' !!}</li>
															<li>- No Telp : {{ $value->phone or '-' }}</li>
															<li>- Website : {{ $value->website or '-' }}</li>
															<li>- Tanggal Berakhir Promo : {{ $value->promoEndDate or '-' }}</li>
															<li>- Harga : {{ moneyFormat($value->priceStart) }}</li>
														</ul>
					                                   
					                                </div>
					                                <div class="col-md-6 col-sm-6 already-registered-login">
														<h4 class="checkout-subtitle">Fasilitas Hotel</h4>
														<ul>
															@if($value->facilities)
																@if(count($value->facilities) > 0)
																	@foreach($value->facilities as $k1 => $value1)
																		<li>- {{ $value1 }}</li>
																	@endforeach
																@endif
															@endif
														</ul>
													</div>
													<div class="col-md-12">
							                          <button type="button" class="pull-right btn btn-success pesanHotel" data-hotelid="hotelID{{$k+1}}" data-form="dataFormPageCekHotel" data-append="formAppend"><i class="ion-android-refresh"></i> Pesan Hotel</button>
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
			@endif
		@endif
		</div>
	</div>
</div>