
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'pembayaran') }}" method="POST">
			{!! csrf_field() !!}
			<div class="">
				<h4>Keranjang Sewa</h4>
				<div class="category-product">
				@if($record->count() > 0)
				@foreach($record as $k => $v)	
				<div class="category-product-inner " style="">
					<div class="products">				
			            <div class="product-list product">
			            	<div class="row product-list-row">
								<div class="col col-sm-4 col-lg-4">
									<div class="product-image">
										<div class="image">
											<center><img src="{{ ($v->form->attachments->first()) ? url('storage/'.$v->form->attachments->first()->url) : url('img/no-images.png') }}" alt="" style="width: 230px"></center>
										</div>
									</div><!-- /.product-image -->
								</div><!-- /.col -->
								<div class="col col-sm-8 col-lg-8">
									<div class="product-info">
										<h3 class="name">
											@if($v->form_type == 'img_rental')
											{{ $v->form->judul or '' }}
											@endif 
										</h3>
										@php
											$jumlah = $v->form->harga_sewa * $v->jumlah_barang;
										@endphp
										<div class="rating rateit-small rateit">
											@if($v->form->user)
											<div class="form-group custom-control custom-checkbox">
												{{-- <input type="checkbox" class="custom-control-input appendTotalHarga{{$v->id}}" id="customCheck{{$k}}" name="accept[barang][{{$v->id}}]" value="{{ $v->id }}" data-url="{{ $jumlah }}"> --}}
												<label class="custom-control-label" for="customCheck{{$k}}">
													@if($v->form_type == 'img_rental')
													{{ $v->form->user->lapak->nama_lapak or '' }}
													@endif
												</label>
											</div>
											@else
												<div class="form-group custom-control custom-checkbox">
													<label class="custom-control-label" for="customCheck{{$k}}">
														Lapak Tidak Tersedia
													</label>
												</div>
											@endif
										</div>

										<span >
											<div> 
												@if($v->form_type == 'img_rental')
												<span id="tersedia"><b>Tersedia : </b>  {{ $v->form->unit or '0' }} Stock</span>
												@endif 
											</div>
										</span>
										<span >
											<div> 
												@if($v->form_type == 'img_rental')
												<span id="terjual"><b>Tersewa : </b>  {{ $v->form->unit_tersewa or '0' }} Stock</span>
												@endif 
											</div>
										</span>
										<span >
											<div> 
												@if($v->form_type == 'img_rental')
												<span id="kategori"><b>Kategori : </b>  {{ $v->form->kategori->nama }} </span>
												@endif 
											</div>
										</span>
										<span >
											<div> 
												@if($v->form_type == 'img_rental')
												<span id="lokasi"><b>Lokasi : </b>  {{ $v->form->kota->kota or '-' }} </span>
												@endif 
											</div>
										</span>
										
											
											<span class="price">
												<div class="price appendTotalHarga{{$v->id}}">
													@if($v->form_type == 'img_rental')
													<span id="jumlah"><b>Harga : </b> Rp. {{ number_format($v->form->harga_sewa,2,',','.') }}</span>
													@endif 
												</div>
											</span>			



											<div class="rating-reviews m-t-20">
												<div class="row">
													<div class="col-sm-3">
														<div class="rating">
															@php
																$totalStar = 0;
															@endphp
															@if($v->form->feedback)
																@if($v->form->feedback()->where('form_type','=','img_rental')->count() > 0)
																@php
																	$totalStar = $v->form->feedback()->where('form_type','=','img_rental')->sum('rate') / $v->form->feedback()->where('form_type','=','img_rental')->count();
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
																	<span><i class="fa fa-star-o"></i></span>
																@endfor
															@endif
														</div>
													</div>
													<div class="col-sm-8">
														<div class="reviews">
															<span class="lnk pull-left">({{$totalStar}} Reviews)</span>
														</div>
													</div>
												</div>
											</div>



											<span >
												<div> 
													@if($v->form_type == 'img_rental')
													<span id="deskripsi"><hr><b>Deskripsi : </b> <br> {{ $v->form->keterangan }} <hr></span>
													@endif 
												</div>
											</span>
											



										<div class="description m-t-10">
											<div class="col-md-1" style="text-align: right">
												<input type="checkbox" style="margin-top: 10px" class="custom-control-input appendTotalHarga{{$v->id}}" id="customCheck{{$k}}" name="accept[barang][{{$v->id}}]" value="{{ $v->id }}" data-url="{{ $jumlah }}">

											</div>
											<div class="col-md-7">
												@php
													$harga = number_format($v->form->harga_sewa,2,',','.');
												@endphp
												<input type="number" name="accept[jumlah_barang][{{$v->id}}]" value="{{ $v->jumlah_barang or '' }}" class="form-control front-ampass-jml" data-harga="@if($v->form_type == 'img_rental')
														{{ $harga or '' }}
														@endif 
														" data-key="{{$v->id}}" min="0" >
											</div>
											<div class="col-md-4">
												<div class="btn btn-danger btn-sm btn-remove-keranjang ampass remove-cart" data-id="{{$v->id}}" data-url="{{ url('keranjang/hapus') }}" ><i class="fa fa-trash"></i></div>
																								
											</div>
										</div>
						               		
									</div><!-- /.product-info -->	
								</div><!-- /.col -->
							</div>
			            </div>
			        </div>
			    </div><hr>
			    @endforeach
			    @endif
				</div>
			</div>
			</form>
	</div>
	<div class="modal-footer">
		<div class="col-md-6 pull-left" style="text-align: left;">
			<h4>Total Belanja :  <span class="sub-total">Rp. 0</span></h4>
		</div>
		<div class="col-md-6" style="position: relative;top: 15px;">
			@if($record->count() > 0)
			<button type="button" class="btn btn-success save-modal save-frontend next-page pull-right"><i class="ion-ios-paper"></i> Lanjutkan Pembayaran Untuk Sewa</button>
			@endif
		</div>
	</div>
</div>
