@extends('layouts.scaffold')

@section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
@endsection
@section('css')
  <style type="text/css">
    /* .input-group,
    .btn-group{
      opacity: 0;
    } */
    /* .table-responsive{
      opacity: 0;
    } */
    li{
      font-size: 14px;
    }
  </style>
@endsection
@section('content-frontend')
<div class="terms-conditions-page">
  <div class="col-md-12 terms-conditions">
    <div class="card">
      <div class="card-header" style="margin-top: 20px">
        <center>Calon Haji / Umroh</center>
      </div>
      <div class="card-body">
        <blockquote class="blockquote mb-0">
          <p>Nama Calon Jamaah Haji / Umroh Yang Belum Lunas Silahkan Harap Melunasi Pembayaran Berikut Nama & Total Pembayaran Yang Harus Di Penuhi Dari Paket & Jadwal Yang Telah Dipilih</p>
          @php
          $total = 0;
          @endphp
          @if($record->count() > 0)
          @foreach($record as $k => $value)
          @php	
                
                $total += $value->jadwal->harga;
                @endphp
            <footer class="blockquote-footer">{{ $value->name }} - <b>Paket ({{ $value->paket->type_paket or '-' }}), Jadwal ({{ $value->jadwal->tgl_berangkat.' - '.$value->jadwal->tgl_pulang }})</b> - Harga ${{ $value->jadwal->harga or '' }} .</footer>
            @endforeach
          @endif
          <br>
          <center>
            <footer class="footer">Total Harga Yang Harus Di Bayar ${{ $total }}
          </footer>
          </center><br>
          <p>Untuk Melakukan Pembayaran Silahkan Transfer Ke NO REK Berikut Dengan Lampiran KODE <b>AyoHU72</b> Untuk Dapat Mengkonfirmasi Pembayaran:</p>
          <footer class="blockquote-footer">
            <p>
              BCA : 2631441990<br>
              BRI : 0577-01-000665-58-2<br>
              Mandiri : 143-00-1892418-1<br>
              BNI : 0831787218
            </p>  
          </footer><br>
          <h3>SYARAT PENDAFTARAN</h3>
          <ol>
            <li>Mengisi formulir pendaftaran</li>
            <li>Tahapan Pembayaran :
              <ul>
                <br>
                <li>a.  Admin Rp. 1.250.000,- saat mendaftar</li>
                <li>b.  Pembayaran 50% (dari harga paket) untuk booking seat</li>
                <li>c.  Pelunasan 1 bulan sebelum keberangkatan</li>
              </ul>
            </li>
            <br>
            <li>Menyerakan dokumen umroh :
              <ul>
                <br>
                <li>a.  Pasport dengan nama 3 kata</li>
                <li>b.  Paspor asli & fotocopy 3 lbr</li>
                <li>c.  Fotocopy buku nikah (Istri)</li>
                <li>d.  Fotocopy Kartu KK (Keluarga Perempuan)</li>
                <li>e.  Fotocopy Akta lahir (Anak umur <= 17 tahun)</li>
                <li>f.  Fotocopy KTP 2 lembar</li>
                <li>g.  Foto fokus wajah 80%, background putih, 4 lbr 4x6 & 3 lbr 3x4</li>
                <li>h.  Kartu Kuning bukti suntik meningitis</li>
              </ul>
            </li>
            <br>
            <li>Ketentuan Lain :
              <ul>
                <br>
                <li>a.  Pembatalan oleh Travel, dikembalikan 100%</li>
                <li>b.  Pembatalan oleh Calon umroh, dikenakan biaya Admin, Pembayaran Tiket dan Visa</li>
                <li>c.  Tambahan Biaya Pengelolaan untuk Cabang ditetapkan oleh masing masing Cabang</li>
              </ul>
            </li>
          </ol>
          <h3>ANJURAN MENTERI AGAMA</h3>
          <p style="font-size: 14px">Menanyakan kepada Travel hal-hal sebagai berikut :</p>
          <ol>
            <li>Keberadaan izin travel</li>
            <li>Alamat travel dan penanggung jawab</li>
            <li>Tiket keberangkatan (tgl, jam, flight number)</li>
            <li>Nama Hotel di Madinah dan Mekkah</li>
            <li>Harga tarif beserta layanan yang diberikan</li>
            <li>Tersedianya Visa Umroh</li>
          </ol>
          <h3>BIAYA SUDAH TERMASUK</h3>
          <ol>
            <li> Tiket pesawat internasional PP</li>
            <li>Air-Pot Tax</li>
            <li>Visa umroh</li>
            <li>Fasilitas hotel bintang 4 dan 5</li>
            <li>Ustadz pembimbing dan guide (15 jamaah dg 1 muthowif)</li>
            <li>Transportasi selama di tanah suci (Bus AC)</li>
            <li>Handling Bandara</li>
            <li>Paket ziarah Madinah, Mekkah, dan Jeddah</li>
            <li>Bimbingan manasik (pembekalan umroh)</li>
            <li>Makan 3 kali sehari prasmanan Indonesia atau fullbox</li>
            <li>Air zam-zam sesuai aturan penerbangan</li>
          </ol>
          <h3>BIAYA TIDAK TERMASUK</h3>
          <ol>
            <li>Hotel, Akomodasi & Transport dari Daerah ke Jakarta</li>
            <li>Kebutuhan pribadi (Laundry dll)</li>
            <li>Biaya tambahan karena peraturan di Arab Saudi</li>
            <li>Kelebihan beban bagasi</li>
            <li>Pemeriksaan kesehatan dan suntik meningitis</li>
            <li>Biaya dan pengobatan bagi jama'ah yang sakit selama perjalanan</li>
            <li>Kehilangan barang atau kejadian tak terduga</li>
            <li>Biaya pembuatan pasport, kursi roda, dll</li>
          </ol>
          <h3>PERLENGKAPAN UMROH</h3>
          <ol>
            <li>Kain Ihrom (L) atau Mukenah (P)</li>
            <li>Koper Polo Jockey (Fiber)</li>
            <li>Cover Koper Polo Jockey</li>
            <li>Tas Slempang (Paspor, HP, dll)</li>
            <li>Tas Sandal</li>
            <li>Bahan Kain Batik</li>
            <li>Kaos Alharom (L)</li>
            <li>Syal dan Kartu Pengenal</li>
            <li>Buku Manasik</li>
          </ol>
          <h3>DIANJURKAN, membawa :</h3>
          <ol>
            <li>GADGET ANDROID</li>
            <li>Obat yg biasa digunakan</li>
            <li>Masker Secukupnya</li>
            <li>Sunblock</li>
            <li>Kacamata Hitam</li>
            <li>Lipgloss (Pelembab Bibir)</li>
            <li>Cream Tumit (Salep Tumit)</li>
            <li>Sandal cadangan</li>
            <li>Obat gosok pegal linu</li>
            <li>Ikat Pinggang Ihram</li>
            <li>Salep Gosok Gatal, dll</li>
            <li>Dalam perjalanan membawa uang secukupnya, selebihnya disimpan dalam bentuk ATM berlogo VISA</li>
          </ol>
          <p>Catatan : </p>
          <ol>
            <li>Jika Sudah Melakukan Pembayaran Silahkan HUB Kontak Kami</li>
            <li>Aturan sewaktu - waktu dapat berubah</li>
          </ol>
        </blockquote>
      </div>
    </div>
  </div>
</div>
<br>
@endsection

{{-- @section('filters')
<div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
	<div class="input-group">
		<input type="text" name="filter[nama]" class="form-control" placeholder="Nama" aria-label="" aria-describedby="">
	</div>&nbsp;
	<div class="btn-group mr-2" role="group" >
		<button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i> Search</button>
		<button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i> Clear</button>
	</div>
</div>
@endsection --}}

{{-- @section('rules')
	<script type="text/javascript">
		formRules = {
			judul: ['empty'],
		};
	</script>
@endsection --}}


{{-- @section('toolbars')

@endsection --}}