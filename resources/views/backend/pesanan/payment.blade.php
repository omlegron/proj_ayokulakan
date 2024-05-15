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
						Metode Pembayaran
					</span>
				</div><br>
				<a href="" class="btn btn-default">Profile</a>
				<a href="" class="btn btn-default">Bank & Kartu</a>
				<a href="" class="btn btn-default">Ganti Password</a>
				@if ($data->count() > 0)
					@foreach ($data as $key =>  $item)
						@if ($date <= $item->transaction_time_expiry)
							<div class="detail-pesanan" style="margin-bottom: 20px">
								<div class="icon-belanja">
									<span><i class="fa fa-shopping-bag"></i></span>
								</div>
								<div style="display: block">
									<p style="margin: 0px; line-height: 50px;font-size: 20px; font-weight: 600">Belanja | <a href="">Invoice</a></p>
									<p style="font-size: 20px; ">Total <span style="color: #db700c">Rp{{ number_format($item->total_harga,'2',',','.') }}</span></p>
									<p>Bayar sebelum {{ $item->transaction_time_expiry or '' }}</p>
									@if(isset($item->va_numbers[0]))
										<strong><h4> Bank yang Digunakan :  {{ strtoupper($item->va_numbers[0]->bank) }}</h4></strong>
										<strong><h4> No. Rekening :   <p><h3 id="p1" >{{ $item->va_numbers[0]->va_number }}</h3> 
											<a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Rek.</a></p></h4></strong>
										<hr>
										@elseif(isset($item->permata_va_number))
										<strong><h4> No. Rekening :   <p><h3 id="p1" >{{ $item->permata_va_number }}</h3> 
											<a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Rek.</a></p></h4></strong>
										<hr>
										@elseif(isset($item->biller_code))
										<strong><h4> Kode Perusahaan :  {{ $item->biller_code }}</h4></strong>
										<strong><h4> Kode Pembayaran :   <p><h3 id="p1" >{{ $item->bill_key }}</h3> 
											<a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Kode</a></p></h4></strong>
										<hr>
										@elseif(isset($item->payment_code))
										<strong><h4> Store yang Digunakan :   <p><h3 >{{ ucwords($item->store) }}</h3> 
											<hr>
										<strong><h4> Kode Pembayaran :   <p><h3 id="p1" >{{ $item->payment_code }}</h3> 
											<a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Kode</a></p></h4></strong>
										<hr>
									@endif
									<a href="{{ env('MIDTRANS_URL_PDF').'/snap/v1/transactions/'.$item->snap_token.'/pdf' }}" class="btn btn-success">Cara Pembayaran</a>
								</div>
							</div>
						@endif
					@endforeach
					{{-- @foreach ($payment as $key => $value)
					@endforeach --}}
				@endif
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
<script>
	$(document).ready(function(){
		$('input[type="number"]').niceNumber({
			autoSize:true,
			autoSizeBuffer: 1,
			buttonDecrement:'-',
			buttonIncrement:"+",
			buttonPosition:'around'

		});
	});
</script>
@endsection