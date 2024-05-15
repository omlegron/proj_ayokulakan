@extends('layouts.scaffold')

@section('css')
<style>
    .outer-top {
        margin-top: 200px;
    }
    .check-detail{
        display: flex;
        margin-bottom: 10px;
    }
    .check-detail i{
        font-size: 24px;
        padding-right: 10px;
    }
    .check-detail p{
        margin: 0px;
    }
    .check-detail a{
        text-decoration: none;
        color: #df8612;
        margin-left: auto;
    }
    .check-addres p{
        float: left;
        padding-right: 5px;
    }
    @media screen and (max-width: 768px) {
        .outer-top {
            margin-top: 400px;
        }
    }
</style>
@endsection

@section('content-frontend')
    <div class="row">
        <div class="col-md-12 terms-conditions" style="margin-top: 10px">
            <form id="dataFormPage" action="{{ url($pageUrl.'store-mt') }}" method="POST">
            {!! csrf_field() !!}
                <div class="container">
                    <div class="checkout-box ">
                        <div class="row">
                            <div class="col-md-8">
                                @php
                                    $i = 0;
                                    $no = 0;
                                    $totalHarga = 0;
                                @endphp
                                @foreach($record as $k => $value)
                                    @php
                                        $i++;
                                        $lapak = \App\Models\Lapak\Lapak::find($k);
                                        $totalBerat = 0;
                                    @endphp
                                    @if($lapak)
                                    <div class="panel-group checkout-steps" id="accordion">
                                        <div class="panel panel-default checkout-step-0{{$i}}">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">
                                                    <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                                        <span>{{ $i }}</span>Lapak {{ $lapak->nama_lapak }}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseTwo" class="panel-collapse collapse in">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="table-responsive">
                                                                <table class="table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="4" class="heading-title">Data Barang</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if(count($value) > 0)
                                                                            @foreach($value as $k1 => $value1)
                                                                                @php
                                                                                    $no++;
                                                                                @endphp
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][lapak_id]" value="{{ $lapak->id }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$no}}][id]" value="{{ $value1->form->id }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$no}}][name]" value="{{ $value1->form->nama_barang }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$no}}][price]" value="{{ $value1->form->harga_barang }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$no}}][quantity]" value="{{ $value1->jumlah_barang }}">
                                                                                <input type="hidden" name="item_details[{{ $lapak->id }}][barang][{{$no}}][id_barang]" value="{{ $value1->id_barang }}">
                                                                                <tr>
                                                                                    <td class="col-md-2">
                                                                                        <img src="{{ ($value1->form->attacOne) ? url('storage/'.$value1->form->attacOne->url) : asset('img/no-images.png') }}" style="max-height: 100px;max-width: 100px" alt="imga">
                                                                                    </td>
                                                                                    <td class="col-md-7">
                                                                                        <div class="product-name berat{{ $lapak->id }}" data-berat="{{ $value1->form->berat_barang }}"><span><b>{{ $value1->form->nama_barang }}</b></span></div>
                                                                                        <div class="price">
                                                                                            Rp. {{ number_format($value1->form->harga_barang, 2, ',', '.') ?? 0 }}
                                                                                        </div>
                                                                                        <div class="price">
                                                                                            Jumlah Pembelian ( {{ $value1->jumlah_barang }} )
                                                                                        </div>
                                                                                        <div class="price">
                                                                                            Total Harga Pembelian  
                                                                                            @php
                                                                                                $harga = (int)$value1->form->harga_barang;
                                                                                                $jumlah = (int)$value1->jumlah_barang;
                                                                                                $total = $jumlah * $harga;
                                                                                                $totalHarga += $total;
                                                                                                $totalBerat += (int)$value1->form->berat_barang;
                                                                                            @endphp
                                                                                            ( Rp. {{ number_format($total, 2, ',', '.') ?? 0 }} )
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                            @endforeach
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="checkout-progress-sidebar ">
                                                                <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="unicase-checkout-title">Pilih Data Pengiriman</h4>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="row">
                                                                                <div class="form-group">
                                                                                  <select id="paket" name="item_details[{{ $lapak->id }}][kurir_code]" class="form-control pilihPengiriman" required="" data-dropup-auto="false" data-size="10" data-style="none" data-pengiriman="#appendPengiriman{{$i}}" data-lapak="{{ $lapak->id }}" data-berat="{{ $totalBerat }}" data-num="{{ $i }}">
                                                                                      {!! App\Models\Master\Rajaongkir::options('nama', 'code', [], 'Pilih Data Pengiriman') !!}
                                                                                  </select>
                                                                                  <input type="hidden" name="item_details[{{ $lapak->id }}][kurir_harga_child]" class="kurir_harga_child{{ $lapak->id }}">
                                                                                  <input type="hidden" name="item_details[{{ $lapak->id }}][kurir_hari_child]" class="kurir_hari_child{{ $lapak->id }}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            <h4 class="unicase-checkout-title">Masukan Voucher</h4>
                                                                        </div>
                                                                        <div class="panel-body">
                                                                            <div class="row">
                                                                                <div class="" style="display: flex">
                                                                                    <input type="text" class="form-control" id="voucher" style="border-radius: 0" placeholder="AK123">
                                                                                    <div class="float-right">
                                                                                        <button type="button" class="btn btn-success btn-voc" data-price="{{ $harga or '' }}" style="border-radius: 0">Cari</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="panel panel-default data-voucher" style="margin-top: 10px">
                                                                        
                                                                    </div>
                                                                </div> --}}
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-12" id="appendPengiriman{{$i}}">
                                                             
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                        <div class="panel-group checkout-steps" id="accordion">
                                            <div class="panel panel-default checkout-step-0{{$i}}">
                                                <div class="panel-heading">
                                                    <h4 class="unicase-checkout-title">
                                                        <a data-toggle="collapse" class="collapsed" data-parent="#accordion" href="#collapseTwo">
                                                            <span>{{ $i }}</span>Maaf Barang Yang Anda Pesan Tidak Tersedia, di Karenakan Lapak Penjual Tidak Tersedia.
                                                        </a>
                                                    </h4>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                
                            </div>
                            <div class="col-md-4">
                                <div class="checkout-progress-sidebar ">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <button type="button" class="btn btn-warning btn-block">Checkout Pesanan Sekarang</button>
                                            {{-- <div class="panel-heading" style="background: #000000 !important">
                                                <h4 class="unicase-checkout-title">Checkout Pesanan Sekarang</h4>
                                            </div> --}}
                                            <h4 class="unicase-checkout-title">Pengiriman dan Penagihan</h4>
                                            <div class="check-detail">
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <p>{{ $user->nama }}</p>
                                                <a href="javascript:void(0)" class="edit-address" data-url="{{ url($pageUrl.'edit') }}" data-id="{{ auth()->user()->id }}" data-title="Ubah Data">Edit</a><br>
                                            </div>
                                            <div class="check-addres">
                                                <p>{{ $user->alamat }}</p>
                                                <p>{{ ($user->kecamatan) ? $user->kecamatan->kecamatan : ''  }}</p>
                                                <p>{{ ($user->kota) ? $user->kota->kota : ''  }}</p>
                                                <p>{{ ($user->provinsi) ? $user->provinsi->provinsi : ''  }}</p>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div class="check-detail">
                                                <i class="fa fa-phone" aria-hidden="true"></i>
                                                <p>{{ $user->hp }}</p>
                                                <a href="javascript:void(0)" class="edit-phone" data-url="{{ url($pageUrl.'edit-phone') }}" data-id="{{ auth()->user()->id }}" data-title="Ubah Data">Edit</a><br>
                                            </div>
                                            <div class="check-detail">
                                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                                <p>{{ $user->email }}</p>
                                                <a href="javascript:void(0)" class="edit-mail" data-url="{{ url($pageUrl.'edit-mail') }}" data-id="{{ auth()->user()->id }}" data-title="Ubah Data">Edit</a><br>
                                            </div>
                                            <p class="unicase-checkout-title">Detail pesanan</p>
                                            <div class="check-detail">
                                                <label>Subotal ({{ $record->count() }})</label>
                                                <p style="margin-left: auto" class="subtotal" data-harga="{{ $totalHarga }}">{{'Rp. '. number_format($totalHarga, 2,',','.') }}</p>
                                            </div>
                                            <div class="check-detail">
                                                <label>Biaya Pengiriman</label>
                                                <p style="margin-left: auto" class="biaya-kirim">Rp 0</p>
                                            </div>
                                            <div class="check-detail">
                                                <input type="text" class="form-control" id="voucher" style="border-radius: 0" placeholder="Masukan Kode Voucher">
                                                <div class="float-right">
                                                    <button type="button" class="btn btn-warning btn-voc" data-price="{{ $harga or '' }}" style="border-radius: 0">Gunakan</button>
                                                </div>
                                            </div>
                                            <div class="check-detail">
                                                <label>Total</label>
                                                <p style="margin-left: auto" class="total">Rp 0</p>
                                            </div>
                                            <div class="check-detail">
                                                <label></label>
                                                <p style="margin-left: auto">Termasuk PPN</p>
                                            </div>
                                                {{-- <ul class="nav nav-checkout-progress list-unstyled">
                                                    <li><a>Nama : {{ $user->nama }}</a></li>
                                                    <li><a>Negara : {{ ($user->negara) ? $user->negara->negara : '' }}</a></li>
                                                    <li><a>Provinsi : {{ ($user->provinsi) ? $user->provinsi->provinsi : '' }}</a></li>
                                                    <li><a>Kabupaten : {{ ($user->kota) ? $user->kota->kota : '' }}</a></li>
                                                    <li><a>Kecamatan : {{ ($user->kecamatan) ? $user->kecamatan->kecamatan : '' }}</a></li>
                                                    <li><a>Alamat : {{ $user->alamat }}</a></li>
                                                    <li><a>Kode : {{ $user->kode_pos }}</a></li>
                                                    <li><a>Email : {{ $user->email }}</a></li>
                                                    <li><a>No : {{ $user->hp }}</a></li>
                                                </ul>     --}}

                                                <input type="hidden" name="nama" value="{{ $user->nama or '' }}">
                                                <input type="hidden" name="negara" value="{{ ($user->negara) ? $user->negara->negara : '' }}">
                                                <input type="hidden" name="provinsi" value="{{ ($user->provinsi) ? $user->provinsi->provinsi : '' }}">
                                                <input type="hidden" name="kota" value="{{ ($user->kota) ? $user->kota->kota : '' }}">
                                                <input type="hidden" name="kecamatan" value="{{ ($user->kecamatan) ? $user->kecamatan->kecamatan : '' }}">
                                                <input type="hidden" name="kode_pos" value="{{ $user->kode_pos or '' }}">
                                                <input type="hidden" name="email" value="{{ $user->email or '' }}">
                                                <input type="hidden" name="hp" value="{{ $user->hp or '' }}"> 
                                                <textarea name="alamat" readonly="" style="display: none">{{ $user->alamat or '' }}</textarea>

                                            
                                            {{-- <div class="payment-method">
                                                <div class="payment-accordion">
                                                    <div class="order-button-payment">
                                                        <a href="{{ url('syarat-dan-ketentuan') }}" class="btn btn-success btn-lg btn-block" >SYARAT & KETENTUAN</a>
                                                    </div>
                                                </div>
                                            </div><br> --}}
                                            <div class="payment-method">
                                                <div class="payment-accordion">
                                                    <div class="order-button-payment">
                                                        <div class="btn btn-primary btn-lg btn-block checkout-btn" style="display: none">TOTAL HARGA : <b class="totalHarga" data-price="{{ $totalHarga }}">{{'Rp. '. number_format($totalHarga, 2,',','.') }}</b></div>
                                                    </div>
                                                </div>
                                            </div><br>
                                            <div class="payment-method">
                                                <div class="payment-accordion">
                                                    <div class="order-button-payment">
                                                        @if($record->count() > 0)
                                                        <button type="button" id="checkout" class="btn btn-warning save-page save-frontend btn-lg btn-block disabled" data-title="Apakah Data Anda Sudah Benar?" data-confirm="Bayar" data-batal="Batal">Checkout</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div> 

                            </div> 

                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection


@section('js')
<script src="{{ env('MIDTRANS_PLUGIN') }}" data-client-key="{{ config('services.midtrans.clientKey') }}"></script>
<script type="text/javascript">
    var totalberat = 0;
    $(document).on('change','.pilihPengiriman',function(){
        var dataAppend = $(this).data('pengiriman');
        var dataLapak = $(this).data('lapak');
        var dataBerat = $(this).data('berat');
        var dataNum = $(this).data('num');
        var result = $(this).val();
        $.ajax({
            url: '{{ url("keranjang/pengiriman") }}',
            type: 'GET',
            data: {
                kurir_id : result,
                dataAppend : dataAppend,
                lapak_id : dataLapak,
                berat : dataBerat,
                num : dataNum,
            },
            success: function(resp){
                $(dataAppend).html(resp);
            },
            error : function(resp){
            }
        });
    });
    var biayaKirim = 0;
    $(document).on('change','.tipeKurir',function(){
        // var checkHargaKurir = $('.tipeKurir').data('harga').serializeArray();
        // console.log('checkHargaKurir',checkHargaKurir)
        var hari = $(this).data('hari');
        var harga = $(this).data('harga');
        var lapak = $(this).data('lapak');
        biayaKirim += harga;
        var totalkirim = convertToRupiah(biayaKirim);
        // var totalHarga = parseInt($('.totalHarga').text()) + harga;
        $('.kurir_harga_child'+lapak).val(harga);
        $('.kurir_hari_child'+lapak).val(hari);
        $('.biaya-kirim').html(totalkirim);
        var totalKurir = convertToAngka($('.biaya-kirim').text());
        var subtotal = convertToAngka($('.subtotal').text());
        var totalharga = totalKurir + subtotal;
        var total = convertToRupiah(totalharga);
        $('.total').html(total);
        $('#checkout').removeClass('disabled');
    });

    // voucher
    $(document).on('click','.btn-voc',function(){
        var voucher = $('#voucher').val();
        $.ajax({
            url: '{{ url("keranjang/voucher") }}',
            type: 'GET',
            data: {
                voucher : voucher,

            },
            success: function(resp){
                $('.data-voucher').html(resp);
            },
            error : function(resp){
            }
        });
    });

    $(document).on('click','.btn-claim',function(){
        var id = $(this).data('id');
        var price = $(this).data('price');
        var tot = parseInt($('.totalHarga').data('price'));
        var back = '{{ url("keranjang/store") }}';
        console.log(tot - price);
        $.ajax({
            url: '{{ url("keranjang/claim") }}',
            type: 'GET',
            data: {
                id : id,

            },
            success: function(resp){
                // window.location.href = back;
                $('.totalHarga').text(tot - price);
            },
            error : function(resp){
            }
        });
    });
    $(document).on('click','.edit-address',function(){
        var url = $(this).data('url');
		var id = $(this).data('id');
		var titlemodal = $(this).data('title');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,obj);
    });

    $(document).on('click','.edit-phone',function(){
        var url = $(this).data('url');
		var id = $(this).data('id');
		var titlemodal = $(this).data('title');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,titlemodal);
    });

    $(document).on('click','.edit-mail',function(){
        var url = $(this).data('url');
		var id = $(this).data('id');
		var titlemodal = $(this).data('title');
		var obj = {};
		obj.titlemodal = titlemodal;
		loadModal(url,id,titlemodal);
    });
</script>
@endsection

