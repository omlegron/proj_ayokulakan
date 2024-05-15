<div class="scroll-tabs outer-top-vs fadeinUp wow">
    <div class="more-info-tab clearfix" id="nav" style="margin-left: 3px;">
        <a data-toggle="tab" href="#grid-container" style="font-size: 20px;"><i class="icon fa fa-th-large" style="color: #16a70cbc"></i><span style="font-weight: bold"> PILIHAN</span></a>
        <ul class="dropdown-pill">
            <li class="col-pil"><a href="{{ url('/') }}" id="dropdown" style=""><img src="{{ asset('img/pilihan/beranda.png') }}" alt="" srcset="" style="width: 100%; height: 100%"></a></li>
            {{-- <li class="col-pil">
                <a href="{{ url('/') }}" style=""><img src="{{ asset('img/pilihan/tentang.png') }}" alt="" srcset="" style="width: 100%; height: 100%"></a>
                <ul class="drop-menu" style="width: 100% !important">
                    <li class="">
                        <div class="row">
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('/tentang') }}">
                                                <img src="{{ asset('img/pilihan/tentang-ayokulakan.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ route('kurir-tentang') }}">
                                                <img src="{{ asset('img/pilihan/tentang-kurir.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ route('kaki-lima') }}">
                                                <img src="{{ asset('img/pilihan/tentang-kaki-lima.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('/aturan-pengguna') }}">
                                                <img src="{{ asset('img/pilihan/aturan-penggunaan.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('/perjanjian') }}">
                                                <img src="{{ asset('img/pilihan/perjanjia.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('/syarat-dan-ketentuan') }}">
                                                <img src="{{ asset('img/pilihan/syarat-ketentuan.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('/kebijakan-privasi') }}">
                                                <img src="{{ asset('img/pilihan/kebijakan-privasi.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3" style="margin: 10px 0px !important">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            <a href="{{ url('/kebijakan-privasi') }}">
                                                <img src="{{ asset('img/pilihan/kontak-kami.png') }}" alt="" srcset="" class="card-img-top" style="width: 50%; height: 50%; border-radius: 40%;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </li> --}}
            <li class="col-pil">
                <a href="javascript:void(0)" id="dropdown" data-hover="sewa" class="dropdown-toggle"
                data-toggle="dropdown"><img src="{{ asset('img/pilihan/sewa.png') }}" alt="" srcset="" style="width: 100%; height: 100%"></a>
                <ul class="drop-menu" id="drop-sewa" style="width: 100% !important">
                    <li>
                        <div class="row">
                            @if($kategoriRental1->count() > 0)
                            @foreach($kategoriRental1 as $key => $val)
                            <div class="col-md-3 mb-2" id="togles-kategori">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <div class="card-text">
                                            @if (!Auth::check())
                                                <a href="{{ url('login') }}"
                                                    style="padding: 8px 0px">
                                                    <img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px;height:50px">
                                                    <p class="title" style="font-size: 11px">{!! $val->nama or '' !!}</p>
                                                </a>
                                                @else
                                                <a href="{{ url('sc/cat-rental/amps/'.slugify($val->nama)) }}"
                                                    style="padding: 8px 0px">
                                                    <img src="{{ ($val->attachments) ? url('storage/'.$val->attachments->url) : asset('img/no-images.png') }}" alt="" class="card-img-top" style="width:50px;height:50px">
                                                    <p class="title" style="font-size: 11px">{!! $val->nama or '' !!}</p>
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </li>
                </ul>
            </li>
            @if(isset($mainMenuFrontEnd))
            @foreach($mainMenuFrontEnd->roots() as $key => $value)
            @if($value->hasChildren())
                <li class="col-pil">
                    @if (!Auth::check())
                        <a href="{{ url('login') }}" id="dropdown" data-hover="dropdown" class="dropdown-toggle"
                            data-toggle="dropdown"
                            style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}"
                            tabindex="{{ $value->id }}">
                            <img src="{!! $value->img !!}" alt="" srcset="" style="width: 100%; height: 100%">
                        </a>
                        @else
                        <a href="{!! $value->url() !!}" id="dropdown" data-hover="dropdown" class="dropdown-toggle"
                            data-toggle="dropdown"
                            style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}"
                            tabindex="{{ $value->id }}">
                            <img src="{!! $value->img !!}" alt="" srcset="" style="width: 100%; height: 100%">
                        </a>
                    @endif
                    <ul class="drop-menu" id="drop-pand" style="width: 100%; !important">
                        <li>
                            <div class="row">
                                @foreach ($value->children() as $k => $child)
                                <div class="col-md-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <div class="card-text">
                                                @if (!Auth::check())
                                                    <a href="{{ url('login') }}"
                                                        style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">
                                                        <img src="{!! $child->img_cart  !!} " alt="" class="card-img-top" srcset="" style="width: 50px; height: 50px; border-radius: 40%">
                                                        <p class="title" style="font-size: 11px">{{ $child->title }}</p>
                                                    </a>
                                                    @else
                                                    <a href="{{$child->url()}}"
                                                        style="{{ isset($title) ? ($child->title == $title ? 'color:red' : '') : '' }} ">
                                                        <img src="{!! $child->img_cart  !!} " alt="" class="card-img-top" srcset="" style="width: 50px; height: 50px; border-radius: 40%">
                                                        <p class="title" style="font-size: 11px">{{ $child->title }}</p>
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                </li>
            @else
                <li class="col-pil">
                    @if (!Auth::check())
                        <a href="{{ url('login') }}"
                            style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}"
                            tabindex="{{ $value->id }}">
                            <img src="{!! $value->img !!}" alt="" srcset="" style="width: 100%; height: 100%">
                            {{-- {!! $value->title !!} yuhu <i class="{{ $value->icon }}"></i> --}}
                        </a>
                        @else
                        <a href="{!! $value->url() !!}"
                            style="{{ isset($title) ? ($value->title == $title ? 'color:red' : '') : '' }}"
                            tabindex="{{ $value->id }}">
                            <img src="{!! $value->img !!}" alt="" srcset="" style="width: 100%; height: 100%">
                            {{-- {!! $value->title !!} yuhu <i class="{{ $value->icon }}"></i> --}}
                        </a>
                    @endif
                </li>
            @endif
            @endforeach
            @endif
        </ul>
    </div>
</div>