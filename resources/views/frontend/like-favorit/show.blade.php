
<div class="modal-body">
	<div class="content-ayokulakan">
		<!-- <form id="dataFormModal" action="{{ url($pageUrl.'pembayaran') }}" method="POST"> -->
			{!! csrf_field() !!}
			<div class="">
				<h4>Favorit Barang dan Sewa</h4>
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
										@if($v->form_type == 'img_barang')
											<a href="{{ url('sc/barang/'.$v->id_barang) }}" title=""><h3 class="name">
												{{ $v->form->nama_barang or '' }}
											</h3></a>
										@elseif($v->form_type == 'img_rental')
										<a href="{{ url('sc/sewa/'.$v->id_barang) }}" title=""><h3 class="name">
											{{ $v->form->judul or '' }}
										</h3></a>
										@else
										{{ $v->form->jadwal->judul or '' }}<br>Keberangkatan : ({{ $v->form->jadwal->tgl_berangkat or '' }} - {{ $v->form->jadwal->tgl_pulang or '' }})
										@endif 
										
										<div class="rating rateit-small rateit">
											@if($v->form->user)
											<div class="form-group custom-control custom-checkbox">
												{{-- <i class="fa fa-star"></i> --}}
												<label class="custom-control-label" for="customCheck{{$k}}">
													@if($v->form_type == 'img_barang')
													{{ $v->form->lapak->nama_lapak or '' }}
													@elseif($v->form_type == 'img_rental')
													{{ $v->form->user->nama or '' }}
													@else
													Paket : {{ $v->form->paket->type_paket or '' }}
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
											<span class="price">
												<div class="price "><b>Type : </b>  
													@if($v->form_type == 'img_barang')
													Barang
													@elseif($v->form_type == 'img_rental')
													Barang Sewa
													@else
													Jadwal Sewa
													@endif 
												</div>
											</span>
											<span class="price">
												<div class="price "><b>Tersedia : </b>  
													@if($v->form_type == 'img_barang')
													{{ $v->form->stock_barang or '0' }} Stock
													@elseif($v->form_type == 'img_rental')
													{{ $v->form->unit or '0' }} Stock
													@else
													{{-- {{ $v->form->jadwal->harga or '' }} --}}
													@endif 
												</div>
											</span>
											<span class="price">
												<div class="price ">
													@if($v->form_type == 'img_barang')
													<b>Terjual : </b> {{ $v->form->barang_terjual or '0' }} Stock
													@elseif($v->form_type == 'img_rental')
													<b>Tersewa : </b>{{ $v->form->unit_tersewa or '0' }} Stock
													@else
													{{-- {{ $v->form->jadwal->harga or '' }} --}}
													@endif 
												</div>
											</span>
											<span class="price">
												<div class="price ">
													@if($v->form_type == 'img_barang')
													<b>Kondisi : </b> {{ $v->form->kondisi_barang or '-' }}
													@elseif($v->form_type == 'img_rental')
													<b>Kategori : </b>{{ $v->form->kategori->nama or '-' }}
													@else
													{{-- {{ $v->form->jadwal->harga or '' }} --}}
													@endif 
												</div>
											</span>
											<span class="price">
												<div class="price appendTotalHarga{{$v->id}}"><b>Harga : </b> Rp. 
													@if($v->form_type == 'img_barang')
													{{ number_format($v->form->harga_barang,2,',','.') }}
													@elseif($v->form_type == 'img_rental')
													{{ number_format($v->form->harga_sewa,2,',','.') }}
													@else
													{{ $v->form->jadwal->harga or '' }}
													@endif 
												</div>
											</span>

											<span class="price">
												<div class="price "><hr><b>Deskripsi : </b> <br>
													@if($v->form_type == 'img_barang')
													{{ $v->form->deskripsi_barang or '0' }} 
													@elseif($v->form_type == 'img_rental')
													{{ $v->form->keterangan or '0' }} 
													
													@endif 
													<hr>
												</div>
											</span>
											

																	
										<div class="description m-t-10 pull-right">
											<div class="col-md-12">
												<div class="btn btn-danger btn-sm btn-remove-keranjang ampass remove-cart" data-id="{{$v->id}}" data-url="{{ url('favorit/hapus') }}" ><i class="fa fa-trash"></i></div>
																								
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
			<!-- </form> -->
	</div>
	<div class="modal-footer">
	
	</div>
</div>
