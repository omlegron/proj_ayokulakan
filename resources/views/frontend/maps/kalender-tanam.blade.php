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
        
    }
    table {
  display: block;
  height: 500px;
  overflow-y: scroll;
}
    .graf{
          width: 100%;
        }
    tr.collapse.in {
      display:table-row;
}

.pointer {cursor: pointer;}
tr {
  font-size: 10px;
}


/* .tableFixHead          { overflow-y: auto; height: 100px; } */
.tableFixHead thead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
/* th, td { padding: 8px 16px; } */
th     { background:#eee; }

</style>
@endsection

@section('content-frontend')

<a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 8px;margin-left: 15px"></i></a>
<div class="terms-conditions-page">
    <div class="body-content">
        {{-- <div id="GoogleMap" style="width:100%;height:500px"></div> --}}
        <h1 style="font-weight: bold; text-align: center">Kalender Tanam</h1>
    </div>
  
    <div class="container">
      <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-12">
              <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                  <div class="more-info-tab clearfix ">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#grafik" role="tab" aria-controls="home" aria-selected="true"><h3 style="font-weight: bold; color: green; color: green">Data Katam</h3></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#varientes" role="tab" aria-controls="home" aria-selected="true"><h3 style="font-weight: bold; color: green">Data Pupuk & Varietas</h3></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="home-tab" data-toggle="tab" href="#alsintan" role="tab" aria-controls="home" aria-selected="true"><h3 style="font-weight: bold; color: green">Data Alsintan & Ternak</h3></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#iklim" role="tab" aria-controls="profile" aria-selected="false"><h3 style="font-weight: bold; color: green">Dampak Perubahan Iklim </h3></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#iklimDanPrediksi" role="tab" aria-controls="profile" aria-selected="false"><h3 style="font-weight: bold; color: green">Iklim dan Prediksi </h3></a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#standcrop" role="tab" aria-controls="profile" aria-selected="false"><h3 style="font-weight: bold; color: green">Standing Crop </h3></a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#graf" role="tab" aria-controls="profile" aria-selected="false"><h3 style="font-weight: bold">Grafik Katam</h3></a>
                        </li> --}}
                        
                    </ul>
                  </div>
              </div>

              <div class="tab-content tableFixHead">
                <div class="tab-pane in" id="grafik" style="overflow-x:auto;">
                  <div class="product-tabs-slider">
                    <div class="more-info-tab clearfix ">
                      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link" id="home-tab" data-toggle="tab" href="#katam-padi" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Katam Padi</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Katam Palawija</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Kebutuhan Benih</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#katam-rawa" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Katam Rawa</h5></a>
                          </li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane in active" id="katam-padi">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pulau</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">ID ADM</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Luas Baku Sawah (ha)</th>
                            <th scope="col">Sumber Data Luas Baku</th>
                            <th scope="col">Prediksi Sifat Hujan</th>
                            <th scope="col">Curah Hujan Rata-rata (mm)</th>
                            <th scope="col">Prakiraan Awal Tanam Padi Sawah Dominan Tanam Pertama</th>
                            <th scope="col">Potensi Luas Tanam Padi Sawah (ha) Tanam Pertama</th>
                            <th scope="col">Prakiraan Awal Tanam Padi Sawah Dominan Tanam Kedua</th>
                            <th scope="col">Potensi Luas Tanam Padi Sawah (ha) Tanam Kedua</th>
                            <th scope="col">Indeks Pertanaman (%)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $angka = 0;
                          ?>
                          @foreach ($katam as $item)
                          <tr class="pointer" data-toggle="collapse" data-target=".order{{ $item['id'] }}">
                            <td scope="row">{{ $item['id'] }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $item['luas'] }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $item['curah'] }}</td>
                            <td></td>
                            <td>{{ $item['potensi_pertama'] }}</td>
                            <td></td>
                            <td>{{ $item['potensi_kedua'] }}</td>
                            <td>{{ $item['indeks'] }}</td>
                            {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                            
                          </tr>
                          <?php $angka++; 
                              $nomor = 1;
                          ?>
                              @foreach ($item['wilayah'] as $items)
                                <tr class="collapse order{{ $item['id'] }} pointer" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                  <td>{{ $angka.'.'.$nomor }}</td>
                                  <td></td>
                                  <td>{{ $items['nama'] or '' }}</td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td>{{ $items['luas'] or '' }}</td>
                                  <td></td>
                                  <td></td>
                                  <td>{{ $items['curah'] or '' }}</td>
                                  <td></td>
                                  <td>{{ $items['potensi_pertama'] or '' }}</td>
                                  <td></td>
                                  <td>{{ $items['potensi_kedua'] or '' }}</td>
                                  <td>{{ $items['indeks'] or '' }}</td>
                                  {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                </tr>
                                <?php $noKabupaten =1; ?>
                                @foreach ($items['kabupaten'] as $itemKabupaten)
                                  <tr class="collapse orderKabupaten{{ $angka.''.$nomor }}">
                                    <td>{{ $angka.'.'.$nomor.'.'.$noKabupaten }}</td>
                                    <td></td>
                                    <td></td>
                                    <td><b>{{ $itemKabupaten['kota'] or '' }}</b></td>
                                    <td>{{ $itemKabupaten['id_adm'] or '' }}</td>
                                    <td>{{ $itemKabupaten['kecamatan'] or '' }}</td>
                                    <td>{{ $itemKabupaten['luas'] or '' }}</td>
                                    <td>{{ $itemKabupaten['sumber_baku'] or '' }}</td>
                                    <td>{{ $itemKabupaten['prediksi_hujan'] or '' }}</td>
                                    <td>{{ $itemKabupaten['curah'] or '' }}</td>
                                    <td>{{ $itemKabupaten['prakiraan_pertama'] or '' }}</td>
                                    <td>{{ $itemKabupaten['potensi_pertama'] or '' }}</td>
                                    <td>{{ $itemKabupaten['prakiraan_kedua'] or '' }}</td>
                                    <td>{{ $itemKabupaten['potensi_kedua'] or '' }}</td>
                                    <td>{{ $itemKabupaten['indeks'] or '' }}</td>
                                  </tr>
                                  <?php $noKabupaten++; ?>
                                @endforeach
                                  <?php $nomor++; ?>
                              @endforeach
                          @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane in"></div>
                    <div class="tab-pane in"></div>
                    <div class="tab-pane in" id="katam-rawa">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Kecamatan</th>
                            <th scope="col">Luas Rawa Pasang Surut (ha)</th>
                            <th scope="col">Luas Rawa Lebak (ha)</th>
                            <th scope="col">Luas Rawa Lainnya (ha)</th>
                            <th scope="col">Luas Total Rawa (ha)</th>
                            <th scope="col">Waktu Tanam MH</th>
                            <th scope="col">Luas MH Padi (ha)</th>
                            <th scope="col">Waktu Tanam MK</th>
                            <th scope="col">Luas MK Padi (ha)</th>
                            {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $angka = 0;
                          $no =1;
                          ?>
                          @foreach ($rawa as $item)
                          <tr class="pointer" data-toggle="collapse" data-target=".orderRawa{{ $no }}">
                            <td scope="row">{{ $no }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td></td>
                            <td></td>
                            <td>{{ $item['luas_surut'] or '' }}</td>
                            <td>{{ $item['luas_lebak'] or '' }}</td>
                                  <td>{{ $item['luas_lainnya'] or '' }}</td>
                                  <td>{{ $item['luas_total'] or '' }}</td>
                                  <td>{{ $item['waktu_mh'] or '' }}</td>
                                  <td>{{ $item['luas_mh'] or '' }}</td>
                                  <td>{{ $item['waktu_mk'] or '' }}</td>
                                  <td>{{ $item['luas_mk'] or '' }}</td>
                            {{-- <td></td> --}}
                            
                            {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                            
                          </tr>
                          <?php $angka++; 
                              $nomor = 1;
                          ?>
                              @foreach ($item['provinsi'] as $items)
                                <tr class="collapse orderRawa{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                  <td>{{ $angka.'.'.$nomor }}</td>
                                  <td></td>
                                  <td>{{ $items['kabupaten'] or '' }}</td>
                                  <td>{{ $items['kecamatan'] or '' }}</td>
                                  <td>{{ $items['luas_surut'] or '' }}</td>
                                  <td>{{ $items['luas_lebak'] or '' }}</td>
                                  <td>{{ $items['luas_lainnya'] or '' }}</td>
                                  <td>{{ $items['luas_total'] or '' }}</td>
                                  <td>{{ $items['waktu_mh'] or '' }}</td>
                                  <td>{{ $items['luas_mh'] or '' }}</td>
                                  <td>{{ $items['waktu_mk'] or '' }}</td>
                                  <td>{{ $items['luas_mk'] or '' }}</td>
                                  {{-- <th>{{ $items['status_kresek'] or '' }}</th> --}}
                                  
                                  {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                </tr>
                                
                                  <?php $nomor++; ?>
                              @endforeach
                              <?php $no++; ?>
                          @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                    {{-- <iframe class="append" src="//katam.litbang.pertanian.go.id/grid_dinamis.aspx" style="width: 100%; height: 470px;" ><p>iframe are not supported by your browser</p></iframe> --}}
                    {{-- <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Pulau</th>
                          <th scope="col">Luas Baku Sawah (ha)</th>
                          <th scope="col">Curah Hujan Rata-rata (mm)</th>
                          <th scope="col">Potensi Luas Tanam Padi Sawah (ha) Tanam Pertama</th>
                          <th scope="col">Potensi Luas Tanam Padi Sawah (ha) Tanam Kedua</th>
                          <th scope="col">Indeks Pertanaman (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($katam as $item)
                            
                        
                        <tr>
                          <th scope="row">{{ $item['id'] }}</th>
                          <td>{{ $item['name'] }}</td>
                          <td>{{ $item['luas'] }}</td>
                          <td>{{ $item['curah'] }}</td>
                          <td>{{ $item['potensi_pertama'] }}</td>
                          <td>{{ $item['potensi_kedua'] }}</td>
                          <td>{{ $item['indeks'] }}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table> --}}
                </div>
                <div class="tab-pane in" id="varientes" style="overflow-x:auto;">
                  <div class="product-tabs-slider">
                    <div class="more-info-tab clearfix ">
                      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link" id="home-tab" data-toggle="tab" href="#pupuk-padi" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Rekomendasi Pupuk Padi</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#varietas-padi" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekomendasi Varietas</h5></a>
                          </li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane in active" id="pupuk-padi">
                      <div class="product-tabs-slider">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#katam-padi" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Rekomendasi Pupuk Padi (Dengan Pupuk Organik)</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekomendasi Pupuk Jagung (Dengan Pupuk Organik)</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekomendasi Pupuk Jagung (Dengan Pupuk Organik)</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekomendasi Pupuk Kedelai (tanpa Pupuk Organik)</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane in" id="varietas-padi">
                      <div class="product-tabs-slider">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#katam-padi" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Rekomendasi Varietas Padi Sawah</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekomendasi Varietas Jagung</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekomendasi Varietas Kedelai</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                    {{-- <iframe class="append" src="//katam.litbang.pertanian.go.id/grid_dinamis.aspx" style="width: 100%; height: 470px;" ><p>iframe are not supported by your browser</p></iframe> --}}
                    {{-- <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Pulau</th>
                          <th scope="col">Luas Baku Sawah (ha)</th>
                          <th scope="col">Curah Hujan Rata-rata (mm)</th>
                          <th scope="col">Potensi Luas Tanam Padi Sawah (ha) Tanam Pertama</th>
                          <th scope="col">Potensi Luas Tanam Padi Sawah (ha) Tanam Kedua</th>
                          <th scope="col">Indeks Pertanaman (%)</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($katam as $item)
                            
                        
                        <tr>
                          <th scope="row">{{ $item['id'] }}</th>
                          <td>{{ $item['name'] }}</td>
                          <td>{{ $item['luas'] }}</td>
                          <td>{{ $item['curah'] }}</td>
                          <td>{{ $item['potensi_pertama'] }}</td>
                          <td>{{ $item['potensi_kedua'] }}</td>
                          <td>{{ $item['indeks'] }}</td>
                          
                        </tr>
                        @endforeach
                      </tbody>
                    </table> --}}
                </div>
                <div class="tab-pane in" id="rawa" style="overflow-x:auto;">
                  
                </div>
                <div class="tab-pane in" id="alsintan" style="overflow-x:auto;">
                  <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link" id="home-tab" data-toggle="tab" href="#data-alsintan" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data Alsintan</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Data Peternakan</h5></a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane in" id="data-alsintan">
                      <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#alsintan-prov" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data Interaktif</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#alnistan-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Penyedia</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Laporan PDF</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-peternakan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Aplikasi alsintan versi 100</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane in active" id="alsintan-prov">
                          <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                              <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#data-provinsi" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data Provinsi</h5></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-kabu" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Data Kabupaten</h5></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#data-keca" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Data Kecamatan</h5></a>
                                  </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-content">
                            <div class="tab-pane in" id="data-provinsi">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">Ketersediaan Traktor roda 2</th>
                                    <th scope="col">Ketersediaan Traktor roda 4</th>
                                    <th scope="col">Ketersediaan Dryer</th>
                                    <th scope="col">Ketersediaan Pompa</th>
                                    <th scope="col">Ketersediaan Transplanter</th>
                                    <th scope="col">Ketersediaan Combine Hasvester</th>
                                    <th scope="col">Ketersediaan Penggilingan Padi</th>
                                    <th scope="col">Ketersediaan Jagung corn Sheller</th>
                                    <th scope="col">Ketersediaan Jagung Therser</th>
                                    <th scope="col">Ketersediaan Jagung Shilo</th>
                                    <th scope="col">Ketersediaan Kedelai Dryer</th>
                                    <th scope="col">Ketersediaan Kedelai Pedal Thresher</th>
                                    <th scope="col">Ketersediaan Kedelai Pedal Power</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $angka = 0;
                                  $no =1;
                                  ?>
                                  @foreach ($alnista_prov as $item)
                                    @foreach ($item['pulau'] as $items)
                                        
                                      <tr class="pointer" data-toggle="collapse" data-target=".orderEpi{{ $no }}">
                                        <td scope="row">{{ $no }}</td>
                                        <td>{{ $items['provinsi'] or '' }}</td>
                                        <td>{{ $items['traktor_roda_dua'] or '' }}</td>
                                        <td>{{ $items['traktor_roda_empat'] or '' }}</td>
                                        <td>{{ $items['thresher'] or '' }}</td>
                                        <td>{{ $items['dryer'] or '' }}</td>
                                        <td>{{ $items['pompa'] or '' }}</td>
                                        <td>{{ $items['transplanter'] or '' }}</td>
                                        <td>{{ $items['combine_harvester'] or '' }}</td>
                                        <td>{{ $items['penggilingan_padi'] or '' }}</td>
                                        <td>{{ $items['jagung_corn_sheller'] or '' }}</td>
                                        <td>{{ $items['jagung_power_thresher_multi'] or '' }}</td>
                                        <td>{{ $items['jagung_bed_dryer'] or '' }}</td>
                                        <td>{{ $items['jagung_vertical_dryer'] or '' }}</td>
                                        <td>{{ $items['jagung_silo'] or '' }}</td>
                                        <td>{{ $items['kedelai_dryer'] or '' }}</td>
                                        <td>{{ $items['kedelai_pedal_thresher'] or '' }}</td>
                                        <td>{{ $items['kedelai_power_thresher'] or '' }}</td>
                                        
                                        {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                                        
                                      </tr>
                                    @endforeach
                                      <?php $no++; ?>
                                  @endforeach
                                
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane in" id="data-kabu">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pulau</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">Kabupaten</th>
                                    <th scope="col">Kebutuhan Traktor Roda 2</th>
                                    <th scope="col">Ketersediaan Traktor Roda 2</th>
                                    <th scope="col">Kekurangan Traktor Roda2</th>
                                    <th scope="col">Kecukupan Traktor Roda 2</th>
                                    <th scope="col">Status Kecukupan</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $angka = 0;
                                  $no =1;
                                  ?>
                                  @foreach ($alnista as $item)
                                  <tr class="pointer" data-toggle="collapse" data-target=".orderEpi{{ $no }}">
                                    <td scope="row">{{ $no }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    
                                    {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                                    
                                  </tr>
                                  <?php $angka++; 
                                      $nomor = 1;
                                  ?>
                                      @foreach ($item['pulau'] as $items)
                                        <tr class="collapse orderEpi{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                          <td>{{ $angka.'.'.$nomor }}</td>
                                          <td></td>
                                          <td>{{ $items['provinsi'] or '' }}</td>
                                          <td>{{ $items['kabupaten'] or '' }}</td>
                                          <td>{{ $items['kbth_traktor_dua'] or '' }}</td>
                                          <td>{{ $items['ktrsd_traktor_dua'] or '' }}</td>
                                          <td>{{ $items['kkrng_traktor_dua'] or '' }}</td>
                                          <td>{{ $items['kckpn_traktor_dua'] or '' }}</td>
                                          <td>{{ $items['status'] or '' }}</td>
                                          {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                        </tr>
                                        
                                          <?php $nomor++; ?>
                                      @endforeach
                                      <?php $no++; ?>
                                  @endforeach
                                
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane in" id="data-keca">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pulau</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">No Kab.</th>
                                    <th scope="col">Kabupaten</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Kebutuhan Traktor</th>
                                    <th scope="col">Ketersediaan Traktor</th>
                                    <th scope="col">Kekurangan Traktor</th>
                                    <th scope="col">Kecukupan Traktor</th>
                                    <th scope="col">Status Kecukupan</th>
                                    <th scope="col">Recomend Pemenuhan Traktor</th>
                                    <th scope="col">Traktor Dimobilisasi</th>
                                    <th scope="col">Koreksi Kekurangan</th>
                                    {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                                    
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php $angka = 0;
                                  $no =1;
                                  ?>
                                  @foreach ($alnista_kec as $item)
                                  <tr class="pointer" data-toggle="collapse" data-target=".orderPrediksi{{ $no }}">
                                    <td scope="row">{{ $no }}</td>
                                    <td>{{ $item['nama'] }}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    {{-- <td></td> --}}
                                    
                                    {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                                    
                                  </tr>
                                  <?php $angka++; 
                                      $nomor = 1;
                                  ?>
                                      @foreach ($item['pulau'] as $items)
                                        <tr class="collapse orderPrediksi{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                          <td>{{ $angka.'.'.$nomor }}</td>
                                          <td></td>
                                          {{-- <td>{{ $items['no'] or '' }}</td> --}}
                                          <td>{{ $items['provinsi'] or '' }}</td>
                                          <td>{{ $items['no_kab'] or '' }}</td>
                                          <td>{{ $items['kabupaten'] or '' }}</td>
                                          <td>{{ $items['kecamatan'] or '' }}</td>
                                          <td>{{ $items['kbthn_traktor'] or '' }}</td>
                                          <td>{{ $items['ktrsd_traktor'] or '' }}</td>
                                          <td>{{ $items['kkrng_traktor'] or '' }}</td>
                                          <td>{{ $items['kckpn_traktor'] or '' }}</td>
                                          <td>{{ $items['status'] or '' }}</td>
                                          <td>{{ $items['recom_traktor'] or '' }}</td>
                                          <td>{{ $items['traktor_mobilisaisi'] or '' }}</td>
                                          <td>{{ $items['krksi_traktor'] or '' }}</td>
                                          {{-- <th>{{ $items['status_kresek'] or '' }}</th> --}}
                                          
                                          {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                        </tr>
                                        
                                          <?php $nomor++; ?>
                                      @endforeach
                                      <?php $no++; ?>
                                  @endforeach
                                
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane in" id="alnistan-kab">
                          
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane in" id="data-peternakan">
                      <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#ternak-kec" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data level kecamatan</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ternak-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Data level Kabupaten</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane in active" id="ternak-kec">
                          <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                              <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#kec-tabular" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data tabular</h5></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#gravik-kec" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Grafik</h5></a>
                                  </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-content">
                            <div class="tab-pane in active" id="kec-tabular">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">No Kab.</th>
                                    <th scope="col">Kabupaten</th>
                                    <th scope="col">Kecamatan</th>
                                    <th scope="col">Luas Padi</th>
                                    <th scope="col">Luas Jagung</th>
                                    <th scope="col">Luas Kedelai</th>
                                    <th scope="col">Populasi Sapi Potong</th>
                                    <th scope="col">Populasi Sapi Perah</th>
                                    <th scope="col">Populasi Kerbau</th>
                                    <th scope="col">Populasi Domba</th>
                                    <th scope="col">Populasi Kambing</th>
                                    <th scope="col">Sumber Data</th>
                                    <th scope="col">Total Ketersediaan Bahan Kering</th>
                                    <th scope="col">Total ketersediaan Protein Kasar</th>
                                    <th scope="col">Total ketersediaan Total Nutrisi Tercerna</th>
                                    <th scope="col">Total Kebutuhan Bahan Kering</th>
                                    <th scope="col">Total Kebutuhan Protein Kasar</th>
                                    <th scope="col">Total Kebutuhan Total Nuturisi Tercerna</th>
                                    <th scope="col">Tingkat Kecukupan Bahan Kering</th>
                                    <th scope="col">Tingkat Kecukupan Protein Kasar</th>
                                    <th scope="col">Tingkat Total Nutrisi Tercerna</th>
                                    <th scope="col">Status Kecukupan Bahan Kering</th>
                                    <th scope="col">Status Kecukupan Protein Kasar</th>
                                    <th scope="col">Status Total Nutrisi Terverna</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td colspan="20"><center>data belum tersedia</center></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane in" id="gravik-kec">
                              <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                                <div class="more-info-tab clearfix ">
                                  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                      <li class="nav-item">
                                          <a class="nav-link" id="home-tab" data-toggle="tab" href="#bahan-kering" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Bahan Kering</h5></a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ternak-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Protein Kasar</h5></a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ternak-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Total Nutrisi Tercerna</h5></a>
                                      </li>
                                  </ul>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="tab-pane in" id="ternak-kab">
                          <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                            <div class="more-info-tab clearfix ">
                              <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                  <li class="nav-item">
                                      <a class="nav-link" id="home-tab" data-toggle="tab" href="#kab-tabular" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data tabular</h5></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#gravik-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Grafik</h5></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ternak-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Laporan PDF</h5></a>
                                  </li>
                              </ul>
                            </div>
                          </div>
                          <div class="tab-content">
                            <div class="tab-pane in active" id="kab-tabular">
                              <table class="table table-bordered">
                                <thead>
                                  <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Provinsi</th>
                                    <th scope="col">No Kab.</th>
                                    <th scope="col">Kabupaten</th>
                                    <th scope="col">Luas Padi</th>
                                    <th scope="col">Luas Jagung</th>
                                    <th scope="col">Luas Kedelai</th>
                                    <th scope="col">Populasi Sapi Potong</th>
                                    <th scope="col">Populasi Sapi Perah</th>
                                    <th scope="col">Populasi Kerbau</th>
                                    <th scope="col">Populasi Domba</th>
                                    <th scope="col">Populasi Kambing</th>
                                    <th scope="col">Sumber Data</th>
                                    <th scope="col">Total Ketersediaan Bahan Kering</th>
                                    <th scope="col">Total ketersediaan Protein Kasar</th>
                                    <th scope="col">Total ketersediaan Total Nutrisi Tercerna</th>
                                    <th scope="col">Total Kebutuhan Bahan Kering</th>
                                    <th scope="col">Total Kebutuhan Protein Kasar</th>
                                    <th scope="col">Total Kebutuhan Total Nuturisi Tercerna</th>
                                    <th scope="col">Tingkat Kecukupan Bahan Kering</th>
                                    <th scope="col">Tingkat Kecukupan Protein Kasar</th>
                                    <th scope="col">Tingkat Total Nutrisi Tercerna</th>
                                    <th scope="col">Status Kecukupan Bahan Kering</th>
                                    <th scope="col">Status Kecukupan Protein Kasar</th>
                                    <th scope="col">Status Total Nutrisi Terverna</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td colspan="20"><center>data belum tersedia</center></td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                            <div class="tab-pane in" id="gravik-kab">
                              <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                                <div class="more-info-tab clearfix ">
                                  <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                                      <li class="nav-item">
                                          <a class="nav-link" id="home-tab" data-toggle="tab" href="#kec-tabular" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Bahan Kering</h5></a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ternak-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Protein Kasar</h5></a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#ternak-kab" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Total Nutrisi Tercerna</h5></a>
                                      </li>
                                  </ul>
                                </div>
                              </div>
                              <div class="tab-content">
                                <div class="tab-pane in active" id="bahan-kering">
                                  @foreach ($gravik as $item)
                                    <center>
                                      <h4 class="text-center">Data Gravik {{ $item['kabupaten'] }}</h4>
                                      <img src="{{ asset("img/gravik/bahan-kering/".$item['image']) }}" alt="">
                                    </center>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane in" id="iklim" style="overflow-x:auto;">
                  <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                    <div class="more-info-tab clearfix ">
                      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link" id="home-tab" data-toggle="tab" href="#endemik" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data Endemik</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rusak" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Data Kerusakan Tanaman</h5></a>
                        </li>
                          <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rawan" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Data Rawan</h5></a>
                          </li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content tableFixHead">
                    <div class="tab-pane in active" id="endemik" style="overflow-x:auto;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pulau</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Status Banjir Padi</th>
                            <th scope="col">Status Kekeringan Padi</th>
                            <th scope="col">Status OPT Wereng Batang Coklat</th>
                            <th scope="col">Status OPT Tikus Sawah</th>
                            <th scope="col">Status OPT Penggerek Batang Padi</th>
                            <th scope="col">Status OPT Tugro</th>
                            <th scope="col">Status OPT Blast</th>
                            <th scope="col">Status OPT Kresek (HBD)</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $angka = 0;
                          $no =1;
                          ?>
                          @foreach ($iklim_epidemik as $item)
                          <tr class="pointer" data-toggle="collapse" data-target=".orderEpi{{ $no }}">
                            <td scope="row">{{ $no }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            
                            {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                            
                          </tr>
                          <?php $angka++; 
                              $nomor = 1;
                          ?>
                              @foreach ($item['pulau'] as $items)
                                <tr class="collapse orderEpi{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                  <td>{{ $angka.'.'.$nomor }}</td>
                                  <td></td>
                                  <td>{{ $items['provinsi'] or '' }}</td>
                                  <td>{{ $items['kabupaten'] or '' }}</td>
                                  <td>{{ $items['status_banjir'] or '' }}</td>
                                  <td>{{ $items['status_kering'] or '' }}</td>
                                  <td>{{ $items['status_wereng'] or '' }}</td>
                                  <td>{{ $items['status_tikus'] or '' }}</td>
                                  <td>{{ $items['status_penggerek'] or '' }}</td>
                                  <td>{{ $items['status_tugro'] or '' }}</td>
                                  <td>{{ $items['status_blast'] or '' }}</td>
                                  <td>{{ $items['status_kresek'] or '' }}</td>
                                  
                                  {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                </tr>
                                
                                  <?php $nomor++; ?>
                              @endforeach
                              <?php $no++; ?>
                          @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane in" id="rusak" style="overflow-x:auto;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pulau</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Status Banjir Padi</th>
                            <th scope="col">Status Kekeringan Padi</th>
                            <th scope="col">Status OPT Wereng Batang Coklat</th>
                            <th scope="col">Status OPT Tikus Sawah</th>
                            <th scope="col">Status OPT Penggerek Batang Padi</th>
                            <th scope="col">Status OPT Tugro</th>
                            <th scope="col">Status OPT Blast</th>
                            {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $angka = 0;
                          $no =1;
                          ?>
                          @foreach ($iklim_kerusakan as $item)
                          <tr class="pointer" data-toggle="collapse" data-target=".orderRusak{{ $no }}">
                            <td scope="row">{{ $no }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            {{-- <td></td> --}}
                            
                            {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                            
                          </tr>
                          <?php $angka++; 
                              $nomor = 1;
                          ?>
                              @foreach ($item['pulau'] as $items)
                                <tr class="collapse orderRusak{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                  <td>{{ $angka.'.'.$nomor }}</td>
                                  <td></td>
                                  <td>{{ $items['provinsi'] or '' }}</td>
                                  <td>{{ $items['kabupaten'] or '' }}</td>
                                  <td>{{ $items['status_banjir'] or '' }}</td>
                                  <td>{{ $items['status_kering'] or '' }}</td>
                                  <td>{{ $items['status_wereng'] or '' }}</td>
                                  <td>{{ $items['status_tikus'] or '' }}</td>
                                  <td>{{ $items['status_penggerek'] or '' }}</td>
                                  <td>{{ $items['status_tugro'] or '' }}</td>
                                  <td>{{ $items['status_blast'] or '' }}</td>
                                  {{-- <th>{{ $items['status_kresek'] or '' }}</th> --}}
                                  
                                  {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                </tr>
                                
                                  <?php $nomor++; ?>
                              @endforeach
                              <?php $no++; ?>
                          @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane in" id="rawan" style="overflow-x:auto;">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Pulau</th>
                            <th scope="col">Provinsi</th>
                            <th scope="col">Kabupaten</th>
                            <th scope="col">Status Banjir Padi</th>
                            <th scope="col">Status Kekeringan Padi</th>
                            <th scope="col">Status OPT Wereng Batang Coklat</th>
                            <th scope="col">Status OPT Tikus Sawah</th>
                            <th scope="col">Status OPT Penggerek Batang Padi</th>
                            <th scope="col">Status OPT Tugro</th>
                            <th scope="col">Status OPT Blast</th>
                            {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                            
                          </tr>
                        </thead>
                        <tbody>
                          <?php $angka = 0;
                          $no =1;
                          ?>
                          @foreach ($iklim_rawan as $item)
                          <tr class="pointer" data-toggle="collapse" data-target=".orderRawan{{ $no }}">
                            <td scope="row">{{ $no }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            {{-- <td></td> --}}
                            
                            {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                            
                          </tr>
                          <?php $angka++; 
                              $nomor = 1;
                          ?>
                              @foreach ($item['pulau'] as $items)
                                <tr class="collapse orderRawan{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                  <td>{{ $angka.'.'.$nomor }}</td>
                                  <td></td>
                                  <td>{{ $items['provinsi'] or '' }}</td>
                                  <td>{{ $items['kabupaten'] or '' }}</td>
                                  <td>{{ $items['status_banjir'] or '' }}</td>
                                  <td>{{ $items['status_kering'] or '' }}</td>
                                  <td>{{ $items['status_wereng'] or '' }}</td>
                                  <td>{{ $items['status_tikus'] or '' }}</td>
                                  <td>{{ $items['status_penggerek'] or '' }}</td>
                                  <td>{{ $items['status_tugro'] or '' }}</td>
                                  <td>{{ $items['status_blast'] or '' }}</td>
                                  {{-- <th>{{ $items['status_kresek'] or '' }}</th> --}}
                                  
                                  {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                </tr>
                                
                                  <?php $nomor++; ?>
                              @endforeach
                              <?php $no++; ?>
                          @endforeach
                        
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="tab-pane in" id="iklimDanPrediksi" style="overflow-x:auto;">
                  <div class="product-tabs-slider">
                    <div class="more-info-tab clearfix ">
                      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                          <li class="nav-item">
                              <a class="nav-link" id="home-tab" data-toggle="tab" href="#stasiun-iklim" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Data Stasiun Iklim dan Hidrologi </h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#analisis-curah" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Analisis Curah Hujan</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#analisis-debit" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Analisis Debit</h5></a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#analisis-tma" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Analisis TMA</h5></a>
                          </li>
                      </ul>
                    </div>
                  </div>
                  <div class="tab-content">
                    <div class="tab-pane in" id="stasiun-iklim">
                      <div class="product-tabs-slider">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#rekap-stasiun" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Rekap Data Stasiun</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rekap-stasiunparameter" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Rekap Data Stasiun Parameter</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <div class="tab-content">
                        <div class="tab-pane in" id="rekap-stasiun">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pulau</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">No Kab.</th>
                                <th scope="col">Kabupaten</th>
                                <th scope="col">ID ADM</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Jenis Stasiun</th>
                                <th scope="col">Nama Stasiun</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Jumlah Hari Hitung</th>
                                <th scope="col">Jumlah Hari Ada</th>
                                <th scope="col">Jumlah Hari Kurang</th>
                                <th scope="col">Awal Data</th>
                                <th scope="col">Akhir Data</th>
                                {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php $angka = 0;
                              $no =1;
                              ?>
                              @foreach ($iklim_prediksi as $item)
                              <tr class="pointer" data-toggle="collapse" data-target=".orderPrediksi{{ $no }}">
                                <td scope="row">{{ $no }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                {{-- <td></td> --}}
                                
                                {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                                
                              </tr>
                              <?php $angka++; 
                                  $nomor = 1;
                              ?>
                                  @foreach ($item['pulau'] as $items)
                                    <tr class="collapse orderPrediksi{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                      <td>{{ $angka.'.'.$nomor }}</td>
                                      <td></td>
                                      {{-- <td>{{ $items['no'] or '' }}</td> --}}
                                      <td>{{ $items['provinsi'] or '' }}</td>
                                      <td>{{ $items['no_kab'] or '' }}</td>
                                      <td>{{ $items['kabupaten'] or '' }}</td>
                                      <td>{{ $items['id_adm'] or '' }}</td>
                                      <td>{{ $items['kecamatan'] or '' }}</td>
                                      <td>{{ $items['jenis_stasiun'] or '' }}</td>
                                      <td>{{ $items['nama_stasiun'] or '' }}</td>
                                      <td>{{ $items['keterangan'] or '' }}</td>
                                      <td>{{ $items['pemilik'] or '' }}</td>
                                      <td>{{ $items['hari_hitung'] or '' }}</td>
                                      <td>{{ $items['jumlah_hari'] or '' }}</td>
                                      <td>{{ $items['jumlah_hari_kurang'] or '' }}</td>
                                      <td>{{ $items['awal_data'] or '' }}</td>
                                      <td>{{ $items['akhir_data'] or '' }}</td>
                                      {{-- <th>{{ $items['status_kresek'] or '' }}</th> --}}
                                      
                                      {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                    </tr>
                                    
                                      <?php $nomor++; ?>
                                  @endforeach
                                  <?php $no++; ?>
                              @endforeach
                            
                            </tbody>
                          </table>
                        </div>
                        <div class="tab-pane in" id="rekap-stasiunparameter" style="overflow-x:auto;">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pulau</th>
                                <th scope="col">Provinsi</th>
                                <th scope="col">No Kab.</th>
                                <th scope="col">Kabupaten</th>
                                <th scope="col">ID ADM</th>
                                <th scope="col">Kecamatan</th>
                                <th scope="col">Jenis Stasiun</th>
                                <th scope="col">Nama Stasiun</th>
                                <th scope="col">Parameter</th>
                                <th scope="col">Keterangan</th>
                                <th scope="col">Pemilik</th>
                                <th scope="col">Jumlah Hari Hitung</th>
                                <th scope="col">Jumlah Hari Ada</th>
                                <th scope="col">Jumlah Hari Kurang</th>
                                <th scope="col">Awal Data</th>
                                <th scope="col">Akhir Data</th>
                                {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                                
                              </tr>
                            </thead>
                            <tbody>
                              <?php $angka = 0;
                              $no =1;
                              ?>
                              @foreach ($iklim_prediksi_parameter as $item)
                              <tr class="pointer" data-toggle="collapse" data-target=".orderParameter{{ $no }}">
                                <td scope="row">{{ $no }}</td>
                                <td>{{ $item['nama'] }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                {{-- <td></td> --}}
                                
                                {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                                
                              </tr>
                              <?php $angka++; 
                                  $nomor = 1;
                              ?>
                                  @foreach ($item['pulau'] as $items)
                                    <tr class="collapse orderParameter{{ $no }}" data-toggle="collapse" data-target=".orderKabupaten{{ $angka.''.$nomor }}">
                                      <td>{{ $angka.'.'.$nomor }}</td>
                                      <td></td>
                                      {{-- <td>{{ $items['no'] or '' }}</td> --}}
                                      <td>{{ $items['provinsi'] or '' }}</td>
                                      <td>{{ $items['no_kab'] or '' }}</td>
                                      <td>{{ $items['kabupaten'] or '' }}</td>
                                      <td>{{ $items['id_adm'] or '' }}</td>
                                      <td>{{ $items['kecamatan'] or '' }}</td>
                                      <td>{{ $items['jenis_stasiun'] or '' }}</td>
                                      <td>{{ $items['nama_stasiun'] or '' }}</td>
                                      <td>{{ $items['parameter'] or '' }}</td>
                                      <td>{{ $items['keterangan'] or '' }}</td>
                                      <td>{{ $items['pemilik'] or '' }}</td>
                                      <td>{{ $items['hari_hitung'] or '' }}</td>
                                      <td>{{ $items['jumlah_hari'] or '' }}</td>
                                      <td>{{ $items['jumlah_hari_kurang'] or '' }}</td>
                                      <td>{{ $items['awal_data'] or '' }}</td>
                                      <td>{{ $items['akhir_data'] or '' }}</td>
                                      {{-- <th>{{ $items['status_kresek'] or '' }}</th> --}}
                                      
                                      {{-- <td>{{ $items['kabupaten'][0]['kota'] or '' }}</td> --}}
                                    </tr>
                                    
                                      <?php $nomor++; ?>
                                  @endforeach
                                  <?php $no++; ?>
                              @endforeach
                            
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane in" id="analisis-curah">
                      <div class="product-tabs-slider">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#rekap-stasiun" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Analisis Curah Hujan Bulanan</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rekap-stasiunparameter" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Analisis Curah Hujan Dasarian</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rekap-stasiunparameter" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">-Analisis Curah Hujan Harian</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <div class="tab-content">

                      </div>
                    </div>
                    <div class="tab-pane in" id="analisis-debit">
                      <div class="product-tabs-slider">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#rekap-stasiun" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Analisis Debit Bulanan</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rekap-stasiunparameter" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Analisis Debit Harian</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <div class="tab-content">
                        
                      </div>
                    </div>
                    <div class="tab-pane in" id="analisis-tma">
                      <div class="product-tabs-slider">
                        <div class="more-info-tab clearfix ">
                          <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                              <li class="nav-item">
                                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#rekap-stasiun" role="tab" aria-controls="home" aria-selected="true"><h5 style="font-weight: bold">Analisis TMA Bulanan</h5></a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#rekap-stasiunparameter" role="tab" aria-controls="profile" aria-selected="false"><h5 style="font-weight: bold">Analisis TMA Harian</h5></a>
                              </li>
                          </ul>
                        </div>
                      </div>
                      <div class="tab-content">
                        
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tab-pane in" id="standcrop" style="overflow-x:auto;">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">No</th>
                        <th scope="col">Administrasi</th>
                        <th scope="col">Luas Total</th>
                        <th scope="col">Fase Air</th>
                        <th scope="col">Fase Vegetatif</th>
                        <th scope="col">Fase Generatif</th>
                        <th scope="col">Fase Pemasakan</th>
                        <th scope="col">Fase Bera</th>
                        <th scope="col">Awan</th>
                        <th scope="col">September 2020</th>
                        <th scope="col">Oktober 2020</th>
                        <th scope="col">November 2020</th>
                        
                        {{-- <th scope="col">Status OPT Kresek (HBD)</th> --}}
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php $angka = 0;
                      $no =1;
                      ?>
                      @foreach ($standcrop as $item)
                      <tr class="" data-toggle="collapse" data-target=".orderPrediksi{{ $no }}">
                        <td scope="row">{{ $no }}</td>
                        <td>{{ $item['no'] or '' }}</td>
                        <td>{{ $item['admin'] or '' }}</td>
                        <td>{{ $item['luas_total'] or '' }}</td>
                        <td>{{ $item['fase_air'] or '' }}</td>
                        <td>{{ $item['fase_vegetatif'] or '' }}</td>
                        <td>{{ $item['fase_generatif'] or '' }}</td>
                        <td>{{ $item['fase_pemasakan'] or '' }}</td>
                        <td>{{ $item['fase_bera'] or '' }}</td>
                        <td>{{ $item['awan'] or '' }}</td>
                        <td>{{ $item['september'] or '' }}</td>
                        <td>{{ $item['oktober'] or '' }}</td>
                        <td>{{ $item['november'] or '' }}</td>
                        {{-- <th></th> --}}
                        
                        {{-- <td>{{ $katam[0]['wilayah'][0]['nama'] }}</td> --}}
                        
                      </tr>
                      
                          <?php $no++; ?>
                      @endforeach
                    
                    </tbody>
                  </table>
                </div>
                {{-- <div class="tab-pane in" id="graf">
                    <img class="graf" src="{{ asset('img/katamgrafik.png') }}" alt="">
                </div> --}}
            </div>

              
          </div>
          <div class="col-sm-12 col-md-12 col-lg-12">
              <div style="margin-top: 20px">
                  <p><b>Sumber Data</b></p>
                  <p>http://katam.litbang.pertanian.go.id/main.aspx</p>
              </div>
          </div>
      </div>
      {{-- <iframe class="append" frameborder="0" style="width: 100%"></iframe> --}}
      <div class="row" style="margin-top: 20px">
          <div class="col-12">
              <h3>Pengertian Kalender Tanam</h3>
              <p>Kalender  tabel  Kalender  Tanam  tingkat kabupaten/ kota untuk digunakan sebagai pedoman bagi pemangku kepentingan, penyuluh,  dan  petani  dalam  menentukan  waktu  tanam  komoditas  tanaman pangan.,  yang  dilengkapi  dengan  rekomendasi  penggunaan  varietas,  dan pemupukan.<br>
                  Untuk mengantisipasi keragaman (variabilitas) dan perubahan iklim yang semakin tidak  menentu  dan  sulit  diprediksi,  Badan  Litbang  Pertanian  telah  melakukan analisis  secara  faktual  dan  menggunakan  data  prakiraan  Badan  Meteorologi Klimatologi dan Geofisika  (BMKG). Analisis  tersebut menghasilkan peta Kalender Tanam dengan empat kemungkinan  (skenario) kondisi dan potensi  iklim, yaitu  :<br><br>
                  (1)   kondisi  eksisting  yang  biasa  dilakukan  oleh  petani, <br>
                  (2)   potensi  pada  tahun basah  (TB), <br>
                  (3)   potensi  pada  tahun  normal  (TN),  dan <br>
                  (4)   potensi  pada  tahun kering (TK).<br><br>
                  Peta Kalender Tanam adalah peta yang menggambarkan potensi pola tanam dan waktu  tanam  untuk  tanaman  pangan,  terutama  padi  lahan  sawah,  berdasarkan potensi dan dinamika  sumberdaya  iklim dan  air. Peta  ini  disusun  secara  khusus untuk  mendukung  Program  Peningkatan  Produksi  Beras  Nasional  (P2BN)  dan program ketahanan pangan pada umumnya dalam upaya menghadapi keragaman (variabilitas) dan perubahan iklim.<br>
                  Penentuan kondisi dan potensi  iklim  suatu  kabupaten pada  tahun  tertentu  akan dilakukan  berdasarkan  data  prakiraan  BMKG.  Kalender  Tanam  terpadu  ini menginformasikan potensi  luas areal  tanam pada musim  tanam  terdekat apakah Musim Tanam I (Musim Hujan/MH, Musim Tanam Kedua ( Musim Kemarau/MK-1), atau  Musim  Tanam  III  (Musim  Kemarau/MK-2)  di  setiap  kecamatan  dan kabupaten. Selain  itu  juga dilengkapi dengan  rekomendasi penggunaan varietas, dan jumlah pupuk yang perlu disiapkan pada level kecamatan.<br>
                  <br><b>1.    Fungsi</b><br>
                  Memberikan informasi tentang waktu tanam, luas areal tanam pada masing-masing musim di setiap kabupaten.<br>
                  <br><b>2.    Manfaat</b><br>
                  a. Menentukan  waktu   tanam  komoditas  tanaman  pangan pada  setiap musim (MH, MK-1, dan  MK-2)   berdasarkan   kondisi   iklim  basah  (La-Nina), kering (El-Nino), dan Normal.<br>
                  b.  Mendukung  perencanaan  waktu tanam,  perkiraan   luas   tanam,  dan  rekomendasi kebutuhan benih dan pupuk.<br>
                  c. Mendukung informasi wilayah rawan OPT serta kekeringan   dan   banjir   yang  bisa mengakibatkan gagal panen dan kerugian petani.<br>
                  Kalender  Tanam  ini  ditampilkan  secara  sederhana  agar  mudah  dibaca  dan dipahami  oleh  penyuluh,  petugas  dinas  pertanian,  kelompok  tani,  dan  petani dalam mengatur pola dan rotasi tanam, sesuai dengan kondisi iklim.<br>
                  <br><b>3.    Keunggulan</b><br>
                  a. Dinamis, karena  penerapannya  dapat  disesuaikan  dengan  kondisi  iklim pada setiap tahun sesuai prediksi BMKG.<br>
                  b.  Operasional pada skala kecamatan.<br>
                  c. Spesifik lokasi, karena  mempertimbangkan  potensi  sumberdaya  iklim dan air setempat.<br>
                  d. Mudah dipahami oleh  pengguna,  karena  disusun  secara  spasial  dan tabular dengan uraian yang jelas.<br>
                  e.  Mudah diperbaharui.<br>
                  <br><b>4.    Informasi yang bisa diperoleh dari Kalender Tanam</b><br>
                  a.  Informasi zona agroklimat atau kelas curah hujan tahunan.<br>
                  b.  Potensi  waktu  dan luas tanam  komoditas  tanaman  pangan.<br>
                  c.  Luas baku sawah atau luas lahan tersedia di setiap kecamatan.<br>
                  d.  Intensitas pertanaman di lahan sawah setiap kecamatan.<br>
                  e. Informasi rekomendasi kebutuhan benih, serta rekomendasi dan kebutuhan pupuk.<br>
                  
                  <br><b>5.    Cara memanfaatkan informasi Kalender Tanaman</b> <br>
                  
                  a.  Pilih wilayah kabupaten yang dikehendaki.<br>
                  b.  Lihat peta atau tabel kabupaten yang dimaksud</p><br><br>
          </div>
      </div>
  </div>
</div>
  
  @endsection
  
  @section('scripts')
  
  <script>
    $(document).ready(function(){
      $('.append').attr('src','//katam.litbang.pertanian.go.id/grid_dinamis.aspx?id_adm=0&kolom=KatamPadi&lang=&62919')
    });
  </script>
  
  
@endsection