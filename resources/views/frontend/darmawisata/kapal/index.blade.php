@extends('layouts.scaffold')

@section('css')
<style>
  .outline-top {
    margin-top: 20px;
  }

  @media (max-width: 500px) {
    .outline-top {
      margin-top: 299px;
    }
  }
</style>
@endsection

@section('content-frontend')

<form id="dataFormPageCekShip" action="{{ url('kapal/schedule') }}" method="GET">
  <div class="container outer-top">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Pemesan</label>
                <input type="text" name="ticketBuyerName" class="form-control" placeholder="Nama Pemesan" value="{{ (\Auth::check()) ? auth()->user()->nama : '' }}">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Email Pemesan</label>
                <input type="text" name="ticketBuyerEmail" class="form-control" placeholder="Email Pemesan" value="{{ (\Auth::check()) ? auth()->user()->email : '' }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Alamat Pemesan</label>
                <input type="text" name="ticketBuyerAddress" class="form-control" placeholder="Alamat Pemesan" value="{{ (\Auth::check()) ? auth()->user()->alamat : '' }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Nomor Telp Pemesan</label>
                <input type="text" name="ticketBuyerPhone" class="form-control" placeholder="Nomor Telp Pemesan" value="{{ (\Auth::check()) ? auth()->user()->hp : '' }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label>Bersama Keluarga ?</label>
                <select name="family" class="form-control">
                  <option value="true">Ya</option>
                  <option value="false">Tidak</option>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Pilih Keberangkatan</label>
                <select name="originPort" class="form-control selectpicker " required="" data-live-search="true" data-dropup-auto="false" data-size="10" data-child="cityID" data-namas="cityID">
                  {!! App\Models\Master\DarmaPelniOrigin::options('originName', 'originPort', [], 'Pilih Salah Satu') !!}
                </select> 
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Pilih Tujuan Keberangkatan</label>
                <select name="destinationPort" class="form-control selectpicker" required="" data-live-search="true" data-dropup-auto="false" data-size="10" data-child="cityID" data-namas="cityID">
                  {!! App\Models\Master\DarmaPelniOrigin::options('originName', 'originPort', [], 'Pilih Salah Satu') !!}
                </select> 
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Keberangkatan</label>
                <input type="text" name="departStartDate" class="form-control start-date" placeholder="Tanggal Keberangkatan" readonly="">   
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Tujuan Akhir</label>
                <input type="text" name="departEndDate" class="form-control end-date" readonly="" placeholder="Tanggal Tujuan Akhir" >
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah Penumpang Dewasa Laki - Laki</label>
                <input type="hidden" name="pax[0][paxType]" class="form-control" placeholder="Check In" value="Adult">  
                <input type="hidden" name="pax[0][paxGender]" class="form-control" placeholder="Check In" value="M">   
                <input type="text" name="pax[0][paxTotal]" class="form-control" placeholder="Jumlah Penumpang Dewasa Laki - Laki" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah Penumpang Dewasa Perempuan</label>
                <input type="hidden" name="pax[1][paxType]" class="form-control" placeholder="Check In" value="Adult">  
                <input type="hidden" name="pax[1][paxGender]" class="form-control" placeholder="Check In" value="F">   
                <input type="text" name="pax[1][paxTotal]" class="form-control" placeholder="Jumlah Penumpang Dewasa Perempuan" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah Penumpang Anak Laki - Laki</label>
                <small>*UMUR KHUSUS PENUMPANG ANAK LEBIH DARI 2 TAHUN</small>
                <input type="hidden" name="pax[2][paxType]" class="form-control" placeholder="Check In" value="Infant">  
                <input type="hidden" name="pax[2][paxGender]" class="form-control" placeholder="Check In" value="M">   
                <input type="text" name="pax[2][paxTotal]" class="form-control" placeholder="Jumlah Penumpang Anak Laki - Laki" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label>Jumlah Penumpang Anak Perempuan</label>
                <small>*UMUR KHUSUS PENUMPANG ANAK LEBIH DARI 2 TAHUN</small>
                <input type="hidden" name="pax[3][paxType]" class="form-control" placeholder="Check In" value="Infant">  
                <input type="hidden" name="pax[3][paxGender]" class="form-control" placeholder="Check In" value="F">   
                <input type="text" name="pax[3][paxTotal]" class="form-control" placeholder="Jumlah Penumpang Anak Perempuan" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">   
              </div>
            </div>
            <div class="col-md-6">
              <a href="{{ url('kapal/panduan') }}" class="btn btn-warning next-page pull-left"><i class="ion-ios-paper"></i> Panduan</a>
            </div>
            <div class="col-md-6">
              <button type="button" class="pull-right btn btn-success searchHotel check append page" data-form="dataFormPageCekShip" data-append="formAppend"><i class="ion-android-refresh"></i> Lihat Jadwal</button>
            </div>

          </div>   
        </div>

      </div>
      <div class="formAppend">

      </div>
      <div class="checkout-box">
        <div class="row">
          <div class="col-md-12">
            <div class="panel-group checkout-steps" id="accordion">
              <div class="panel panel-default checkout-step-01">
                <div class="panel-heading">
                  <h4 class="unicase-checkout-title">
                    <a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne1">
                      <span>1</span>
                      Syarat & Ketentuan
                    </a>
                  </h4>
                </div>

                <div id="collapseOne1" class="panel-collapse collapse in" style="">
                  <div class="panel-body">
                    <div class="row">   
                      <h1><b>Syarat & Ketentuan</b></h1>
                      <p>
                        <ol>
                          <li>
                            Selama Pandemi Covid-19, Calon Penumpang wajib memperhatikan hal-hal sebagai berikut :
                            <ul style="list-style-type: lower-alpha;padding-left: 12px;">
                              <li>
                                Calon Penumpang Wajib Memiliki Surat Keterangan Bebas Covid-19 dari hasil PCR atau Rapid Test terbaru dengan hasil Negatif / Non-Reaktif dan masih berlaku (14 hari) yang dikeluarkan oleh Rumah Sakit atau Fasilitas Kesehatan yang diakui Pemerintah.
                              </li>
                              <li>
                                Calon Penumpang wajib datang ke Pelabuhan maksimal 3 (tiga) jam sebelum keberangkatan Kapal untuk dilakukan verifikasi dan validasi Surat Keterangan Bebas Covid-19 oleh Kantor Kesehatan Pelabuhan (KKP) serta melakukan pencetakan tiket atau boarding pass.
                              </li>
                              <li>
                                Jika Surat Keterangan Bebas Covid-19 milik Calon Penumpang bermasalah (dinyatakan tidak berlaku, palsu atau ditolak oleh Kantor Kesehatan Pelabuhan) maka Tiket yang sudah dibeli dapat dibatalkan di Loket Cabang PT.PELNI sesuai dengan ketentuan yang berlaku.
                              </li>
                              <li>
                                Calon Penumpang wajib memperhatikan syarat masuk di pelabuhan tujuan yang dapat di cek melalui link : http://bit.ly/DaftarPelabuhan.
                              </li>
                              <li>
                                Calon Penumpang yang ditolak masuk di Pelabuhan tujuan karena tidak melengkapi persyaratan yang telah disebutkan, bukan menjadi tanggung jawab PT.PELNI (Persero).
                              </li>
                              <li>
                                Calon Penumpang wajib menjalankan Protokol Kesehatan 3M (Memakai Masker, Mencuci Tangan dan Menjaga Jarak) selama berada di atas Kapal.
                              </li>
                            </ul>
                          </li>
                          <li>
                            Bukti pembayaran ini tidak berlaku sebagai dokumen yang sah bagi penumpang untuk naik ke atas kapal, wajib ditukar menjadi tiket/boarding pass selambat-lambatnya 3 (tiga) jam sebelum keberangkatan kapal.
                          </li>
                          <li>
                            Bukti pembayaran ini dapat ditukar menjadi tiket di cabang PT. PELNI(Persero), kecuali bagi calon penumpang dengan Pelabuhan keberangkatan Tg. Priok, Semarang, Surabaya, Makassar, Belawan, Ambon, dan Bitung. Penukaran boarding pass dapat dilakukan di terminal keberangkatan penumpang mulai 24 jam sebelum keberangkatan kapal.
                          </li>
                          <li>
                            Kode booking yang tertera pada bukti pembayaran adalah bersifat rahasia, PT. PELNI (Persero) tidak bertanggung jawab apabila terjadi penyalahgunaan kode booking yang digunakan pihak lain.
                          </li>
                          <li>
                            PT. PELNI (Persero) tidak bertanggungjawab atas kerugian yang ditimbulkan akibat pembatalan/keterlambatan calon penumpang.
                          </li>
                          <li>
                            Pembatalan tiket atas kehendak penumpang dapat dilakukan selambat-lambatnya 5 (lima) jam sebelum keberangkatan kapal dan penumpang belum mencetak boarding pass atau boarding di terminal, dengan ketentuan sebagai berikut : 
                            <ul style="list-style-type: lower-alpha;padding-left: 12px;">
                              <li>Pembatalan umum penumpang dikenakan biaya 50% (lima puluh persen) dari tarif dasar tiket;</li>
                              <li>Pembatalan tiket disebabkan oleh pemalsuan Surat Bebas Covid-19 sesuai dengan point a.</li>
                              <li>Pembatalan ubah jadwal atau rute kapal dikenakan biaya administrasi sebesar 10% (sepuluh persen) dari tarif dasar tiket yang dibatalkan ditambah tarif tiket pengganti, jika tarif tiket yang dibatalkan lebih tinggi dari tarif tiket pengganti maka tidak ada pengembalian biaya selisih tiket;</li>
                              <li>atal Suplisi (upgrade jenis kelas), dikenakan biaya administrasi sebesar Rp. 10.000,- (sepuluh ribu rupiah).  </li>
                            </ul> 
                          </li>
                          <li>
                            Bagi penumpang dengan kondisi hamil lebih dari 7 (tujuh) bulan tidak diijinkan untuk berlayar.
                          </li>
                          <li>Penumpang dilarang berjudi, mengkonsumsi minuman keras, berdagang di atas kapal, dan membawa barang-barang terlarang selama pelayaran </li>
                          <li>Barang-barang terlarang yang dimaksud adalah sebagai berikut:  <ul style="list-style-type: lower-alpha;padding-left: 12px;">
                            <li>Binatang;</li>
                            <li>Tanaman yang dilarang oleh Karantina Pelabuhan;</li>
                            <li>Narkotika psikotropika dan zat aditif lainnya;</li>
                            <li>Senjata api dan senjata tajam;</li>
                            <li>Semua barang-barang yang mudah terbakar/meledak;</li>
                            <li>Semua barang-barang berbau busuk, amis atau karena sifatnya dapat mengganggu/merusak kesehatan dan mengganggu kenyamanan penumpang lainnya;</li>
                            <li>Barang yang menurut pertimbangan petugas boarding atau pemeriksa bagasi karena keadaan dan ukuran berat/volume melebihi batas ketentuan bagasi;</li>
                            <li>Barang yang dilarang oleh peraturan perundang-undangan.</li>
                          </ul> 
                        </li>
                        <li>Setiap penumpang dapat membawa barang bagasi cuma-cuma maksimal 40 (empat puluh) kg </li>
                        <li>Setiap kelebihan barang bawaan sebagaimana ketentuan diatas maka dikenakan tarif over bagasi sesuai dengan syarat dan ketentuan yang berlaku.</li>
                        <li>PT. PELNI tidak bertanggung jawab atas hilang/rusaknya tiket dan barang-barang bawaan penumpang.</li>
                        <li>Penumpang diharapkan untuk mengikuti perubahan waktu keberangkatan kapal yang mungkin terjadi dan selambat-lambatnya 2 (dua) jam sebelum keberangkatan kapal sudah berada di terminal penumpang.</li>
                        <li>Informasi syarat dan ketentuan yang berlaku dapat diperoleh di Kantor Cabang PT. PELNI atau website www. pelni.co.id</li>
                        <li>Informasi Pengaduan dapat menghubungi call center PT. PELNI dinomor 162/021-162 atau melalui Whatsapp di nomor 0811-1621-162.</li>
                      </ol>

                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
</form>
@endsection

@section('js')

<script>
  $(document).on('click','.searchHotel',function(){
    $('#dataFormPageCekShip').attr('action',"{{ url('kapal/schedule') }}");
  });

  $(document).on('click','.shipID',function(){
    var shipID = $(this).data('key');
    $('.clearshipID').attr('checked', false);
    $('.'+shipID).attr('checked','checked');
    $('#dataFormPageCekShip').attr('action',"{{ url('kapal/rooms') }}");
  });

  $(document).on('click','.pesanKapal',function(){
    $('#dataFormPageCekShip').append(`
      <div class="loadings" >Loading&#8230;</div>
      `);
    $('#dataFormPageCekShip').submit();
  });

  $(document).on('keyup','input[name="childNum"]',function(){
    val = $(this).val();
    $('.removeUmur').remove();
    for (var i = 0; i < val; i++) {
      $('.appendUmur').append(`
        <div class="col-md-4 removeUmur">
        <div class="form-group">
        <label>Umur Anak</label>
        <input type="text" name="childAges[]" class="form-control" placeholder="Umur Anak Yang di Bawa" >
        </div>
        </div>
        `);
    }
  });
</script>

<script type="text/javascript" src="{{ url('/plugins/datepicker/bootstrap-datepicker.js') }}"></script>

<script type="text/javascript">
  months = [ "January", "February", "March", "April", "May", "June",
  "July", "August", "September", "October", "November", "December" ];
  $.fn.datepicker.dates['id'] = {
    days: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
    daysShort: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
    daysMin: ["Su", "Mo", "Tu", "We", "Th", "Fr", "Sa"],
    months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
    monthsShort: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    today: "Today",
    clear: "Clear",
    format: "mm/dd/yyyy",
    titleFormat: "MM yyyy", /* Leverages same syntax as 'format' */
    weekStart: 0
  };
  $('.bots-month').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'MM',
    language:'id'
  });
  $('.bots-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true,
  });
  var date = new Date();
  var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
  var end = new Date(date.getFullYear(), date.getMonth(), date.getDate());

  $('.start-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,
  }).on('changeDate', function (selected) {
    var minDate = new Date(selected.date.valueOf());
    $('.end-date').datepicker('setStartDate', minDate);
  });

  $('.end-date').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    autoclose: true
  }).on('changeDate', function (selected) {
    var maxDate = new Date(selected.date.valueOf());
    $('.start-date').datepicker('setEndDate', maxDate);
  });
  $('.input-daterange').datepicker({
    format: 'yyyy-mm-dd',
    todayHighlight: true,
    startDate: today,
    autoclose: true,

  });
</script>
@endsection
