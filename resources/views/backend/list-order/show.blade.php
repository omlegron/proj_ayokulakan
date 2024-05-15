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
<div class="content-ayokulakan">
	<div class="terms-conditions">
		<div class="row">
			<div class="col-md-12">
				<h2 class="heading-title">Barang Pesanan</h2>
				<form id="dataFormModal" action="{{ url('list-order/proses-barang/'.$record->id) }}" method="POST">
					{!! csrf_field() !!}
					@php
					$total = 0;
					$totalBarang = 0;
					@endphp
					<div class="container">
						<div class="checkout-box ">
							<div class="row">
								<div class="col-md-8" style="max-height: 700px;overflow-x: visible;overflow-y: scroll;">
									<div class="panel-group checkout-steps" id="accordion">
										@if($record)
										@if($record->detail)
										@if($record->detail->count() > 0)
										@foreach($record->detail as $k => $value)
										@if($value->form_type == 'img_rental')
										<div class="panel panel-default checkout-step-01">
											<div class="panel-heading">
												<h4 class="unicase-checkout-title">
													<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne{{ $k+1 }}">
														<span>{{ $k+1 }}</span> {{ $value->form->judul or '' }}
													</a>
												</h4>
											</div>
											
											<div id="collapseOne{{ $k+1 }}" class="panel-collapse collapse in" >
												<div class="panel-body">
													<div class="row">			
														<div class="col-md-12 col-sm-6 guest-login">
															<h4 class="checkout-subtitle">Detail Pesanan</h4>
															<ul style="list-style-type: square;">
																<li><a>Nama Barang Sewaan : {{ $value->form->judul or '' }}</a></li>										  	
																<li><a>Jumlah Barang Sewaan : {{ $value->jumlah_barang or '' }}</a></li>
																<li><a>Harga / Sewa : {{ $value->form->harga_sewa or '' }}</a></li>
															</ul>
														</div>
													</div>			
												</div>
											</div>
										</div>
										@else
										@php
										$totalBarang += $value->total_harga;
										@endphp
										<div class="panel panel-default checkout-step-01">
											<div class="panel-heading">
												<h4 class="unicase-checkout-title">
													<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne{{$k+1}}">
														<span>{{ $k+1 }}</span> {{ ($value->barang) ? $value->barang->nama_barang : '' }}
													</a>
												</h4>
											</div>
											
											<div id="collapseOne{{$k+1}}" class="panel-collapse collapse in" >
												<div class="panel-body">
													<div class="row">			
														<div class="col-md-12 col-sm-6 guest-login">
															<h4 class="checkout-subtitle">Detail Barang</h4>
															<img src="{{ ($value->barang->attacOne) ? imgExist(asset('storage/'.$value->barang->attacOne->url)) : asset('img/no-images.png') }}" style="max-width: 690px;max-height: 400px;">
															<ul>
																<li>- Nama Barang : {{ $value->barang->nama_barang }}</li>
																<li>- Jumlah Pesanan : {{ $value->jumlah_barang }}</li>
																<li>- Total Harga : {{ moneyFormat($value->total_harga) }}</li>
															</ul>
															<div class="payment-method">
																<div class="panel-heading">
																	<h4 class="unicase-checkout-title">Data Jalur Pengiriman</h4>
																</div>
																<div class="">
																	@php
																	$kurirCheck = $record->kurir->where('lapak_id',$value->barang->id_trans_lapak)->first();
																	$total = $totalBarang + $kurirCheck->kurir_child_harga;
																	@endphp
																	<ul class="nav nav-checkout-progress list-unstyled">
																		<li><a>Kurir : {{ ($kurirCheck) ? $kurirCheck->kurir_child_tipe : '' }}</a></li>
																		<li><a>Harga Kurir : {{ ($kurirCheck) ? moneyFormat($kurirCheck->kurir_child_harga) : '' }}</a></li>
																	</ul>    
																</div>
															</div>
														</div>
													</div>			
												</div>
											</div>
										</div>
										@endif
										@endforeach
										@endif
										@elseif($record->prepaid)
										<div class="panel panel-default checkout-step-01">
											<div class="panel-heading">
												<h4 class="unicase-checkout-title">
													<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
														<span>1</span> {{ $record->prepaid->type }} (TIPE PREPAID)
													</a>
												</h4>
											</div>
											
											<div id="collapseOne" class="panel-collapse collapse in" >
												<div class="panel-body">
													<div class="row">			
														<div class="col-md-12 col-sm-6 guest-login">
															<h4 class="checkout-subtitle">Detail Pesanan</h4>
															<ul style="list-style-type: square;">
																<li><a>Tipe Pesanan : {{ $record->prepaid->type or '' }}</a></li>
																<li><a>Jumlah Pesanan : {{ $record->prepaid->form->pulsa_nominal or '' }}</a></li>
																<li><a>No Pelanggan : {{ $record->prepaid->pelanggan or '' }}</a></li>										  	
																<li><a>Harga : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->prepaid->ttl_harga or '' }}</span></a></li>
																<li><a>Biaya Admin : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->prepaid->biaya_admin or '-' }}</span></a></li>
															</ul>
														</div>
													</div>			
												</div>
											</div>
										</div>
										@elseif($record->postpaid)
										<div class="panel panel-default checkout-step-01">
											<div class="panel-heading">
												<h4 class="unicase-checkout-title">
													<a data-toggle="collapse" class="" data-parent="#accordion" href="#collapseOne">
														<span>1</span> {{ $record->postpaid->type }} (TIPE POSTPAID)
													</a>
												</h4>
											</div>
											
											<div id="collapseOne" class="panel-collapse collapse in" >
												<div class="panel-body">
													<div class="row">			
														<div class="col-md-12 col-sm-6 guest-login">
															<h4 class="checkout-subtitle">Detail Pesanan</h4>
															<ul style="list-style-type: square;">
																<li><a>No Pelanggan : {{ $record->postpaid->pelanggan or '' }}</a></li>										  	
																<li><a>Pelanggan : {{ $record->postpaid->tr_name or '' }}</a></li>	

																<li><a>Tipe Pesanan : {{ $record->postpaid->type or '' }} ({{ $record->postpaid->server or '' }}) </a></li>
																@if($record->postpaid->form)
																<li><a>Pesanan : {{ $record->postpaid->form->province or '' }} ({{ $record->postpaid->form->name or '' }})</a></li>
																@endif
																@if(isset($record->postpaid->period) && !is_null($record->postpaid->period))
																<li><a>Periode : {{ \Carbon\Carbon::parse($record->postpaid->period)->format('Y-m') }}</a></li>	
																@endif
																<li><a>Harga : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->postpaid->ttl_harga or '' }}</span></a></li>
																<li><a>Biaya Admin : <span class="badge badge-secondary" style="font-size: 12px">{{ $record->postpaid->biaya_admin or '-' }}</span></a></li>
															</ul>
														</div>
													</div>			
												</div>
											</div>
										</div>
										@endif
										@endif
									</div>
								</div>
								<div class="col-md-4">
									<div class="checkout-progress-sidebar ">
										<div class="panel-group">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="unicase-checkout-title">Data Pembeli</h4>
												</div>
												<div class="">
													<ul class="nav nav-checkout-progress list-unstyled">
														<li><a>Nama : {{ $record->user->nama }}</a></li>
														<li><a>Negara : {{ ($record->user->negara) ? $record->user->negara->negara : '' }}</a></li>
														<li><a>Provinsi : {{ ($record->user->provinsi) ? $record->user->provinsi->provinsi : '' }}</a></li>
														<li><a>Kabupaten : {{ ($record->user->kota) ? $record->user->kota->kota : '' }}</a></li>
														<li><a>Kecamatan : {{ ($record->user->kecamatan) ? $record->user->kecamatan->kecamatan : '' }}</a></li>
														<li><a>Alamat : {{ $record->user->alamat }}</a></li>
														<li><a>Kode POS : {{ $record->user->kode_pos }}</a></li>
														<li><a>Email : {{ $record->user->email }}</a></li>
														<li><a>No : {{ $record->user->hp }}</a></li>
													</ul>    
												</div><br>
												@if($record->kurir)
												<div class="payment-method">
													<div class="panel-heading">
														<h4 class="unicase-checkout-title">Data Jalur Pengiriman</h4>
													</div>
													<div class="">
														
														<ul class="nav nav-checkout-progress list-unstyled">
															<li><a>Kurir : {{ ($kurirCheck) ? $kurirCheck->kurir_child_tipe : '' }}</a></li>
															<li><a>Harga Kurir : {{ ($kurirCheck) ? moneyFormat($kurirCheck->kurir_child_harga) : '' }}</a></li>
														</ul>    
													</div>
												</div><br>
												@endif
												<div class="payment-method">
													<div class="payment-accordion">
														<div class="order-button-payment">
															<div class="btn btn-primary btn-lg btn-block checkout-btn">TOTAL HARGA : <b class="totalHarga">{{ moneyFormat($record->total_harga) }}</b></div>
														</div>
													</div>
												</div><br>
												<div class="payment-method">
													<div class="payment-accordion">
														<div class="order-button-payment">
															@if($record->detail->count() > 0)
															<button type="button" class="btn save-modal save-ayokulakan btn-lg btn-block btn-success" >Proses Barang</button>
															@endif
														</div>
													</div>
												</div>
											</div>
										</div>

									</div> 

								</div> 

							</div>
						</div>

					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection

@section('init-modal')
<script>
	initModal = function(){
		
		$('.date').calendar({
			type: 'date',
			text: {
				months: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
			},
		});
		$('.year').calendar({
			type: 'year',
		});
		$('.month').calendar({
			type: 'month',
			disableMonth: false, 
		});
		$('.summernote').summernote({
			height: 50,
		});
	};
</script>
@endsection
