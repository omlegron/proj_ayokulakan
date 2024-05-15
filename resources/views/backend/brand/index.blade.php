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
						My Profile
					</span>
				</div><br>
				<a href="" class="btn btn-default">Profile</a>
				<a href="" class="btn btn-default">Bank & Kartu</a>
				<a href="" class="btn btn-default">Ganti Password</a>
				<h5 style="font-weight: 600">Jaga informasi profil Anda untuk mengontrol melindungi dan menggunakan akun</h5>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection