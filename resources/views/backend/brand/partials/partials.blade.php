<div class="col-md-4">
    <div class="scroll-tabs fadeinUp wow">
        <div class="more-info-tab clearfix">
            <img src="{{ asset('img/users.png') }}" alt="" class="profile-img">
            <p class="profile-name">{{ auth()->user()->nama }}</p>
            <p class="profile-verif">Verived</p>
        </div>
    </div>
    
    <div class="scroll-tabs fadeinUp wow">
        <div class="more-info-tab clearfix">
            <ul class="list-unstyled components">
                <li>
                    <a href="{{ url($pageUrl) }}">Home</a>
                </li>
                <li>
                    <a href="#pesanan" data-toggle="collapse" aria-expanded="false">Pesanan <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled bg-secondary" id="pesanan">
                        <li class="colapse-item"><a href="{{ url('pesanan') }}">Semua</a></li>
                        <li class="colapse-item"><a href="{{ url('pesanan/pending') }}">Pesanan belum dibayar</a></li>
                        <li class="colapse-item"><a href="{{ url('pesanan/payment') }}">Metode Pembayaran</a></li>
                        <li class="colapse-item"><a href="#">Pesanan dikemas</a></li>
                        <li class="colapse-item"><a href="#">Selesai</a></li>
                        <li class="colapse-item"><a href="#">Pesanan dibatalkan</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#addproduct" data-toggle="collapse" aria-expanded="false">Tambah Product Brand <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled bg-secondary" id="addproduct">
                        <li class="colapse-item"><a href="{{ url($pageUrl.'create-brand') }}">Tambah Product Brand</a></li>
                        <li class="colapse-item"><a href="{{ url($pageUrl.'product-brand') }}">Product Brand</a></li>
                    </ul>
                </li>
                <li><a href="{{ url('pesanan/history-order-transaksi') }}" id="history">Data History Order & Transaksi</a></li>
                <li>
                    <a href="#brand" data-toggle="collapse" aria-expanded="false">Setting Brand <i class="fa fa-angle-down"></i></a>
                    <ul class="collapse list-unstyled bg-secondary" id="brand">
                        <li class="colapse-item"><a href="{{ url($pageUrl.'create') }}">Setting Brand</a></li>
                        <li class="colapse-item"><a href="{{ url($pageUrl.'admin') }}">Setting Admin</a></li>
                    </ul>
                </li>
                <li><a href="#">Notifikasi</a></li>
                <li><a href="#">Voucher</a></li>
            </ul>
        </div>
    </div>
</div>