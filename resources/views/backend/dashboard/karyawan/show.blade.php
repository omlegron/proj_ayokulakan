<div class="col-md-12">
    <div class="row">
      <div class="col-md-4">
        <p>ID Karyawan</p>
        <p>Nama</p>
        <p>Email</p>
        <p>Nomer Telphone</p>
        <p>Alamat</p>
        <p>Jabatan</p>
        <p>Status</p>
        <p>Bergabung</p>
      </div>
      <div class="col-md-8">
            <p>UAK{{ $record->id or '-'}}</p>
            <p>{{ $record->nama }}</p>
            <p>{{ $record->email or '-'}}</p>
            <p>{{ $record->hp or '-'}}</p>
            <p>{{ $record->alamat or '-'}}</p>
            <p>-</p>
            <p>{!! $record->getStatus() ?? '-' !!}</p>
            <p>{{ $record->created_at or '-'}}</p>
      </div>
    </div>
  </div>