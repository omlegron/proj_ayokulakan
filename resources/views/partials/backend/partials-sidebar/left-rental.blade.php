<div class="sidebar-widget  hot-deals wow fadeInUp outer-bottom-xs">
	<h3 class="section-title">Lapak Baru</h3>
	<div class="sidebar-widget-body">
		<div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme">
			<div class="item">
				<div class="products special-product">
					@if($lapakRental->count() > 0)
					@foreach($lapakRental as $k => $value)
					<div class="product">
						<div class="product-micro">
							<div class="row product-micro-row">
								<div class="col col-xs-5">
									<div class="product-image">
										<div class="image">
											@if($value->attachments->count() > 0)
											<img src="{{ url('storage/'.$value->attachments->first()->url) }}" alt="" style="">
											@else
											<img src="{{ asset('img/no-images.png') }}" alt="" style="">
											@endif
										</div>
									</div>
								</div>
								<div class="col col-xs-7">
									<div class="product-info">
										<h3 class="name"><a href="javascript:void(0)" class="sharp-show show front-load-show buttons showing" data-name="{{ slugify($value->judul) }}" data-id="{{ $value->id or '' }}">{{ $value->judul or '' }}</a></h3>
										<div class="rating rateit-small">

											@php
											$totalStar = 0;
											@endphp
											@if($value->feedback)
											@if($value->feedback()->where('form_type','=','img_rental')->count() > 0)
											@php
											$totalStar = $value->feedback()->where('form_type','=','img_rental')->sum('rate') / $value->feedback()->where('form_type','=','img_rental')->count();
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
											@for($i = 0; $i < 5; $i++)
											<span><i class="fa fa-star-o" ></i></span>
											@endfor
											@endif
											( {{ $value->feedback()->where('form_type','=','img_rental')->count() }} )
										</div>
										<div class="product-price">
											<span class="price">
												Rp. {{ number_format($value->harga_sewa, 2, ',', '.') }}
											</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					@endforeach
					@endif
					<a href="{{ url('sc/cat-rental/all-lapak') }}" class="btn btn-warning">Lihat Lainya</a>
				</div>
			</div>
		</div>
	</div>
</div>
