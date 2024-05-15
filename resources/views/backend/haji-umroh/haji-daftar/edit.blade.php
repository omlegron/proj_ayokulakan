<script>
	$('.dropify').dropify();
</script>
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id }}">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Pemesan</label>
						{{-- <select name="user_id" class="form-control watcher ui fluid search transparent dropdown">
							{!! \App\Models\User::options('nama', 'id', [], 'Pilih User') !!}
						</select>	 --}}		
						<select name="user_id" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\User::options('nama', 'id', ['selected' => $record->user_id, ['filters' => ['user_id' => $record->user_id]]], ('Pilih Pemesan')) !!}
						</select>			
					</div>	
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Nama Peserta</label>
						<input type="text" name="name" class="form-control" placeholder="Nama Peserta" value="{{ $record->name or '' }}">					
					</div>	
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Paket & Jadwal</label>
						<select name="id_jadwal" class="form-control child target changeSelects selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							{!! \App\Models\HajiUmroh\HajiJadwal::options('judul', 'id', ['selected' => $record->id_jadwal, ['filters' => ['id_jadwal' => $record->id_jadwal]]], ('Pilih Jadwal')) !!}
						</select>						
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="">NIK</label>
						<input type="text" name="nik" class="form-control" placeholder="NIK" required="" value="{{$record->nik}}">
					</div>
				</div>	
				<div class="col-md-6">
					<div class="form-group">
						<label for="">KK</label>
						<input type="text" name="kk" class="form-control" placeholder="KK" required="" value="{{$record->kk}}">
					</div>
				</div>		
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Pilih Status</label>
						<select name="status" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" data-style="none">
							<option value="">Pilih Status</option>
							<option value="1" {{ ($record->status == 1) ? 'selected' : '' }}>Belum Lunas</option>
							<option value="2" {{ ($record->status == 2) ? 'selected' : '' }}>Sudah Lunas</option>
							<option value="3" {{ ($record->status == 3) ? 'selected' : '' }}>Hold</option>
							<option value="4" {{ ($record->status == 4) ? 'selected' : '' }}>Cancle</option>
						</select>						
					</div>	
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="">Keterangan Penyakit</label>
						<textarea name="keterangan_penyakit" class="form-control summernote" rows="2">{!!$record->keterangan_penyakit!!}</textarea>
					</div>
				</div>
				<div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[passport]',
                    'fileTitle' => 'Upload Foto Copy Dokumen Passport',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','passport')->first()) ? url('storage/'.$record->attachments->where('type','passport')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[miningitis]',
                    'fileTitle' => 'Upload Foto Copy Dokumen Buku Suntik Miningitis Asli',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','miningitis')->first()) ? url('storage/'.$record->attachments->where('type','miningitis')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[foto]',
                    'fileTitle' => 'Upload Foto Fokus Wajah Background Putih (Ukuran 4x6)',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','foto')->first()) ? url('storage/'.$record->attachments->where('type','foto')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[menikah]',
                    'fileTitle' => 'Upload Foto Copy Buku Menikah (Jika Sudah Menikah)',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','menikah')->first()) ? url('storage/'.$record->attachments->where('type','menikah')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[akte]',
                    'fileTitle' => 'Upload Foto Copy Akte Lahir (Jika Usia Dibawah 16 Tahun)',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','akte')->first()) ? url('storage/'.$record->attachments->where('type','akte')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[ktp]',
                    'fileTitle' => 'Upload Foto Copy Dokumen KTP',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','ktp')->first()) ? url('storage/'.$record->attachments->where('type','ktp')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[kk]',
                    'fileTitle' => 'Upload Foto Copy Dokumen KK',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','kk')->first()) ? url('storage/'.$record->attachments->where('type','kk')->first()->url) : '',
                  ])
                </div>
                <div class="col-md-6"> 
                  @include('partials.component.single-attachment',[
                    'attName' => 'file[hamil]',
                    'fileTitle' => 'Upload Foto Copy Surat Bukti Keterangan Hamil (Jika Perempuan Sedang Mengandung).',
                    'fileType' => 'pdf doc png gif docx',
                    'fileSize' => '3M',
                    'fileUrl' => ($record->attachments->where('type','hamil')->first()) ? url('storage/'.$record->attachments->where('type','hamil')->first()->url) : '',
                  ])
                </div>
			</div>
		</form>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-outline-secondary " data-dismiss="modal" aria-label="Close"><i class="ion-android-close"></i> Tutup</button>
	<button type="button" class="btn btn-success save-modal save-ayokulakan"><i class="ion-ios-paper"></i> Simpan</button>
</div>
</div>
</div>
</div>