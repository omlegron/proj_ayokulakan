<div class="scroll-tabs outer-top-vs fadeinUp wow">
    <div class="more-info-tab clearfix" style="margin-left: 13px;">
        <a data-toggle="tab" href="#grid-container" style="font-size: 20px;"><i class="icon fa fa-th-large" style="color: #16a70cbc"></i><span style="font-weight: bold"> PENCARIAN POPULER</span></a>
        <div class="row" id="slick-populer">
            @if(count($populer) > 0) 
            @foreach($populer as $k => $v)
            <div class="col-6 col-xs-6 col-md-3 wow fadeInUp animated" id="slick-disc-items" style="visibility: visible; animation-name: fadeInUp;width:207;height: 300px">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image" style="height:150px;width:190px;display:table-cell;vertical-align: middle;">
                                @if($v->attachments->count() > 0)
                                <img src="{{ url('storage/'.$v->attachments->first()->url) }}" alt="" style="max-height: 150px">
                                @else
                                <img src="{{ asset('img/no-images.png') }}" alt="" style="max-height: 150px">
                                @endif
                            </div>
                            <div class="tag new"><span>new</span></div>
                        </div>
                        <div class="product-info text-left">
                            @if(isset($v->nama_barang))
                                @if(strlen($v->nama_barang) > 50)
                                    <a href="{{ url('sc/barang/'.$v->id) }}" class="name"><h5>{{ substr($v->nama_barang,0,50) }} ...</h5></a>
                                @else
                                    <a href="{{ url('sc/barang/'.$v->id) }}" class="name"><h5>{{ $v->nama_barang or '' }}</h5></a>
                                @endif
                            @else
                                <a href="{{ url('sc/barang/'.$v->id) }}" class="name">{{ $v->nama_barang or '-' }}</a>
                            @endif

                            {{-- <div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->kota->kota or '-' }}</div> --}}

                            <div class="product-price">
                                <span class="price">
                                        Rp. {{ number_format($v->harga_barang, 2, ',', '.') ?? 0 }}
                                </span><br>
                                <span >
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
                                    <p>
                                        @for($i = 0; $i < 5; $i++)
                                        <span><i class="fa fa-star-o" ></i></span>
                                        @endfor
                                        {{ $v->barang_terjual or '0' }} Terjual</p>
                                    @endif
                                </span>
                                <div class="description"><i class="fa fa-map-marker"></i> {{ $v->lapak->provinsi->provinsi or '-' }} </div>
                                @if($v->status_halal == 'Dijamin Halal')
                                    <span class=""><i class="fa fa-check"></i>{{ $v->status_halal or '-' }}</span> 
                                @endif
                                {{-- <span class="price-before-discount">( {{ $v->feedback()->where('form_type','=','img_barang')->count() }} )</span> --}}

                            </div>

                        </div>
                        <div class="cart clearfix animate-effect">
                            <div class="action" style="">
                                <ul class="list-unstyled">

                                    @if(Auth::check())
                                        <li class="add-cart-button btn-group">
                                            <a href="javascript:void(0)" class="sharp-show show custom-front-load-show buttons showing btn btn-warning icon" data-url="{{ url('favorit/'.$v->id) }}" data-id="{{ $v->id or '' }}" data-titlemodal="List Favorit Barang">
                                                <i class="fa fa-heart"></i>
                                            </a>
                                        </li>
                                    @endif

                                    <li class="add-cart-button btn-group">
                                        <a href="javascript:void(0)" class="sharp-show show front-load-show buttons showing btn btn-primary icon" data-name="{{ slugify($v->nama_barang) }}" data-id="{{ $v->id or '' }}">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </li>
                                    <li class="lnk wishlist">
                                        <a href="javascript:void(0)" title="Tambahi" class="ampass add-cart" data-item="{{ $v->id or '' }}" data-type="img_barang">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                    <!-- <li class="add-cart-button btn-group">
                                        <a href="javascript:void(0)" title="Wishlist" class="sharp-show show custom-front-load-show buttons showing btn btn-primary icon" data-url="chat">
                                            <i class="fa fa-phone"></i>
                                        </a>
                                    </li> -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
            <div class="clearfix"></div>
        </div>
        <strong class="pop-kanan" style=""><i class="glyphicon glyphicon-chevron-left"></i></strong>
        <strong class="pop-kiri"><i class="glyphicon glyphicon-chevron-right"></i></strong>
    </div>
</div>