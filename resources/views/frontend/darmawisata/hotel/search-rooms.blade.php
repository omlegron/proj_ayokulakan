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
<form id="dataFormPageCekHotel" action="{{ url('hotel/bookings') }}" method="POST">
  {!! csrf_field() !!}
  <div class="terms-conditions-page">
    <div class="row">
      <div class="col-md-12 terms-conditions">
        <h2 class="heading-title">Checkout</h2>
        <div class="container">
          <div class="checkout-box ">
            <div class="row">
              <div class="col-md-8">
                @if($result)
                @if($result->status == 'SUCCESS')
                <div class="col-md-12">
                  <input type="hidden" name="accessToken" value="{{ $request->accessToken or '' }}">
                  <input type="hidden" name="paxPassport" value="{{ $request->paxPassport or '' }}">
                  <input type="hidden" name="countryID" value="{{ $request->countryID or '' }}">
                  <input type="hidden" name="cityID" value="{{ $request->cityID or '' }}">
                  <input type="hidden" name="checkInDate" value="{{ $request->checkInDate or '' }}">
                  <input type="hidden" name="checkOutDate" value="{{ $request->checkOutDate or '' }}">
                  <input type="hidden" name="hotelID" value="{{ $request->hotelID or '' }}">
                  <input type="hidden" name="internalCode" value="{{ $request->internalCode or '' }}">
                  <input type="hidden" name="roomType" value="{{ $request->roomType or '' }}">
                  <input type="hidden" name="isRequestChildBed" value="{{ $request->isRequestChildBed or '' }}">
                  <input type="hidden" name="childNum" value="{{ $request->childNum or '' }}">
                  @if(!is_null($request->childAges) && ($request->childAges != null) && isset($request->childAges) && count($request->childAges) > 0)
                    @foreach($request->childAges as $k => $value)
                      <input type="hidden" name="childAges[]" value="{{ $value }}">
                    @endforeach
                  @endif
                </div>
                <div class="panel-group checkout-steps" id="accordion">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
                          <span>1</span> {{ $result->hotelInfo->name }}
                        </a>
                      </h4>
                    </div>

                    <div id="collapseOne" class="panel-collapse collapse in">
                      <div class="panel-body">
                        <div class="row">       
                          <div class="col-md-6 col-sm-6 guest-login">
                            <h4 class="checkout-subtitle outer-top-vs">Detail Hotel</h4>
                            <ul class="text instruction inner-bottom-30">
                              @if(isset($result->hotelInfo->logo))
                              @if(file_exists($result->hotelInfo->logo) || is_file($result->hotelInfo->logo))
                              <li class="save-time-reg">
                                <img src="{{ $result->hotelInfo->logo }}" style="max-width: 80px;">
                              </li>
                              @endif
                              @endif
                              <li class="save-time-reg">- Nama Hotel : {{ $result->hotelInfo->name or '-' }}</li>
                              <li>
                                - Rating Hotels : 
                                @if($result->hotelInfo->rating > 0)
                                @php
                                $totalStar = $result->hotelInfo->rating;
                                $cekStar = 5 - $totalStar;
                                @endphp
                                @for($i = 0; $i < $totalStar; $i++)
                                <span><i class="fa fa-star" style="color:#ff7429;"></i></span>
                                @endfor

                                @for($i1 = 0; $i1 < $cekStar; $i1++)
                                <span><i class="fa fa-star-o"></i></span>
                                @endfor

                                @else
                                @for($i = 0; $i < 5; $i++)
                                <span ><i class="fa fa-star-o" ></i></span>
                                @endfor
                                @endif
                              </li>
                              <li>- Email Hotel : {{ $result->hotelInfo->email or '-' }}</li>
                              <li>- Alamat Hotel : {{ $result->hotelInfo->address or '-' }}</li>
                              <li>- Availability : {{ ($result->hotelInfo->availabilityStatus == true) ? 'Tersedia' : 'Tidak Tersedia' }}</li>
                              <li>- Pesan : {!! $result->hotelInfo->message or '-' !!}</li>
                              <li>- No Telp : {{ $result->hotelInfo->phone or '-' }}</li>
                              <li>- Website : {{ $result->hotelInfo->website or '-' }}</li>
                              <li>- Tanggal Berakhir Promo : {{ $result->hotelInfo->promoEndDate or '-' }}</li>
                            </ul>

                          </div>
                          <div class="col-md-6 col-sm-6 already-registered-login">
                            <h4 class="checkout-subtitle">Fasilitas Hotel</h4>
                            <ul>
                              @if(($result->hotelInfo->facilities) && ($result->hotelInfo->facilities != null) && isset($result->hotelInfo->facilities))
                              @if(count($result->hotelInfo->facilities) > 0)
                              @foreach($result->hotelInfo->facilities as $k1 => $v)
                              <li>- {{ $v }}</li>
                              @endforeach
                              @endif
                              @endif
                            </ul>
                          </div>
                          <div class="col-md-12 col-sm-6 already-registered-login">
                            <h4 class="checkout-subtitle">Pilih Kamar / Ruangan</h4>
                            <input type="hidden" name="breakfast">
                            <input type="hidden" name="price">
                            @if($result->hotelInfo->rooms && ($result->hotelInfo->rooms != null) && isset($result->hotelInfo->rooms))
                            @if(count($result->hotelInfo->rooms) > 0)
                            @foreach($result->hotelInfo->rooms as $k1 => $value1)
                            @if($value1->isOnRequest == false && $value1->isPackageDeal == false)
                              <div class="col-md-4" style="margin-bottom: 10px">
                                <div class="input-group">
                                  <span class="input-group-addon" >
                                    <input type="radio" class="hotelID checkedID{{$k1+1}}" data-key="checkedID{{$k1+1}}" data-breakfast="{{ $value1->breakfast }}" data-price="{{ !is_null($value1->price) ? moneyFormat((int)$value1->price+500) : 0 }}" name="roomID" aria-label="..." value="{{ $value1->ID }}" style="transform: scale(1.4);">
                                  </span>
                                </div>
                                <div class="panel panel-default panel panel-body" style="height: 110px">
                                  <h5 class="heading-title">{{ $value1->name }}</h5>
                                  <h6 class="">Harga : {{ !is_null($value1->price) ? moneyFormat((int)$value1->price+500) : 0 }}</h6>
                                </div>
                              </div>
                            @endif
                            @endforeach
                            @endif
                            @endif
                          </div>
                          <div class="col-md-12 ">
                            <button type="button" class="pull-right btn btn-success cekBed " data-form="dataFormPageCekHotel" data-append="formAppend"><i class="fa fa-search"></i> Cek Bed Hotel</button>
                          </div>
                          <div class="col-md-12 col-sm-6 already-registered-login formAppend">
                            
                          </div>
                        </div>          
                      </div>
                    </div>
                  </div>
                </div>
                @endif
                @endif
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
                          <li><a>Nama : {{ $user->nama }}</a></li>
                          <li><a>Negara : {{ ($user->negara) ? $user->negara->negara : '' }}</a></li>
                          <li><a>Provinsi : {{ ($user->provinsi) ? $user->provinsi->provinsi : '' }}</a></li>
                          <li><a>Kabupaten : {{ ($user->kota) ? $user->kota->kota : '' }}</a></li>
                          <li><a>Kecamatan : {{ ($user->kecamatan) ? $user->kecamatan->kecamatan : '' }}</a></li>
                          <li><a>Alamat : {{ $user->alamat }}</a></li>
                          <li><a>Kode : {{ $user->kode_pos }}</a></li>
                          <li><a>Email : {{ $user->email }}</a></li>
                          <li><a>No : {{ $user->hp }}</a></li>
                        </ul>    
                        <textarea name="alamat" readonly="" style="display: none">{{ $user->alamat or '' }}</textarea>
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
  </div>
</form>
@endsection

@section('js')
<script>
  $(document).on('click','.hotelID',function(){
    var hotelID = $(this).data('key');
    $('.'+hotelID).attr('checked','checked');
    $('input[name="breakfast"]').val($(this).data('breakfast'));
    $('input[name="price"]').val($(this).data('price'));
  });

  $(document).on('click','.bedID',function(){
    $('input[name="bedTypeBed"]').val($(this).data('bed'));
  });

  $(document).on('click','.cekBed',function(e){
    $('#dataFormPageCekHotel').append(`
      <div class="loadings" >Loading&#8230;</div>
    `);
    if($('#dataFormPageCekHotel').form('is valid')){
      $('#dataFormPageCekHotel').ajaxSubmit({
        url:"{{ url('hotel/detail') }}",
        // data:$('#dataFormPageCekHotel').serialize(),
        method:"POST",
        success: function(resp){
          $('.loadings').hide();
          $('.formAppend').html(resp);
        },error: function(resp){
          $('.loadings').hide();
        }
      });
    }
  });
</script>
@endsection
