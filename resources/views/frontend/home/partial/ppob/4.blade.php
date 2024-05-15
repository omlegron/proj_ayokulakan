
<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormInqueryPascaBPJS" action="{{ url('ppob-pasca/store') }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" name="type" value="BPJS">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <h4 style="color: green;font-family: arial">BPJS Kesehatan</h4>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control childPPOBInquery" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group ">
              <label for="">Pilih Bulan</label>
              <input type="text" name="month" class="bots-month form-control" placeholder="Pilih Bulan" >   
            </div>    
          </div>
          <div class="col-md-12" style="padding-top: 13px;margin-bottom: 15px">
            <button type="button" class="btn btn-success check-inquiry ppob-bpjs pull-right" data-url="check-bpjs" data-form="dataFormInqueryPascaBPJS"  data-show="show-inquiry-bpjs"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-bpjs">
    
</div>
