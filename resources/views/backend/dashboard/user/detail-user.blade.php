@extends('layouts.admin')
@section('content')
<div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>150</h3>

            <p>Total Karyawan</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Laki-Laki</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-4 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>Perempuan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>
    <div class="card">
        <h4 class="card-header">Profile</h4>
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 bg-white">
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
                      <p>{{ $record->nama.' '.$record->username}}</p>
                      <p>{{ $record->email or '-'}}</p>
                      <p>{{ $record->hp or '-'}}</p>
                      <p>{{ $record->alamat or '-'}}</p>
                      <p>{!! $record->getStatus() ?? '-'!!}</p>
                      <p>{{ $status or '-'}}</p>
                      <p>{{ $record->created_at or '-'}}</p>
                </div>
              </div>
        </div>
    </div>
    @if ($records->count() > 0)
    <div class="card">
      <h4 class="card-header">Alamat</h4>
      @foreach ($records->get() as $item => $items)
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 bg-white">
                  <p>Nama Penerima</p>
                  <p>Nomor Telphone</p>
                  <p>Alamat</p>
                </div>
                  <div class="col-md-8">
                        <p>{{ $items->user->nama or '-'}}</p>
                        <p>{{ $items->user->hp or '-'}}</p>
                        <p>{{ $items->user->alamat or '-' }}</p>
                  </div>
              </div>
          </div>
          @endforeach
        </div>
    <div class="card">
        <h4 class="card-header">Berkas</h4>
        <div class="card-body">
            
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-4">
                    <select name="" id="" class="form-control">
                        <option value="">Atur Berdasarkan</option>
                    </select>
                </div>
                <div class="col-md-8">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" id="inlineFormInputGroupUsername" placeholder="Search..">
                            <div class="input-group-prepend">
                                <button class="btn btn-warning">Cari</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Order Id</th>
                        <th>Total Transaksi</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                      @foreach ($records->get() as $item)
                          <tr>
                              <td>{{ $item->order_id }}</td>
                              <td>Rp. {{ number_format($item->total_harga,0,',','.') }}</td>
                              <td>{{ $item->created_at }}</td>
                              <td><span class="badge badge-pill badge-warning">{{ $item->status }}</span></td>
                              <td>
                                  <a href="{{ route('admin.detail.show',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
                              </td>
                          </tr>
                      @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="pull-right">
          {!! $record->links() !!}
        </div> --}}
    </div>
    @else
      <p>DATA Transaksi Kosong</p>
    @endif
</div><!-- /.container-fluid -->
@endsection
