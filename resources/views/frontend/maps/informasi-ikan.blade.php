@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();

@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty']
    , };

</script>

@endsection

@section('css')
<style>
    .outer-top {
        margin-top: 188px;
    }
    .terms-conditions-page{
      padding-top: 0px !important;
    }
    

    @media only screen and (max-width: 768px) {
        
        .outer-top {
            margin-top: 387px;
        }
        .table {
          font-size: 50%;
        }
        .graf{
          width: 100%;
        }
        .tani {
                border-radius: 10px;width: 100%;
            }
            .tani {
                border-radius: 10px;width: 100%;
            }
            .pilar {
            max-width: 100%;
            position: relative;
            z-index: 1;
            top: 0px;
        }
        .kotak {
            border-bottom-right-radius: 10px;
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
            /* width: 100px;
            height: 40px; */
            background-color:#6ba6cf;
            position: absolute;
            top: 0px;
            z-index: 2;
        }
        .pilar {
          width: 100%;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        
        
    }
    @media screen and (min-width: 769px) {
      .pilar {
            width: 100%;
            position: relative;
            z-index: 1;
            top: 0px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .kotak {
            border-bottom-right-radius: 10px;
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
            /* width: 100px;
            height: 40px; */
            background-color:#6ba6cf;
            position: absolute;
            top: 0px;
            z-index: 2;
        }
      .tani {
            float: left;
            border-radius: 10px;
            width: 100px;
        }
    }
    tr.collapse.in {
      display:table-row;
}

.pointer {cursor: pointer;}
.tabel {
    height: 500px;
    overflow-x:auto;
}
</style>
@endsection
@section('content-frontend')
<a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 8px;margin-left: 15px"></i></a>
<div class="terms-conditions-page">
    <div class="body-content">
        {{-- <div id="GoogleMap" style="width:100%;height:500px"></div> --}}
        <h1>Informasi Perikanan</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#kub" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Jumlah Kelompok Usaha Bersama</h5></a>
                        </li>
                        
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ppl" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Produksi Perikanan Laut</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#nppb" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Nilai Produksi Perikanan Budidaya</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#jppi" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Jumlah Perusahaan Penangkapan Ikan</h5></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#kdm" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Konsep dan Metodologi</h5></a>
                        </li>
                    </ul>
                    </div>
                </div>

                <div class="tab-content">
                <div class="tab-pane in active tabel" id="kub" style="overflow-x:auto;height: 500px">
                    {{-- <iframe class="append" src="//katam.litbang.pertanian.go.id/grid_dinamis.aspx" style="width: 100%; height: 470px;" ><p>iframe are not supported by your browser</p></iframe> --}}
                    <table class="table table-striped" >
                        <h4><b>Jumlah Kelompok Usaha Bersama (KUB) Perikanan Tangkap</b></h4><hr>
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Tahun 2015</th>
                            <th scope="col">Tahun 2016</th>
                            <th scope="col">Tahun 2017</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                            <?php $angka = 1; ?>
                        @foreach ($ikan[0]['kub'] as $item)
                            
                        
                        <tr>
                            <th scope="row">{{ $angka++ }}</th>
                            <td>{{ $item['provinsi'] }}</td>
                            <td>{{ $item['tahun1'] }}</td>
                            <td>{{ $item['tahun2'] }}</td>
                            <td>{{ $item['tahun3'] }}</td>
                            
                            
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                    
                
                </div>
                
                <div class="tab-pane in tabel" id="ppl">
                    <table class="table table-striped" >
                        <h4><b>Produksi Perikanan Laut Yang Dijual Di TPI (Ton)</b></h4><hr>
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Tahun 2018</th>
                        <th scope="col">Tahun 2017</th>
                        <th scope="col">Tahun 2016</th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php $angka = 1; ?>
                        @foreach ($ikan[0]['ppl'] as $item)
                            
                        
                        <tr>
                        <th scope="row">{{ $angka++ }}</th>
                        <td>{{ $item['provinsi'] }}</td>
                        <td>{{ $item['tahun2018'] }}</td>
                        <td>{{ $item['tahun2017'] }}</td>
                        <td>{{ $item['tahun2016'] }}</td>
                        
                        
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="tab-pane in tabel" id="nppb">
                    <table class="table table-striped" >
                        <h4><b>Nilai Produksi Perikanan Budidaya Menurut Provinsi dan Jenis Budidaya 2017</b></h4><hr>
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Provinsi</th>
                        <th scope="col">Tambak Semi Intensif
                        </th>
                        <th scope="col">Tambak Sederhana
                        </th>
                        <th scope="col">Tambak Intensif
                        </th>
                        <th scope="col">Laut Lainnya

                        </th>
                        <th scope="col">Kolam Air Tenang
                        </th>
                        <th scope="col">Kolam Air Deras
                        </th>
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php $angka = 1; ?>
                        @foreach ($ikan[0]['nppb'] as $item)
                            
                        
                        <tr>
                        <th scope="row">{{ $angka++ }}</th>
                        <td>{{ $item['provinsi'] }}</td>
                        <td>{{ $item['tambak_semi'] }}</td>
                        <td>{{ $item['tambak_sederhana'] }}</td>
                        <td>{{ $item['tambak_intensif'] }}</td>
                        <td>{{ $item['laut_lainnya'] }}</td>
                        <td>{{ $item['kolam_tenang'] }}</td>
                        <td>{{ $item['kolam_deras'] }}</td>
                        
                        
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="tab-pane in tabel" id="jppi">
                    <table class="table table-striped" >
                        <h4><b>Jumlah Perusahaan Penangkapan Ikan</b></h4><hr>
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Status Pemodalan</th>
                        <?php for ($i=2013; $i >2000 ; $i--) { 
                        ?>
                        <th scope="col">{{ $i }}</th>
                        <?php } ?>
                        
                        
                        </tr>
                    </thead>
                    <tbody>
                        <?php $angka = 1; ?>
                        @foreach ($ikan[0]['jppi'] as $item)
                            
                        
                        <tr>
                        <th scope="row">{{ $angka++ }}</th>
                        <td>{{ $item['status'] }}</td>
                        <?php for ($i=2013; $i >2000 ; $i--) { 
                            ?>
                        <td>{{ $item[$i] }}</td>
                        <?php } ?>
                        
                        
                        </tr>
                        @endforeach
                    </tbody>
                    </table>
                </div>
                <div class="tab-pane in" id="kdm">
                    <div class="col-12">
                    <h3>Konsep</h3>
                    <ol>
                        <li>Produksi ikan mencakup semua hasil penangkapan/budidaya ikan/binatang air lainnya/tanaman air yang ditangkap/dipanen dari sumber perikanan alami atau dari tempat pemeliharaan, baik yang diusahakan oleh perusahaan perikanan maupun rumah tangga perikanan.

                            Produksi yang dicatat tidak hanya yang dijual saja tetapi termasuk juga yang dikonsumsi oleh rumah tangga atau yang diberikan kepada nelayan/pekerja sebagai upah. Tidak termasuk ikan yang diperoleh dalam rangka olah raga atau rekreasi, juga ikan yang dibuang kembali ke laut setelah ditangkap atau ikan yang dibuang karena terkena racun, pencemaran, atau penyakit.
                            
                            Volume produksi dihitung dalam bentuk berat basah ikan hasil tangkapan/budidaya.</li>
                        <li>Nilai produksi adalah nilai pada waktu hasil penangkapan/budidaya didaratkan. Jadi harga yang digunakan adalah harga produsen.</li>
                        <li>Penangkapan ikan adalah kegiatan menangkap atau mengumpulkan ikan/binatang air lainnya/tanaman air yang hidup di laut/perairan umum secara bebas dan bukan milik perseorangan.</li>
                        <li>  Budidaya ikan adalah kegiatan memelihara ikan/binatang air lainnya/tanaman air dengan menggunakan fasilitas buatan. Termasuk juga kegiatan pembenihan ikan.</li>
                        <li>Perusahaan perikanan tangkap/budidaya adalah unit ekonomi berbadan hukum yang melakukan kegiatan penangkapan/budidaya ikan/binatang air lainnya/tanaman air dengan tujuan sebagian/seluruh hasilnya untuk dijual.</li>
                        <li>Rumah tangga perikanan tangkap/budidaya adalah rumah tangga yang melakukan kegiatan penangkapan/budidaya ikan/binatang air lainnya/tanaman air dengan tujuan sebagian/seluruh hasilnya untuk dijual.</li>
                        <li>Luas area budidaya ikan merupakan luas kotor yaitu tidak hanya luas permukaan air yang digunakan untuk pemeliharaan saja, tetapi termasuk juga luas tanah/galengan/tanggul dan lain-lain.</li>
                        <li>Kapal penangkap ikan adalah perahu/kapal yang langsung dipergunakan dalam operasi penangkapan ikan/binatang air lainnya/tanaman air. Perahu/kapal yang digunakan untuk mengangkut nelayan, alat-alat penangkap dan hasil penangkapan dalam kegiatan penangkapan ikan dengan menggunakan bagan, sero dan kelong juga termasuk kapal penangkap ikan.</li>
                        <li>Tempat Pelelangan Ikan (TPI) adalah pasar yang biasanya terletak di dalam pelabuhan/pangkalan pendaratan ikan, dan di tempat tersebut terjadi transaksi penjualan ikan/hasil laut baik secara lelang maupun tidak (tidak termasuk TPI yang menjual/melelang ikan darat). TPI tersebut harus memenuhi kriteria sebagai berikut: <br>

                            a.       Tempat tetap (tidak berpindah-pindah)<br>
                            
                            b.      Mempunyai bangunan tempat transaksi penjualan ikan<br>
                            
                            c.       Ada yang mengkoordinasi prosedur lelang/penjualan<br>
                            
                            d.      Mendapat ijin dari instansi yang berwenang (Dinas Perikanan/Pemerintah Daerah)<br></li>
                        </ol>
                        <h3>Metodologi</h3>
                        <ol>
                            <li> Statistik Dasar (Badan Pusat Statistik) <br>

                            Pengumpulan data dilakukan secara lengkap baik untuk perusahaan perikanan maupun TPI di seluruh Indonesia. Sistem pengumpulan data dilakukan dengan system laporan dari perusahaan perikanan dan TPI di setiap daerah dan laporan tersebut dibuat rutin setiap tahun. Data yang dikumpulkan adalah menurut keadaan tahun yang bersangkutan (Januari sampai dengan Desember).</li>
                            <li>Statistik Sektoral (Kementerian Kelautan dan Perikanan)<br>

                            Sistem pengumpulan data dilakukan melalui survey produksi perikanan budidaya/penangkapan (system baru statistik perikanan yang disempurnakan), yaitu:<br>
                            
                            a.       Perikanan Tangkap<br>
                            
                            &emsp;·           Untuk pendataan perusahaan perikanan dilakukan pencacahan lengkap<br>
                            
                            &emsp;·           Untuk perikanan tangkap di laut, dilakukan pencacahan melalui Tempat Pendaratan Ikan (Pelabuhan Perikanan, TPI)<br>
                            
                            &emsp;·           Untuk pendataan rumahtangga perikanan di wilayah yang tidak ada pelabuhan dilakukan melalui desa sampel (hasil Podes), melakukan pendaftaran rumahtangga dan memilih sampel rumahtangga secara systematic sampling<br>
                            
                            b.      Perikanan Budidaya<br>
                            
                            &emsp;·           Melakukan updating frame rumahtangga perikanan budidaya hasil ST2013<br>
                            
                            &emsp;·           Memilih sampel rumahtangga perikanan budidaya menurut jenis ikan di masing-masing kecamatan</li>
                        </ol>
                    </div>
                </div>
            </div>

                
            </div>
            
        </div>
    </div>
</div>
@endsection