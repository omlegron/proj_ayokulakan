<div class="modal-body">
    <form id="dataFormModal" action="{{ url('admin/berita') }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="kategori" value="Berita">
        <div class="form-group">
            <label for="">Judul</label>
            <input type="text" name="judul" placeholder="judul" class="form-control">
        </div>
        <div class="form-group">
            @include('partials.file-tab.attachment')
        </div>
        <div class="form-group">
            <label for="">Konten Berita</label>
            <textarea name="deskripsi" id="" cols="30" rows="10" placeholder="Description" class="form-control summernote"></textarea>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Add</button>
</div>