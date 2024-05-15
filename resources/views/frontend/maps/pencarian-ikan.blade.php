@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();

@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty']
    , };

</script>

@endsection

@section('css')
<style>
    .outer-top {
        margin-top: 188px;
    }
    .terms-conditions-page{
      padding-top: 0px !important;
    }
    

    @media only screen and (max-width: 768px) {
        
        .outer-top {
            margin-top: 387px;
        }
        .table {
          font-size: 50%;
        }
        .graf{
          width: 100%;
        }
        .tani {
                border-radius: 10px;width: 100%;
            }
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
          width: 100%;
            border-top-right-radius: 10px;
            border-bottom-left-radius: 10px;
        }
        
        
    }
    @media screen and (min-width: 769px) {
      .pilar {
            width: 100%;
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
      .tani {
            float: left;
            border-radius: 10px;
            width: 100px;
        }
    }
    tr.collapse.in {
      display:table-row;
}

.pointer {cursor: pointer;}
.tabel {
    height: 500px;
    overflow-x:auto;
}
</style>
@endsection

@section('content-frontend')

<a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 8px;margin-left: 15px"></i></a>
<div class="terms-conditions-page">
  <div class="container">
    <div class="row" style="margin-top: 50px">
      <h3>Berita Terkini</h3><br>
      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <div class="row">
          <?php 
          for ($i=0; $i < 6; $i++) { 
      ?>
      <form action="/baca-ikan" method="POST">
        {{  csrf_field() }}
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" style="margin-bottom: 10px; height: 300px">
          <div class="media">
              
              <img class="mr-3 pilar" alt="Bootstrap Media Preview" src="{{ $pilar['gambar_pilar'][$i] }}" style="width:100%; height:200px"/>
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
                  background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $pilar['judul_pilar'][$i] }}</b></h4></button>
                  {{-- <h4  style="margin-left: 10px;"><b><a href="{{ $pilar['href_pilar'][$i] }}">{{ $pilar['judul_pilar'][$i] }}</a></b></h4>  --}}
                  <h5 style="margin-left: 10px;"><b style="color: #3a6d91">{{ $pilar['tgl_pilar'][$i] }}</b></h5> 
                  
                  
              </div>
          </div>
 
      </div>
      </form>
          <?php } ?>
          

          
      </div>


        <?php 
        for ($i=0; $i < 8; $i++) { 
         ?>
         <form action="/baca-ikan" method="POST">
          {{  csrf_field() }}
        <div class="media">
            <img class="mr-3 tani" alt="Bootstrap Media Preview" src="{{ isset($data['gambar'][$i]) ? $data['gambar'][$i] : asset('img/loggo.png') }}"/>
            <div class="media-body">
              <input type="hidden" value="{{ $data['href'][$i] or "" }}" name="href">
              <input type="hidden" value="{{ $data['judul'][$i] or ""}}" name="judul">
              <input type="hidden" value="{{ $data['category'][$i] or ""}}" name="upload">
              <input type="hidden" value="{{ $data['gambar'][$i] or ""}}" name="gambar">
              <input type="hidden" value="{{ $data['tgl'][$i] or ""}}" name="tgl">
              <input type="hidden" value="sindo" name="jenis">
              <button style="border: none;
              background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $data['judul'][$i] or '' }}</b></h4></button>
                <h5 style="margin-left: 20px;"><b style="color: #3a6d91">{{ $data['category'][$i] or ""}}</b> - {{ $data['tgl'][$i] or ""}}</h5> 
                <h5 style="margin-left: 20px">{{ $data['isi'][$i] or ""}}</h5> 
                
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
        <form action="/baca-ikan" method="POST">
          {{  csrf_field() }}
            <div class="media">
                <img class="mr-3 post tani" alt="Bootstrap Media Preview" src="{{ $post_terbaru['gambar_tani'][$i] }}" style=""/>
                <div class="media-body">
                  <input type="hidden" value="{{ $post_terbaru['href_tani'][$i] }}" name="href">
                  <input type="hidden" value="{{ $post_terbaru['judul_tani'][$i] }}" name="judul">
                  {{-- <input type="hidden" value="{{ $post_terbaru['judul_tani'][$i] }}" name="upload"> --}}
                  <input type="hidden" value="{{ $post_terbaru['gambar_tani'][$i] }}" name="gambar">
                  <input type="hidden" value="{{ $post_terbaru['tgl_tani'][$i] }}" name="tgl">
                  <input type="hidden" value="ikan" name="jenis">
                  <button style="border: none;
                  background: none;text-align: left;margin-left: 15px;"><h4><b>{{ $post_terbaru['judul_tani'][$i] }}</b></h4></button>
                    {{-- <h4 class="judul" style="margin-left: 20px;"><b><a href="{{ $post_terbaru['href_tani'][$i] }}"> {{ $post_terbaru['judul_tani'][$i] }}</a></b></h4>  --}}
                    <h5 style="margin-left: 20px;"><b style="color: #3a6d91"></b>  {{ $post_terbaru['tgl_tani'][$i] }}</h5> 
                    
                </div>
            </div>
            <hr>
        </form>
            <?php } ?>
    </div>
      
    </div>
    <div class="row" style="margin-top: 20px">
        
      <div class="col-sm-12 col-md-12 col-lg-12">
          <div style="margin-top: 20px">
              <p><b>Sumber Data</b></p>
              <p><a href="https://www.bps.go.id/">https://www.bps.go.id/</a></p>
              <p><a href="https://www.tempo.co/tag/perikanan">https://www.tempo.co/tag/perikanan</a></p>
              <p><a href="https://www.detik.com/tag/kementerian-kelautan-dan-perikanan">https://www.detik.com/tag/kementerian-kelautan-dan-perikanan</a></p>
          </div>
      </div>
  </div>
</div>
</div>
  
  @endsection
  
  @section('scripts')
  <script>
    $(document).ready(function(){
      $('.append').attr('src','//katam.litbang.pertanian.go.id/grid_dinamis.aspx')
    })
  </script>
  
@endsection