@extends('layouts.scaffold-sidebar-right')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty'],
    };
</script>
@endsection


@section('content-frontend-left')
<a href="{{ url('/') }}" style="margin-left: 35px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
<div class="col-md-12" style="padding: 0px; margin-top: -15px">
    @include('frontend.home.partial.pilihan')
    <div class="filters-container">
        <h2 class="heading-title">Bergabung Menjadi Kurir Ayokulakan</h2>
        <div class="flter-tabs">
            <div class="alert alert-danger" role="alert">
                <p>Silahkan lakukan pendaftaran dengan menyertai file upload sebagai berikut :.</p>
                <p>
                    {{-- 1. Foto Kendaraan<br> --}}
                        1. Foto KTP<br>
                        2. Foto SIM<br>
                        3. Swafoto<br>
                        4. Fotocopy KK<br>
                </p>
                <p>Agar pendaftar dapat ditindaklanjuti oleh ayokulakan, silakan lengkapi pemberkasan.</p>
                <hr>
                <p class="mb-0">Salam Hangat Ayokulakan.com</p>
            </div>
    
            <div class="content-ayokulakan">
                <div class="row">
                    <div class="col-md-12">
    
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
    
                        <form id="dataFormPage" action="{{ url($pageUrl . 'newStore') }}" method="POST" enctype="multipart/form-data">
    
                            {!! csrf_field() !!}
                            <h4>Biodata</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namadepan">Nama Depan <span class="required">*</span></label>
                                        <input id="namadepan" type="text" name="namadepan" class="form-control">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="namabelakang">Nama Belakang <span class="required">*</span></label>
                                        <input id="namabelakang" type="text" name="namabelakang" class="form-control">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email <span class="required">*</span></label>
                                        <input id="email" type="email" name="email" class="form-control"
                                        value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nomorTelepon">Nomor telepon <span class="required">*</span></label>
                                        <input id="nomorTelepon" type="text" name="phoneNumber" class="form-control"
                                        value="{{ auth()->user()->hp }}">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="tanggalLahir">Tanggal lahir <span class="required">*</span></label>
                                        <input id="tanggalLahir" type="text" name="tanggalLahir" class="form-control">
                                    </div>
                                </div>
    
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nik">NIK <span class="required">*</span></label>
                                        <input type="text" id="numb" name="nik" class="form-control">
                                    </div>
                                </div>
                            </div>
    
                            <hr>
                            <h4>Wilayah</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Negara <span class="required">*</span></label>
                                        <select name="id_negara"
                                        class="form-control child-new target-new dynamic-more-than-5-select custom-select"
                                        required="" data-dropup-auto="false" data-size="10" data-style="none"
                                        data-arraynama="id_provinsi,id_kota,id_kecamatan">
                                        {!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' =>
                                        auth()->user()->id_negara], ('Pilih Wilayah Negara')) !!}
                                    </select>
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Provinsi <span class="required">*</span></label>
                                    <select class="form-control child-new target-new id_provinsi custom-select"
                                    required="" data-dropup-auto="false" data-size="10" data-style="none"
                                    name="id_provinsi">
                                    {!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id',
                                    ['selected' => auth()->user()->id_provinsi,'filters' => ['id_negara' =>
                                    auth()->user()->id_negara]], ('Pilih Wilayah Provinsi')) !!}
                                </select>
                                <div id="id_provinsi"></div>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Kab/Kota <span class="required">*</span></label>
                                <select class="form-control child-new target-new id_kota custom-select"
                                required="" data-dropup-auto="false" data-size="10" data-style="none"
                                name="id_kota">
                                {!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' =>
                                auth()->user()->id_kota,'filters' => ['id_provinsi' =>
                                auth()->user()->id_provinsi]],
                                ('Pilih Wilayah Kab/Kota')) !!}
                            </select>
                            <div id="id_kota"></div>
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Kecamatan <span class="required">*</span></label>
                            <select class="form-control child-new target-new id_kecamatan custom-select"
                            required="" data-dropup-auto="false" data-size="10" data-style="none"
                            name="id_kecamatan">
                            {!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id',
                            ['selected' => auth()->user()->id_kecamatan,'filters' => ['id_kota' =>
                            auth()->user()->id_kota]], ('Pilih Wilayah Kecamatan')) !!}
                            </select>
                        <div id="id_kecamatan"></div>
                    </div>
                </div>
            </div>
    
            <hr>
            <h4>Harga</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga /KM <span class="required">*</span></label>
                        <input type="text" id="num" min="0" name="km" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Harga /KG <span class="required">*</span></label>
                        <input type="text" id="num" min="0" name="kg" class="form-control">
                    </div>
                </div>
            </div>
    
            <hr>
            <h4>Upload Foto</h4>
            <div class="row">
                <div class="col-md-6">
                    @include('partials.file-tab.kurir-attachment',[
                    'inputName' => 'fotoKtp',
                    'labelName' => 'Foto KTP'
                    ])
                    <p style="margin-top: -10px">* Jenis File yang di upload adalah jpeg, png, jpg, dan pdf</p>
                </div>
    
                <div class="col-md-6">
                    @include('partials.file-tab.kurir-attachment',[
                    'inputName' => 'swafoto',
                    'labelName' => 'Swafoto'
                    ])
                    <p style="margin-top: -10px">* Jenis File yang di upload adalah jpeg, png, jpg, dan pdf</p>
                </div>
    
                <div class="col-md-6">
                    @include('partials.file-tab.kurir-attachment',[
                    'inputName' => 'fotoSim',
                    'labelName' => 'Foto Sim'
                    ])
                    <p style="margin-top: -10px">* Jenis File yang di upload adalah jpeg, png, jpg, dan pdf</p>
                </div>
    
                <div class="col-md-6">
                    @include('partials.file-tab.kurir-attachment',[
                    'inputName' => 'fotocopyKK',
                    'labelName' => 'Fotocopy KK'
                    ])
                    <p style="margin-top: -10px">* Jenis File yang di upload adalah jpeg, png, jpg, dan pdf</p>
                </div>
            </div>
    
            <hr>
            <h4>Identitas Kendaraan</h4>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group country-select mb-30">
                        <label>Kendaraan Yang Dimiliki <span class="required">*</span></label>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="kendaraan" class="custom-control-input"
                            id="customCheck1" value="1">
                            <label class="custom-control-label" for="customCheck1">Motor</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="kendaraan" class="custom-control-input"
                            id="customCheck2" value="2">
                            <label class="custom-control-label" for="customCheck2">Mobil</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="kendaraan" class="custom-control-input"
                            id="customCheck3" value="3">
                            <label class="custom-control-label" for="customCheck3">Mobil & Motor</label>
                        </div>
    
                    </div>
                </div>
    
                <div class="col-md-6">
                    <div class="form-group country-select mb-30">
                        <label>SIM Yang Dimiliki <span class="required">*</span></label>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="sim" class="custom-control-input"
                            id="customCheck4" value="1">
                            <label class="custom-control-label" for="customCheck4">SIM A</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="sim" class="custom-control-input"
                            id="customCheck5" value="2">
                            <label class="custom-control-label" for="customCheck5">SIM C</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" name="sim" class="custom-control-input"
                            id="customCheck6" value="3">
                            <label class="custom-control-label" for="customCheck6">SIM A & C</label>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="modelKendaraan">Model kendaraan <span
                            class="required">*</span></label>
                            <input id="modelKendaraan" type="text" name="modelKendaraan"
                            class="form-control">
                        </div>
                    </div>
    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahunKendaraan">Tahun Kendaraan <span
                                class="required">*</span></label>
                                <input id="tahunKendaraan" type="text" name="tahunKendaraan"
                                class="form-control">
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="NomorPolisiKendaraan">Nomor Polisi Kendaraan <span
                                    class="required">*</span></label>
                                    <input id="NomorPolisiKendaraan" type="text" name="NomorPolisiKendaraan"
                                    class="form-control">
                                </div>
                            </div>
    
                       
                        </div>
                        <hr>
                        <div class="row" id="dvPinNo" style="display: none">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="modelKendaraan1">Model kendaraan Bermotor<span
                                            class="required">*</span></label>
                                    <input id="modelKendaraan1" type="text" name="modelKendaraan1"
                                        class="form-control">
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahunKendaraan1">Tahun Kendaraan Bermotor<span
                                            class="required">*</span></label>
                                    <input id="tahunKendaraan1" type="text" name="tahunKendaraan1"
                                        class="form-control">
                                </div>
                            </div>
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="NomorPolisiKendaraan1">Nomor Polisi Kendaraan Bermotor<span
                                            class="required">*</span></label>
                                    <input id="NomorPolisiKendaraan1" type="text" name="NomorPolisiKendaraan1"
                                        class="form-control">
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-12">
                                <div id="googleMap" style="width:100%; height:380px; margin-bottom: 20px;"></div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label for="">Position Latitude <span class="required">*</span></label>
                                  <input id="lat" type="text" name="lat" class="form-control" placeholder="cth: 1.565650" required readonly="" value="">
                                </div>
                              </div>
      
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label>Longitude <span class="required">*</span></label>
                                  <input id="lng" type="text" name="lng" readonly="" class="form-control" placeholder="cth: -1.565650">
                                </div>
                              </div>
                        </div>
                                
                        <hr>
                        <h4>Pertanyaan Umum</h4>
    
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="merekHandphone">Sebutkan Merek Handphone yang anda gunakan! <span
                                        class="required">*</span></label>
                                        <input id="merekHandphone" type="text" name="merekHandphone"
                                        class="form-control">
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="SmartphoneMinRAM">
                                            Apakah anda menggunakan Smartphone dengan RAM minimal 1 gb? <span
                                            class="required">*</span>
                                        </label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="smartphoneMinRAM" class="custom-control-input"
                                            id="customCheck4" value="1">
                                            <label class="custom-control-label" for="customCheck4">Ya</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" name="smartphoneMinRAM" class="custom-control-input"
                                            id="customCheck5" value="0">
                                            <label class="custom-control-label" for="customCheck5">Tidak</label>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="pekerjaanTetap">Apakah anda memiliki pekerjaan tetap? <span
                                            class="required">*</span></label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="pekerjaanTetap" class="custom-control-input"
                                                id="customCheck4" value="1">
                                                <label class="custom-control-label" for="customCheck4">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="pekerjaanTetap" class="custom-control-input"
                                                id="customCheck5" value="0">
                                                <label class="custom-control-label" for="customCheck5">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="pekerjaanLain">
                                                Apakah anda sedang bekerja diperusahaan lain? <span
                                                class="required">*</span>
                                            </label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="kerjaPerusahaan" class="custom-control-input"
                                                id="customCheck4" value="1">
                                                <label class="custom-control-label" for="customCheck4">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="kerjaPerusahaan" class="custom-control-input"
                                                id="customCheck5" value="0">
                                                <label class="custom-control-label" for="customCheck5">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bekerja8Jam">
                                                Apakah anda bersedia untuk bekerja setidaknya 8 jam/hari?
                                                <span class="required">*</span>
                                            </label>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="kerjaMinimal" class="custom-control-input"
                                                id="customCheck4" value="1">
                                                <label class="custom-control-label" for="customCheck4">Ya</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="kerjaMinimal" class="custom-control-input"
                                                id="customCheck5" value="0">
                                                <label class="custom-control-label" for="customCheck5">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    
                                <div class="order-button-payment">
                                    <button type="button" class="btn btn-success save-page save-ayokulakan btn-lg btn-block"
                                    data-title="Bergabung Dengan Kurir Ayokulakan?" data-confirm="Bergabung"
                                    data-batal="Batal">Bergabung</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
</div>
@endsection

    @section('scripts')
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY"></script>
    <script src="{{ asset('js/gmaps.js') }}"></script>
    <script>
      var map = new GMaps({
          div: '#googleMap',
      });
      GMaps.geocode({
        address: $('#address').val(),
        callback: function(results, status) {
          if (status == 'OK') {
            var latlng = results[0].geometry.location;
            map.setCenter(latlng.lat(), latlng.lng());
            map.addMarker({
              lat: latlng.lat(),
              lng: latlng.lng()
          });
        }
    }
});

      GMaps.geolocate({
          success: function(position) {
              let lat = position.coords.latitude;
              let lng = position.coords.longitude;

              $('#lat').val(lat.toFixed(5));
              $('#lng').val(lng.toFixed(5));

              map.setCenter(lat, lng);
              map.addMarker({
                  lat: lat,
                  lng: lng,
                  draggable: true,
                  dragend: function(event) {
                      var lat = event.latLng.lat();
                      var lng = event.latLng.lng();
                      $('#lat').val(lat.toFixed(5));
                      $('#lng').val(lng.toFixed(5));
                  },
                  infoWindow: {
                      content: '<p>Data yang ingin di tampilkan</p>'
                  }
              });
          },
          error: function(error) {
              alert("Lokasi Anda Tidak Ditemukan");
          },
          not_supported: function() {
              alert("Browser Anda Tidak Support Geolokasi");
          },
          always: function(e) {

          }
      });
  </script>

  <script type="text/javascript">
    $( document ).ready(function() {

    });
    const anElement = AutoNumeric.multiple('#num', {
     'digitGroupSeparator': '.',
     'decimalPlaces': '2',
     'decimalCharacter': ',',
     'currencySymbol': 'Rp.',
    });

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
            });
        });
    }

    setInputFilter(document.getElementById("numb"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
    setInputFilter(document.getElementById("numb1"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
    setInputFilter(document.getElementById("numb2"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
    setInputFilter(document.getElementById("tahunKendaraan"), function(value) {
        return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
    });
</script>
<script type="text/javascript">
    $(function() {
      $("input[name='kendaraan']").click(function() {
        if ($("#customCheck3").is(":checked")) {
          $("#dvPinNo").show();
        } else {
          $("#dvPinNo").hide();
        }
      });
    });
       </script>
@endsection
