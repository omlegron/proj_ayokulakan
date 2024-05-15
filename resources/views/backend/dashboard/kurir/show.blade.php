@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" style="width:30%; padding-right: 10px">
                    <a class="nav-link active btn btn-success" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Data Pribadi</a>
                  </li>
                  <li class="nav-item" style="width:30%; padding-right: 10px !important">
                    <a class="nav-link btn bg-green" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Informasi Kendaraan</a>
                  </li>
                  <li class="nav-item" style="width:30%;">
                    <a class="nav-link btn bg-green" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tarif</a>
                  </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <p class="card-header">Profile</p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text">Id Kurir</p>
                                    <p class="card-text">Nik</p>
                                    <p class="card-text">Nama</p>
                                    <p class="card-text">Tanggal Lahir</p>
                                    <p class="card-text">Alamat</p>
                                    <p class="card-text">Register</p>
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text">KAK{{ $record->id }}</p>
                                    <p class="card-text">{{ $record->nik }}</p>
                                    <p class="card-text">{{ $record->namadepan .' '. $record->namabelakang }}</p>
                                    <p class="card-text">{{ $record->tanggalLahir }}</p>
                                    <p class="card-text">{{ $record->creator->alamat }}</p>
                                    <p class="card-text">{{ $record->created_at }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Berkas</p>
                            <div class="card-body">
                                <center>
                                    <p>Ktp</p>
                                    <img src="{{ url('storage/'.$record->fotoKtp) ?? '-' }}" alt="" srcset="" style="max-height: 150px">
                                    <p>KK</p>
                                    <img src="{{ url('storage/'.$record->fotocopyKK) ?? '-' }}" alt="" srcset="" style="max-height: 150px">
                                </center>
                            </div>
                            <center>
                                <button type="button" class="btn btn-success mt-5 verif" id="verif1" data-id="1" data-url="{{ $record->id }}">Verifikasi Pertama</button><br><br>
                                <textarea name="verivikasi" id="isi1" cols="5" rows="5" class="form-control" placeholder="Tulis disini keterangan pembatalan verifikasi (Contoh : KTP habis masa berlaku, segera perbarui KTP)"></textarea>
                                <button type="button" class="btn btn-danger batal mt-2" data-id="4" data-url="{{ $record->id }}" id="batal1">Batalkan Verifikasi</button>
                            </center>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <p class="card-header">Informasi Kendaraan</p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text">Kendaraan</p>
                                    <p class="card-text">Sim</p>
                                    <p class="card-text">Model Kendaraan</p>
                                    <p class="card-text">Tahun Kendaraan</p>
                                    <p class="card-text">Nopol</p>
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text">{{ $record->getKendaraan()  ?? '-'}}</p>
                                    <p class="card-text">{{ $record->getSim() ?? '-' }}</p>
                                    <p class="card-text">{{ $record->modelKendaraan or '-' }}</p>
                                    <p class="card-text">{{ $record->tahunKendaraan or '-' }}</p>
                                    <p class="card-text">{{ $record->NomorPolisiKendaraan or '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Berkas</p>
                            <div class="card-body">
                                <center>
                                    <p>Sim</p>
                                    <img src="{{ url('storage/'.$record->fotoSim) ?? '-' }}" alt="" srcset="" style="max-height: 150px">
                                </center>
                            </div>
                            <center>
                                <button class="btn btn-success mt-5 verif" data-id="2" data-url="{{ $record->id }}">Verifikasi kedua</button><br><br>
                                <textarea name="verivikasi" id="isi2" cols="5" rows="5" class="form-control" placeholder="Tulis disini keterangan pembatalan verifikasi (Contoh : NOPOL kendaraan tidak sesuai dengan STNK)"></textarea>
                                <button type="button" class="btn btn-danger batal mt-2" data-id="4" data-url="{{ $record->id }}" id="batal2">Batalkan Verifikasi</button>
                            </center>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                        <p class="card-header">Tarif Kurir</p>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <p class="card-text">Harga / Km</p>
                                    <p class="card-text">Harga / kg</p>
                                </div>
                                <div class="col-md-8">
                                    <p class="card-text">{{ $record->km }}</p>
                                    <p class="card-text">{{ $record->kg }}</p>
                                </div>
                            </div>
                        </div>
                        <center>
                            <button class="btn btn-success mt-5 verif" data-id="3" data-url="{{ $record->id }}">Verifikasi Akhir</button><br><br>
                            <textarea name="verivikasi" id="isi3" cols="5" rows="5" class="form-control isi" placeholder="Tulis disini keterangan pembatalan verifikasi (Contoh : Tarif tidak memnuhi standar maksimal kebijakan dari perusahaan)"></textarea>
                            <button type="button" class="btn btn-danger batal mt-2" data-id="4" data-url="{{ $record->id }}" id="batal3">Batalkan Verifikasi</button>
                        </center>
                    </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script type="text/javascript">
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
        var url = "{{ url('admin/kurir/show/verif') }}";
        var id = $(this).data('url');
        var value = $(this).data('id');

        console.log(id);
        verif(url,id,value);
    });
    $(document).on('click','#batal1',function(){
        var url = "{{ url('admin/kurir/show/batal-verif') }}";
        var id = $(this).data('url');
        var value = $(this).data('id');
        var isi = $('#isi1').val();
        verif(url,id,value,isi);
    });
    $(document).on('click','#batal2',function(){
        var url = "{{ url('admin/kurir/show/batal-verif') }}";
        var id = $(this).data('url');
        var value = $(this).data('id');
        var isi = $('#isi2').val();
        verif(url,id,value,isi);
    });
    $(document).on('click','#batal3',function(){
        var url = "{{ url('admin/kurir/show/batal-verif') }}";
        var id = $(this).data('url');
        var value = $(this).data('id');
        var isi = $('#isi3').val();
        verif(url,id,value,isi);
    });
</script>
    
@endsection