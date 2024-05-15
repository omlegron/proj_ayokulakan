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
		border-radius: 10px;
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
	<div class="col-md-4">
		@include('partials.backend.partials-sidebar.left-profile')
	</div>
	<div class="col-md-8">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
				<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
					<span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
						My Profile
					</span>
				</div><br>
				<a href="{{ url($pageUrl) }}" class="btn btn-default">Profile</a>
				<a href="{{ url('profile-bank') }}" class="btn btn-default">Bank & Kartu</a>
				<a href="{{ url('ganti-pass') }}" class="btn btn-default">Ganti Password</a>
				<h5 style="font-weight: 600">Jaga informasi profil Anda untuk mengontrol melindungi dan menggunakan akun</h5>
				<form id="dataFormPage" action="{{ url($pageUrl.$record->id) }}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<input type="hidden" name="_method" value="PUT">
					<input type="hidden" name="id" value="{{ $record->id or ''}}">
					<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<div class="col-xs-12 col-sm-6 col-md-5 gallery-holder" style="text-align: left">
							<div class="product-item-holder size-big single-product-gallery small-gallery">
								<div id="owl-single-product" style="opacity: 1; display: block;" class="owl-carousel owl-theme">
									<div class="owl-wrapper-outer">
										<div class="owl-wrapper" style="width: 4608px; left: 0px; display: block; transition: all 0ms ease 0s; transform: translate3d(0px, 0px, 0px);">
											<div class="owl-item" style="width: 256px;">
												<div class="single-product-gallery-item" id="slide1">
													 <a data-lightbox="image-1" data-title="Gallery" href="{{ ($record->pictureusers->sortByDesc('created_at')->first()) ? url('storage/'.$record->pictureusers->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}">
														<center><img class="img-responsive" alt="" src="{{ ($record->pictureusers->sortByDesc('created_at')->first()) ? url('storage/'.$record->pictureusers->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}"></center>
													</a> 
													<a href="" class="btn btn-default btn-block">edit Profile</a>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-7 product-info-block">
							<div class="product-info" style="text-align: left;">
								 <div class="form-group">
									<a href="{{ url('profile-user') }}" class="btn btn-primary">Tambah Alamat Lain</a>
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
									<label for="">Kode Pos</label>
									<input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" required="" value="{{ $record->kode_pos or '' }}">
		
								</div>
								<div class="form-group">
									<label for="">Nama</label>
									<input type="text" name="nama" class="form-control" placeholder="Nama" required="" value="{{ $record->nama or '' }}">
								</div>
								<div class="form-group">
									<label for="">Jenis Kelamin</label>
									<select name="gender" class="form-control" placeholder="Jenis Kelamin" required>
										<option value="">- Pilih Jenis Kelamin -</option>
										<option value="Laki - Laki" {{ ($record->gender == 'Laki - Laki') ? 'selected' : '' }}>Laki - Laki</option>
										<option value="Perempuan" {{ ($record->gender == 'Perempuan') ? 'selected' : '' }}>Perempuan</option>
									</select>
								</div>
								<div class="form-group">
									<label for="">No Telp / HP </label>
									<input type="text" name="hp" class="form-control" placeholder="No Telp / HP" required="" value="{{ $record->hp or '' }}" minlength="12" maxlength="13" oninput="this.value= this.value.replace(/[^0-9.,]/g, '').replace(/(\..*)\.,/g, '$1')">
								</div>
								<div class="form-group">
									<label for="">Alamat</label>
									<textarea class="form-control" name="alamat" rows="1">{{ $record->alamat or '' }}</textarea>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										@include('partials.file-tab.foto-users',['label' => 'Lampiran Foto','shows' => false])
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body pull-right">
							<button type="button" class="btn btn-success save-page save-ayokulakan pull-right"><i class="ion-ios-paper"></i> Simpan</button>
						</div>
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection