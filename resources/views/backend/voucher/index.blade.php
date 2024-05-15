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
    .picture-voucher{
        display: block;
        padding: 10px;

    }
    .picture-voucher img{
        width: 200px;
        height: 150px;
        text-align: center;
    }
    .ft0{font: bold 40px 'Arial';color: #ffc000;line-height: 37px;}
    .ft1{font: bold 40px 'Arial';color: #00b050;line-height: 37px;}
    .vouc-body{
        border: 1px solid #a39b9b;
        padding: 10px;
        border-radius: 10px;
    }
    .vouc-body p{
        font-weight: bold;
    }
</style>
<div class="row">
	<div class="col-md-4">
		@include('partials.backend.partials-sidebar.left-profile')
	</div>
	<div class="col-md-8">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
				<div class="row">
                    <div class="col-md-6">
                        <h1 class="ft0">Voucher</h1>
                        <h1 class="ft1" style="margin-top: 0px;">Belanja</h1>
                        <p>Tambahkan Diskon Dari Toko Favoritmu</p>
                        <button class="btn btn-primary">Hanya Di Ayokulakan</button>
                    </div>
                    <div class="col-md-6">
                        <div class="picture-voucher">
                            <img src="{{ asset('img/logo/favicon-16x16.png') }}" alt="" width="250">
                            <p class="class="p0 ft1"">
                                <span class="ft0">Ayo</span><span class="ft1">kulakan</span>
                            </p>
                        </div>
                    </div>
                </div>
			</div>
        </div>
        <div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
                <center><p style="font-weight: bold; font-size: 25px">Voucher Toko</p></center>
				<div class="row">
                    @if ($record->count() > 0)
                        @foreach ($record as $item)
                            <div class="col-md-4">
                                <div class="vouc-body">
                                    <p>{{ $item->desc_voucher or ''}}</p>
                                    <div class="vouc-desc">
                                        <p>
                                            Rp {{ number_format($item->nominal_voucher,0,',','.')}}
                                        </p>
                                        <p>Seluruh Toko Berlaku</p>
                                        <p>{{ $record->expire_date or '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection