<div style="width: 100%; height: 20px; border-bottom: 1px solid black; margin-bottom: 20px; text-align: center">
    <span style="font-size: 22px; background-color: #FFFFFF; padding: 0 10px;">
        Pesanan
    </span>
</div><br>
<div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
    <div class="more-info-tab clearfix">
      <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
          <li class="nav-item">
              <a class="nav-link" id="home-tab" data-toggle="tab" href="#semua" role="tab" aria-controls="home" aria-selected="true"><p>Semua</p></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="home-tab" data-toggle="tab" href="#pesanan-belum-dibayar" role="tab" aria-controls="home" aria-selected="true"><p>Pesanan belum dibayar & Kartu</p></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="home-tab" data-toggle="tab" href="#metode-pembayaran" role="tab" aria-controls="home" aria-selected="true"><p>Menunggu Pembayaran</p></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="home-tab" data-toggle="tab" href="#pesanan-dikemas" role="tab" aria-controls="home" aria-selected="true"><p>Pesanan Dikemas</p></a>
          </li>
          <li class="nav-item">
              <a class="nav-link" id="home-tab" data-toggle="tab" href="#pesanan-dalam-pengiriman" role="tab" aria-controls="home" aria-selected="true"><p>Pesanan Dalam Pengiriman</p></a>
          </li>
      </ul>
    </div>
</div>
<div class="tab-content">
    <div class="tab-pane in active" id="semua">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                @if ($product->count() > 0)
                    @foreach ($product as $key => $value)
                        <div class="col-md-12" style="margin-top: 20px">
                            <div class="form-group">
                                {{-- <input type="checkbox" value="1">
                                <span>{{ $value->barang->lapak->nama_lapak }}</span> --}}
                                <div class="detail-pesanan">
                                    {{-- @if($value->form_type == 'img_barang')
                                        <input type="checkbox" value="1">
                                        @if($value->barang->attachments->count() > 0)
                                            @if(isset($value->form->attachments->first()->url))
                                                <center><img src="{{ ($value->barang->attachments->first()) ? url('storage/'.$value->barang->attachments->first()->url) : url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                            @else
                                                <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                            @endif
                                            @else
                                                <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>	
                                            @endif
                                        @else
                                            <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                    @endif --}}
                                        <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                    <div class="deskripsi-pesanan">
                                        <h3>{{ $value->barang->nama_barang }} <span style="color: #e61616; font-size: 18px">Rp {{ number_format($value->total_harga,2,',','.') }}</span></h3>
                                    </div>
                                    <div class="pesanan-check" style="float: right !important">
                                        <div class="nice-number">
                                            <input type="number" value="1" style="width: 4ch; margin: 0px 5px;">
                                        </div>
                                    </div>
                                </div>
                                <div class="action-pesanan">
                                    <span></span>
                                    <span style="color: #e67b16; font-weight: 600;">Hanya {{ $value->barang->stock_barang }} barang yang tersedia</span>
                                    <div class="pesanan-icon">
                                        <button style="border: none; background:none; font-size:24px"><i class="fa fa-heart" style="color: #e61616"></i></button>
                                        <button style="border: none; background:none; font-size:24px"><i class="fa fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </form>
    </div>
    <div class="tab-pane in" id="pesanan-belum-dibayar">
        <form action="" method="post">
            <div class="row">
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-warning" type="button"><i class="fa fa-search"></i></button>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                @if ($product->count() > 0)
                    @foreach ($product as $key => $value)
                        @if ($value->status_barang == 'Menunggu Pembayaran')
                            <div class="col-md-12" style="margin-top: 20px">
                                <div class="form-group">
                                    <div class="detail-pesanan">
                                        @if($value->form_type == 'img_barang')
                                            <input type="checkbox" value="1">
                                            @if($value->barang->attachments->first())
                                                @if(isset($value->form->attachments->first()->url))
                                                    <center><img src="{{ ($value->barang->attachments->first()) ? url('storage/'.$value->barang->attachments->first()->url) : url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                                @else
                                                    <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                                @endif
                                                @else
                                                    <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>	
                                                @endif
                                            @else
                                                <center><img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px"></center>
                                            @endif
                                        <div class="deskripsi-pesanan">
                                            <h3>{{ $value->barang->nama_barang }} <span style="color: #e61616; font-size: 18px">Rp {{ number_format($value->total_harga,2,',','.') }}</span></h3>
                                        </div>
                                        <div class="pesanan-check" style="float: right !important">
                                            <div class="nice-number">
                                                <input type="number" value="1" style="width: 4ch; margin: 0px 5px;">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="action-pesanan">
                                        <span></span>
                                        <span style="color: #e67b16; font-weight: 600;">Hanya {{ $value->barang->stock_barang }} barang yang tersedia</span>
                                        <div class="pesanan-icon">
                                            <button style="border: none; background:none; font-size:24px"><i class="fa fa-heart" style="color: #e61616"></i></button>
                                            <button style="border: none; background:none; font-size:24px"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
        </form>
    </div>
    <div class="tab-pane in" id="metode-pembayaran">
        <form id="dataFormPage" class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="row  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                <div class="col-md-12">
                    @if ($pembayaran->count() > 0 )
                        @foreach ($pembayaran->get() as $value)
                        @if($value->transaction_time >= $date)
                            <div class="detail-pesanan" style="margin-bottom: 20px">
                                <div class="icon-belanja">
                                    <span><i class="fa fa-shopping-bag"></i></span>
                                </div>
                                <div style="display: block">
                                    <p style="margin: 0px; line-height: 50px;font-size: 20px; font-weight: 600">Belanja | <a href="">Invoice</a></p>
                                    <p style="font-size: 20px; ">Total <span style="color: #db700c">Rp{{ number_format($value->total_harga,'2',',','.') }}</span></p>
                                    <p>Bayar sebelum {{ $value->transaction_time or '' }}</p>
                                    <table class="table">
                                        <tr>
                                            <th>Methode Pembayaran</th>
                                            <td>{{ $value->payment_type or ''}}</td>
                                        </tr>
                                        <tr>
                                            <th>Kode Pembayaran / no rekening</th>
                                            <td>{{ $value->payment_code or '' }}</td>
                                        </tr>
                                    </table>
                                    <a href="{{ env('MIDTRANS_URL_PDF').'/snap/v1/transactions/'.$value->snap_token.'/pdf' }}" class="btn btn-success">Cara Pembayaran</a>
                                </div>
                            </div>
                        @endif
                        @endforeach
                        @else
                        <center>data belum di temukan</center>
                    @endif

                    {{--  @foreach ($products as $item)
                    @endforeach  --}}
                </div>
            </div>
        </form>
    </div>

</div>