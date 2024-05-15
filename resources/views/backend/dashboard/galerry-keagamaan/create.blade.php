<div class="modal-body">
    <form id="dataFormModal" action="{{ url($pageUrl) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="">Description</label>
            <input type="text" name="deskripsi" value="{{ old('deskripsi') }}" class="form-control">
        </div>
        <div class="form-group">
            @include('partials.file-tab.attachment')
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
</div>