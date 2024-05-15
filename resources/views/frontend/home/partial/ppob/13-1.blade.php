<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>
<div class="row" >
<div class="col-md-12 mt-15 mt-lg-0">
  <div class="tab-content">
      <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
          <div class="myaccount-content" style="padding: 10px">
            <h3>{!! $record['code'] or '' !!} - {{ $record['tr_name'] or '' }}</h3>
              <div class="row">
                  <div class="col-md-12">
                      {{-- <label><b>No. Telepon :</b></label>
                      {!! $request['ppob_pelanggan'] or '' !!} <br>
                      <label><b>Nama Provider :</b></label>
                      {!! $record['pulsa_op'] or '' !!} <br>
                      <label><b>Paket Data :</b></label>
                       {!! $record['pulsa_nominal'] or '' !!} --}}

                       <label><b>No. Pelanggan :</b></label>
                       {!! $request['ppob_pelanggan'] or '' !!} <br>
                       <label><b>Periode :</b></label>
                       {!! $record['period'] or '' !!} <br>
                       <label><b>Tagihan :</b></label>
                       <?php echo 'Rp. '. number_format($record['nominal'], 0, ".", "."); ?> <br>
                       <label><b>admin :</b></label>
                       <?php echo 'Rp. '. number_format($record['admin'], 0, ".", "."); ?>
                       
                                    

                  </div>
                  {{-- <div class="col-md-6">
                      

                  </div> --}}
                  {{-- <div class="col-md-6">
                      <label><b>Periode :</b></label>
                      {!! $record['period'] or '' !!}

                  </div> --}}
                  
                  <div class="col-md-6">
                      
                  </div>
                  {{-- <div class="col-md-6">
                      <label><b>Total Pembayaran :</b></label>
                      Rp. {!! $record['pulsa_price'] !!}

                  </div> --}}
              </div>
              {{-- <p class="saved-message">You Can't Saved Your Payment Method yet.</p> --}}
              <p class="mb-0">
                  

                <div class="content-ayokulakan" style="padding-top: 12px">
                    <form id="dataFormPageTvByr" action="{{ url('ppob-pasca/store') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                    <input type="hidden" name="type" value="{{ $record['code'] or '' }}">
                                    <input type="hidden" name="types" value="TV">
                                    <input type="hidden" name="form_type" value="ppob_tv">

                                    
                                    
                                    <div class="col-md-12">
                                        <label ><b>Total Pembayaran : </b><?php echo 'Rp. '. number_format($record['price'], 0, ".", "."); ?>
                                            </label>
                                    </div>
                                    <div class="col-md-12">
                                        <label ><i style="font-size: 10px">*Sudah Termasuk Biaya Admin (<?php echo 'Rp. '. number_format($record['admin'], 0, ".", "."); ?>
                                            )</i></label>
                                    </div>
                                    <div class="col-md-12" style="padding-top: 33px">
                                        @if(\Auth::check())
                                        <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Bayar Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPageTvByr"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
                                        @else
                                        @endif
                                    </div>
                                </div>    
                            </div>
                        </div>
                    </form>
                </div>
                

              </p>
          </div>
      </div>
  </div>
</div>
</div>

