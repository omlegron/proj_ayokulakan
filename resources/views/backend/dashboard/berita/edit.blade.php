<div class="modal-body">
    <form id="dataFormModal" action="{{ url('admin/berita',$record->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $record->id or ''}}">
        <div class="form-group">
            <label for="">Judul</label>
            <input type="text" name="judul" placeholder="judul" value="{{$record->judul}}" class="form-control">
        </div>
        <div class="form-group">
            @include('partials.file-tab.attachment')
        </div>
        <input type="hidden" name="kategori" value="Berita">
        <div class="form-group">
            <label for="">Konten Berita</label>
            <textarea name="deskripsi" id="" cols="30" rows="10" placeholder="Description" class="form-control summernote">{!! $record->deskripsi !!}</textarea>
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Edit</button>
</div>