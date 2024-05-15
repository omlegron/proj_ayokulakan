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
	.send-kode{
		position: relative;
	}
	.load{
		position: absolute;
		top: 3; left: 50%;
	}
	.d-none{
		display: none;
	}
	.form-password{
		position: relative;
	}
	.check-pass{
		position: absolute;
		top: 15%; right: 5%;
		font-size: 18px;
		z-index: 45;
	}
	.check-pass i{
		cursor: pointer;
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
						Ganti Password
					</span>
				</div><br>
				<a href="{{ url('myprofile') }}" class="btn btn-default">Profile</a>
				<a href="{{ url('profile-bank') }}" class="btn btn-default">Bank & Kartu</a>
				<a href="{{ url('ganti-pass') }}" class="btn btn-default">Ganti Password</a>
				<form id="dataReset" class="form-horizontal" action="{{ url('ganti-pass/reset') }}" method="POST" enctype="multipart/form-data">
					{!! csrf_field() !!}
					<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
						<label for="">Untuk Keamanan akun anda mohon untuk tidak menyebarkan password anda ke orang lain</label>
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Password baru:</label>
							<div class="col-sm-8 form-password">
								<input type="password" class="form-control" id="form-password" name="password">
								<div class="check-pass password">
									<i class="fa fa-eye"></i>
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Konfirmasi Password:</label>
							<div class="col-sm-8 form-password">
								<input type="password" class="form-control" id="form-password2" name="password_confirmation">
								<div class="check-pass confirmation">
									<i class="fa fa-eye"></i>
                                </div>
							</div>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-3" for="email">Kode Verifikasi:</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" id="kode-verif" name="kode_verivikasi">
							</div>
							<div class="col-sm-4">
								<button type="button" class="btn btn-secondary btn-block send-kode">
									<span class="send-title">
										Kirim Kode Verifikasi
									</span>
									<span class="load d-none">
										<center>
											<img src="{{ url('img/loading.gif') }}" alt="">
										</center>
									</span>
								</button>
							</div>
						</div>
						<div class="form-group">        
							<div class="col-sm-offset-3 col-sm-9">
							  <button type="button" class="btn btn-warning reset">Simpan</button>
							</div>
						  </div>
					</div>
				</form>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
 <script>
	$(document).on('click','.send-kode',function(){
		$(this).addClass('disabled');
		$('.load').removeClass('d-none');
		$.ajax({
			url: "{{ url('ganti-pass/verivication') }}",
			type: 'POST',
			data:{
				_token: "{{ csrf_token() }}",
			},
			success: function(res){
				swal(
					'success',
					'Kode Verivition berhasil dikirim silahkan cek email anda',
					'success'
					).then((result) => {
						$('.load').addClass('d-none');
				});
				
			}
		});
		
	});
	$(document).on('click','.password',function(){
		var pass = document.getElementById("form-password");
		if(pass.type === "password"){
			pass.type = "text";
		}else{
			pass.type = "password";
		}
		$('i', this).toggleClass('fa-eye fa-eye-slash');
	});
	$(document).on('click','.confirmation',function(){
		var pass = document.getElementById("form-password2");
		if(pass.type === "password"){
			pass.type = "text";
		}else{
			pass.type = "password";
		}
		$('i', this).toggleClass('fa-eye fa-eye-slash');
	});
	$(document).on('click','.reset',function(){
		const form = 'dataReset';
		saveFormModal(form);
	});
 </script>
@endsection