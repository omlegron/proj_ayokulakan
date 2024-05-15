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
      <h4 class="card-header">Penyewa</h4>
        <div class="card-body">
          {{-- {{ dd($record) }} --}}
          <div class="row">
            <div class="col-md-4">
              <p class="card-text">Nama Penyewa</p>
              <p class="card-text">Nomor Telphone</p>
              <p class="card-text">Alamat</p>
            </div>
            <div class="col-md-8">
              <p class="card-text">{{ $record->user->username or '-' }}</p>
              <p class="card-text">{{ $record->user->hp or '-' }}</p>
              <p class="card-text">{{ $record->user->alamat or '-' }}</p>
            </div>
          </div>
        </div>
    </div>
    @php
      
        $transaksi = $records->where('trans_transaksi_id',$record->trans_transaksi->id)->get();
    @endphp
    <div class="card">
        <h4 class="card-header">Detail Pesanan</h4>
        <div class="card-body">
            @foreach ($transaksi as $k => $v)
            {{-- {{ dd($v) }} --}}
              <div class="row no-gutters">
                <div class="col-md-4">
                  @if($v->rent->attachments)
                    <img src="{{ url('storage/'.$v->rent->attachments->first()->url) }}" alt="" style="max-height: 150px">
                    @else
                    <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                  @endif
                </div>
                <div class="col-md-8">
                  <p class="card-text">{{ $v->rent->judul or '-' }}</p>
                  <span>{{ $v->jumlah_barang.' x' }}</span>
                  <span>Rp. {{ number_format($v->rent->harga_sewa,0,',','.') }}</span>
                </div>
              </div> 
            @endforeach
        </div>
    </div>
    @if ($record->count() > 0)
    {{-- @php
        $kurir = App\Models\TransaksiAmpas\TransaksiKurir::where('trans_id',$record->trans_transaksi_id)->first();
    @endphp
      <div class="card">
        <h4 class="card-header">Pengiriman Barang</h4>
        @if ($kurir)
        <div class="card-body">
            <div class="row no-gutters">
              <div class="col-md-4 bg-white">
                <span>Logo</span>
                <span>{{ $kurir->kurir_child_tipe }}</span><br>
                <span>{{ $kurir->kurir_child_hari }}</span>
              </div>
              <div class="col-md-8">
                    <p class="card-text">{{ number_format($kurir->kurir_child_harga,0,',','.') }}</p>
              </div>
          </div>
        </div>
        @endif
      </div> --}}
    <div class="card">
        <h4 class="card-header">Metode Pembayaran</h4>
        <div class="card-body">
          <table class="table">
            <thead>
              <tr>
                <td width="150">{!! $record->trans_transaksi->getBayar() ? $record->trans_transaksi->getBayar() : $record->trans_transaksi->getBank() !!}</td>
                <td>
                  @if ($record->trans_transaksi->payment_type == 'cstore')
                      <p>{{ $record->trans_transaksi->store }}</p>
                    @elseif($record->trans_transaksi->payment_type == 'bank_transfer')
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
              @foreach ($transaksi as $item)
              <tr>
                <td>{{ $item->rent->judul or '' }}</td>
                <td width="10">Rp. </td>
                <td width="10">{{ number_format($item->total_harga,0,',','.') }}</td>
              </tr>
              @endforeach
              <tr>
                <td><p class="text-success">Total</p></td>
                <td width="10" class="text-success">Rp.</td>
                <td width="10" class="text-success">{{ number_format($record->trans_transaksi->total_harga,0,',','.') }}</td>
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
