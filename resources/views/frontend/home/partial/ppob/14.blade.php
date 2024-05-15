<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormPageInternetLG" action="{{ url('ppob-pasca/store') }}" method="POST">
    {!! csrf_field() !!}
    <div class="row">
    <div class="col-md-12">
              <div class="form-group">
                <h4 style="color: green;font-family: arial">Internet</h4>
              </div>
            </div>
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group" style="padding-bottom: 10px !important">
              <label>Pilih Langganan</label>
              <select name="type" class="form-control selectpicker" data-dropup-auto="false" data-size="10" required="" data-live-search="true" >
                <option value="" selected disabled>Pilih Langganan Internet</option>
                <option value="CBN">CBN Internet</option>
                <option value="SPEEDY">Indihome (Speedy)</option>
                <option value="MYREPUBLIC">My Republic</option>
                {{-- <option value="Bizznet">Bizznet</option> --}}
              </select>    
            </div>
          </div>
          <div class="col-md-12" style="padding-top: 13px;margin-bottom: 15px">
            <button type="button" class="btn btn-success check-inquiry-internet ppob-internetLG pull-right" data-url="check-internet" data-form="dataFormPageInternetLG" data-show="show-inquiry-internetLG"><i class="ion-android-refresh"></i> Cek Tagihan</button>
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-internetLG">
    
</div>