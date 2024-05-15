<script type="text/javascript">
  $('.selectpicker').selectpicker();
</script>
<div class="row" >
  <div class="col-md-12 mt-15 mt-lg-0">
    <div class="tab-content">
      <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
        <div class="myaccount-content" style="padding: 10px">
          <h3> Paket Data </h3>
          <div class="row">
            <div class="col-md-12">
              <label><b>No. Telepon :</b></label>
              {!! $request['ppob_pelanggan'] or '' !!} <br>
              <label><b>Nama Provider :</b></label>
              {!! $record['pulsa_op'] or '' !!} <br>
              <label><b>Paket Data :</b></label>
              {!! $record['pulsa_nominal'] or '' !!} <br>
              <label><b>Harga Paket Data :</b></label>
              {{ isset($record) ? moneyFormat($record->pulsa_price) : '' }}
            </div>

            @if($record)
              <div class="content-ayokulakan" style="padding-top: 12px">
                <form id="dataFormPageData" action="{{ url('ppob-pulsa/store') }}" method="POST">
                  {!! csrf_field() !!}
                  <div class="row">
                    <div class="col-md-12">
                      <div class="row">
                        <input type="hidden" name="ppob_type" value="list_ppob">
                        <input type="hidden" name="form_type" value="list_ppob">
                        <input type="hidden" name="cek_pane" value="data">
                        <input type="hidden" name="type" value="data">

                        <input type="hidden" name="ppob_pelanggan" value="{!! $request['ppob_pelanggan'] or '' !!}" class="form-control child childSelect" placeholder="Nomor Telepon" minlength="12" maxlength="13" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')" data-child="PPOBPulsa" data-nama="id_barang" data-type="pulsa">
                        <input type="hidden" class="form-control child target PPOBPulsa selectpicker" value="{!! $request['id_barang'] or '' !!}" name="id_barang" required="" data-dropup-auto="false" data-size="10" data-live-search="true">



                        <div class="col-md-12" style="padding-top: 23px">
                          @if(\Auth::check())
                          <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Beli Paket Data Sekarang ? Pastikan Nomor Sudah Benar." data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageData"><i class="ion-ios-plus"></i> Beli Paket Data</button>
                          @else
                          @endif

                        </div>
                      </div>    
                    </div>
                  </div>
                </form>
              </div>
            @else
              <center>Maaf Saat Ini Paket Tidak Tersedia</center>
            @endif
          </p>
        </div>
      </div>
    </div>
  </div>
</div>