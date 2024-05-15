<div class="modal-body">
	<div class="content-ayokulakan">
		<form id="dataFormModal" action="{{ url($pageUrl.'store-voucher') }}" method="POST" class="was-validated needs-validation"  novalidate>
			{!! csrf_field() !!}
			<div class="form-group">
				<label for="">Kode Voucher</label>
				<input type="text" name="kode_voucher" value="{{ old('kode_voucher') }}" class="form-control" placeholder="Ak1234" required>
			</div>
			<div class="form-group">
				<label for="">Nominal Voucher</label>
				<input type="text" name="nominal_voucher" value="{{ old('nominal_voucher') }}" class="form-control change-money-modals" placeholder="Masukan Nominal..." required>
			</div>
			<div class="form-group">
				<label for="">Descripsi Voucher</label>
				<input type="text" name="desc_voucher" value="{{ old('desc_voucher') }}" class="form-control" placeholder="Voucher Gratis Ongkir..." required>
			</div>
			<div class="form-group">
				<label for="ExpireDate">Expire Date</label>
				<input type="date" name="expire_date" required class="form-control" id="">
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
