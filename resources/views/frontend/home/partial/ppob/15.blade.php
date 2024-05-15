{{-- <div class="content-ayokulakan" style="padding-top: 12px">
  <form id="ppob_telpon_rumah" onsubmit="return false"  method="POST">
    {!! csrf_field() !!}
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="telepon_rumah" class="form-control" placeholder="Nomor Pelanggan">
            </div>
          </div>
          <div class="col-md-3" style="padding-top: 23px">
            <button type="submit" class="btn btn-success"><i class="ion-android-refresh"></i> Cek Tagihan</button>
          </div>
        </div>
      </div>
    </div>
  </form>
</div>
<div id="ppob_telpon_rumah_result" style="display:none">
  <div class="form-group">
    <label>Nama Pelanggan</label>
    <input type="text" class="form-control napel" disabled value="">
  </div>
  <div class="form-group">
    <label>Jumlah Tagihan </label>
    <input type="text" class="form-control juta" disabled value="">
  </div>
  <div class="form-group">
    <label>Periode</label>
    <input type="text" class="form-control periode" disabled value="">
  </div>
</div>
 --}}





<div class="content-ayokulakan" style="padding-top: 12px">
  <form id="dataFormInqueryPascaTelepon" action="{{ url('ppob-pasca/store') }}" method="POST">
    {!! csrf_field() !!}
    <input type="hidden" value="TELKOMPSTN" name="type">
    <div class="row">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <h4 style="color: green;font-family: arial">Telepon Rumah</h4>
            </div>
          </div>
          <div class="col-md-9">
            <div class="form-group">
              <label>Nomor Pelanggan</label>
              <input type="text" name="ppob_pelanggan" class="form-control childPPOBInquery" placeholder="Nomor Pelanggan">
            </div>
          </div>
          
          <div class="col-md-3" style="padding-top: 23px;margin-bottom: 15px">
            <button type="button" class="btn btn-success check-inquiry ppob-telepon pull-right" data-url="check-tlp-rmh" data-form="dataFormInqueryPascaTelepon"  data-show="show-inquiry-telepon"><i class="ion-android-refresh"></i> Cek Tagihan</button>
           {{--  @if(\Auth::check())
              <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Paket Data Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormInqueryPascatelepon"><i class="ion-ios-plus"></i> Beli Paket Data</button>
            @else
            @endif --}}
            
          </div>
        </div>    
      </div>
    </div>
  </form>
</div>
<div class="show-inquiry-telepon">
    
</div>
