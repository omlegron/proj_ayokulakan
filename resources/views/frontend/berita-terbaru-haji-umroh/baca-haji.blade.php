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
        .img {
                border-radius: 10px;width: 100%;
            }
        
    }
    @media screen and (min-width: 800px) {
        .img {
            float: left;
            border-radius: 10px;
            width: 300px;
        }
        .post {
            width : 120px;
        }
        .judul {
            margin-top: 50px;
        }
    }
            
</style>
@endsection
@section('content-frontend-left')
<a href="{{ url('/') }}" style="margin-left: 20px; font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left"></i></a>
{{-- @include('frontend.home.partial.pilihan') --}}
<div class="col-sm-12 col-md-12 p-0" style="padding: 0px !important">
    <div class="filters-container">
        <h2>Berita Terbaru</h2>
        <hr>
        <div class="filter-tabs">
            <div class="container-fluid">
                <div class="row" style="margin-bottom: 50px">
                    <div class="col-12">
                        
                        <img class="img" src="{{ $data['gambar'][0] or $request->gambar }}" style="width: 100%;border-radius: 10px;margin-bottom: 15px" alt="">
                        <h3><b>{{ $request->judul }}</b></h3>
                        <h5><b>{{ $request->tgl }}</b> </h5>
                        @foreach ($data['isi'] as $item)
                        <p>{{ $item }}</p>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
        </div><!-- /.filter-tabs -->
       
        {{-- <div class="filter-tabs">
            <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                <li class="active">
                    <!-- <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Barang</a> -->
                </li>
                <li>
                    <a>
                         <div class="lbl-cnt">
                            <div class="fld inline">
                                <label>Urutkan Berdasarkan :</label>
                                <select name="berita-terbaru" id="berita-terbaru">
                                    <option value="asc" class="categories">Urutkan Berdasarkan</option>
                                    <option value="desc">Berita Terbaru</option>
                                </select>
                            </div><!-- /.fld -->
                        </div><!-- /.lbl-cnt -->
                    </a>
                </li>
            </ul>
        </div><!-- /.filter-tabs --> --}}
    </div>
</div>
   {{-- <div class="kabar-terbaru-sortir" id="sortir">
        <center><h3 style="background: #ffffff; margin-bottom: 0px; padding-bottom: 50px">Berita Terkait Haji Dan Umroh</h3></center>
        @if($record->count() > 0)
        @foreach($record as $k => $v)
        <div class="col-md-12 kabar-terbaru-sortir" style="background: #ffffff; border:1px solid #2422223e; margin-bottom: 10px">
            <div class="row no-gutters">
                <div class="col-md-8">
                    <span style="color: orange; font-weight: bold; font-size: 20px; float: left; margin-right: 30px">Haji</span>
                    <span style="color: orange; font-weight: bold; font-size: 20px">Umroh</span>
                    <h1><a href="{{ url($pageUrl.$v->id) }}">{{ substr($v->judul,0,35).'..' }}</a></h1>
                    <span class="author">{{ $v->creatorName() }}</span>
                    <span class="date-time">{{ DateToStringWday($v->created_at) }}</span>
                        <p>{!! substr($v->deskripsi,0,100) !!}</p>
                    <a href="{{ url($pageUrl.$v->id) }}" class="btn btn-upper btn-primary read-more">read more</a>
                </div>
                <div class="col-md-4">
                    @if($v->attachments->count() > 0)
                        <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ url('storage/'.$v->attachments->first()->url) }}" alt=""></a></center>
                    @else
                        <center><a href="javascript:void(0)"><img class="img-responsive" src="{{ asset('img/no-images.png') }}" alt="bege blog images"></a></center>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        @else
                    <div class="blog-post  wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
                        <center>No Data Found</center>
                    </div>
                @endif
        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                {!! $record->links('partials.pagination.frontend-pagination') !!}
            </div>
        </div>
   </div> --}}

@endsection
