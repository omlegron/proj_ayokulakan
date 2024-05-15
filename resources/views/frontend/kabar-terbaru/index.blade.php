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
<style>
    

    @media only screen and (max-width: 768px) {
        .tani {
                border-radius: 10px;width: 100%;
            }
            .pilar {
            max-width: 100%;
            position: relative;
            z-index: 1;
            top: 0px;
        }
        .kotak {
            border-bottom-right-radius: 10px;
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
            /* width: 100px;
            height: 40px; */
            background-color:#6ba6cf;
            position: absolute;
            top: 0px;
            z-index: 2;
        }
        .pilar {
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
    }
    @media screen and (min-width: 769px) {
        .tani {
            float: left;
            border-radius: 10px;
            width: 200px;
        }
        .post {
            width : 120px;
        }
        .judul {
            margin-top: -3px;
        }
        .pilar {
            max-width: 100%;
            position: relative;
            z-index: 1;
            top: 0px;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        .kotak {
            border-bottom-right-radius: 10px;
            text-align: center;
            padding-left: 5px;
            padding-right: 5px;
            /* width: 100px;
            height: 40px; */
            background-color:#6ba6cf;
            position: absolute;
            top: 0px;
            z-index: 2;
        }
    }
</style>
@endsection
@section('content-frontend-left')  

<a href="{{ url('/') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
<div class="col-md-12">
    <div class="filters-container" style="margin-bottom: 10px">
        <h2>Kabar Terbaru</h2>
        <hr>
        <div class="filter-tabs">
            <div class="container-fluid">
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row">
                            
                            <?php 
                            for ($i=0; $i < 6; $i++) { 
                            ?>
                        <form action="/baca-berita" method="POST">
                            {{  csrf_field() }}
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 10px;">
                                <div class="media">
                                    
                                    <img class="mr-3 pilar" alt="Bootstrap Media Preview" src="{{ $pilar['gambar_pilar'][$i] }}" style="height:200px; width: 100%"/>
                                    <div class="kotak" style="">
                                        <h4><b>{{ $pilar['upload_pilar'][$i] }}</b></h4>
                                    </div>
                                    <div class="media-body">
                                        <input type="hidden" value="{{ $pilar['href_pilar'][$i] }}" name="href">
                                        <input type="hidden" value="{{ $pilar['judul_pilar'][$i] }}" name="judul">
                                        <input type="hidden" value="{{ $pilar['upload_pilar'][$i] }}" name="upload">
                                        <input type="hidden" value="{{ $pilar['gambar_pilar'][$i] }}" name="gambar">
                                        <input type="hidden" value="{{ $pilar['tgl_pilar'][$i] }}" name="tgl">
                                        <input type="hidden" value="pilar" name="jenis">
                                        <button style="border: none;
                                        background: none;text-align: left"><h4><b>{{ $pilar['judul_pilar'][$i] }}</b></h4></button>
                                        {{-- <h4  style="margin-left: 10px;"><b><a href="{{ $pilar['href_pilar'][$i] }}">{{ $pilar['judul_pilar'][$i] }}</a></b></h4>  --}}
                                        <h5 style="margin-left: 10px;"><b style="color: #3a6d91">{{ $pilar['tgl_pilar'][$i] }}</b></h5> 
                                    </div>
                                </div>
                        </form>
                    </div>
                    <?php } ?>      
                </div>
                        <hr>
                        <?php 
                            for ($i=0; $i < 20; $i++) { 
                        ?>
                        <form action="/baca-berita" method="POST">
                            {{  csrf_field() }}
                            <div class="media">
                                <img class="mr-3 tani" alt="Bootstrap Media Preview" src="{{ $data['gambar'][$i] }}" style=""/>
                                <div class="media-body">
                                    <input type="hidden" value="{{ $data['href'][$i] }}" name="href">
                                    <input type="hidden" value="{{ $data['judul'][$i] }}" name="judul">
                                    <input type="hidden" value="{{ $data['category'][$i] }}" name="upload">
                                    <input type="hidden" value="{{ $data['gambar'][$i] }}" name="gambar">
                                    <input type="hidden" value="{{ $data['tgl'][$i] }}" name="tgl">
                                    <input type="hidden" value="sindo" name="jenis">
                                    <button style="border: none;
                                    background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $data['judul'][$i] }}</b></h4></button>
                                    {{-- <h4  style="margin-left: 20px;"><b><a href="{{ $data['href'][$i] }}">{{ $data['judul'][$i] }}</a></b></h4>  --}}
                                    <h5 style="margin-left: 20px;"><b style="color: #3a6d91">{{ $data['category'][$i] }}</b> - {{ $data['tgl'][$i] }}</h5> 
                                    <h5 style="margin-left: 20px">{{ $data['isi'][$i] }}</h5> 
                                    
                                </div>
                            </div>
                            <hr>
                            {{-- <h3>{{ $data['judul'][$i] }}</h3> --}}
                            {{-- <h3>{{ $item['isi'][5] }}</h3> --}}
                        </form>
                            <?php } ?>
                            
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Berita Lainnya</h3>
                        <hr>
                        <?php 
                            for ($i=0; $i < 6; $i++) { 
                        ?>
                        <form action="/baca-berita" method="POST">
                            {{  csrf_field() }}
                            <div class="media">
                                {{-- <img class="mr-3 post tani" alt="Bootstrap Media Preview" src="{{ $post_terbaru['gambar_tani'][$i] }}" style=""/> --}}
                                <div class="media-body">
                                    <input type="hidden" value="{{ $post_terbaru['href_tani'][$i] }}" name="href">
                                    <input type="hidden" value="{{ $post_terbaru['judul_tani'][$i] }}" name="judul">
                                    <input type="hidden" value="{{ $post_terbaru['upload'][$i] }}" name="upload">
                                    {{-- <input type="hidden" value="{{ $data['gambar'][$i] }}" name="gambar"> --}}
                                    <input type="hidden" value="{{ $post_terbaru['tgl_tani'][$i] }}" name="tgl">
                                    <input type="hidden" value="saria" name="jenis">
                                    <button style="border: none;
                                    background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $post_terbaru['judul_tani'][$i] }}</b></h4></button>
                                    {{-- <h4 class="judul" style="margin-left: 20px;"><b><a href="{{ $post_terbaru['href_tani'][$i] }}"> {{ $post_terbaru['judul_tani'][$i] }}</a></b></h4>  --}}
                                    <h5 style="margin-left: 20px;"><b style="color: #3a6d91">{{ $post_terbaru['upload'][$i] }}</b> - {{ $post_terbaru['tgl_tani'][$i] }}</h5> 
                                    
                                </div>
                            </div>
                            <hr>
                            </form>
                            <?php } ?>
                    </div>
                </div>
            
            </div>
            
        </div><!-- /.filter-tabs -->
        <p>Sumber Data : </p>
        <a href="https://www.jpnn.com/tag/pertanian">https://www.jpnn.com/tag/pertanian</a><br>
        <a href="https://pilarpertanian.com/">https://pilarpertanian.com/</a><br>
        <a href="https://sariagri.id/pertanian">https://sariagri.id/pertanian</a><br><br>
    </div>
</div>
@endsection
