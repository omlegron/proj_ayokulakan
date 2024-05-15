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
		padding: 10px;
	}
	.divstart p{
		float: left;
	}
	.col-sm-6 h5{
		display: none;
	}

	#image_preview img{

	width: 200px;

	padding: 5px;

	}
	tr > td , 
    tr > th{
        border: none !important;
    }
</style>
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
	<div class="col-md-8">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
				<form id="dataSave" class="form-horizontal" action="{{ url('daftar-lapak') }}" method="POST">
					{!! csrf_field() !!}
					<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<label for="">Ayo buka lapakmu</label>
						<div class="form-group">
							<label class="col-sm-3" for="email">Nomor Handphone</label>
							<div class="col-sm-8 form-password">
								<input type="text" class="form-control" name="phone" placeholder="Nomor Handphone">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3" for="email">Nama Lapak</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" name="nama_lapak" placeholder="Masukan Nama Lapak">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-9">
								<input type="checkbox" name="" id="" class="check-daftar">
								<span>
									Saya setuju dengan syarat dan kebijakan privasi ayokulakan
								</span>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-offset-3 col-sm-9">
							  <button type="button" class="btn btn-default btn-batal">Batal</button>
							  <button type="button" class="btn btn-warning btn-save disabled">Konfirmasi</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
