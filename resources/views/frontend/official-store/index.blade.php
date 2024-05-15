@extends('layouts.scaffold')
@section('css')
<style type="text/css">
	.warnas {
		background-color:#ff823e0a;
	}
	.card{
	  position:relative;
	  display:-ms-flexbox;
	  display:flex;
	  -ms-flex-direction:column;
	  flex-direction:column;
	  min-width:0;
	  word-wrap:break-word;
	  background-color:#fff;
	  background-clip:border-box;
	  border:1px solid rgba(0,0,0,.125);
	  border-radius:.25rem
	}
	.card-header{padding:.75rem 1.25rem;
	  margin-bottom:0;
	  background-color:rgba(0,0,0,.03);
	  border-bottom:1px solid rgba(0,0,0,.125)
	}
	.card-body{
	  -ms-flex:1 1 auto;
	  flex:1 1 auto;
	  padding:1.25rem;
	  height: 40rem;
	}
	.justify-content-end{
	  -ms-flex-pack:end!important;
	  justify-content:flex-end!important
	}
	.card-footer{
	  padding:.75rem 1.25rem;
	  background-color:rgba(0,0,0,.03);
	  border-top:1px solid rgba(0,0,0,.125)
	}
	.rows{
	  display:-ms-flexbox;display:flex;
	  -ms-flex-wrap:wrap;
	  flex-wrap:wrap;
	  margin-right:-15px;
	  margin-left:-15px
	}
	.img{
		background-color: #eaeaea;
		padding: 5px;
		border-radius: 30px;
	}
	.img img{
		display: block;
		width: 120px !important;
		height: 70px;
		border-radius: 20px;
		margin: 0 auto;
	}
	.product-info{
		padding: 10px;
	}
	.buat-kanan,
	.buat-kiri{
		display: none;
	}
	
</style>
@endsection
@section('content-frontend')
<div class="container">
	<div class="clearfix filters-container" style="margin-top: 20px">
		<div class="row">
			<div class="col col-sm-8 col-lg-12">
				<div class="filter-tabs">
					<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
						<li class="active">
							<a data-toggle="tab" href="#grid-container" style="font-size: 20px;"><i class="icon fa fa-th-large" style="color: #16a70cbc"></i><span style="font-weight: bold">Kategori Official Store</span></a>
						</li>
						<li style="float: right">
							<span><a href="">Produk Lainnya</a></span>
						</li>
					</ul>
				</div><!-- /.filter-tabs -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
	<div class="search-result-container" style="margin-bottom: 20px">
		<div id="myTabContent" class="tab-content category-list">
			<div class="tab-pane active " id="grid-container">
				<div class="category-product">
					<div class="row">
						@if ($record->count() > 0)
							@foreach ($record as $key => $value)
								<div class="col-md-2">
									<div class="products">
										<div class="product">
											<div class="product-image">
												<div class="image img">
													@if($value->attachMany->count() > 0)
														<img src="{{ url('storage/'.$value->attachMany->first()->url) }}" alt="">
													@else
														<img src="{{ asset('img/no-images.png') }}" alt="">
													@endif
												</div>
											</div>
											<div class="product-info text-center">
												<p>{{ $value->kat_nama or '' }}</p>
											</div>
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

	<div class="clearfix filters-container" style="margin-top: 20px">
		<div class="row">
			<div class="col col-sm-8 col-lg-12">
				<div class="filter-tabs">
					<ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
						<li class="active">
							<a data-toggle="tab" href="#grid-container" style="font-size: 20px;"><i class="icon fa fa-th-large" style="color: #16a70cbc"></i><span style="font-weight: bold">Brand Official Store</span></a>
						</li>
					</ul>
				</div><!-- /.filter-tabs -->
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div>
	<div class="search-result-container" style="margin-bottom: 20px">
		<div id="myTabContent" class="tab-content category-list">
			<div class="tab-pane active " id="grid-container">
				<div class="category-product">
					<div class="row">
						@if ($store->count() > 0)
							@foreach ($store as $key => $value)
								<div class="col-md-2">
									<div class="products">
										<div class="product">
											@php
												$slug = str_replace(' ', '-', strtolower($value->nama_lapak));
											@endphp
											<a href="{{ url($pageUrl.$slug) }}">
												<div class="product-image">
													<div class="image img">
														@if($value->attachments->count() > 0)
															<img src="{{ url('storage/'.$value->attachments->first()->url) }}" alt="">
														@else
															<img src="{{ asset('img/no-images.png') }}" alt="">
														@endif
													</div>
												</div>
												<div class="product-info text-center">

													<p>{{ $value->nama_lapak or '' }}</p>
												</div>
											</a>
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
	@include('frontend.home.partial.product-area-perikanan')
</div>
				
@endsection
