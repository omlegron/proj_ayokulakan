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
	.load{
		position: absolute;
		top: 60%; left: 50%; 
	}
	.d-none{
		display: none;
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
				<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
					<span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
						Semua Pesanan
					</span>
				</div><br>
				<a href="{{ url($pageUrl.'pesanan/all') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Semua</a>
				<a href="{{ url($pageUrl.'pesanan/pending') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Pesanan Belum dibayar</a>
				<a href="{{ url($pageUrl.'pesanan/packing') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Pesanan dikemas</a>
				<a href="{{ url($pageUrl.'pesanan/set-tracking') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Atur Pengiriman</a>
				<a href="{{ url($pageUrl.'pesanan/tracking') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Pesanan dalam pengiriman</a>
				<a href="{{ url($pageUrl.'pesanan/success') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Pesanan diterima</a>
				<a href="{{ url($pageUrl.'pesanan/cancel') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Pesanan dibatalkan</a>
				<a href="{{ url($pageUrl.'pesanan/pengembalian-barang') }}" class="btn btn-default btn-sm" style="margin-top: 2px">Pengembalian barang / dana</a>
				<form action="" class="form-inline" style="margin: 20px 0px">
					<div class="form-group">
						<input type="text" name="cari" class="form-control" id="exampleInputAmount" placeholder="Cari">
					</div>
					<button type="button" class="btn btn-warning btn-cari">Cari</button>
					<button type="button" class="btn btn-warning btn-reset">Reset</button>
				</form>
				<div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
					<div class="table-responsive">
						<table class="table ayokulakan table-bordered table-hover table-content" style="position: relative">
							<thead>
								<th>No</th>
								<th>Nama Pembeli</th>
								<th>Order Id</th>
								<th>Status Order</th>
								<th>Total</th>
								<th>Tanggal Order</th>
								<th>Aksi</th>
							</thead>
							<tbody id="body">
								<?php $no = 1; ?>
								@foreach ($record as $item)
									<tr>
										<td>{{ $no }}</td>
										<td>{{ $item->user->nama or '' }}</td>
										<td>{{ $item->trans_transaksi->order_id or '' }}</td>
										<td><span class="badge badge-pill badge-warning">{{ $item->trans_transaksi->status }}</span></td>
										<td>Rp {{ number_format($item->total_harga,2,',','.') }}</td>
										<td>{{ $item->created_at }}</td>
										<td><a href="{{ url("history-trans/$item->trans_transaksi_id/detail") }}" data-toggle="tooltip" data-placement="" data-id="{{ $item->trans_transaksi->id }}" class="ui mini btn btn-sm btn-success button"><i class="fa fa-eye"></i></a></td>
									</tr>
									<?php $no++ ?>
								@endforeach
							</tbody>
							<div class="load d-none">
								<center>
									<img src="{{ url('img/loading.gif') }}" alt="">
								</center>
							</div>
						</table>
						<div class="row " style="margin-top: 35px;">
							<div class="pull-right">
							   {!! $record->links('partials.pagination.frontend-pagination') !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
<script>
	$(document).on('click','.btn-cari',function(){
		$('.load').removeClass('d-none');
		$('#body').css("opacity", "0");
		const value = $('input[name="cari"]').val();
		$.ajax({
			type: "GET",
			url: "{{ url('pesanan/search-histori') }}",
			data: {
				_token: "{{ csrf_token() }}",
				value: value
			},
			success:function(res){
				$('#body').css("opacity", "1");
				$('#body').html(res);
				$('.load').addClass('d-none');
			}
		});

	});
	$(document).on('click','.btn-reset',function(){
		$('input[name="cari"]').val('');
		$('input[name="cari"]').focus();
		const value = $('input[name="cari"]').val();
		$.ajax({
			type: "GET",
			url: "{{ url('pesanan/search-histori') }}",
			data: {
				_token: "{{ csrf_token() }}",
				value: value
			},
			success:function(res){
				$('#body').html(res);
			}
		});
	});
</script>
@endsection
