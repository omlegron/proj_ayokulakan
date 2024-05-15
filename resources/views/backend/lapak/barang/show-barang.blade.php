
	@extends('layouts.grid')

    @section('js-filters')
    d.nama = $("input[name='filter[nama]']").val();
    @endsection
    @section('scripts')
    @include('backend.lapak.script.index')
    @endsection
    @section('rules')
    <script type="text/javascript">
        formRules = {
            judul: ['empty'],
        };
    </script>
    @endsection
    @section('filters')
    
    @endsection
    @section('toolbars')
    
    @endsection
    @section('subcontent')
    <style type="text/css">
        .terms-conditions-page{
            padding-top: 0px !important;
            margin-top: -35px;
        }
        .detail-block{
            background-color: transparent;
        }
        .outer-top-vs {
            margin-top: 3px;
        }
        .scroll-tabs{
            margin-bottom: 5px;
        }
        .profile-img{
            width: 40px; height: 40px;
            float: left;
            margin-right: 20px;
        }
        .profile-name{
            font-size: 18px;
            font-weight: 600;
            color: #000;
            margin: 0px;
        }
        .profile-verif{
            font-size: 14px;
            font-weight: 300;
            color: #a09898;
    
        }
        .components>li{
            padding: 10px;
        }
        .components > li > a{
            color: #000;
            font-size: 16px;
            font-weight: 400;
        }
        .colapse-item{
            padding: 10px !important;
        }
        .colapse-item{
            color: #a09898;
        }
        .colapse-item a{
            font-size: 15px
            font-weight: 300;
        }
        .colapse-item:hover{
            background: #d4bcbc;
            color: #ffffff !important;
        }
        .detail-pesanan{
            display: flex;
            margin-top: 10px;
        }
        .detail-pesanan .deskripsi-pesanan{
            padding: 12px; 
        }
        .detail-pesanan .deskripsi-pesanan h3{
            margin: 2px;
        }
        .detail-pesanan .pesanan-check{
            margin-left: auto;
        }
        .detail-pesanan input{
            margin-right: 10px;
        }
        .action-pesanan{
            display: flex;
            padding: 10px 15px;
            height: 50px;
        }
        .pesanan-kurir{
            border: 2px solid #000000;
            padding: 10px;
            margin: 5px;
        }
        .pesanan-kurir p{
            font-weight: 600;
            text-transform: capitalize;
        }
        .icon-belanja{
            width: 50px;
            height: 50px;
            border: 1px solid #ccc;
            border-radius: 50px;
            padding: 10px;
            text-align: center;
            margin-right: 10px;
        }
        .icon-belanja span{
            color: #db700c;
            font-size: 18px;
        }
        .action-pesanan .pesanan-icon{
            margin-left: auto;
        }
        .nice-number button{
            background: #db700c;
            color: #ffffff;
            padding: 0px 10px;
            border: none;
        }
        .buttons:hover {
            background:black;
        }
        .col-md-4{
            margin-bottom: 20px;
            padding: 1px;
        }
        .prof-body{
            border: 1px solid #a56028;
            padding: 10px;
            border-radius: 10px;
        }
        .prof-body p{
            font-weight: 600;
        }
        .prof-title{
            font-size: 18px;
        }
        .prof-text{
            font-size: 30px;
        }
    </style>
    <div class="row">
        @include('backend.lapak.partials.partials')
        <div class="col-md-9">
            <div class="scroll-tabs fadeinUp wow">
                <div class="more-info-tab clearfix" id="content">
                    @if($record->count() > 0)
                    <div class="more-info-tab clearfix ">
                        <p style="font-size: 20px; font-weight: 600;">Product Lapak</p>
                        <div class="row">
                            <div class="col-md-3">
                                <form method="get" class="form filter-form">
                                    <select name="filter[tampilkan]" class="nice-select-menu orderby form-control" >
                                        <option>Tampilkan</option>
                                        <option value="10">10</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <form method="get" class="woocommerce-ordering hidden-xs">
                                    <select name="filter[sort]" class="nice-select-menu orderby form-control">
                                        <option>Default sorting</option>
                                        <option value="popularity">Sort by popularity</option>
                                        <option value="rating">Sort by average rating</option>
                                        <option value="date">Sort by newness</option>
                                        <option value="price">Sort by price: low to high</option>
                                        <option value="price-desc">Sort by price: high to low</option>
                                    </select>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="container">
                                    <div class="page-title text-center">
                                        <form class="form filter-form">
                                            <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
                                                <div class="input-group">
                                                    <input type="text" name="filter[nama]" class="form-control" placeholder="Search" aria-label="" aria-describedby="" 	>&nbsp;
                                                </div>&nbsp;
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-primary filter button" data-toggle="tooltip" data-placement="bottom" title="Cari Data"><i class="fa fa-search"></i> Search</button>
                                                    <button type="reset" class="btn btn-secondary reset button" data-toggle="tooltip" data-placement="bottom" title="Refresh"><i class="fa fa-close"></i> Clear</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($record as $key => $v)
                         <div class="col-6 col-xs-6 col-md-3 wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;width:207;height: 300px">
                            <div class="products">
                                <div class="product">       
                                    <div class="product-image">
                                        <div class="image">
                                            @if($v->attachments->count() > 0)
                                                <img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="height: 150px">
                                            @else
                                                <img src="{{ asset('img/no-images.png') }}" alt="" style="height: 150px">
                                            @endif
                                        </div>
                                        <div class="tag new"><span>new</span></div>
                                        <div class="tag new"><span>new</span></div>
                                    </div>
                                    <div class="product-info text-left">
                                        <h3 class="name">{{ $v->nama_barang or '-' }}</h3>
                                        
                                        <div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->provinsi->provinsi or '-' }}</div>
                
                                            <div class="product-price"> 
                                                <span class="price">
                                                {{ isset($v->harga_barang) ? number_format($v->harga_barang, 2, ',', '.') : 0 }} 
                                                </span><br>
                                                <span class="price">
                                                
                                                    @php
                                                        $totalStar = 0;
                                                    @endphp
                                                    @if($v->feedback)
                                                        @if($v->feedback()->where('form_type','=','img_barang')->count() > 0)
                                                            @php
                                                                $totalStar = $v->feedback()->where('form_type','=','img_barang')->sum('rate') / $v->feedback()->where('form_type','=','img_barang')->count();
                                                            @endphp
                                                        @endif
                                                    @endif
                                                    @if($totalStar > 0)
                                                        @php
                                                            $cekStar = 5 - $totalStar;
                                                        @endphp
                                                        @for($i = 0; $i < $totalStar; $i++)
                                                            <span><i class="fa fa-star" style="color:#ff7429;"></i></span>
                                                        @endfor
                
                                                        @for($i1 = 0; $i1 < $cekStar; $i1++)
                                                            <span><i class="fa fa-star-o"></i></span>
                                                        @endfor
                                                    
                                                    @else
                                                        @for($i = 0; $i < 5; $i++)
                                                            <span><i class="fa fa-star-o" ></i></span>
                                                        @endfor
                                                    @endif
                                                    ( {{ $v->feedback()->where('form_type','=','img_barang')->count() }} )
                                                </span>
                                                @if($v->status_halal == 'Dijamin Halal')
                                                    <span class=""><i class="fa fa-check"></i>{{ $v->status_halal or '-' }}</span> 
                                                @endif
                                                <!-- <span class="price-before-discount">$ 800</span>  -->
                
                                            </div>
                
                                        </div>
                                        <div class="cart clearfix animate-effect">
                                            <div class="">
                                                <ul class="list-unstyled">
                                                    <li class="add-cart-button btn-group">
                                                        <a href="javascript:void(0)" class="btn btn-warning show front-load-show" data-id="{{ $v->id }}" data-name="feedback">
                                                            <i class="fa fa-eye"></i>              
                                                        </a>
                                                    </li> 
                                                    <li class="add-cart-button btn-group">
                                                        <a href="javascript:void(0)" class="btn btn-success icon others-edit button" data-id="{{$v->id or ''}}" data-urls="edit-barang" data-titlemodal="Ubah Barang Jualan">
                                                            <i class="fa fa-edit"></i>              
                                                        </a>
                                                    </li>
                                                    <li class="add-cart-button btn-group">
                                                        <a href="javascript:void(0)" class="btn btn-danger others-deletes button" data-id="{{$v->id or ''}}" data-url="hapus-barang">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @else
                            <div class="col-sm-12">
                                <div class="single-product-area">
                                    <div class="product-wrapper listview">
                                        <center>DATA BARANG YANG DI JUAL KOSONG</center>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                
                <div>
                    {!! $record->links('partials.pagination.frontend-pagination') !!}
                </div>
                </div>
            </div>	
        </div>
    </div>
    @endsection
    @section('scripts-js')
        
    @endsection