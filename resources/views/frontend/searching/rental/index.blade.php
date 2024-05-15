@extends('layouts.scaffold-sidebar-left-rental')

@section('content-frontend-right')
    @include('frontend.home.partial.category-rental')
    <br>
    @include('frontend.home.partial.iklan')

    <div class="clearfix filters-container m-t-10">
    <div class="row">
        <div class="col col-sm-8 col-lg-6">
            <div class="filter-tabs">
                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                    <li class="active">
                        <!-- <a data-toggle="tab" href="#grid-container"><i class="icon fa fa-th-large"></i>Barang</a> -->
                    </li>
                    <li>
                        <a>
                             <div class="lbl-cnt">
                                <div class="fld inline">
                                    @if (isset($name))
                                        <label>Urutkan Berdasarkan :</label>
                                        <select name="orders_cat" id="select">
                                            <option value="{{ $name }}" class="categories">Urutkan Berdasarkan</option>
                                            <option value="{{ $name }}" data-sorts="created_at" id="desc" class="categories">Terbaru</option>
                                            <option value="{{ $name }}" data-sorts="harga_sewa" id="asc" class="categories">Harga Rendah ke Tinggi</option>
                                            <option value="{{ $name }}" data-sorts="harga_sewa" id="desc" class="categories">Harga tinggi ke Rendah</option>
                                        </select>
                                        @else
                                        <select name="orders_rental" class="nice-select-menu orderby ampas-order">
                                            <option value="">Urutkan Berdasarkan</option>
                                            <option value="created_at" data-sorts="desc">Terbaru</option>
                                            <option value="harga_sewa1"  data-sorts="asc">Harga Rendah Ke Tinggi</option>
                                            <option value="harga_sewa2"  data-sorts="desc">Harga Tinggi Ke Rendah</option>
                                        </select>
                                    @endif
                                </div><!-- /.fld -->
                            </div><!-- /.lbl-cnt -->
                        </a>
                    </li>
                </ul>
            </div><!-- /.filter-tabs -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</div>

<div class="search-result-container ">
    <div id="myTabContent" class="tab-content category-list">
        <div class="tab-pane active " id="grid-container">
            <div class="category-product product-search-ampas">
                <div class="row ">
                    @if($record->count() > 0)
                    @foreach($record as $k => $v)
                    <div class="col-2 col-xs-6 col-md-3 wow fadeInUp animated" style="height: 320px">
                        <div class="products">
                            <div class="product">
                                <div class="product-image" style="height:150px;display:table-cell;width:190px;vertical-align: middle;">
                                    <div class="image" >
                                        @if($v->attachments->count() > 0)
                                        <img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="max-height: 150px">
                                        @else
                                        <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                                        @endif
                                    </div>
                                    <div class="tag new"><span>new</span></div>
                                </div>
                                <div class="product-info text-left">
                                    @if(isset($v->judul))
                                        @if(strlen($v->judul) > 35)
                                            <h3 class="name">{{ substr($v->judul,0,35) }}</h3>
                                        @else
                                            <h3 class="name">{{ $v->judul or '-' }}</h3>
                                        @endif
                                    @else
                                        <h3 class="name">{{ $v->judul or '-' }}</h3>
                                    @endif
                                        {{-- <div class="description"><i class="fa fa-map-marker"></i> {{ $v->kota->kota or '-'  }}</div> --}}

                                    <div class="product-price">
                                        <span class="price">
                                             Rp. {{ number_format($v->harga_sewa, 0, ',', '.') }}
                                        </span><br>
                                        <span >
                                            @php
                                            $totalStar = 0;
                                            @endphp
                                            @if($v->feedback)
                                            @if($v->feedback()->where('form_type','=','img_rental')->count() > 0)
                                            @php
                                            $totalStar = $v->feedback()->where('form_type','=','img_rental')->sum('rate') / $v->feedback()->where('form_type','=','img_rental')->count();
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
                                            <p>
                                                @for($i = 0; $i < 5; $i++)
                                                <span><i class="fa fa-star-o" ></i></span>
                                                @endfor
                                                {{ $v->unit_tersewa or '0' }} Tersewa</p>
                                            @endif
                                        </span>
                                        <div class="description"><i class="fa fa-map-marker"></i> {{ $v->kota->kota or '-'  }}</div>

                                        {{-- <br> --}}
                                        {{-- <span class="price-before-discount">( {{ $v->feedback()->where('form_type','=','img_rental')->count() }} )</span> --}}

                                    </div>

                                </div>
                                <div class="cart clearfix animate-effect">
                                    <div class="action" style="position: relative;left: 20px">
                                        <ul class="list-unstyled">
                                            @if (Auth::check())
                                            <li class="add-cart-button btn-group">
                                                <a href="javascript:void(0)" class="sharp-show show custom-front-load-show buttons showing btn btn-warning icon" data-url="{{ url('favorit/rental/'.$v->id) }}" data-id="{{ $v->id or '' }}" data-titlemodal="List Favorit Barang">
                                                    <i class="fa fa-heart"></i>
                                                </a>
                                            </li>
                                            @endif
                                            <li class="add-cart-button btn-group">
                                                <a href="javascript:void(0)" class="sharp-show show front-load-show buttons showing btn btn-primary icon" data-name="{{ slugify($v->judul) }}" data-id="{{ $v->id or '' }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </li>
                                            <li class="lnk wishlist">
                                                <a href="javascript:void(0)" title="Tambahi" class="ampass add-cart-sewa" data-item="{{ $v->id or '' }}" data-type="img_rental">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
                <div class="row " style="margin-top: 35px;">
                    <div class="pull-right">
                       {!! $record->links('partials.pagination.frontend-pagination') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
