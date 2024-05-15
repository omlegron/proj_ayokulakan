<div class="checkout-box " >
  <div class="row" >
    @if($result && ($result->status == 'SUCCESS') && (count($result->Tours) > 0))
    <input type="hidden" name="TourID" value="">
    <input type="hidden" name="DepartDate" value="">
    <input type="hidden" name="PaymentType" value="">
    <input type="hidden" name="TourVariant" value="">
    <input type="hidden" name="accessToken" value="{{ $result->accessToken }}">
    @foreach($result->Tours as $k => $value)
    <div class="col-md-12">
      <div class="panel-group checkout-steps" id="accordion">
        <div class="panel panel-default checkout-step-01">
          <div class="panel-heading">
            <h4 class="unicase-checkout-title">
              <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne{{$k+1}}">
                <span>{{ $k+1 }}</span> {{ $value->Name or '' }}
              </a>
            </h4>
          </div>

          <div id="collapseOne{{$k+1}}" class="panel-collapse collapse in">
            <div class="panel-body">
              @php
                request()['accessToken'] = $result->accessToken;
                request()['tourid'] = $value->Id;
                request()['tourvariant'] = $value->Variant;
                request()['id'] = $value->Id;
                request()['variant'] = $value->Variant;
                $tourDetail = guzzleGet(request(),'/api/darmawisata/tour/detail')->data;
                $imgList = guzzleGet(request(),'/api/darmawisata/tour/image')->data;
              @endphp
              <div class="row" style="margin-bottom: 20px">
                <div class="col-md-12">
                  <!-- IMG LIST -->
                  <div class="col-md-12 gallery-holder">
                    <div id="myCarousel{{ $k+1 }}" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                     @if($imgList && ($imgList->status == 'SUCCESS') && (count($imgList->Images) > 0))
                     @foreach($imgList->Images as $k1 => $value1)
                     <li data-target="#myCarousel{{ $k+1 }}" data-slide-to="{{$k1}}" class="{{ ($k1 == 0) ? 'active' : '' }}"></li>
                     @endforeach
                     @else
                     <li data-target="#myCarousel{{ $k+1 }}" data-slide-to="1" class="active"></li>
                     @endif
                   </ol>

                   <div class="carousel-inner">
                    @if($imgList && ($imgList->status == 'SUCCESS') && (count($imgList->Images) > 0))
                    @foreach($imgList->Images as $k1 => $value1)
                    <div class="item {{ ($k1 == 0) ? 'active' : '' }}">
                      <img src="{{ $value1->Image }}" alt="Ayokulakan" style="max-width: 400px;">
                      <div class="carousel-caption">
                        <h3>{{ $value1->Caption or '' }}</h3>
                      </div>
                    </div>
                    @endforeach
                    @else
                    <div class="item active">
                      <center>
                        <img src="{{ asset('img/loggo.png') }}" alt="Ayokulakan" style="max-width: 400px;">
                      </center>
                      <div class="carousel-caption">
                        <h3>Ayokulakan Tour</h3>
                      </div>
                    </div>
                    @endif
                    </div>
                    </div>
                  </div>

                  <ul>
                    <li>- Durasi : {{ ($tourDetail->Duration) ? $tourDetail->Duration : '-' }}</li>
                    <li>- Payment Type : {{ ($tourDetail->PaymentType) ? $tourDetail->PaymentType : '-' }}</li>
                    <li>- Destinasi : {{ ($tourDetail->Country) ? $tourDetail->Country.' - ' : '' }} {{ ($tourDetail->Destination) ? $tourDetail->Destination : '-' }}</li>
                    <li>- Tarif Minimum : {{ ($value->MinimumFare) ? $value->MinimumFare : '-' }} </li>
                    <li>- Kapasitas : {{ ($tourDetail->MinPax) ? $tourDetail->MinPax : '-' }} Orang </li>
                  </ul>
                </div>
              </div>
              <div class="row">    
                <div class="col-md-4">
                     <!-- DESKRIPSI -->
                  <div class="panel-group checkout-steps" id="vDesc">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#vDesc" href="#colVDesc{{$k+1}}">
                          <span>-</span> Deskripsi
                        </a>
                      </h4>
                    </div>
                    <div id="colVDesc{{$k+1}}" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="row"> 
                        @if($tourDetail->status == 'SUCCESS')
                          {!! $tourDetail->Description or '-' !!}
                        @else
                        <center>Deskripsi</center>
                        @endif
                      </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </div>   
                <div class="col-md-4">
                  <!-- Itinerary -->
                  <div class="panel-group checkout-steps" id="vIten">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#vIten" href="#colVIten{{$k+1}}">
                          <span>-</span> Itinerary
                        </a>
                      </h4>
                    </div>
                    <div id="colVIten{{$k+1}}" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="row"> 
                        @if($tourDetail->status == 'SUCCESS')
                          {!! $tourDetail->Itinerary or '-' !!}
                        @else
                        <center>Itinerary</center>
                        @endif
                      </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <!-- TermsAndConditions -->
                  <div class="panel-group checkout-steps" id="vTerms">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#vTerms" href="#colVTerms{{$k+1}}">
                          <span>-</span> Terms And Conditions
                        </a>
                      </h4>
                    </div>
                    <div id="colVTerms{{$k+1}}" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="row"> 
                        @if($tourDetail->status == 'SUCCESS')
                          {!! $tourDetail->TermsAndConditions or '-' !!}
                        @else
                        <center>Terms And Conditions</center>
                        @endif
                      </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <!-- Orang -->
                  <div class="panel-group checkout-steps" id="orang">
                  <div class="panel panel-default checkout-step-01">
                    <div class="panel-heading">
                      <h4 class="unicase-checkout-title">
                        <a data-toggle="collapse" class="collapsed" data-parent="#orang" href="#colOrang{{$k+1}}">
                          <span>-</span> Jumlah Pendaftar
                        </a>
                      </h4>
                    </div>
                    <div id="colOrang{{$k+1}}" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="row"> 
                        @if($request->MinimumPax && ((int)$request->MinimumPax > 0))
                        @for($i = 0; $i < $request->MinimumPax; $i++)
                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon" >
                            Orang {{ $i }}    
                            </span>
                          </div>
                          <div class="panel panel-default panel panel-body">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <select name="Pax[0][Title]" class="form-control">
                                    <option value="Mr" selected="">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Miss">Miss</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <input type="text" name="Pax[0][Name]" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                  <select name="Pax[0][Type]" class="form-control">
                                    <option value="Adult" selected="">Adult</option>
                                    <option value="Child">Child</option>
                                    <option value="Infant">Infant</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <input type="hidden" name="Pax[0][Room]" class="paxRoom" value="">
                                </div>
                              </div>
                          </div>
                        </div>
                        @endfor
                        @else
                        <div class="col-md-6">
                          <div class="input-group">
                            <span class="input-group-addon" >
                            Orang 1   
                            </span>
                          </div>
                          <div class="panel panel-default panel panel-body">
                              <div class="col-md-12">
                                <div class="form-group">
                                  <select name="Pax[0][Title]" class="form-control">
                                    <option value="Mr" selected="">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                    <option value="Ms">Ms</option>
                                    <option value="Miss">Miss</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <input type="text" name="Pax[0][Name]" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                  <select name="Pax[0][Type]" class="form-control">
                                    <option value="Adult" selected="">Adult</option>
                                    <option value="Child">Child</option>
                                    <option value="Infant">Infant</option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <input type="hidden" name="Pax[0][Room]" class="paxRoom" value="">
                                </div>
                              </div>
                          </div>
                        </div>
                        @endif
                      </div>
                    </div>
                    </div>
                  </div>
                  </div>
                </div>
                @if($value->Packages && (count($value->Packages) > 0))
                @foreach($value->Packages as $pack => $vPack)
                  <div class="col-md-6" style="padding-bottom: 5px;">
                    <div class="input-group">
                        <span class="input-group-addon" >
                          <input type="radio" class="package{{$k}}_{{$pack}}" name="PackageID" data-depart="{{ \Carbon\Carbon::parse($vPack->DepartDate)->format('Y-m-d') }}" aria-label="..." value="{{ $vPack->Id }}" data-tour="{{ $value->Id }}" style="transform: scale(1.4);" data-payment="{{ $tourDetail->PaymentType }}" data-variant="{{ $tourDetail->Variant }}">
                              </span>
                        </span>
                    </div>
                    <div class="panel panel-default panel panel-body">
                        @if(($vPack->Rabs != null))
                        <div class="form-group">
                          <select name="RabID" class="form-control rab">
                            @foreach($vPack->Rabs as $kRabs => $vRabs)
                            <option value="{{ $vRabs->Name }}" {{ ($kRabs == 0) ? 'selected' : '' }}>{{ $vRabs->Name }} - {{ moneyFormat($vRabs->Price) }}</option>
                            @endforeach
                          </select>
                        </div>
                        @endif
                        <h6 class="">Name : {{ $vPack->Name }}</h6>
                        <h6 class="">Depart Date : {{ $vPack->DepartDate }}</h6>
                        <h6 class="">Remaining Quota : {{ $vPack->RemainingQuota }}</h6>
                        <h6 class="">Harga : {{ $vPack->SellPrice }}</h6>
                        <button type="button" class="btn btn-success btn-lg btn-block darma-save-transaksi-render" data-form="#dataForm">Booking Sekarang</button>
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
    </div>
    @endforeach
    @else
    <div class="col-md-12">
      <div class="panel panel-default" style="padding: 20px; overflow: hidden;">
          <div class="text-center">
              <b>Upss... sepertinya anda tidak menemukan apa2 disini!</b>
              <br>
              Maaf Data Pencarian Tidak Tersedia Silahkan Lakukan Pencarian Ulang.
          </div>
      </div>
    </div>
    @endif
  </div>
</div>

<script type="text/javascript">
  $(document).on('change','input[name="PackageID"]',function(){
    var depart = $(this).data('depart');
    var tourId = $(this).data('tour');
    var payment = $(this).data('payment');
    var variant = $(this).data('variant');
    $('input[name="DepartDate"]').val(depart);
    $('input[name="TourID"]').val(tourId);
    $('input[name="PaymentType"]').val(payment);
    $('input[name="TourVariant"]').val(variant);
  });

  $(document).on('change','.rab',function(){
    var val = $(this).val();
    $('.paxRoom').val(val);
  });
</script>