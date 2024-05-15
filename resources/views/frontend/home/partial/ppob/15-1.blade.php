<script type="text/javascript">
    $('.selectpicker').selectpicker();

</script>
<div class="row">
    <div class="col-md-12 mt-15 mt-lg-0">
        <div class="tab-content">
            <div class="tab-pane active show tab-pane-ampas" irole="tabpanel" style="background-color: #ffeee2;">
                <div class="myaccount-content">
                    <h3 style="padding: 10px"> {{ $record['tr_name'] or '' }}</h3>
                    <p class="mb-0">
                    <div class="content-ayokulakan" style="padding-top: 12px">
                        <form id="dataFormPageTelepon" action="{{ url('ppob-pasca/store') }}" method="POST">
                            {!! csrf_field() !!}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <input type="hidden" name="ppob_pelanggan" class="form-control"
                                            placeholder="Nomor Pelanggan" value="{{ $record['hp'] or '' }}">
                                        
                                        <input type="hidden" name="type" value="{{ $record['code'] or '' }}">
                                        <input type="hidden" name="types" value="telepon">
                                        <input type="hidden" name="form_type" value="ppob_telepon">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label><b>Nama Pelanggan :</b></label>
                                                {!! $record['tr_name'] or '' !!} <br>
                                                <label><b>No. Pelanggan :</b></label>
                                                {!! $record['hp'] or '' !!} <br>
                                                <label><b>Jumlah Tagihan :</b></label>
                                                {!! $record['desc']->jumlah_tagihan or '' !!} <br><br>

                                                <div class="container">
                                                    <div class="row" style="margin-left: 30px">
                                                        <h5><b>Tagihan Per Bulan</b></h5>
                                                        <div class="col-md-12">
                                                            @foreach ($record['desc']->tagihan->detail as $item)
                                                
                                                <label><b>Periode :</b></label>
                                                {!! $item->periode or '' !!}
                                                 <br>
                                                 <label><b>Biaya Admin :</b></label>
                                                 <?php echo 'Rp. '. number_format($item->admin, 0, ".", "."); ?>
                                                 <br>
                                                 <label><b>Tagihan :</b></label>
                                                 <?php echo 'Rp. '. number_format($item->nilai_tagihan, 0, ".", "."); ?> <br>
                                                <label><b>Total Tagihan Periode {!! $item->periode or '' !!} :</b></label>
                                                <?php echo 'Rp. '. number_format($item->total, 0, ".", "."); ?> <br><br>
                                                
                                                @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                <label><b>Total Biaya Admin :</b></label>
                                                <?php echo 'Rp. '. number_format($record['admin'], 0, ".", "."); ?><br>
                                                <label><b>*Total Pembayaran :</b></label>
                                                <?php echo 'Rp. '. number_format($record['price'], 0, ".", "."); ?> <br>
                                                
                                                
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="padding-top: 33px">
                                            @if (\Auth::check())
                                                <button type="button" class="btn btn-success save-page save-frontend pull-right"
                                                    data-title="Bayar Sekarang ? Pastikan Nomor Sudah Benar."
                                                    data-confirm="Bayar" data-batal="Batal"
                                                    data-forms="dataFormPageTelepon"><i class="ion-ios-plus"></i> Bayar
                                                    Sekarang</button>
                                            @else
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
