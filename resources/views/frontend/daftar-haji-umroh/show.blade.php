<div class="row">
	<div class="col-md-12 terms-conditions">
		<div class="col-md-12">
			<h3>{{ $data->judul or '' }}</h3>
			<ul>
				<li>Paket : {{ $data->type_paket }}</li>
				<li>Tanggal Keberangkatan : {{ $data->tgl_berangkat }}</li>
				<li>Tanggal Kepulangan : {{ $data->tgl_pulang }}</li>
				<li>Total Hari : {{ $data->total_hari }}</li>
				<li>Harga : {{ $data->harga }} /USD</li>
			</ul>
			<hr>
			<p>
				{!! $data->keterangan !!}
			</p>
		</div>
	</div>			
</div><!-- /.row -->