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
        <h4 class="card-header">Detail Pesanan</h4>
        <div class="card-body">
          @if ($records->count() > 0)
            @foreach ($records as $k => $v)
              <div class="row no-gutters">
                <div class="col-md-4">
                  @if($v->barang->attachments)
                    <img src="{{ url('storage/'.$v->barang->attachments->first()->url) }}" alt="" style="max-height: 150px">
                    @else
                    <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                  @endif
                </div>
                <div class="col-md-8">
                  <p class="card-text">{{ $v->barang->nama_barang }}</p>
                  <span>{{ $v->jumlah_barang.'x' }}</span>
                  <span>{{ number_format($v->total_harga,0,',','.') }}</span>
                </div>
              </div> 
            @endforeach
          @endif
        </div>
    </div>
    @if ($record->count() > 0)
    <div class="card">
      <h4 class="card-header">Pengiriman Barang</h4>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <td width="150">{!! $record->kurir->getKurir() !!}</td>
                <td width="450"><p>{{ $record->kurir->kurir_child_tipe }}</p>
                  <p>{{ $record->kurir->kurir_child_hari.' hari' }}</p>
                </td>
                <td>{{ number_format($record->kurir->kurir_child_harga,0,',','.') }}</td>
              </tr>
            </thead>
          </table>
        </div>
    </div>
    <div class="card">
        <h4 class="card-header">Metode Pembayaran</h4>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <td width="150">{!! $record->getBayar() ? $record->getBayar() : $record->getBank() !!}</td>
                <td>
                  @if ($record->payment_type == 'cstore')
                      <p>{{ $record->store }}</p>
                    @elseif($record->payment_type == 'bank_transfer')
                      <p>BCA (Bank Central Asia)</p>
                  @endif
                </td>
              </tr>
            </thead>
          </table>
        </div>
    </div>
    <div class="card">
        <h4 class="card-header">Total Pembayaran</h4>
        <div class="card-body">
          <table class="table">
            <thead>
              @foreach ($records as $item)
              <tr>
                <td>{{ $item->barang->nama_barang or '' }}</td>
                <td width="10">Rp.</td>
                <td width="10">{{ number_format($item->total_harga,0,',','.') }}</td>
              </tr>
              @endforeach
              <tr>
                <td>Ongkos Kirim</td>
                <td width="10">Rp.</td>
                <td width="10">{{ number_format($record->kurir->kurir_child_harga,0,',','.') }}</td>
              </tr>
              <tr>
                <td><p class="text-success">Total</p></td>
                <td width="10" class="text-success">Rp.</td>
                <td width="10" class="text-success">{{ number_format($record->total_harga,0,',','.') }}</td>
              </tr>
            </thead>
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
