<div class="modal-body">
    <form id="dataFormModal" action="{{ url($pageUrl.$record->id) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $record->id }}">
        <div class="form-group">
            <label for="">Description</label>
            <input type="text" name="deskripsi" value="{{ $record->deskripsi or '' }}" class="form-control">
        </div>
        <div class="form-group">
            @include('partials.file-tab.attachment')
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Edit</button>
</div>