<div class="modal-body">
    <form id="dataFormModal" action="{{ url($pageUrl) }}" method="post" enctype="multipart/form-data">
        @csrf
            <label for="">Judul</label>
            <input type="text" name="judul" placeholder="judul" value="" class="form-control">
        </div>
        <div class="form-group">
            @include('partials.file-tab.attachment')
        </div>
        <input type="hidden" name="kategori" value="Slider">
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Simpan</button>
</div>