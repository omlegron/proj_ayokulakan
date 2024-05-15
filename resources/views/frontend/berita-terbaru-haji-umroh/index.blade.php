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
    .tani {
        float: left;
        border-radius: 10px;
        width: 200px;
    }
    @media only screen and (max-width: 768px) {
        .tani {
            border-radius: 10px;
            width: 100%;
            float: none;
        }
    }  
</style>
@endsection
@section('content-frontend-left')
<a href="{{ url('/') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
<div class="col-md-12">
    <div class="filters-container" style="margin-bottom: 10px">
        <h2>Berita Terbaru</h2>
        <hr>
        <div class="filter-tabs">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="row">
                            <?php 
                                for ($i=0; $i < $jumlah; $i++) { 
                            ?>
                                <form action="/baca-haji" method="POST">
                                    {{  csrf_field() }}
                                    <div class="media">
                                        <img class="mr-3 tani" alt="Bootstrap Media Preview" src="{{ $haji['gambar'][$i] }}" style=""/>
                                        <div class="media-body">
                                            <input type="hidden" value="{{ $haji['href'][$i] }}" name="href">
                                            <input type="hidden" value="{{ $haji['judul'][$i] }}" name="judul">
                                            {{-- <input type="hidden" value="{{ $data['category'][$i] }}" name="upload"> --}}
                                            <input type="hidden" value="{{ $haji['gambar'][$i] }}" name="gambar">
                                            <input type="hidden" value="{{ $haji['tgl'][$i] }}" name="tgl">
                                            <input type="hidden" value="ihram" name="jenis">
                                            <button style="border: none;
                                            background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $haji['judul'][$i] }}</b></h4></button>
                                            {{-- <h3 class="judul" style="margin-left: 20px;"><b><a href="{{ $haji['href'][$i] }}">{{ $haji['judul'][$i] }}</a></b></h3>  --}}
                                            <h5 style="margin-left: 20px;"><b style="color: #3a6d91"></b>{{ $haji['tgl'][$i] }}</h5> 
                                            {{-- <h5 style="margin-left: 20px">{{ $haji['isi'][$i] }}</h5>  --}}
                                            
                                        </div>
                                    </div>
                                    <hr>
                                    {{-- <h3>{{ $data['judul'][$i] }}</h3> --}}
                                    {{-- <h3>{{ $item['isi'][5] }}</h3> --}}
                                </form>

                            <?php } ?>
                        </div>
                            
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <h3>Berita Lainnya</h3>
                        <hr>
                        <?php 
                            for ($i=0; $i < 10; $i++) { 
                        ?>
                            <form action="/baca-haji" method="POST">
                                {{  csrf_field() }}
                                {{-- <div class="media"> --}}
                                    {{-- <img class="mr-3 post tani" alt="Bootstrap Media Preview" src="{{ $post_terbaru['gambar_tani'][$i] }}" style=""/> --}}
                                    {{-- <div class="media-body"> --}}
                                        <input type="hidden" value="{{ $post_terbaru['href_tani'][$i] }}" name="href">
                                        <input type="hidden" value="{{ $post_terbaru['judul_tani'][$i] }}" name="judul">
                                        {{-- <input type="hidden" value="{{ $data['category'][$i] }}" name="upload"> --}}
                                        {{-- <input type="hidden" value="{{ $haji['gambar'][$i] }}" name="gambar"> --}}
                                        <input type="hidden" value="{{ $post_terbaru['tgl_tani'][$i] }}" name="tgl">
                                        <input type="hidden" value="republik" name="jenis">
                                        <button style="border: none;
                                        background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $post_terbaru['judul_tani'][$i] }}</b></h4></button>
                                        {{-- <h4 class="" style="margin-left: 20px;"><b><a href="{{ $post_terbaru['href_tani'][$i] }}"> {{ $post_terbaru['judul_tani'][$i] }}</a></b></h4>  --}}
                                        <h5 style="margin-left: 20px;"><b style="color: #3a6d91">{{ $post_terbaru['upload'][$i] }}</b> - {{ $post_terbaru['tgl_tani'][$i] }}</h5> 
                                        
                                    {{-- </div> --}}
                                {{-- </div> --}}
                                <hr>
                            </form>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
