
	@extends('layouts.grid')

    @section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
    @endsection
    
    
    
    @section('rules')
    <script type="text/javascript">
        formRules = {
            judul: ['empty'],
        };
    </script>
    @endsection
    @section('filters')
    
    @endsection
    @section('toolbars')
    
    @endsection
    @section('subcontent')
    <style type="text/css">
        .terms-conditions-page{
            padding-top: 0px !important;
            margin-top: -35px;
        }
        .detail-block{
            background-color: transparent;
        }
        .outer-top-vs {
            margin-top: 3px;
        }
        .scroll-tabs{
            margin-bottom: 5px;
        }
        .profile-img{
            width: 40px; height: 40px;
            float: left;
            margin-right: 20px;
        }
        .profile-name{
            font-size: 18px;
            font-weight: 600;
            color: #000;
            margin: 0px;
        }
        .profile-verif{
            font-size: 14px;
            font-weight: 300;
            color: #a09898;
    
		}
		.scroll-tabs{
			border-radius: 10px;
		}
        .components>li{
            padding: 10px;
        }
        .components > li > a{
            color: #000;
            font-size: 16px;
            font-weight: 400;
        }
        .colapse-item{
            padding: 10px !important;
        }
        .colapse-item{
            color: #a09898;
        }
        .colapse-item a{
            font-size: 15px
            font-weight: 300;
        }
        .colapse-item:hover{
            background: #d4bcbc;
            color: #ffffff !important;
		}
		.oprational{
			display: flex;
		}
		.oprational-body{
			padding: 10px;
		}
    </style>
    <div class="row">
        @include('backend.lapak.partials.partials')
        <div class="col-md-9">
			<form id="dataFormModal" action="" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="id" value="{{ $record->id }}">
				<div class="scroll-tabs fadeinUp wow">
					<div class="more-info-tab clearfix" id="content">
						<p style="font-size: 20px; font-weight: 600;">Pengaturan Lapak</p>
						<a href="{{ url($pageUrl.'create') }}" class="btn-sm btn-default">Informasi</a>
						<a href="{{ url($pageUrl.'note') }}" class="btn-sm btn-default">Catatan</a>
						<a href="{{ url($pageUrl.'address') }}" class="btn-sm btn-default">Lokasi</a>
						<a href="" class="btn-sm btn-default">Pengiriman</a>
						<br><br>
                        <label for="">Catatan Lapak</label>
                        <div class="form-group">
							<label for="">Lokasi</label>
							<textarea name="deskripsi_lapak" class="form-control" rows="2" placeholder="Contoh : Gedung Rumah Lapak"></textarea>
                        </div>
                        <div class="form-group">
							<label for="">Alamat</label>
							<input type="text" name="nama_lapak" class="form-control" placeholder="Masukan Alamat Lengkap Anda" required="">
						</div>
                        <div class="form-group">
                            <label for="">Wilayah Negara</label>
                            <select name="id_negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan,id_kelurahan">
                                {!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' => $record->id_negara], ('Pilih Wilayah Negara')) !!}
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Wilayah Provinsi</label>
                            <select class="form-control child-new target-new dynamic-more-than-5-select id_provinsi custom-select" required="" data-dropup-auto="false" data-size="10" data-arraynama="id_kota,id_kecamatan" data-style="none" name="id_provinsi">
                                {!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected' => $record->id_provinsi,'filters' => ['id_negara' => $record->id_negara]], ('Pilih Wilayah Provinsi')) !!}
                            </select>
                            <div id="id_provinsi">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Wilayah Kab/Kota</label>
                            <select class="form-control child-new target-new dynamic-more-than-5-select id_kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kota" data-arraynama="id_kecamatan">
                                {!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' => $record->id_kota,'filters' => ['id_provinsi' => $record->id_provinsi]], ('Pilih Wilayah Kab/Kota')) !!}
                            </select>
                            <div id="id_kota">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Wilayah Kecamatan</label>
                            <select class="form-control child-new target-new id_kecamatan custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kecamatan">
                                {!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected' => $record->id_kecamatan,'filters' => ['id_kota' => $record->id_kota]], ('Pilih Wilayah Kecamatan')) !!}
                            </select>
                            <div id="id_kecamatan">

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Wilayah Kelurahan</label>
                            <select class="form-control child-new target-new id_kelurahan custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kelurahan">
                                {!! \App\Models\Master\WilayahKelurahan::options('kelurahan', 'id', ['selected' => $record->id_kelurahan,'filters' => ['id_kecamatan' => $record->id_kecamatan]], ('Pilih Wilayah kelurahan')) !!}
                            </select>
                            <div id="id_kelurahan">

                            </div>
                        </div>
                        <div class="form-group">
							<label for="">E-mail</label>
							<input type="text" name="nama_lapak" class="form-control" placeholder="Masukan E-mail Anda" required="">
						</div>
                        <div class="form-group">
							<label for="">Kode Pos</label>
							<input type="text" name="nama_lapak" class="form-control" placeholder="Masukan Kode Pos Anda" required="">
						</div>
                        <div class="form-group">
							<label for="">Phone</label>
							<input type="text" name="nama_lapak" class="form-control" placeholder="Masukan Nomor telephone Anda" required="">
						</div>
                        <div class="form-group">
							<label for="">Fax</label>
							<input type="text" name="nama_lapak" class="form-control" placeholder="Masukan Fax" required="">
                        </div>
                        <div class="form-group">        
                            <div class="col-sm-offset-9 col-sm-3 text-right">
                                <button type="button" class="btn btn-warning save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
                            </div>
                        </div>
					</div>
				</div>
			</form>
        </div>
    </div>
    @endsection
    @section('scripts-js')
        
    @endsection