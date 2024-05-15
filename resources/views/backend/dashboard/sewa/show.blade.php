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
        <div class="card-body">
           <div class="row no-gutters">
               <div class="col-md-4">
                @if($record->attachments)
                    <img src="{{ url('storage/'.$record->attachments->first()->url) }}" alt="" style="max-height: 150px">
                    @else
                    <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                @endif
               </div>
               <div class="col-md-8">
                   <span class="card-text">{{ $record->nama_lapak }}</span><br>
                   <span class="text-secondary">{{ $record->deskripsi_lapak }}</span>
                   <p class="card-text">{{ $record->alamat_lapak }}</p>
                   <p class="card-text">{{ $record->phone }}</p>
               </div>
           </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="">Product Jual</h4>
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
           <div class="row">
               @php
                   $barang = $transaksi->where('created_by',$record->created_by)->paginate(8);
               @endphp
                @foreach ($barang as $e)
                <div class="col-md-3">
                    <div class="card">
                        @if($e->attachments->count() > 0)
                            <img src="{{ url('storage/'.$e->attachments->first()->url) }}" class="card-img-top" style="max-height: 150px" alt="" >
                            @else
                            <img src="{{ asset('img/no-images.png') }}" style="max-height: 150px" alt="" >
                        @endif
                       {{-- <img class="card-img-top" src="..." alt="Card image cap">  --}}
                       <div class="card-body text-center">
                            <p class="card-text">{{ $e->judul or '-' }}</p>
                            <p class="">Rp. {{ number_format($e->harga_sewa,0,',','.') }}</p>
                            </div>
                    </div>
                </div>
                @endforeach 
            </div>
            {!! $barang->links() !!}
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
                    @foreach ($transaksi->where('created_by',$record->created_by)->get() as $e)
                        @if ($e->trans_rental->count() > 0)
                            @foreach ($e->trans_rental as $item)
                                <tr>
                                    <td>{{ $item->trans_transaksi_id or '-' }}</td>
                                    <td>{{ number_format($item->total_harga,0,',','.') }}</td>
                                    <td>{{ $item->created_at or '-' }}</td>
                                    <td>{{ $item->status_barang or '-' }}</td>
                                    <td>
                                        <a href="{{ url('admin/sewa/detail',$item->id) }}" class="btn btn-sm"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- <div class="pull-right">
          {!! $record->links() !!}
        </div> --}}
    </div>
</div><!-- /.container-fluid -->
@endsection
