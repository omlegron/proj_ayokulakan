<div class="modal-body">
    <form id="dataFormModal" action="{{ route('admin.karyawan.update',$record->id) }}" method="POST">
        @csrf
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="id" value="{{ $record->id }}">
        <div class="form-group">
            <label for="">Nama</label>
            <input type="text" name="nama" value="{{ $record->nama }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Username</label>
            <input type="text" name="username" value="{{ $record->username }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="email" value="{{ $record->email }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Nomor Hp</label>
            <input type="text" name="hp" value="{{ $record->hp }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Alamat</label>
            <textarea name="alamat" id="" cols="30" rows="10" class="form-control">{{ $record->alamat }}</textarea>
        </div>
        {{-- <div class="form-group">
            <label for="">Jabatan/Role</label>
            <select class="form-control" name="role" id="">
                <option value="">Pilih Role</option>
                <option value="Managing Director">Managing Director</option>
                <option value="Content Designer">Content Designer</option>
                <option value="Verifier">Verifier</option>
                <option value="Web Developer">Web Developer</option>
                <option value="Customer Service">Customer Service</option>
                <option value="HRD">HRD</option>
            </select>
            @if ($errors->has('role'))
                <span class="text-danger">{{ $errors->first('role') }}</span>
            @endif
        </div> --}}
        <div class="form-group">
            <label for="">Status</label>
            <select class="form-control" name="status" id="">
                <option value="">Pilih Status</option>
                <option value="1010" {{ ($record->status == '1010') ? 'selected' : '' }}>Super Admin</option>
                <option value="1011" {{ ($record->status == '1011') ? 'selected' : '' }}>Admin</option>
                <option value="1012" {{ ($record->status == '1012') ? 'selected' : '' }}>Cs</option>
                <option value="1013" {{ ($record->status == '1013') ? 'selected' : '' }}>User</option>
            </select>
        </div>
        <div class="form-group">
            @include('partials.file-tab.foto-users',['label' => 'Lampiran Foto','shows' => false])
        </div>
    </form>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
    <button type="button" class="btn btn-primary btn-simpan">Edit</button>
</div>