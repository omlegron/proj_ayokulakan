<div class="checkout-box " >
  <div class="row" >
  	@if($result && ($result->status == 'SUCCESS') && (count($result->schedules) > 0))
    @foreach($result->schedules as $k => $value)
    <form action="{{ url('travel/seat') }}" method="GET" accept-charset="utf-8">
	    <input type="hidden" name="shuttleID" value="{{ $request->shuttleID }}">
	    <input type="hidden" name="departDate" value="{{ $request->departDate }}">
	    <input type="hidden" name="accessToken" value="{{ $result->accessToken }}">
	    <input type="hidden" name="directionID" value="{{ $result->directionID }}">
	    <input type="hidden" name="totalTicket" value="{{ $result->totalTicket }}">
	    <div class="col-md-12">
	      <div class="panel-group checkout-steps" id="accordion">
	        <div class="panel panel-default checkout-step-01">
	          <div class="panel-heading">
	            <h4 class="unicase-checkout-title">
	              <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne{{$k+1}}">
	                <span>{{ $k+1 }}</span> Kode Jadwal {{ $value->scheduleCode or '' }}
	              </a>
	            </h4>
	          </div>

	          <div id="collapseOne{{$k+1}}" class="panel-collapse collapse in">
	            <div class="panel-body">
	            	<input type="hidden" name="seatLayoutID" value="{{ $value->seatLayoutID or '' }}">
	            	<input type="hidden" name="scheduleCode" value="{{ $value->scheduleCode or '' }}">
	            	<input type="hidden" name="specialLayoutID" value="{{ $value->specialLayoutID or '' }}">
	            	<ul>
	            		<li>- Schedule Code : {{ $value->scheduleCode }}</li>
	            		<li>- Waktu Sampai : {{ $value->departTime }}</li>
	            		<li>- Kapsitas Tempat Duduk Tersisa : {{ $value->seatCapacity }}</li>
	            		<li>- Harga Tempat : {{ moneyFormat($value->pricePerSeat) }}</li>
	            	</ul>
	            	<div class="row">
	            		<div class="col-md-12">
	            			<input type="submit" class="btn btn-success btn-lg btn-block" value="Submit">
	            		</div>
	            	</div>
	            </div>
	          </div>
	        </div>
	      </div>
	    </div>
    </form>

    @endforeach

    @endif
  </div>
</div>