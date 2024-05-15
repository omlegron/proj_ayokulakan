@extends('layouts.scaffold')

@section('css')
<style>
  .outline-top {
    margin-top: 20px;
  }

  @media (max-width: 500px) {
    .outline-top {
      margin-top: 299px;
    }
  }
</style>
@endsection

@section('content-frontend')
<form id="dataFormPage" action="{{ url('check-ticket/store') }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Detail Booking Kereta</h2>
        <div class="container">
          <div class="checkout-box ">
          	@if($record)
            <div class="row">
            <input type="hidden" name="id" value="{{ $record->id or '' }}">
              <div class="col-md-8">
               
                  <div class="panel-group checkout-steps" id="accordion">
                    <div class="panel panel-default checkout-step-01">
                      <div class="panel-heading">
                        <h4 class="unicase-checkout-title">
                          <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                            <span>1</span> {{ $record->trainNumber or '' }} - {{ $record->trainName }}
                          </a>
                        </h4>
                      </div>

                      <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                          <div class="row">       
                            <div class="col-md-12 col-sm-12 guest-login">
                              <h4 class="checkout-subtitle outer-top-vs">Detail Booking</h4>
                              <ul class="text instruction inner-bottom-30">
                                <li class="save-time-reg">- TR ID : {{ $record->tr_id or '-' }}</li>
                                <li>- Kode : {{ $record->code or '-' }}</li>
                                <li>- Booking Code : {{ $record->bookingCode or '-' }}</li>
                                <li>- Booking Date : {{ $record->bookingDateTime or '-' }}</li>
                                <li>- Nama Kereta : {{ $record->trainName or '-' }}</li>
                                <li>- Nomor Kereta : {{ $record->trainNumber or '-' }}</li>
                                <li>- Kelas : {{ $record->class or '-' }}</li>
                                <li>- Sub Kelas : {{ $record->subClass or '-' }}</li>
                                <li>- Keberangkatan : {{ $record->org or '-' }}</li>
                                <li>- Tujuan : {{ $record->dest or '-' }}</li>
                                <li>- Waktu Keberangkatan : {{ $record->departDate or '-' }} - {{ $record->departTime or '-' }}</li>
                                <li>- Total Tiket : {{ $record->passenger->count() }}</li>
                                <li>- Total Harga : {{ moneyFormat($record->price) }}</li>
                                <li>- Biaya Admin : {{ ($record->admin) ? moneyFormat((int)$record->admin + 500) : moneyFormat(0) }}</li>
                                <li>- Status : {{ $record->message or '' }}</li>
                              </ul>

                            </div>
                            @if(!is_null($record->passenger) && (count($record->passenger) > 0))
                            @foreach($record->passenger as $k => $value)
                            <div class="col-md-12">
                              <div class="checkout-progress-sidebar ">
                                <div class="panel-group">
                                  <div class="panel panel-default">
                                    <div class="panel-heading">
                                      <h4 class="unicase-checkout-title">Detail Booking</h4>
                                    </div>
                                    <div class="">
                                      <ul>
                                        <li>- Id : {{ $value->trID or '-' }}</li>
                                        <li>- Name : {{ $value->name or '-' }}</li>
                                        <li>- Kode Wagon : {{ $value->wagonCode or '-' }}</li>
                                        <li>- Tempat Duduk : {{ $value->seat or '-' }}</li>
                                        <li>- Nomer Tiket : {{ $value->ticketNumber or '-' }}</li>
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            @endforeach
                            @endif
                          </div>          
                        </div>
                      </div>
                    </div>
                  </div>
                
                
              </div>
              <div class="col-md-4">
                <div class="checkout-progress-sidebar ">
                  <div class="panel-group">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        <h4 class="unicase-checkout-title">Data Diri Pemesan</h4>
                      </div>
                      <div class="">
                        <ul class="nav nav-checkout-progress list-unstyled">
                          <li><a>Nama : {{ $record->contactName or '' }}</a></li>
                          <li><a>Telp : {{ $record->contactPhone or '' }}</a></li>
                          <li><a>Email : {{ $record->contactEmail or '' }}</a></li>
                        </ul>    
                        
                      </div>
                      
                      <div class="payment-method">
                          <div class="payment-accordion">
                              <div class="order-button-payment">

                                  @if($record->message == 'INQUIRY SUCCESS')
                                  <button type="button" class="btn btn-success btn-lg btn-block darma-save-transaksi-render" data-form="#dataFormPage">Bayar</button>
                                  @endif
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>

                </div> 

              </div>
            </div>
            @else
            <div class="row">
            	<div class="panel panel-default" style="padding: 20px; overflow: hidden;">
                    <div class="text-center">
                        <b>Upss... Maaf data pesanan anda tidak tersedia, dikarenakan tiket kosong!</b>
                        <br>
                        Silahkan pesan kembali
                    </div>
                </div>
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
@endsection

