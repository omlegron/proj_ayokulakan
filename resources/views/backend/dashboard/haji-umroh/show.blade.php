@extends('layouts.admin')
@section('content')
    <div class="card">
        <p class="card-header">Data Calon Jamaah</p>
        <div class="card-body">
            <table class="table border-0">
                <thead>
                    <tr>
                        <td>Npu</td>
                        <td>{{ $record->passport or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>{{ $record->name or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Tempat/Tanggal Lahir</td>
                        <td>{{ $record->created_at or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>{{ $record->creator->alamat or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $record->creator->email or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telephone</td>
                        <td>{{ $record->creator->hp or '-' }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="card">
        <p class="card-header">
            Berkas
        </p>
        <div class="card-body">
            <center>
                @if ($record->attachments->count() > 0)
                    @foreach ($record->attachments as $item)
                        <p>{{ $item->type }}</p>
                        <img src="{{ url('storage/'.$item->url) }}" class="card-img-top" style="max-height: 250px;width:350px" alt="" ><br>
                    @endforeach
                @else
                <img src="{{ asset('img/no-images.png') }}" style="max-height: 150px" alt="" >
                @endif
            </center>
        </div>
    </div>
    <div class="card">
        <p class="card-header">Paket</p>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <td>Ibadah</td>
                        <td>{!! $record->jadwal->judul or '-' !!}</td>
                    </tr>
                    <tr>
                        <td>Paket</td>
                        <td>{{ $record->paket->type_paket or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Keberangkatan</td>
                        <td>{{ $record->jadwal->tgl_berangkat or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Harga</td>
                        <td>$ {{ $record->jadwal->harga or '-' }}</td>
                    </tr>
                    <tr>
                        <td>Setoran Awal</td>
                        <td>{{ $record->jadwal->keterangan_paket or '-' }}</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    <div class="card">
        <p class="card-header">Pembayaran</p>
        <div class="card-body">
            @php
                $angsuran = $pembayaran->where('user_id',$record->user_id)->first();
            @endphp
            @if ($angsuran != '')
            <div class="row">
                <div class="col-md-4">
                    <p class="card-text">Pembayaran</p>
                    <p class="card-text">Tanggal Pembayaran</p>
                </div>
                <div class="col-md-8">
                        <p class="card-text">{{ $angsuran->uang_pembayaran or '-' }}</p>
                        <p class="card-text">{{ $angsuran->tgl_pembayaran or '-' }}</p>
                </div>
            </div>
            @else
            <h1 class="text-center">Data Kosong</h1>
            @endif
        </div>
    </div>
@endsection