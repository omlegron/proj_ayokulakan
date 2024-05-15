<script type="text/javascript">
		$(document).ready(function(){
			$(document).on('select','change',function(){
				console.log('as')
			});
		});
		$(document).on('input[name="judul"]','click',function(){
				console.log('asas')
			});
	</script>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-12">
						<div class="form-group">
							<label for="">Wilayah Negara</label>
							<select name="id_negara" class="form-control child-new target-new dynamic-more-than-5-select custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan">
								{!! \App\Models\Master\WilayahNegara::options('negara', 'id', ['selected' => $record->id_negara], ('Pilih Wilayah Negara')) !!}
							</select>
						</div>
						<div class="form-group">
							<label for="">Wilayah Provinsi</label>
							<select class="form-control child-new target-new dynamic-more-than-5-select id_provinsi custom-select" required="" data-dropup-auto="false" data-size="10" data-arraynama="id_kota,id_kecamatan" data-style="none" name="id_provinsi">
								{!! \App\Models\Master\WilayahProvinsi::options('provinsi', 'id', ['selected' => $record->id_provinsi,'filters' => ['id_negara' => $record->id_negara]], ('Pilih Wilayah Provinsi')) !!}
							</select>
							<div id="id_provinsi">

							</div>
						</div>
						<div class="form-group">
							<label for="">Wilayah Kab/Kota</label>
							<select class="form-control child-new target-new dynamic-more-than-5-select id_kota custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kota" data-arraynama="id_kecamatan">
								{!! \App\Models\Master\WilayahKota::options('kota', 'id', ['selected' => $record->id_kota,'filters' => ['id_provinsi' => $record->id_provinsi]], ('Pilih Wilayah Kab/Kota')) !!}
							</select>
							<div id="id_kota">

							</div>
						</div>
						<div class="form-group">
							<label for="">Wilayah Kecamatan</label>
							<select class="form-control child-new target-new id_kecamatan custom-select" required="" data-dropup-auto="false" data-size="10" data-style="none" name="id_kecamatan">
								{!! \App\Models\Master\WilayahKecamatan::options('kecamatan', 'id', ['selected' => $record->id_kecamatan,'filters' => ['id_kota' => $record->id_kota]], ('Pilih Wilayah Kecamatan')) !!}
							</select>
							<div id="id_kecamatan">

							</div>
						</div>
						<div class="form-group">
							<label for="">Kode Pos</label>
							<input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" required="" value="{{ $record->kode_pos or '' }}">

						</div>	
						<div class="form-group">
							<label for="">Alamat</label>
							<textarea class="form-control" name="alamat" rows="1">{{ $record->alamat or '' }}</textarea>
						</div>
						<div class="form-group">
							<label for="">Status Alamat</label>
							<select class="form-control" required="" data-dropup-auto="false" data-size="10" data-style="none" name="status">
								<option value="Alamat Utama" {{ ($record->status == 'Alamat Utama') ? 'selected' : '' }}>Alamat Utama</option>
								<option value="Batalkan Alamat" {{ ($record->status == 'Batalkan Alamat') ? 'selected' : '' }}>Batalkan Alamat</option>
							</select>
						</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i classź"ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-outline-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>
@section('modalss')
	<script type="text/javascript">
		$("#formModals").modal(function(){
					$(document).on('input[name="judul"]','click',function(){
				console.log('asas')
			});
		})
		initModal = function(){
			console.log('asdasdas')
		}
		$(document).on('input[name="judul"]','click',function(){
				console.log('asas')
			});
	</script>
@endsection