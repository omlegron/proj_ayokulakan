<script type="text/javascript">
    $('.selectpicker').selectpicker();
</script>
<div class="row" >
<div class="col-md-12 mt-15 mt-lg-0">
  <div class="tab-content">
      <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
          <div class="myaccount-content" style="padding: 10px">
              <h3> Pulsa {{ $record['pulsa_op'] or '' }}</h3>
              <div class="row">
                  <div class="col-md-6">
                      <label><b>No. Telepon :</b></label>
                      {!! $request['ppob_pelanggan'] or '' !!} <br>
                      <label><b>Nama Provider :</b></label>
                      {!! $record['pulsa_op'] or '' !!} <br>
                      <label><b>Nominal Pulsa :</b></label>
                      <?php echo 'Rp. '. number_format($record['pulsa_nominal'], 0, ".", "."); ?>
                      {{-- Rp. {!! $record['pulsa_nominal'] or '' !!} --}}

                  </div>
                  <div class="col-md-6">
                      

                  </div>
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
                  <form id="dataFormPagePulsa" action="{{ url('ppob-pulsa/store') }}" method="POST">
                    {!! csrf_field() !!}
                    <div class="row">
                      <div class="col-md-12">
                        <div class="row">
                        
                          <input type="hidden" name="ppob_type" value="list_ppob">
                          <input type="hidden" name="form_type" value="list_ppob">
                          <input type="hidden" name="cek_pane" value="pulsa">
                          <input type="hidden" name="type" value="pulsa">
                          <input type="hidden" name="ppob_pelanggan" value="{!! $request['ppob_pelanggan'] or '' !!}" class="form-control child childSelect" placeholder="Nomor Telepon" minlength="12" maxlength="13" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" data-child="PPOBPulsa" data-nama="id_barang" data-type="pulsa">
                          <input type="hidden" class="form-control child target PPOBPulsa selectpicker" value="{!! $request['id_barang'] or '' !!}" name="id_barang" required="" data-dropup-auto="false" data-size="10" data-live-search="true">

                          
                          
                          <div class="col-md-2" style="padding-top: 23px">
                            @if(\Auth::check())
                              <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Pulsa Sekarang ? Pastikan Nomor dan Nominal Pulsa Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPagePulsa"><i class="ion-ios-plus"></i> Beli Pulsa</button>
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