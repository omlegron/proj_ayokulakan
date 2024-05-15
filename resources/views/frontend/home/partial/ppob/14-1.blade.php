<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>
<div class="row">
<div class="col-md-12 mt-15 mt-lg-0">
  <div class="tab-content">
      <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
          <div class="myaccount-content">
              <h3>Internet Atas Nama -  {{ $record['tr_name'] or '' }}</h3>
              <div class="row">
                  <div class="col-md-6">
                      <label><b>No. Pelanggan :</b></label>
                      {!! $record['hp'] or '' !!}

                  </div>
                  <div class="col-md-6">
                      <label><b>Atas Nama :</b></label>
                      {!! $record['tr_name'] or '' !!}

                  </div>
                  {{-- <div class="col-md-6">
                      <label><b>Periode :</b></label>
                      {!! $record['period'] or '' !!}

                  </div> --}}
                  
                  <div class="col-md-6">
                      <label><b>Produk Internet :</b></label>
                      {!! $record['desc']->product_desc or $record['code'] !!}

                  </div>
                  <div class="col-md-6">
                      <label><b>Total Tagihan :</b></label>
                      <?php echo 'Rp. '. number_format($record['price'], 0, ".", "."); ?>

                  </div>
              </div>
              {{-- <p class="saved-message">You Can't Saved Your Payment Method yet.</p> --}}
              <p class="mb-0">
                  <div class="content-ayokulakan" style="padding-top: 12px">
                      <form id="dataFormPageInternet" action="{{ url('ppob-pasca/store') }}" method="POST">
                          {!! csrf_field() !!}
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="row">
                                      <input type="hidden" name="form_type" value="ppob_internet">

                                      <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                      <input type="hidden" name="type" value="{{ $record['code'] or '' }}">
                                      <input type="hidden" name="types" value="internet">

                                      <div class="col-md-12 pull-right" style="padding-top: 33px">
                                          @if(\Auth::check())
                                          <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Bayar Sekarang ? Pastikan Nomor Pelanggan dan Tagihan Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPageInternet"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
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