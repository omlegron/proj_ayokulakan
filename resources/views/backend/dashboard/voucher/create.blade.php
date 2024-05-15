<div class="modal-body">
    <form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Kode Voucher</label>
            <input type="text" name="kode_voucher" value="{{ old('kode_voucher') }}" class="form-control" placeholder="Ak1234" required>
        </div>
        <div class="form-group">
            <label for="">Nominal Voucher</label>
            <input type="text" name="nominal_voucher" value="{{ old('nominal_voucher') }}" class="form-control" placeholder="Masukan Nominal..." required>
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
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
</div>