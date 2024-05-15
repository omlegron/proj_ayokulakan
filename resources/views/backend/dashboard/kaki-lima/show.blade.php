@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" style="width:30%; padding-right: 10px">
                    <a class="nav-link active btn btn-success" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Kaki Lima</a>
                  </li>
                  <li class="nav-item" style="width:30%; padding-right: 10px !important">
                    <a class="nav-link btn bg-green" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Titik Lokasi</a>
                  </li>
                  <li class="nav-item" style="width:30%;">
                    <a class="nav-link btn bg-green" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Daftar Menu</a>
                  </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="card-header">Data Kaki Lima</p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text">Id Kaki Lima</p>
                                    <p class="card-text">Nik</p>
                                    <p class="card-text">Nama</p>
                                    <p class="card-text">Nomor Telephone</p>
                                    <p class="card-text">Email</p>
                                    <p class="card-text">Tipe Usaha</p>
                                    <p class="card-text">Keterangan</p>
                                    <p class="card-text">Alamat</p>
                                    <p class="card-text">Register</p>
                                </div>
                                {{-- {{ dd($record) }} --}}
                                <div class="col-md-8">
                                    <p class="card-text">KLAK{{ $record->id or '-' }}</p>
                                    <p class="card-text">{{ $record->nik or '-' }}</p>
                                    <p class="card-text">{{ $record->name or '-' }}</p>
                                    <p class="card-text">{{ $record->creator->hp or '-' }}</p>
                                    <p class="card-text">{{ $record->creator->email or '-' }}</p>
                                    <p class="card-text">{{ $record->type_usaha or '-' }}</p>
                                    <p class="card-text">{{ $record->keterangan or '-' }}</p>
                                    <p class="card-text">{{ $record->creator->alamat or '-' }}</p>
                                    <p class="card-text">{{ $record->created_at or '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Berkas</p>
                            <div class="card-body">
                                <center>
                                    <p>Foto Ktp</p>
                                    <img src="{{ url('storage/'.$record->fotoktp) ?? '-' }}" alt="" srcset="" style="max-height: 150px">
                                    <p>Skck</p>
                                    <img src="{{ url('storage/'.$record->skck) ?? '-' }}" alt="" srcset="" style="max-height: 150px">
                                </center>
                            </div>
                            <center>
                                <button type="button" class="btn btn-success mt-5 verif" id="verif1" data-id="1" data-url="{{ $record->id }}">Verifikasi Pertama</button><br><br>
                                <textarea name="verivikasi" id="isi1" cols="5" rows="5" class="isi form-control" placeholder="Tulis disini keterangan pembatalan verifikasi (Contoh : KTP habis masa berlaku, segera perbarui KTP)"></textarea>
                                <button type="button" class="btn btn-danger batal mt-2" data-id="4" data-url="{{ $record->id }}" id="batal1">Batalkan Verifikasi</button>
                            </center>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="card-header">Informasi Titik Lokasi</p>
                        <div class="card-body">
                            <div id="map" style="width:100%;height:500px"></div>
                        </div>
                        <center>
                            <button type="button" class="btn btn-success mt-5 verif" id="verif1" data-id="2" data-url="{{ $record->id }}">Verifikasi Kedua</button><br><br>
                            <textarea name="verivikasi" id="isi2" cols="5" rows="5" class="isi form-control" placeholder="Tulis disini keterangan pembatalan verifikasi"></textarea>
                            <button type="button" class="btn btn-danger batal mt-2" data-id="4" data-url="{{ $record->id }}" id="batal2">Batalkan Verifikasi</button>
                        </center>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="card-header">Menu Makan</p>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Nama Makanan</th>
                                        <th>Harga</th>
                                        <th>AKsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <center>
                            <button type="button" class="btn btn-success mt-5 verif" id="verif1" data-id="3" data-url="{{ $record->id }}">Verifikasi Akhir</button><br><br>
                            <textarea name="verivikasi" id="isi3" cols="5" rows="5" class="isi form-control" placeholder="Tulis disini keterangan pembatalan verifikasi"></textarea>
                            <button type="button" class="btn btn-danger batal mt-2" data-id="4" data-url="{{ $record->id }}" id="batal3">Batalkan Verifikasi</button>
                        </center>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
var map;
function initMap() {
  var feature = [];
  navigator.geolocation.getCurrentPosition(position => {
  localCoord = position.coords;
      map = new google.maps.Map(
      document.getElementById('map'),
      {center: new google.maps.LatLng(localCoord.latitude, localCoord.longitude), zoom: 18});
      
       
      var iconBase =
      'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

      var icons = {
        info: {
          icon: "{{ asset('kaki_lima.png') }}"
        },
        me:{
          icon: iconBase + 'info-i_maps.png'
        }
      };
      feature.push({
          "name": "Posisi Saat Ini",
          "position": new google.maps.LatLng(localCoord.latitude, localCoord.longitude),
          "map": map,
          "type":'me',
          "data" : 'false',
      });
      @if($record)
          @if($record->count() > 0)
            feature.push({
                "position": new google.maps.LatLng("{{ $record->lat or '' }}", "{{ $record->lng }}"),
                "type": 'info',
                "name": "{{ $record->name or '' }}",
                "data" : 'true',
                "type_usaha" : "{{ $record->type_usaha or '' }}",
                "keterangan" : "{!! $record->keterangan or '' !!}",
                "nomor_telepon" : "{{ $record->nomor_telepon or '' }}",
            })
          @endif
      @endif
      
      var contentString = '';
      // Create markers.
      if(feature.length > 0){
          for (var i = 0; i < feature.length; i++) {
              if(feature[i].data === 'true'){
                   contentString = `<div id="content">
                      <div id="siteNotice"></div>
                      <h1 id="firstHeading" class="firstHeading">`+feature[i].name+`</h1>
                      <div id="bodyContent">
                          <ul>
                              <li>Tipe Usaha : `+feature[i].type_usaha+` </li>
                              <li>No Tlp : `+feature[i].nomor_telepon+` </li>
                              <li>Keterangan : `+feature[i].keterangan+` </li>
                          </ul>
                      </div>
                  </div>`;
              }else{
                   contentString = `<div id="content">
                      <div id="siteNotice"></div>
                      <h1 id="firstHeading" class="firstHeading">`+feature[i].name+`</h1>
                  </div>`;
              }

              const infowindow = new google.maps.InfoWindow({
                  content: contentString
              });

              var marker = new google.maps.Marker({
                  position: feature[i].position,
                  icon: icons[feature[i].type].icon,
                  map: map,
                  title: feature[i].name,
              });

              marker.addListener("click", () => {
                  infowindow.open(map, marker);
              });
          }
      }
  });
}
function verif(url, id='',value='',isi='') {
    $.ajax({
        type: 'GET',
        url: url,
        data: {id:id,value:value,isi:isi},
        success: function(resp){
            swal(
                'Tersimpan!',
                'Data Berhasil Di Simpan.',
                'success'
                ).then((result) => {
                    if(resp.url){
                        // var url = "{{ url($pageUrl) }}";
                        window.history.back();
                    }
                    dt.draw();
                })
            },
            error: function(resp){
                swal(
                'Gagal Menyimpan Data!',
                showBoxValidation(resp),
                'error'
                );
                showFormErrorModalTwo(resp,form);
            },
    });
}
$(document).on('click','.verif',function(){
    var url = "{{ url('admin/kaki-lima/show/verif') }}";
    var id = $(this).data('url');
    var value = $(this).data('id');
    verif(url,id,value);
});

$(document).on('click','#batal1',function(){
    var url = "{{ url('admin/kaki-lima/show/batal-verif') }}";
    var id = $(this).data('url');
    var value = $(this).data('id');
    var isi = $('#isi1').val();
    verif(url,id,value,isi);
});
$(document).on('click','#batal2',function(){
    var url = "{{ url('admin/kaki-lima/show/batal-verif') }}";
    var id = $(this).data('url');
    var value = $(this).data('id');
    var isi = $('#isi2').val();
    verif(url,id,value,isi);
});
$(document).on('click','#batal3',function(){
    var url = "{{ url('admin/kaki-lima/show/batal-verif') }}";
    var id = $(this).data('url');
    var value = $(this).data('id');
    var isi = $('#isi3').val();
    verif(url,id,value,isi);
});


</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script>
@endsection