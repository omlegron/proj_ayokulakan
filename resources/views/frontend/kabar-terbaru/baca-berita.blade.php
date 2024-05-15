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
            <div class="container-fluid" >
                <div class="row" style="margin-bottom: 50px">
                    <div class="col-12">
                        
                        <img src="{{ $data['gambar'][0] or $request->gambar }}" style="width: 100%;border-radius: 10px" alt="">
                        <h3><b>{{ $request->judul }}</b></h3>
                        <h5><b>{{ $request->tgl }}</b> | <b style="color: red">{{ $request->upload }}</b></h5>
                        @foreach ($data['isi'] as $item)
                        <p>{{ $item }}</p>
                        @endforeach
                        
                    </div>
                </div>
            </div>
            
        </div>
            
    </div><!-- /.filter-tabs -->
        
</div>
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="kabar-terbaru-sortir">
                <div class="blog-page">
                    <div class="col-md-12">
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                           {{-- {!! $record->links('partials.pagination.frontend-pagination') !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection