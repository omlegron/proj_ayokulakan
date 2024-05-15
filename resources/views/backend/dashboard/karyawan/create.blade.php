    <div class="modal-body">
        <form id="dataFormModal" action="{{ url('admin/karyawan') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="">Username</label>
                <input type="text" name="username" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nama</label>
                <input type="text" name="nama" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Nomor Hp</label>
                <input type="text" name="hp" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" id="" cols="30" rows="10" class="summernote form-control"></textarea>
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
                    <option value="1010">Super Admin</option>
                    <option value="1011">Admin</option>
                    <option value="1012">Cs</option>
                    <option value="1013">User</option>
                </select>
            </div>
            {{-- <div class="form-group">
                @include('partials.file-tab.foto-users',['label' => 'Lampiran Foto','shows' => false])
            </div> --}}
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Konfirmasi Password</label>
                <input type="password" name="" id="" class="form-control">
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-primary btn-simpan">Add</button>
    </div>