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
	.detail-pesanan{
		display: flex;
		margin-top: 10px;
	}
	.detail-pesanan .deskripsi-pesanan{
		padding: 12px; 
	}
	.detail-pesanan .deskripsi-pesanan h3{
		margin: 2px;
	}
	.detail-pesanan .pesanan-check{
		margin-left: auto;
	}
	.detail-pesanan input{
		margin-right: 10px;
	}
	.action-pesanan{
		display: flex;
		padding: 10px 15px;
		height: 50px;
	}
	.pesanan-kurir{
		border: 2px solid #000000;
		padding: 10px;
		margin: 5px;
	}
	.pesanan-kurir p{
		font-weight: 600;
		text-transform: capitalize;
	}
	.icon-belanja{
		width: 50px;
		height: 50px;
		border: 1px solid #ccc;
		border-radius: 50px;
		padding: 10px;
		text-align: center;
		margin-right: 10px;
	}
	.icon-belanja span{
		color: #db700c;
		font-size: 18px;
	}
	.action-pesanan .pesanan-icon{
		margin-left: auto;
	}
	.nice-number button{
		background: #db700c;
		color: #ffffff;
		padding: 0px 10px;
		border: none;
	}
	.buttons:hover {
		background:black;
	}
</style>
<div class="row">
	@include('backend.brand.partials.partials')
	<div class="col-md-8">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
				<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
					<span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
						Setting Brand
					</span>
				</div><br>
				<a href="" class="btn btn-default">Informasi</a>
				<a href="" class="btn btn-default">Catatan</a>
				@if ($record)
				<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="id" value="{{ $record->id or ''}}">
					<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Nama Brand</label>
								<input type="text" name="nama_lapak" class="form-control" value="{{ $record->nama_lapak }}" placeholder="Masukan Nmaa Brand">
							</div>
							<div class="form-group">
								<label for="">Deskripsi Brand</label>
								<textarea name="deskripsi_lapak" id="" cols="30" rows="10" class="form-control" placeholder="Masukan Deskripsi Brand">{{ $record->deskripsi_lapak }}</textarea>
							</div>
							<div class="form-group">
								<label for="">Alamat Brand</label>
								<input type="text" name="alamat_lapak" class="form-control" value="{{ $record->alamat_lapak }}" placeholder="Masukan Alamat Brand">
							</div>
							<div class="form-group">
								<label for="">Nomer Telphone</label>
								<input type="text" name="phone" class="form-control" value="{{ $record->phone }}" placeholder="Masukan Nomer Telphone">
							</div>
							<div class="form-group">
								<label for="">Kode Pos</label>
								<input type="text" name="kode_pos" class="form-control" value="{{ $record->kode_pos }}" placeholder="Masukan Nomer Telphone">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Negara</label>
										<select name="id_negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan" data-live-search="true">
											{!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' => $record->id_negara], ('Pilih Wilayah Negara')) !!}
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Provinsi</label>
										<select class="form-control child-new target-new dynamic-more-than-5-select id_provinsi custom-select" required="" data-dropup-auto="false" data-size="10" data-arraynama="id_kota,id_kecamatan" data-style="none" name="id_provinsi">
											{!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected' => $record->id_provinsi,'filters' => ['id_negara' => $record->id_negara]], ('Pilih Wilayah Provinsi')) !!}
										</select>
										<div id="id_provinsi">
			
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Kab/Kota</label>
										<select class="form-control child-new target-new dynamic-more-than-5-select id_kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kota" data-arraynama="id_kecamatan">
											{!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' => $record->id_kota,'filters' => ['id_provinsi' => $record->id_provinsi]], ('Pilih Wilayah Kab/Kota')) !!}
										</select>
										<div id="id_kota">
			
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Kecamatan</label>
										<select class="form-control child-new target-new id_kecamatan custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kecamatan">
											{!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected' => $record->id_kecamatan,'filters' => ['id_kota' => $record->id_kota]], ('Pilih Wilayah Kecamatan')) !!}
										</select>
										<div id="id_kecamatan">
			
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								@include('partials.file-tab.attachment')
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-outline-success save-modal save-ayokulakan btn-success btn-block"><i class="ion-ios-paper"></i> Simpan</button>
				</form>
				@else
				<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<div class="col-md-12">
							<div class="form-group">
								<label for="">Nama Brand</label>
								<input type="text" name="nama_store" class="form-control" placeholder="Example Official Store">
							</div>
							<div class="form-group">
								<label for="">Deskripsi Brand</label>
								<textarea name="deskripsi_store" id="" cols="30" rows="10" class="form-control" placeholder="Masukan Deskripsi Brand"></textarea>
							</div>
							<div class="form-group">
								<label for="">Alamat Brand</label>
								<input type="text" name="alamat_store" class="form-control" placeholder="Masukan Alamat Brand">
							</div>
							<div class="form-group">
								<label for="">Nomer Telphone</label>
								<input type="text" name="phone" class="form-control" placeholder="Masukan Nomer Telphone">
							</div>
							<div class="form-group">
								<label for="">Kode Pos</label>
								<input type="text" name="kode_pos" name="phone" class="form-control" placeholder="Masukan Nomer Telphone">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Negara</label>
										<select name="id_negara" class="form-control child target dynamic-more-than-5-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan" data-live-search="true">
											{!! \App\Models\Master\WilayahNegara::options('negara', 'id', [], ('Pilih Wilayah Negara')) !!}
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Provinsi</label>
										<select class="form-control child target id_provinsi selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
										</select>
										<div id="id_provinsi"></div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Kab/Kota</label>
										<select class="form-control child target id_kota selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
										</select>
										<div id="id_kota"></div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">Wilayah Kecamatan</label>
										<select class="form-control child target id_kecamatan selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
										</select>
										<div id="id_kecamatan"></div>
									</div>
								</div>
							</div>
							<div class="form-group">
								@include('partials.file-tab.attachment')
							</div>
						</div>
					</div>
					<button type="button" class="btn btn-outline-success save-modal save-ayokulakan btn-success btn-block"><i class="ion-ios-paper"></i> Simpan</button>
				</form>
				@endif
				
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection