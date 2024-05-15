
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageData1" action="{{ url('ppob-pulsa/store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <h4 style="color: green;font-family: arial">Paket Data</h4>
            </div>
          </div>
          <input type="hidden" name="ppob_type" value="list_ppob">
          <input type="hidden" name="form_type" value="list_ppob">
          <input type="hidden" name="cek_pane" value="data">
          <input type="hidden" name="type" value="data">

          <div class="col-md-12">
            <div class="form-group">
              <label>Nomor Telepon</label>
              <input type="text" name="ppob_pelanggan" class="form-control child childSelect" placeholder="Nomor Telepon" min="" max="13" data-child="PPOBPaket" data-nama="id_barang" data-type="data">
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label for="">Pilih Nominal</label>
              <select class="form-control child target PPOBPaket selectpicker" name="id_barang" required="" data-dropup-auto="false" data-size="10" >
              </select> 
          
              <div id="PPOBPaket">
                
              </div>          
            </div>    
          </div>
          <div class="col-md-12" style="padding-top: 13px;margin-bottom: 15px">
            <button type="button" class="btn btn-success pulsa ppob-pulsa pull-right" data-url="check-pulsa" data-form="dataFormPageData1" data-show="show-inquiry-data"><i class="ion-android-refresh"></i> Cek Pembayaran</button>

            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-data">
    
</div>
