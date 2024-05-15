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
		width: 50px; height: 50px;
		float: left;
		margin-right: 20px;
		border-radius: 20px;
		box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
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
    .col-md-4{
        margin-bottom: 20px;
        padding: 1px;
    }
    .prof-body{
        border: 1px solid #a56028;
        padding: 10px;
        border-radius: 10px;
    }
    .prof-body p{
        font-weight: 600;
    }
    .prof-title{
        font-size: 18px;
    }
    .prof-text{
        font-size: 30px;
	}
	tr > td , 
    tr > th{
        border: none !important;
    }
</style>
<div class="row">
	@include('backend.lapak.partials.partials')
	<div class="col-md-9">
		<div class="scroll-tabs fadeinUp wow">
			<div class="more-info-tab clearfix" id="content">
                <p>Aktivitas Yang perlu anda pantau untuk jaga kepuasan pembeli</p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Pesan Baru</p>
                            <p class="prof-text">{{ $pending->count() }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Siap Kirim</p>
                            <p class="prof-text">{{ $packing->count() }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Pesanan Dikomplain</p>
                            <p class="prof-text">0</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Chat Baru</p>
                            <p class="prof-text">{{ $chat }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Diskusi Baru</p>
                            <p class="prof-text">{{ $diskusi }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Ulasan Baru</p>
                            <p class="prof-text">0</p>
                        </div>
                    </div>
                </div>
                <p>Analisis Lapak dan Produk Anda</p>
                <p>Update Terakhir : </p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Pendapatan bersih</p>
                            <p class="prof-text">Rp {{ ($pendapatan ? number_format($pendapatan,2,',','.') : '0') }}</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Produk dilihat</p>
                            <p class="prof-text">0</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Produk Terjual</p>
                            <p class="prof-text">{{ $terjual->count() }}</p>
                        </div>
                    </div>
                </div>
                <p>Produk Terlaris dilapakmu</p>
                <p>Update Terakhir : </p>
                <div class="row">
                    <div class="col-md-4">
                        <div class="prof-body">
                            <p class="prof-title">Produk Terlaris</p>
                            <p class="prof-text">Rp 0</p>
                        </div>
                    </div>
                </div>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection