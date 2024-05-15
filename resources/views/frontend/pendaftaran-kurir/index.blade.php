@extends('layouts.scaffold-sidebar-right')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
formRules = {
    judul: ['empty'],
};
</script>
@endsection
@section('css')
    <style type="text/css">
    .ft0{font: bold 32px 'Arial';color: #ffc000;line-height: 37px;}
    .ft1{font: bold 32px 'Arial';color: #00b050;line-height: 37px;}
    .ft2{font: bold 19px 'Arial';line-height: 22px;}
    .ft3{font: 15px 'Arial';line-height: 17px;}
    .ft4{font: 15px 'Times New Roman';line-height: 17px;}
    .ft5{font: 15px 'Arial';margin-left: 12px;line-height: 17px;}
    .ft6{font: 11px 'Arial';line-height: 14px;}
    .ft7{font: 15px 'Arial';line-height: 16px;}
    .ft8{font: 15px 'Arial';margin-left: 16px;line-height: 17px;}
    .ft9{font: 15px 'Arial';margin-left: 13px;line-height: 17px;}
    .ft10{font: 15px 'Arial';margin-left: 14px;line-height: 17px;}
    .ft11{font: 15px 'Arial';margin-left: 10px;line-height: 17px;}
    .ft12{font: 15px 'Arial';margin-left: 8px;line-height: 17px;}
    .ft13{font: 15px 'Arial';margin-left: 9px;line-height: 17px;}
    .ft14{font: 15px 'Arial';color: #0000ee;line-height: 17px;}
    .ft15{font: 15px 'Arial';color: #222222;line-height: 17px;}
    .ft16{font: bold 15px 'Arial';color: #0000ee;line-height: 18px;}
    .terms-conditions-page{
        padding-top: 0px !important;
    }
    </style>
@endsection
@section('content-frontend-left')
<a href="{{ url('/') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
    <div class="col-sm-12 col-md-12" style="padding: 0px; margin-top: -15px">
        @include('frontend.home.partial.pilihan')
        <div class="filters-container">
            <h1 class="heading-title section-title">Daftar Menjadi Kurir</h1>
            <div class="filter-tabs">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @if($recordKurir)
                                <center>
                                <div class="contact-address-area">
                                    <h3>Anda Telah Menjadi Kurir Ayokulakan</h3>
                                    <hr>
                                    <h3>Kartu Kurir (Youkuy Kurir)</h3>
                                    <h5>Kartu kurir merupakan tanda pengenal atau kartu pegangan untuk seseorang yang mendaftar dan
                                        sudah terdaftar di ayokulakan.com sebagai kurir.
                                        </h5>
                                    <img src="{{ asset('img/yokuy_kurir.png') }}" alt="" style="margin-bottom: 20px; width: 80%"> 
                                    <p>* Silakan download & cetak kartu Kurir di bawah ini </p>
                                    <img src="{{ url('img/download.png') }}" class="img-responsive" style="width:auto;height:200px" alt="">
                                    <br>
                                    <div class="form-group">
                                        <button id="downloadImg" type="button" data-url="{{route('kartu_yokurir.card')}}" class="btn btn-primary">
                                        <span class="fa fa-download"></span> Download Kartu
                                        </button>
                                    </div>
                                </div>
                            </center>
                            @else
                            <center>
                                <div class="contact-address-area">
                                    <h3>Mengerti Dengan Syarat & Ketentuan</h3>
                                    <p>
                                        Jika dapat dimengerti dari syarat & ketentuan kurir,
                                        silahkan bergabung untuk menjadi kurir di bawah ini.
                                    </p>
                                    <ul>
                                        <li >
                                            <a href="{{ url($pageUrl.'pendaftaran') }}" class="btn btn-success"><span class="cui-contrast"></span> Daftar Yokuy Kurir</a>
                                        </li>
                                    </ul>
                                </div>
                            </center>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
