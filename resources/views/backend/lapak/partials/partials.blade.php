<div class="col-md-3">
    <div class="scroll-tabs fadeinUp wow">
        <div class="more-info-tab clearfix">
            <img src="{{ (auth()->user()->lapak->attachments->sortByDesc('created_at')->first()) ? url('storage/'.auth()->user()->lapak->attachments->sortByDesc('created_at')->first()->url) :  asset('img/users.png') }}" alt="" class="profile-img">
            <p class="profile-name">{{ auth()->user()->lapak->nama_lapak ?? '' }}</p>
        </div>
        <table class="table borderless">
            <tr>
                <th style="padding: 10px">Saldo</th>
                <th>Rp 0</th>
            </tr>
            <tr>
                <th>Kredit</th>
                <th>Rp 0</th>
            </tr>
        </table>
    </div>
    
    <div class="scroll-tabs fadeinUp wow">
        <div class="more-info-tab clearfix">
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ url('settings-lapak') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('settings-lapak/lapak/chat') }}">Chat</a>
                </li>
                <li>
                    <a href="#pesanan" data-toggle="collapse" aria-expanded="false">Pesanan <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled bg-secondary" id="pesanan">
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/all') }}">Semua</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/pending') }}">Pesanan belum dibayar</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/packing') }}">Pesanan dikemas</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/set-tracking') }}">Atur pengiriman</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/tracking') }}">Pesanan dalam pengiriman</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/success') }}">Pesanan diterima</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/cancel') }}">Pesanan dibatalkan</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/pesanan/pengembalian-barang') }}">Pengembalian barang/dana</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('settings-barang') }}" >Tambah Product Lapak</a>
                    <ul class="collapse list-unstyled bg-secondary" id="addproduct">
                        <li class="colapse-item"><a href="">Tambah Product Lapak</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('settings-barang/show') }}">Product Lapak</a></li>
                <li><a href="{{ url('settings-lapak/history/trans-lapak') }}" id="history">Data History Order & Transaksi</a></li>
                <li>
                    <a href="#brand" data-toggle="collapse" aria-expanded="false">Pengaturan Lapak <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled bg-secondary" id="brand">
                        <li class="colapse-item"><a href="{{ url('settings-lapak/create') }}">Pengaturan Lapak</a></li>
                        <li class="colapse-item"><a href="{{ url('settings-lapak/admin') }}">Pengaturan Admin</a></li>
                    </ul>
                </li>
                {{--  <li><a href="#">Notifikasi</a></li>
                <li><a href="#">Voucher</a></li>  --}}
            </ul>
        </div>
    </div>
</div>