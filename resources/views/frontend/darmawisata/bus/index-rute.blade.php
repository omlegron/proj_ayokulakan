<div class="checkout-box ">
	
		<div class="row" style="">
			<div class="col-md-12">
				
				<div class="panel-group checkout-steps" id="accordion">
					<div class="panel panel-default checkout-step-01">
						<div class="panel-heading">
							<h4 class="unicase-checkout-title">
								<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
									<span>-</span>
									Pilih Tujuan
								</a>
							</h4>
						</div>

						<div id="collapseOne" class="panel-collapse collapse in">
							<div class="panel-body">
								<div class="row">       
									<div class="col-md-12 col-sm-12 guest-login">
										<h4 class="checkout-subtitle outer-top-vs">Pilih Tujuan</h4>
										<select name="originTerminal" class="form-control" required="" data-live-search="true" data-dropup-auto="false" data-size="10">
											<option value="">Pilih Tujuan</option>
											@if($result->status == 'SUCCESS')
												@if(count($result->routes) > 0)
													@foreach($result->routes as $k => $value)
														<option value="{{ $value->originTerminal }}" data-destination="{{ $value->destinationTerminal }}">{{ $value->originTerminal }} - {{ $value->destinationTerminal }}</option>
													@endforeach
												@endif
											@endif
										</select>
										<div class="col-md-12" style="display: none">
											<input type="hidden" name="destinationTerminal">
											<input type="hidden" name="accessToken" value="{{ $result->accessToken }}">
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
