@extends('layouts.grid')

@section('js-filters')
d.nama = $("input[name='filter[nama]']").val();
@endsection

@section('scripts')
@include('backend.lapak.script.index')
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
	.detail-block{
		background-color: transparent;
	}
	.ft0{font: bold 32px 'Arial';color: #ffc000;line-height: 37px;}
	.ft1{font: bold 32px 'Arial';color: #00b050;line-height: 37px;}	
	#image_preview{
	padding: 10px;

	}
	.scroll-tabs{
		border-radius: 10px;
		padding: 10px 10px 0px 10px;
	}
	.divstart p{
		float: left;
	}
	.col-sm-6 h5{
		display: none;
	}
	.scroll-tabs{
		position: relative !important;
	}

	#image_preview img{
		width: 200px;
		padding: 5px;
	}
	#footer{
		margin-top: 10px;
	}
	{{-- .address-body{
		min-height: 110vh !important;
	} --}}
</style>
<div class="container" style="margin-top: 15px">
	<div class="row">
		<div class="col-md-4">
			<div class="divstart">
				<p class="p0 ft1">
				  <span class="ft0">Ayo</span><span class="ft1">kulakan</span>
				</p>
				<img src="{{ asset('img/logo/favicon-16x16.png') }}" alt="" width="50">
				<div class="clearfix"></div>
				<h4>Tebarkan Kesejahteraan dan Kedamaian Bersama AYOKULAKAN</h4>
			</div>
		</div>
		<div class="col-md-8 address-body">
			<form id="dataSave" class="form-horizontal" action="{{ url('daftar-lapak/bank') }}" method="POST" enctype="multipart/form-data">
				<div class="scroll-tabs fadeinUp wow">
					<div class="more-info-tab clearfix" id="content">
						{!! csrf_field() !!}
						<input type="hidden" name="lapak_id" value="{{ auth()->user()->lapak->id }}">
						<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
							<label for="">Memverifikasi informasi identitas</label>
							<div class="form-group">
								<label class="col-sm-3" for="email">Nama lengkap sesuai KTP</label>
								<div class="col-sm-8 form-password">
									<input type="text" class="form-control" name="nama_ktp" placeholder="Nama Lengkap">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Nomor Identitas (KTP)</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nomor_ktp" placeholder="Nomor KTP">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Upload Foto Ktp</label>
								<div class="col-sm-8">
									<input type="file" name="foto_ktp" id="" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Upload Swaphoto</label>
								<div class="col-sm-8">
									<input type="file" name="swa_foto" id="" class="form-control">
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="scroll-tabs fadeinUp wow">
					<div class="more-info-tab clearfix" id="content">
						<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
							<label for="">Mohon Informasikan Akun Bank Sesuai dengan Perusahaan/Pribadi</label>
							<div class="form-group">
								<label class="col-sm-3" for="email">Nama Pemilik Rekening</label>
								<div class="col-sm-8 form-password">
									<input type="text" class="form-control" name="nama_rekening" placeholder="Nama Pemilik">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Nomor Rekening</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="nomor_rekening" placeholder="Nomor Rekening">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Bank</label>
								<div class="col-sm-8">
									<select name="bank" id="" class="form-control">
										<option value="">Pilih Bank</option>
										<option value="BCA">BCA</option>
										<option value="BRI">BRI</option>
										<option value="BNI">BNI</option>
										<option value="MANDIRI">MANDIRI</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Upload Buku Tabungan / Giro</label>
								<div class="col-sm-8">
									<input type="file" name="foto_tabungan" id="" class="form-control">
								</div>
							</div>
							
						</div>
					</div>
				</div>
				<div class="form-group">        
					<div class="col-sm-offset-3 col-sm-9">
					  <button type="button" class="btn btn-default btn-batal">Batal</button>
					  <button type="button" class="btn btn-warning btn-save">Konfirmasi</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

@endsection
