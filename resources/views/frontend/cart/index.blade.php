@extends('layouts.scaffold')

@section('css')
<style type="text/css">
    .outer-top {
        margin-top: 200px;
    }
    tr > td , 
    tr > th{
        border: none !important;
    }
    .nice-number button{
		background: #db700c;
		color: #ffffff;
		padding: 0px 10px;
		border: none;
	}
    @media screen and (max-width: 768px) {
        .outer-top {
            margin-top: 400px;
        }
    }
</style>
@endsection

@section('content-frontend')
<div class="container">
    <form id="dataFormModal" action="{{ url($pageUrl.'pembayaran') }}" method="POST">
        {!! csrf_field() !!}
        <div class="row" style="margin-top: 10px">
            <div class="col-md-8">
                <div class="scroll-tabs fadeinUp wow">
                    <div class="more-info-tab clearfix">
                        <table class="table table-borderless">
                            <tr>
                                <td colspan="3">
                                    <h4>Keranjang Barang</h4>
                                </td>
                            </tr>
                            @if ($record->count() > 0)
                                <tr>
                                    <td>
                                        <input type="checkbox" id="selectall">
                                    </td>
                                    <td>
                                        <p>Pilih Semua</p>
                                    </td>
                                </tr>
                                @php
                                    $i = 0;
                                @endphp
                                @foreach ($record as $key => $value)
                                    @php        
                                        $i++;
                                        $lapak = \App\Models\Lapak\Lapak::find($key);
                                    @endphp
                                    @if ($lapak)
                                        <tr>
                                            <td width="20">
                                                <input type="checkbox" class="lapak{{ $lapak->id }} lapaks" value="{{ $lapak->id }}">
                                            </td>
                                            <td><p>{{ $lapak->nama_lapak }}</p></td>
                                        </tr>
                                        @if ($value->count() > 0)
                                            @foreach ($value as $k => $item)
                                                @if($item->form_type == 'img_barang')
                                                    <tr>
                                                        @if ($item->form->lapak)
                                                            <td>
                                                                <input type="checkbox" value="{{ $item->id or '' }}" class="custom-control-input appendTotalHarga{{ $lapak->id }} custome-length" id="customCheck{{$item->id}}" name="accept[barang][{{$item->id or ''}}]" data-url="{{ $item->form->harga_barang }}" data-key="{{ $item->id or '' }}" data-lapak="{{ $lapak->id }}">
                                                            </td>
                                                        @endif
                                                        @if ($item->form->attachments->first())
                                                            @if (isset($item->form->attachments->first()->url))
                                                                <td>
                                                                    <img src="{{ ($item->form->attachments->first()) ? url('storage/'.$item->form->attachments->first()->url) : url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px">
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px">
                                                                </td>
                                                            @endif
                                                            @else
                                                            <td>
                                                                <img src="{{ url('img/no-images.png') }}" alt="" style="width: 69px; height: 69px">
                                                            </td>
                                                        @endif
                                                        <td>
                                                            <h3>{{ str_limit($item->form->nama_barang,25) }} <span style="color: #e61616; font-size: 18px">Rp {{ number_format($item->form->harga_barang,2,',','.') }}</span></h3>
                                                        </td>
                                                        <td>
                                                            <div class="nice-number">
                                                                <input type="number" name="accept[jumlah_barang][{{$item->id or ''}}]" value="{{ $item->jumlah_barang or '' }}" class="qty{{ $item->id }}" data-id="{{ $item->id }}" style="width: 4ch; margin: 0px 5px;" id="jumlah">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td colspan="2">
                                                            <span style="color: #e67b16; font-weight: 600;">Hanya {{ $item->form->stock_barang }} barang yang tersedia</span>
                                                        </td>
                                                        <td>
                                                            <div style="display: flex">
                                                                <button type="button" style="border: none; background:none; font-size:24px" class="show custom-front-load-show" data-url="{{ url('/favorit/'.$item->id_barang) }}" data-id="{{ $item->id_barang }}" data-titlemodal="List Favorit Barang">
                                                                    <i class="fa fa-heart" style="color: #e61616"></i>
                                                                </button>
                                                                <button type="button" class="ampass remove-cart" data-id="{{$item->id}}" data-url="{{ url('keranjang/hapus') }}" style="border: none; background:none; font-size:24px">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endif
                                @endforeach
                            @endif
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="scroll-tabs fadeinUp wow">
                    <div class="more-info-tab clearfix">
                        <table class="table table-borderless">
                            <tr>
                                <th>Detail Pesanan</th>
                            </tr>
                            <tr>
                                <th>
                                    Subtotal
                                </th>
                                <td>
                                    <p style="text-align: end"><span class="subtotal">Rp.0</span></p>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Total
                                </th>
                                <td>
                                    <p style="text-align: end"><span class="subtotal">Rp.0</span></p>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div class="" style="display: flex">
                                        <input type="text" class="form-control" id="voucher" style="border-radius: 0" placeholder="Masukan Kode Voucher">
                                        <div class="float-right">
                                            <button type="button" class="btn btn-warning btn-voc" data-price="{{ $harga or '' }}" style="border-radius: 0">Gunakan</button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <button type="button" class="btn btn-warning save-modal save-frontend next-page btn-block disabled" id="checkout">
                                        Checkout Pesanan (<span class="lengthtotal">0</span>)
                                    </button>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection


@section('js')
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="number"]').niceNumber({
            autoSize:true,
            autoSizeBuffer: 1,
            buttonDecrement:'-',
            buttonIncrement:"+",
            buttonPosition:'around'

        });
    });
    
    $(document).on('click','#selectall',function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));
        if($("input[type=checkbox]").is(':checked')){
            var total = 0;
            var cekharga = 0;
            var lengh = 0;
            $("input[type='checkbox']:checked").each(function(){
                var value = $(this).data('url');
                id = $(this).data('key');
                if(value !== undefined){
                    qty = $('.qty'+id).val();
                    cekharga = parseInt(value) * qty;
                    $("#boxes input[type='checkbox']:checked")
                    total += cekharga;
                    var con = convertToRupiah(total);
                    $('.subtotal').html(con); 
                    $('#checkout').removeClass('disabled');
                    lengh = $(".custome-length:checked").length;
                    $('.lengthtotal').html(length);
                }
            });

        }else{
            $('.subtotal').html('Rp.0');
            $('#checkout').addClass('disabled');
            $('.lengthtotal').html('0');
        }
    });
    $(document).on('input','#jumlah',function(){
        var total = 0;
        var cekharga = 0;
        var idqty = $(this).data('id');
        if($("input[type=checkbox]").is(':checked')){
            $("input[type='checkbox']:checked").each(function(){
                var value = $(this).data('url');
                id = $(this).data('key');
                if(value !== undefined){
                    qty = $('.qty'+id).val();
                    if(qty < 1){
                        qty = $('.qty'+id).val('1');
                        cekharga = parseInt(value) * 1;
                        total += cekharga;
                        var con = convertToRupiah(total); 
                        $('.subtotal').html(con); 
                        $('#checkout').removeClass('disabled');
                    }else{
                        cekharga = parseInt(value) * qty;
                        total += cekharga;
                        var con = convertToRupiah(total); 
                        $('.subtotal').html(con); 
                        $('#checkout').removeClass('disabled');
                    }
                }
            });

        }else{
            if($('.qty' + idqty).val() < 1){
                $('.qty' + idqty).val('1');
            }
            $('.subtotal').html('Rp.0');
            $('#checkout').addClass('disabled');
            $('.lengthtotal').html('0');
        }
        
    });
    $(document).on('click','.lapaks',function(){
        var id = $(this).val();
        if(this.checked){
            $('.appendTotalHarga'+id).each(function(){
                this.checked = true;
            });
            var total = 0;
            var cekharga = 0;
            var lengh = 0;
            $("input[type='checkbox']:checked").each(function(){
                var value = $(this).data('url');
                id = $(this).data('key');
                if(value !== undefined){
                    qty = $('.qty'+id).val();
                    cekharga = parseInt(value) * qty;
                    $("#boxes input[type='checkbox']:checked")
                    total += cekharga;
                    var con = convertToRupiah(total);
                    $('.subtotal').html(con); 
                    $('#checkout').removeClass('disabled');
                    lengh = $(".custome-length:checked").length;
                    $('.lengthtotal').html(length);
                }
            });
        }else{
            $('.appendTotalHarga'+id).each(function(){
                this.checked = false;
            });
            var total = 0;
            var cekharga = 0;
            var lengh = 0;
            $("input[type='checkbox']:checked").each(function(){
                var value = $(this).data('url');
                id = $(this).data('key');
                if(value !== undefined){
                    qty = $('.qty'+id).val();
                    cekharga = parseInt(value) * qty;
                    $("#boxes input[type='checkbox']:checked")
                    total += cekharga;
                    var con = convertToRupiah(total);
                    $('.subtotal').html(con); 
                    $('#checkout').removeClass('disabled');
                    lengh = $(".custome-length:checked").length;
                    $('.lengthtotal').html(length);
                }
            });
        }
    });
    $(document).on('click','.custome-length',function(){
        var id = $(this).data('lapak');
        if(this.checked){
            var total = 0;
            var cekharga = 0;
            var lengh = 0;
            $("input[type='checkbox']:checked").each(function(){
                $('.lapak'+id).each(function(){
                    this.checked = true;
                });
                var value = $(this).data('url');
                id = $(this).data('key');
                if(value !== undefined){
                    qty = $('.qty'+id).val();
                    cekharga = parseInt(value) * qty;
                    $("#boxes input[type='checkbox']:checked")
                    total += cekharga;
                    var con = convertToRupiah(total);
                    $('.subtotal').html(con); 
                    $('#checkout').removeClass('disabled');
                    lengh = $(".custome-length:checked").length;
                    $('.lengthtotal').html(length);
                }
            });
        }else{
            var total = 0;
            var cekharga = 0;
            var lengh = 0;
            $("input[type='checkbox']:checked").each(function(){
                $('.lapak'+id).each(function(){
                    this.checked = true;
                });
                var value = $(this).data('url');
                id = $(this).data('key');
                if(value !== undefined){
                    qty = $('.qty'+id).val();
                    cekharga = parseInt(value) * qty;
                    $("#boxes input[type='checkbox']:checked")
                    total += cekharga;
                    var con = convertToRupiah(total);
                    $('.subtotal').html(con); 
                    $('#checkout').removeClass('disabled');
                    lengh = $(".custome-length:checked").length;
                    $('.lengthtotal').html(length);
                }
            });
        }
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
</script>
@endsection

