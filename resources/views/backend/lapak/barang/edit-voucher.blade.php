
<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'update-vouc/'.$record->id) }}" method="POST" class="was-validated needs-validation"  novalidate>
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="PUT">
			<input type="hidden" name="id" value="{{ $record->id or ''}}">
			<div class="form-group">
				<label for="">Kode Voucher</label>
				<input type="text" name="kode_voucher" value="{{ $record->kode_voucher }}" class="form-control" placeholder="Ak1234" required>
			</div>
			<div class="form-group">
				<label for="">Nominal Voucher</label>
				<input type="text" name="nominal_voucher" value="{{ $record->nominal_voucher }}" class="form-control change-money-modals" placeholder="Masukan Nominal..." required>
			</div>
			<div class="form-group">
				<label for="">Descripsi Voucher</label>
				<input type="text" name="desc_voucher" value="{{ $record->desc_voucher }}" class="form-control" placeholder="Voucher Gratis Ongkir..." required>
			</div>
			<div class="form-group">
				<label for="ExpireDate">Expire Date</label>
				<input type="date" name="expire_date" required class="form-control" value="{{ $record->expire_date }}" id="">
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
