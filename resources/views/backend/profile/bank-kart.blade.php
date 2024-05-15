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
	<div class="col-md-4">
		@include('partials.backend.partials-sidebar.left-profile')
	</div>
	<div class="col-md-8">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
				<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
					<span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
						Bank & Kartu Kredit
					</span>
				</div><br>
				<a href="{{ url('myprofile') }}" class="btn btn-default">Profile</a>
				<a href="{{ url('profile-bank') }}" class="btn btn-default">Bank & Kartu</a>
				<a href="{{ url('ganti-pass') }}" class="btn btn-default">Ganti Password</a>
				@if ($card)
					<form id="dataKredit" action="{{ url($pageUrl.'cart') }}" method="POST" style="margin: 10px">
						{!! csrf_field() !!}
						<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
						<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
							<a href="javascript:void(0)" style="padding: 5px 10px; border: 1px solid black; border-radius: 5px; box-shadow: 1px #776f6f; margin-bottom: 5px; float: right" class="edit-card">Edit</a>
							<div class="form-group">
								<label for="">Kartu Kredit</label>
								<input name="nama" type="text" value="{{ $card->nama }}" class="form-control" placeholder="Nama">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="no_kartu" value="{{ $card->no_kartu }}" class="form-control" placeholder="No Kartu Kredit">
									</div>
								</div>
								<div class="col-md-6">
									<div class="d-flex">
										<a href="">
											<img src="{{ asset('new_temp/images/payments/3.png') }}" alt="">
										</a>
										<a href="">
											<img src="{{ asset('new_temp/images/payments/4.png') }}" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">kadaluarda Pada</label>
											<div class="d-flex" style="display: flex;">
												<input type="text" name="bulan" value="{{ $card->bulan }}" class="form-control" placeholder="MM">
												<span style="padding: 3px 10px; font-size: 20px;">/</span>
												<input type="text" name="tahun" value="{{ $card->tahun }}" class="form-control" placeholder="YY">
											</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">CVV</label>
										<input type="text" name="cvv" value="{{ $card->cvv }}" class="form-control" placeholder="00">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="alamat" value="{{ $card->alamat }}" class="form-control" placeholder="Alamat">
							</div>
							<div class="form-group mb-2">
								<input type="text" name="kode_pos" value="{{ $card->kode_pos }}" class="form-control" placeholder="Kode Pos">
							</div>
							<button type="button" class="btn btn-warning btn-block simpan-cart">Simpan</button>
					</form>
				@else
					<form id="dataKredit" action="{{ url($pageUrl.'cart') }}" method="POST" style="margin: 10px">
						{!! csrf_field() !!}
						<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
						<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
							<a href="javascript:void(0)" style="padding: 5px 10px; border: 1px solid black; border-radius: 5px; box-shadow: 1px #776f6f; margin-bottom: 5px; float: right" class="edit-card">Edit</a>
							<div class="form-group">
								<label for="">Kartu Kredit</label>
								<input name="nama" value="" type="text" class="form-control" placeholder="Nama">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="no_kartu" class="form-control" placeholder="No Kartu Kredit">
									</div>
								</div>
								<div class="col-md-6">
									<div class="d-flex">
										<a href="">
											<img src="{{ asset('new_temp/images/payments/3.png') }}" alt="">
										</a>
										<a href="">
											<img src="{{ asset('new_temp/images/payments/4.png') }}" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="">kadaluarda Pada</label>
											<div class="d-flex" style="display: flex;">
												<input type="text" name="bulan" class="form-control" placeholder="MM">
												<span style="padding: 3px 10px; font-size: 20px;">/</span>
												<input type="text" name="tahun" class="form-control" placeholder="YY">
											</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="">CVV</label>
										<input type="text" name="cvv" class="form-control" placeholder="00">
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="alamat" class="form-control" placeholder="Alamat">
							</div>
							<div class="form-group mb-2">
								<input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos">
							</div>
							<button type="button" class="btn btn-warning btn-block simpan-cart">Simpan</button>
					</form>
				@endif
				@if ($rekening)
					<form id="dataRekening" action="{{ url($pageUrl.'rekening') }}" method="POST" style="margin: 10px">
						<a href="javascript:void(0)" class="edit-rek" style="padding: 5px 10px; border: 1px solid black; border-radius: 5px; box-shadow: 1px #776f6f; margin-bottom: 5px; float: right">Edit</a>
							{!! csrf_field() !!}
							<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
							<div class="form-group">
								<label for="">Rekening Bank</label>
								<input type="text" name="nama" class="form-control" placeholder="Nama">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="no_rekening" value="{{ $rekening->no_rekening }}" class="form-control" placeholder="No Rekening">
									</div>
								</div>
								<div class="col-md-6">
									<div class="d-flex">
										<a href="">
											<img src="{{ asset('new_temp/images/payments/3.png') }}" alt="">
										</a>
										<a href="">
											<img src="{{ asset('new_temp/images/payments/4.png') }}" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="nama_bank" value="{{ $rekening->nama_bank }}" class="form-control" placeholder="Nama Bank">
							</div>
							<div class="form-group">
								<input type="text" name="alamat" value="{{ $rekening->alamat }}" class="form-control" placeholder="Alamat">
							</div>
							<div class="form-group">
								<input type="text" name="kode_pos" value="{{ $rekening->kode_pos }}" class="form-control" placeholder="Kode Pos">
							</div>
							<button type="button" class="btn btn-warning btn-block simpan-rek">Simpan</button>
						</div>
					</form>
				@else
					<form id="dataRekening" action="{{ url($pageUrl.'rekening') }}" method="POST" style="margin: 10px">
						<a href="javascript:void(0)" class="edit-rek" style="padding: 5px 10px; border: 1px solid black; border-radius: 5px; box-shadow: 1px #776f6f; margin-bottom: 5px; float: right">Edit</a>
							{!! csrf_field() !!}
							<input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
							<div class="form-group">
								<label for="">Rekening Bank</label>
								<input type="text" name="nama" class="form-control" placeholder="Nama">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" name="no_rekening" class="form-control" placeholder="No Rekening">
									</div>
								</div>
								<div class="col-md-6">
									<div class="d-flex">
										<a href="">
											<img src="{{ asset('new_temp/images/payments/3.png') }}" alt="">
										</a>
										<a href="">
											<img src="{{ asset('new_temp/images/payments/4.png') }}" alt="">
										</a>
									</div>
								</div>
							</div>
							<div class="form-group">
								<input type="text" name="nama_bank" class="form-control" placeholder="Nama Bank">
							</div>
							<div class="form-group">
								<input type="text" name="alamat" class="form-control" placeholder="Alamat">
							</div>
							<div class="form-group">
								<input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos">
							</div>
							<button type="button" class="btn btn-warning btn-block simpan-rek">Simpan</button>
						</div>
					</form>
				@endif
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	<script>
		$(document).on('click','.simpan-cart',function(){
			const form = 'dataKredit';
			saveFormModal(form);
		});
		$(document).on('click','.simpan-rek',function(){
			const form = 'dataRekening';
			saveFormModal(form);
		});
	</script>
@endsection