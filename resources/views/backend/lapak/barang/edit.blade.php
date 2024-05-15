
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST" class="was-validated needs-validation"  novalidate>
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id or ''}}">
			<div class="row">
				<div class="col-md-12">
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Kategori Barang</label>
								<select name="id_kategori" class="form-control child target dynamic-more-than-5-select selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" data-arraynama="id_sub_kategori,id_child_kategori">
									{!! \App\Models\Master\KategoriBarang::options('kat_nama', 'id', ['selected' => $record->id_kategori], ('Pilih Kategori Barang')) !!}
							</select>					
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Sub Kategori Barang</label>
								<select name="id_sub_kategori" class="form-control child target id_sub_kategori selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									{!! \App\Models\Master\KategoriBarangSub::options('sub_nama', 'id', ['selected' => $record->id_sub_kategori,['filters' => ['id_kategori' => $record->id_kategori]]], ('Pilih Sub Kategori Barang')) !!}
								</select>	
								<div id="id_sub_kategori">
									
								</div>					
							</div>		
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Nama Child Kategori Barang</label>
								<select name="id_child_kategori" class="form-control child target id_child_kategori selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
									{!! \App\Models\Master\KategoriBarangChild::options('nama', 'id', ['selected' => $record->id_sub_kategori,['filters' => ['id_sub_kategori' => $record->id_sub_kategori]]], ('Pilih Sub Child Kategori Barang')) !!}
								</select>	
								<div id="id_child_kategori">
									
								</div>	
								
							</div>		
						</div>
					</div>
					<div class="form-group">
						<label for="">Nama Barang</label>
						<input type="text" name="nama_barang" class="form-control" placeholder="Nama Barang" required="" value="{{ $record->nama_barang or '' }}">
						
					</div>	
					<div class="form-group">
						<label for="">Deskripsi Barang</label>
						<textarea name="deskripsi_barang" class="form-control" rows="2" placeholder="Deskripsi Barang" required="">{{ $record->deskripsi_barang or '' }}</textarea>
						
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Status Halal</label>
								<select name="status_halal" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
									<option value="Dijamin Halal" {{ ($record->status_halal == 'Dijamin Halal') ? 'selected' : '' }}>Dijamin Halal</option>
									<option value="None Halal" {{ ($record->status_halal == 'None Halal') ? 'selected' : '' }}>None Halal</option>
								</select>					
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Satuan Barang</label>
								<select name="satuan_barang" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none" >
									<option>Pilih Satuan</option>
									<option {{ ($record->satuan_barang == 'Buah') ? 'selected' : '' }} value="Buah">Buah</option>
									<option {{ ($record->satuan_barang == 'Lusin') ? 'selected' : '' }} value="Lusin">Lusin</option>
									<option {{ ($record->satuan_barang == 'Box') ? 'selected' : '' }} value="Box">Box</option>
									<option {{ ($record->satuan_barang == 'Kodi') ? 'selected' : '' }} value="Kodi">Kodi</option>
									<option {{ ($record->satuan_barang == 'Gross') ? 'selected' : '' }} value="Gross">Gross</option>
									<option {{ ($record->satuan_barang == 'Rim') ? 'selected' : '' }} value="Rim">Rim</option>
									<option {{ ($record->satuan_barang == 'Drum') ? 'selected' : '' }} value="Drum">Drum</option>
									<option {{ ($record->satuan_barang == 'Krat') ? 'selected' : '' }} value="Krat">Krat</option>
									<option {{ ($record->satuan_barang == 'Slop') ? 'selected' : '' }} value="Slop">Slop</option>
									<option {{ ($record->satuan_barang == 'Pcs') ? 'selected' : '' }} value="Pcs">Pcs</option>
									<option {{ ($record->satuan_barang == 'Liter') ? 'selected' : '' }} value="Liter">Liter</option>
								</select>					
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="">Berat Barang</label>
								<div class="input-group mb-3">
								  <input type="number" name="berat_barang" class="form-control" placeholder="Berat Barang" required="" value="{{ $record->berat_barang or '' }}">
								  <div class="input-group-append">
								    <span class="input-group-text" id="basic-addon2">Gram</span>
								  </div>
								</div>					
							</div>
						</div>
					</div>
						
					<div class="row">
						<div class="col-md-6">		
							<div class="form-group">
								<label for="">Jumlah Barang</label>
								<input type="number" min="1" name="stock_barang" class="form-control" placeholder="Jumlah Barang" required=""  value="{{ $record->stock_barang or '' }}">			
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Kondisi Barang</label>
								 <div class="custom-control custom-radio">
								    <input type="radio" class="custom-control-input" id="customControlValidation2" name="kondisi_barang" required value="Baru" {{ ($record->kondisi_barang == 'Baru') ? 'checked' : '' }}>
								    <label class="custom-control-label" for="customControlValidation2">Baru</label>
								  </div>
								  <div class="custom-control custom-radio mb-3">
								    <input type="radio" class="custom-control-input" id="customControlValidation3" name="kondisi_barang" required value="Bekas" {{ ($record->kondisi_barang == 'Bekas') ? 'checked' : '' }}>
								    <label class="custom-control-label" for="customControlValidation3">Bekas</label>
								  </div>
							</div>	
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">	
							<div class="form-group">
								<label for="">Harga Jual Barang</label>
								<div class="input-group mb-3">
								  <div class="input-group-prepend">
								    <span class="input-group-text" id="basic-addon3">Rp. </span>
								  </div>
								  <input type="text" class="form-control change-money-modals key" data-id="1" id="basic-url" aria-describedby="basic-addon3" name="harga_normal" placeholder="Harga Jual Barang" required="" value="{{ $record->harga_normal or '' }}">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Merek Barang</label>
								<input type="text" name="merek" class="form-control" placeholder="Merek Barang" required="" value="{{ $record->merek or '' }}">
							</div>	
						</div>	
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="">Expired</label>
								<input type="text" name="expired" class="form-control" placeholder="Expired" required="" value="{{ $record->expired or '' }}">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="subTotal">Sub Total</label>
								<input type="text" name="harga_barang" class="form-control keys1" aria-describedby="basic-addon3" value="{{ $record->harga_barang }}" readonly>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								@include('partials.file-tab.attachment',[
										'foto' => 'Upload Foto Product (wajib)',
										'lapak' => true,
										'multi' => 'multiple'
									])
							</div>	
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-outline-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>
