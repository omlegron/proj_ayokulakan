@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty'],
    };
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <div class="row">
        <div class="col-md-12 terms-conditions">
            <h2 class="heading-title">Detail Orderan</h2>
            <center><h4 class="">Untuk No Order <span class="text-danger">{{ $record->order_id or '' }}</span> Status <span class="text-danger">{{ $status->transaction_status or '' }}</span></h4></center>
            <center><h4 class="">Batas Pembayaran Terakhir Pada <span class="text-danger">{{ $batasPembayaran }}</span></h4></center>

            <div class="container">
                <div class="content-ayokulakan">
                    <form id="dataFormPage" action="{{ url($pageUrl.'store-mt') }}" method="POST">
                        {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="checkbox-form">
                                    <h3>Data Pemesan</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group country-select mb-30">
                                                <label>Nama <span class="required">*</span></label>
                                                <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $user->nama or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Negara <span class="required">*</span></label>
                                                <input type="text" name="negara" class="form-control" placeholder="Negara" value="{{ $user->negara->negara or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Provinsi <span class="required">*</span></label>
                                                <input type="text" name="provinsi" class="form-control" placeholder="Provinsi" value="{{ $user->provinsi->provinsi or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Kabupaten / Kota <span class="required">*</span></label>
                                                <input type="text" name="kota" class="form-control" placeholder="Kabupaten / Kota" value="{{ $user->kota->kota or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group country-select mb-30">
                                                <label>Kecamatan <span class="required">*</span></label>
                                                <input type="text" name="kecamatan" class="form-control" placeholder="Kecamatan" value="{{ $user->kecamatan->kecamatan or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group checkout-form-list">
                                                <label>Alamat <span class="required">*</span></label>
                                                <textarea name="alamat" placeholder="Alamat" class="form-control" readonly="">{{ $user->alamat or '' }}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group checkout-form-list mb-30">
                                                <label>Kode Pos <span class="required">*</span></label>
                                                <input type="text" name="kode_pos" class="form-control" placeholder="Kode Pos" value="{{ $user->kode_pos or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group checkout-form-list mb-30">
                                                <label>Email <span class="required">*</span></label>
                                                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ $user->email or '' }}" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group checkout-form-list mb-30">
                                                <label>No Hp  <span class="required">*</span></label>
                                                <input type="text" name="hp" class="form-control" placeholder="No Hp" value="{{ $user->hp or '' }}" readonly="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="checkout-progress-sidebar ">
                                    <div class="panel-group">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="unicase-checkout-title">Pesanan Anda</h4>
                                            </div>
                                            <div class="">
                                                <ul class="nav nav-checkout-progress list-unstyled">
                                                    @if($record->detail->count() > 0)
                                                        @foreach($record->detail as $k => $value)
                                                            <li style="margin-top: 10px">
                                                                <div class="col-md-8" >
                                                                    <a href="javascript:void(0)">
                                                                        @if($value->form_type == 'img_rental')
                                                                            {{ $value->form->judul or '' }} <strong class="product-quantity">( {{ $value->jumlah_barang or '' }} ) x {{ number_format($value->form->harga_sewa, 2, ',', '.')  }}</strong>
                                                                        @else
                                                                            {{ $value->form->nama_barang or '' }} <strong class="product-quantity">( {{ $value->jumlah_barang or '' }} ) x {{ ($value->form && isset($value->form->harga_barang)) ? moneyFormat($value->form->harga_barang) : 0 }}</strong>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <span class="amount">
                                                                        @if($value->form_type == 'img_barang')
                                                                            {{-- {{ $value->form->harga_barang * $value->jumlah_barang }} --}}
                                                                            <?php echo 'Rp. '. number_format($value->form->harga_barang * $value->jumlah_barang, 2, ",", "."); ?>
                                                                        @elseif($value->form_type == 'img_rental')
                                                                            {{-- {{ $value->form->harga_sewa * $value->jumlah_barang }} --}}
                                                                            <?php echo 'Rp. '. number_format($value->form->harga_sewa * $value->jumlah_barang, 2, ",", "."); ?>

                                                                        @else
                                                                            {{-- {{ $value->form->jadwal->harga or '' }} --}}
                                                                            <?php echo 'Rp. '. number_format($value->form->jadwal->harga, 2, ",", "."); ?>

                                                                        @endif
                                                                    </span>
                                                            </li><hr>
                                                        @endforeach
                                                        <li>
                                                            <div class="col-md-8">
                                                                <a href="javascript:void(0)">
                                                                    @if($record->kurir)
                                                                        ({{ $record->kurir->form->nama or '' }}) - {{  $record->kurir->kurir_child_tipe  }} ({{ $record->kurir->kurir_child_hari }})
                                                                    @endif
                                                                </a>
                                                            </div>&nbsp;&nbsp;&nbsp;
                                                            <span class="amount">
                                                                @if($record->kurir)
                                                                    {{-- {{  $record->kurir->kurir_child_harga  }} --}}
                                                                    <?php echo 'Rp. '. number_format($record->kurir->kurir_child_harga, 2, ",", "."); ?>

                                                                @endif  
                                                            </span>
                                                            </a>
                                                        </li>
                                                    @elseif($record->kereta)
                                                        @if(count($record->kereta) > 0)
                                                        @foreach($record->kereta as $k => $value)
                                                        <li>
                                                                Tiket Kereta Tujuan ({{ $value->org or '' }} | {{ $value->dest or '' }})
                                                                <span class="amount">Rp. {{ $value->ticketPrice or '' }}</span>
                                                        </li>
                                                        @endforeach
                                                        @endif
                                                    @elseif($record->prepaid)
                                                    <li>
                                                            ({{ $record->prepaid->form->pulsa_op or '' }} | {{ $record->prepaid->form->pulsa_nominal or '' }})
                                                            <span class="amount">Rp. {{ $record->prepaid->form->pulsa_price or '' }}</span>
                                                    </li>
                                                    @elseif($record->postpaid)
                                                    <li>
                                                            ({{ $record->postpaid->type or '' }} | {{ $record->postpaid->pelanggan or '' }} - {{ $record->postpaid->tr_name or '' }}) - Periode {{ Carbon\Carbon::parse($record->postpaid->period)->format('Y-m') }}
                                                            <span class="amount">Rp. {{ $record->postpaid->ttl_harga or '' }}</span>
                                                    </li>
                                                    @endif
                                                </ul><br>
                                                @php
                                                    $total = 0;
                                                        if($record->detail->count() > 0){
                                                        foreach($record->detail as $k => $value){
                                                        $total += $value->total_harga;
                                                    }
                                                }
                                                @endphp
                                                <ul style="margin-left: 10px">
                                                    <li>
                                                        <b >
                                                            <strong><h5>Total Orderan :  <?php echo 'Rp. '. number_format($record->total_harga, 2, ",", "."); ?></h5></strong>
                                                            @if(isset($status->va_numbers[0]))
                                                            <strong><h4> Bank yang Digunakan :  {{ strtoupper($status->va_numbers[0]->bank) }}</h4></strong>
                                                            <strong><h4> No. Rekening :   <p><h3 id="p1" >{{ $status->va_numbers[0]->va_number }}</h3> 
                                                                <a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Rek.</a></p></h4></strong>
                                                            <hr>
                                                            @elseif(isset($status->permata_va_number))
                                                            <strong><h4> No. Rekening :   <p><h3 id="p1" >{{ $status->permata_va_number }}</h3> 
                                                                <a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Rek.</a></p></h4></strong>
                                                            <hr>
                                                            @elseif(isset($status->biller_code))
                                                            <strong><h4> Kode Perusahaan :  {{ $status->biller_code }}</h4></strong>
                                                            <strong><h4> Kode Pembayaran :   <p><h3 id="p1" >{{ $status->bill_key }}</h3> 
                                                                <a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Kode</a></p></h4></strong>
                                                            <hr>
                                                            @elseif(isset($status->payment_code))
                                                            <strong><h4> Store yang Digunakan :   <p><h3 >{{ ucwords($status->store) }}</h3> 
                                                                <hr>
                                                            <strong><h4> Kode Pembayaran :   <p><h3 id="p1" >{{ $status->payment_code }}</h3> 
                                                                <a type="btn" class="btn btn-primary" onclick="copyToClipboard('#p1')">Salin Kode</a></p></h4></strong>
                                                            <hr>
                                                            @endif
                                                            <strong><h4>Total Orderan :  <?php echo 'Rp. '. number_format($record->total_harga, 2, ",", "."); ?></h5></strong>
                                                        </b>
                                                    </li>
                                                </ul>
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
    </div>
</div>
@endsection

{{-- <script type="text/javascript">
    function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script> --}}