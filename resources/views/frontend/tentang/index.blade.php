@extends('layouts.scaffold')

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
    .ft3{font: 15px 'Arial';line-height: 17px; font-family: verdana}
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

    .terms-conditions {
        margin-top: 120px;
        text-align: justify;
    }
    .terms-conditions-page{
        padding-top: 0px !important;
    }

    @media only screen and (max-width: 768px) {
        .terms-conditions {
            margin-top: 220px;
            padding: 0 20px 0 40px;
        }
    }
    </style>
@endsection
@section('content-frontend')
<div class="terms-conditions-page">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px; "></i></a>
    <div class="col-xs-12 col-md-12">
        <div class="row">
                <div class="container" id="page_1">
                    <div id="id1_1">
                        <p class="p0 ft1" style="text-align: center">
                            <span class="ft0">Ayo</span>kulakan <img src="data:image/png;base64,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" id="p1inl_img2">
                        </p>
                    </div>
                    <div id="id1_2">
                        <p class="p1 ft3 text-justify" style="padding: 5px 10px">Ayokulakan didirikan berdasarkan Akta Pendirian Perseroan Komanditer pada tanggal 11 Maret 2019 nomor 5 dan SK.KEMENTERIAN HUKUM dan HAM.RI No.AHU-51.AH.02.01-TH.2011
                        Tanggal 14 Januari 2011, dengan tujuan utama untuk dapat membantu para petani maupun peternak dalam memasarkan produknya baik itu dalam kondisi mentah maupun matang, bukan
                        saja para petani maupun peternak yang diuntungkan, para pemilik angkutan barangpun akan ikut diuntungkan dengan adanya pemilihan jasa pengiriman yang menggunakan angkutan
                        mereka yang akan mempercepat proses pengiriman barang.</p>
                    </div>
                </div>
            </div>
            <h3 style="text-align: center; font-weight:bold;">Keuntungan Menggunakan Applikasi <span style="color: orange">AYO</span><span style="color: #00b050">KULAKAN</span></h3>
            <div class="col-md-12">
                <div class="scroll-tabs">
                    <div class="more-info-tab clearfix">
                        <div class="row">
                            <div class="col-md-4" style="height: 250px">
                                <div class="text-center">
                                    <img src="{{ asset('img/tentang/Data-penjualan.JPG') }}" alt="" class="card-img-top" height="200" width="135">
                                    <div class="card-body">
                                        <p>Data Penjualan akan lebih rapih dan tertata.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="height: 250px">
                                <div class="card text-center">
                                    <img src="{{ asset('img/tentang/data-penjualan-terbanyak.JPG') }}" alt="" class="card-img-top" height="200" width="135">
                                    <div class="card-body">
                                        <p class="card-text">Akan muncul data penjualan terbanyak yang
                                        akan dijadikan patokan untuk produksi para
                                        petani maupun peternak.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="height: 250px">
                                <div class="card text-center">
                                    <img src="{{ asset('img/tentang/petani-dan-pertenak.JPG') }}" alt="" class="card-img-top" height="200" width="135">
                                    <div class="card-body">
                                        <p class="card-text">Petani dan peternak ikan tidak akan
                                        kebingungan menjual hasil pertanian dan
                                        peternakan mereka.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="height: 250px">
                                <div class="card text-center">
                                    <img src="{{ asset('img/tentang/Pemilik-angkutan.JPG') }}" alt="" class="card-img-top" height="200" width="135">
                                    <div class="card-body">
                                        <p class="card-text">Pemilik angkutan barang akan lebih mudah
                                        mendapatkan pekerjaan.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="height: 250px">
                                <div class="card text-center">
                                    <img src="{{ asset('img/tentang/Kemudahan-dalam-transaksi.JPG') }}" alt="" class="card-img-top" height="200" width="135">
                                    <div class="card-body">
                                        <p class="card-text">Kemudahan dalam melakukakan transaksi.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4" style="height: 250px">
                                <div class="card text-center">
                                    <img src="{{ asset('img/tentang/Pemilik-jasa-pengiriman.JPG') }}" alt="" class="card-img-top" height="200" width="135">
                                    <div class="card-body">
                                        <p class="card-text">Pemilik jasa pengiriman yang beragam.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center"><p class="p3 ft2">VISI DAN MISI</p></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="scroll-tabs">
                                <div class="more-info-tab clearfix">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{ asset('img/tentang/tentang-visi.JPG') }}" alt="" srcset="" height="144" width="169">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="card-text"><h1>VISI</h1></div>
                                                <p>Meningkatkan martabat manusia,
                                                    kesejahteraan dan kedamaian dengan
                                                    bermuamalat (jual-beli) secara syar'i.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="scroll-tabs">
                                <div class="more-info-tab clearfix">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <img src="{{ asset('img/tentang/tentang-misi.JPG') }}" alt="" srcset="" height="144" width="169">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <div class="card-text"><h1>MISI</h1></div>
                                                <p>Melakuakan dengan jujur, sabar, menepati,
                                                    berkeseimbangan, dan menghormati hak
                                                    orang lain karena Allah.</p>
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
    </div>
</div>
    {{-- <main class="outer-top"></main>
    <div class="terms-conditions-page">
        <div class="row" style="margin: 50px 0 0">
            <div class="col-md-12 terms-conditions">
                <h2 class="heading-title">Tentang Ayokulakan</h2>
                <div class="">
                    <p>
                    {!! $record->deskripsi or '' !!}
                    </p>
                </div>
            </div>
        </div>
    </div> --}}

@endsection
