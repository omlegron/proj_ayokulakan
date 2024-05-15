<div class="modal-body">
    <form id="dataFormModal" action="{{ url('admin/konten-web',$record->id) }}" method="post" enctype="multipart/form-data">
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
        <input type="hidden" name="kategori" value="Slider">
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Edit</button>
</div>