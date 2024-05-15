
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
			{!! csrf_field() !!}
			
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Judul Sewa</label>
						<input type="text" name="judul" class="form-control" placeholder="Judul Sewa" required="">
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi Lengkap Sewa</label>
						<textarea name="keterangan" class="form-control" rows="2" placeholder="Deskripsi Lengkap Sewa"></textarea>
						
					</div>
					<div class="form-group">
						<label for="">Kategori Sewa</label>
						<select name="kategori_id" class="form-control child target selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-child="sub_kategori_id" data-namas='sub_kategori_id'>
							{!! \App\Models\Master\KategoriRental::options('nama', 'id', [], ('Pilih Kategori Sewa')) !!}
					</select>	
					</div>		
					<div class="form-group">
						<label for="">Sub Kategori Sewa</label>
						<select name="sub_kategori_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
						</select>	
						<div id="sub_kategori_id">
							
						</div>						
					</div>		
					
					<div class="form-group">
						<label for="">Unit</label>
						<input type="text" min="0" name="unit" class="form-control" placeholder="Masukan Dengan Input Number">
					</div>	
					<div class="form-group">
						<label for="">Harga Sewa Barang / Hari</label>
						<div class="input-group mb-3">
						  
						  <input type="text" class="form-control change-money-modals" id="basic-url" aria-describedby="basic-addon3" name="harga_sewa" placeholder="Harga Sewa Barang / Hari" required="" value="">
						</div>
					</div>
					<div class="row">
						<h4 class="text-center">Silahkan Pilih Alamat Anda</h4>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Wilayah Negara</label>
								<select name="id_negara" class="form-control child target dynamic-more-than-5-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_provinsi,id_kota,id_kecamatan">
									{!! \App\Models\Master\WilayahNegara::options('negara', 'id', [], ('Pilih Wilayah Negara')) !!}
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Wilayah Provinsi</label>
								<select class="form-control child target id_provinsi selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
								</select>
								<div id="id_provinsi"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Wilayah Kab/Kota</label>
								<select class="form-control child target id_kota selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
								</select>
								<div id="id_kota"></div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Wilayah Kecamatan</label>
								<select class="form-control child target id_kecamatan selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
								</select>
								<div id="id_kecamatan"></div>
							</div>
						</div>
					</div>
					<div class="form-group">
						@include('partials.file-tab.attachment')
					</div>	
						
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>
