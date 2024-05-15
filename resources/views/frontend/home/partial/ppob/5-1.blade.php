<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>
<div class="row">
<div class="col-md-12 mt-15 mt-lg-0">
  <div class="tab-content">
      <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
          <div class="myaccount-content">
              <h3>{!! $record['desc']->pdam_name or '' !!} - {{ $record['tr_name'] or '' }}</h3>
              <div class="row">
                  <div class="col-md-6">
                      <label><b>No. Pelanggan :</b></label>
                      {!! $record['hp'] or '' !!} <br>
                      <label><b>Nama :</b></label>
                      {!! $record['tr_name'] or '' !!}<br>
                      <label><b>Alamat Pdam :</b></label>
                      {!! $record['desc']->pdam_name or '' !!}<br>
                      <label><b>Jatuh Tempo :</b></label>
                      {!! $record['desc']->due_date or '' !!} <br>
                      <label><b>Biaya Admin :</b></label>
                      <?php echo 'Rp. '. number_format($record['admin'], 0, ".", "."); ?>
                    <br><br>
                  </div>
                  
                  {{-- <div class="col-md-6">
                      <label><b>Kode Tarif :</b></label>
                      {!! $record['desc']->kode_tarif or '' !!}

                  </div> --}}
                  {{-- <div class="col-md-6">
                      

                  </div> --}}
                  {{-- <div class="col-md-6">
                      

                  </div> --}}
                  <div class="col-md-12 pull-right">
                      <label><b>Total Tagihan :</b></label>
                      <?php echo 'Rp. '. number_format($record['price'], 0, ".", "."); ?>


                  </div>
              </div>
              {{-- <p class="saved-message">You Can't Saved Your Payment Method yet.</p> --}}
              <p class="mb-0">
                  <div class="content-ayokulakan" style="padding-top: 12px">
                      <form id="dataFormPagePdam" action="{{ url('ppob-pasca/store') }}" method="POST">
                          {!! csrf_field() !!}
                          <div class="row">
                              <div class="col-md-12">
                                  <div class="row">
                                      <input type="hidden" name="form_type" value="ppob_pdam">

                                      <input type="hidden" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                      <input type="hidden" name="type" value="{{ $record['code'] or '' }}">
                                      <input type="hidden" name="types" value="PDAM">

                                      <div class="col-md-12 pull-right" style="padding-top: 15px">
                                          @if(\Auth::check())
                                          <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Bayar Sekarang ? Pastikan Nomor Pelanggan dan Tagihan Sudah Benar." data-confirm="Bayar" data-batal="Batal" data-forms="dataFormPagePdam"><i class="ion-ios-plus"></i> Bayar Sekarang</button>
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