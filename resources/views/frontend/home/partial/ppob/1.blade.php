
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPagePulsa1" action="{{ url('ppob-pulsa/check-pulsa') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
        <div class="col-md-12">
              <div class="form-group">
                <h4 style="color: green;font-family: arial">Pulsa</h4>
              </div>
            </div>
          <input type="hidden" name="ppob_type" value="list_ppob">
          <input type="hidden" name="form_type" value="list_ppob">
          <input type="hidden" name="cek_pane" value="pulsa">
          <input type="hidden" name="type" value="pulsa">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="text" name="ppob_pelanggan" class="form-control child childSelect" placeholder="Nomor Telepon" minlength="12" maxlength="13" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" data-child="PPOBPulsa" data-nama="id_barang" data-type="pulsa">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Pilih Nominal</label>
              <select class="form-control child target PPOBPulsa selectpicker" name="id_barang" required="" data-dropup-auto="false" data-size="10" data-live-search="true">
              </select> 
          
              <div id="PPOBPulsa" >
                
              </div>          
            </div>    
          </div>
          <div class="col-md-12" style="padding-top: 13px;margin-bottom: 15px">
          
            <button type="button" class="btn btn-success pulsa ppob-pulsa pull-right" data-url="check-pulsa" data-form="dataFormPagePulsa1" data-show="show-inquiry-pulsa"><i class="ion-android-refresh"></i> Cek Pembayaran</button>
            
          </div>
          
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-pulsa">
    
</div>