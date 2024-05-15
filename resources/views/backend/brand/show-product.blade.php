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
		<div class="search-result-container ">
			<div id="myTabContent" class="tab-content category-list">
				<div class="tab-pane active " id="grid-container">
					<div class="category-product ">
						<div class="search-ampas">
							<div class="card">
								<div class="card-title">
									<h3 class="section-title">Data Barang Brand</h3>
								</div>
								<div class="card-body">
									<div class="row ">
										@if($record->count() > 0)
											@foreach($record as $k => $v)
											<div class="col-2 col-xs-6 col-md-3 wow fadeInUp animated" style="height: 320px">
												<div class="products">
													<div class="product">
														<div class="product-image" style="height:150px;width:190px;display:table-cell;vertical-align: middle;">
															<div class="image" >
																@if($v->attachments->count() > 0)
																<img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="max-height: 150px">
																@else
																<img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
																@endif
															</div>
															@if ($v->kondisi_barang === 'baru')
																<div class="tag new"><span>new</span></div>
															@else
																<div class="tag new"><span>sec</span></div>
															@endif
														</div>
														<div class="product-info text-left">
															@if(isset($v->nama_barang))
																@if(strlen($v->nama_barang) > 35)
																	<a href="{{ url('sc/barang/'.$v->id) }}" class="name"><h5>{{ substr($v->nama_barang,0,35) }} ...</h5></a>
																@else
																	<a href="{{ url('sc/barang/'.$v->id) }}" class="name"><h5>{{ $v->nama_barang or '' }}</h5></a>
																@endif
															@else
																<a href="{{ url('sc/barang/'.$v->id) }}" class="name">{{ $v->nama_barang or '-' }}</a>
															@endif
			
															{{-- <div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->provinsi->provinsi or '-' }} - {{ $v->lapak->kota->kota or '-' }}</div> --}}
			
															<div class="product-price">
																<span class="price">
																	 Rp. {{ number_format($v->harga_barang, 2, ',', '.') }}
																</span><br>
																<span >
																	@php
																	$totalStar = 0;
																	@endphp
																	@if($v->feedback)
																	@if($v->feedback()->where('form_type','=','img_barang')->count() > 0)
																	@php
																	$totalStar = $v->feedback()->where('form_type','=','img_barang')->sum('rate') / $v->feedback()->where('form_type','=','img_barang')->count();
																	@endphp
																	@endif
																	@endif
																	@if($totalStar > 0)
																	@php
																	$cekStar = 5 - $totalStar;
																	@endphp
																	@for($i = 0; $i < $totalStar; $i++)
																	<span><i class="fa fa-star" style="color:#ff7429;"></i></span>
																	@endfor
			
																	@for($i1 = 0; $i1 < $cekStar; $i1++)
																	<span><i class="fa fa-star-o"></i></span>
																	@endfor
			
																	@else
																	<p>
																		@for($i = 0; $i < 5; $i++)
																		<span><i class="fa fa-star-o" ></i></span>
																		@endfor
																		{{ $v->barang_terjual or '0' }} Terjual</p>
																	@endif
																</span>
																{{-- <br> --}}
																<div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->provinsi->provinsi or '-' }} - {{ $v->lapak->kota->kota or '-' }}</div>
		
																{{-- <span class="price-before-discount">( {{ $v->feedback()->where('form_type','=','img_barang')->count() }} )</span> --}}
		
																@if($v->status_halal == 'Dijamin Halal')
																	<br><span class=""><i class="fa fa-check"></i>{{ $v->status_halal or '-' }}</span> 
																@endif
															</div>
			
														</div>
														<div class="cart clearfix animate-effect">
															<div class="action">
																<ul class="list-unstyled">
																	@if(Auth::check())
																		<li class="add-cart-button btn-group">
																			<a href="javascript:void(0)" class="sharp-show show custom-front-load-show buttons showing btn btn-warning icon" data-url="{{ url('favorit/'.$v->id) }}" data-id="{{ $v->id or '' }}" data-titlemodal="List Favorit Barang">
																				<i class="fa fa-heart"></i>
																			</a>
																		</li>
																	@endif
																	<li class="add-cart-button btn-group">
																		<a href="javascript:void(0)" class="sharp-show show front-load-show buttons showing btn btn-primary icon" data-name="{{ slugify($v->nama_barang) }}" data-id="{{ $v->id or '' }}">
																			<i class="fa fa-eye"></i>
																		</a>
																	</li>
																	<li class="lnk wishlist">
																		<a href="javascript:void(0)" title="Tambahi" class="ampass add-cart" data-item="{{ $v->id or '' }}" data-type="img_barang">
																			<i class="fa fa-shopping-cart"></i>
																		</a>
																	</li>
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
											@endforeach
										@else
											<center><h3>Data Barang Kosong</h3></center>
										@endif
									</div>
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
		</div>	
	</div>
</div>
@endsection
@section('scripts-js')
	
@endsection