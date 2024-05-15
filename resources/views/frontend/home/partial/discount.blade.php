<div class="scroll-tabs fadeinUp wow">
    <div class="more-info-tab clearfix" style="margin-left: 13px;">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="row">
                    <div class="col-md-12">
                        <div style="display: flex; padding-bottom: 10px !important">
                            <img src="{{ asset('img/discount.png') }}" alt="" srcset="" width="30px" height="30px">
                            <h4 style="padding-left: 10px; font-weight: bold; font-size: 24px; margin: 0px">SUPER DISCOUNT!</h4>
                        </div>
                        <p>Akan Berakhir dalam <span id="time"></span></p>
                        <h5 style="font-weight: bold">AKAN ADA DISKON DI SETIAP HARI SABTU DAN MINGGU</h5>
                    </div>
                </div>
            </div>
            <script type="text/javascript">
                function timer(){
                    var date = new Date();
                    var h = date.getHours();
                    var m = date.getMinutes();
                    var s = date.getSeconds();
                    var waktu = h + ":" + m + ":" + s;
                    document.getElementById("time").innerText = waktu;
                    document.getElementById("time").textContent = waktu;
                }
                setInterval(timer,1000);
            </script>
            <div class="col-xs-12 col-sm-12 col-md-9">
                <div class="row" id="slick-disc">
                    @if(count($discount) > 0)
                    @foreach($discount as $k => $v)
                    <div class="col-6 col-xs-6 col-md-3 wow fadeInUp animated" id="slick-disc-items" style="visibility: visible; animation-name: fadeInUp;width:207;height: 300px">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image" style="height:150px;display:table-cell;width:190px;vertical-align: middle;">
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
                                                <br><span class=""><i class="fa fa-check"></i>{{ $v->status_halal or '-' }}</span> 
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
                </div>
                <strong class="disc-kanan" style=""><i class="glyphicon glyphicon-chevron-left"></i></strong>
                 <strong class="disc-kiri"><i class="glyphicon glyphicon-chevron-right"></i></strong>
            </div>
        </div>
    </div>
</div>