@if($record->count() > 0)
	<div style="padding: 0px 10px; border-bottom: 1px solid #eaeaea">
		<p style="font-size: 20px; font-weight: 600; float: left; margin-right: 5px;">Keranjang Barang ({{ $record->count() }})</p>
		<p style="line-height: 30px;"><a style="text-decoration: none; color: #ce1212;" href="{{ url('keranjang') }}">Lihat</a></p>
	</div>
	<div class="clearfix"></div>
	@foreach($record as $k => $v)
	<div class="row no-guther" style="margin-top: 5px; border-bottom: 1px solid #eaeaea">
		<a href="{{ url('keranjang') }}">
				<div class="col-md-2">
					@if($v->form)
						@if($v->form->attachments->first())
							@if(isset($v->form->attachments->first()->url))
								<img src="{{ ($v->form->attachments->first()) ? url('storage/'.$v->form->attachments->first()->url) : url('img/no-images.png') }}" alt="" style="width: 50px">
							@else
								<img src="{{ url('img/no-images.png') }}" alt="" style="width: 50px">
							@endif
						@else
							<img src="{{ url('img/no-images.png') }}" alt="" style="width: 50px">	
						@endif
					@else
						<img src="{{ url('img/no-images.png') }}" alt="" style="width: 50px">
					@endif
				</div>
				<div class="col-md-5">
					@if($v->form_type == 'img_barang')
						<p style="line-height: 50px">{{ str_limit($v->form->nama_barang,10) }}</p>
					@endif 
				</div>
				@php
					$jumlah = $v->form->harga_barang * $v->jumlah_barang;
				@endphp
				<div class="col-md-2">
					<p style="line-height: 50px; color: #ce1212;">Rp{{ number_format($jumlah,'2','.',',') }}</p>
				</div>
			</a>
		</div>
	@endforeach
@endif