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
			<form id="dataSave" class="form-horizontal" action="{{ url('daftar-lapak/address') }}" method="POST">
				<div class="scroll-tabs fadeinUp wow">
					<div class="more-info-tab clearfix" id="content">
						{!! csrf_field() !!}
						<input type="hidden" name="id" value="{{ $record->id }}">
						<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
							<label for="">Alamat Penjual</label>
							<div class="form-group">
								<label class="col-sm-3" for="email">Negara</label>
								<div class="col-sm-8 form-password">
									<select name="id_negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan,id_kelurahan">
										{!! \App\Models\Master\WilayahNegara::options('negara', 'id', [], ('Pilih Wilayah Negara')) !!}
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Provinsi</label>
								<div class="col-sm-8">
									<select class="form-control child target id_provinsi selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									</select>
									<div id="id_provinsi"></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Kabupaten/Kota</label>
								<div class="col-sm-8">
									<select class="form-control child target id_kota selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									</select>
									<div id="id_kota"></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Kecamatan</label>
								<div class="col-sm-8">
									<select class="form-control child target id_kecamatan selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									</select>
									<div id="id_kecamatan"></div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-3" for="email">Kelurahan / Desa</label>
								<div class="col-sm-8">
									<select class="form-control child target id_kelurahan selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									</select>
									<div id="id_kelurahan"></div>
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
