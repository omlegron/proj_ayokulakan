<div class="scroll-tabs fadeinUp wow">
    <div class="more-info-tab clearfix">
        @if (isset($record))
            <img src="{{ ($record->pictureusers->sortByDesc('created_at')->first()) ? url('storage/'.$record->pictureusers->sortByDesc('created_at')->first()->url) : asset('img/users.png') }}" alt="" class="profile-img">
        @else
            <img src="{{ asset('img/users.png') }}" alt="" class="profile-img">
        @endif
        <p class="profile-name">{{ auth()->user()->nama }}</p>
        <p class="profile-verif">Verived</p>
    </div>
</div>

<div class="scroll-tabs fadeinUp wow">
    <div class="more-info-tab clearfix">
        <ul class="list-unstyled components">
            <li>
                <a href="#homeSubmenu" id="profile" data-toggle="collapse" aria-expanded="false">My Profile <i class="fa fa-angle-down"></i></a>
                <ul class="collapse list-unstyled bg-secondary " id="homeSubmenu">
                    <li class="colapse-item"><a href="{{ url('myprofile') }}">Profile</a></li>
                    <li class="colapse-item"><a href="{{ url('profile-bank') }}">Bank & Kartu Kredit</a></li>
                    <li class="colapse-item"><a href="{{ url('ganti-pass') }}">Ganti Password</a></li>
                </ul>
            <li>
                <a href="#pesanan" data-toggle="collapse" aria-expanded="false">Pesanan <i class="fa fa-angle-down"></i></a>
                <ul class="collapse list-unstyled bg-secondary" id="pesanan">
                    <li class="colapse-item"><a href="{{ url('pesanan') }}">Semua</a></li>
                    <li class="colapse-item"><a href="{{ url('pesanan/pending') }}">Pesanan belum dibayar</a></li>
                    <li class="colapse-item"><a href="{{ url('pesanan/payment') }}">Metode Pembayaran</a></li>
                    <li class="colapse-item"><a href="{{ url('pesanan/packing') }}">Pesanan dikemas</a></li>
                    <li class="colapse-item"><a href="#">Selesai</a></li>
                    <li class="colapse-item"><a href="{{ url('pesanan/cancel') }}">Pesanan dibatalkan</a></li>
                </ul>
            </li>
            <li><a href="{{ url('pesanan/history-order-transaksi') }}" id="history">Data History Order & Transaksi</a></li>
            <li><a href="#">Notifikasi</a></li>
            <li><a href="{{ url('myvoucher') }}">Voucher</a></li>
        </ul>
    </div>
</div>