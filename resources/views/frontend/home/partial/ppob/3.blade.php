
    
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <h4 style="color: green;font-family: arial">Voucher Game</h4>
                    </div>
                  </div>
                @if($ppobGame->count() > 0)
                @foreach($ppobGame as $k => $value)
                <div class="col-md-4" style="padding-bottom: 5px">
                    <div class="myaccount-tab-menu nav tab-menu-ampas" role="tablist">
                        @php
                            if($value->code == 'Ragnarok'){
                                $name = 'Ragnarok';
                            }else{
                                $name = isset($value->name) ? $value->name : '';
                            }
                        @endphp
                        <a href="#{{$name}}" class="" data-toggle="tab" style="font-size: 11px">
                            <img src="{{ ($value->attachments->first()) ? url('storage/'.$value->attachments->first()->url) : asset('img/slider-ayokulakan.png') }}"><br>
                            {{ $value->code or '' }} 
                        </a>

                    </div>
                </div>
                @endforeach
                @endif
            </div>
            <div class="row">
                <div class="col-md-12 mt-15 mt-lg-0">
                    <div class="tab-content" id="myaccountContent">
                        @if($ppobGame->count() > 0)
                        @foreach($ppobGame as $k => $value)
                        @php
                            if($value->code == 'Ragnarok'){
                                $name = 'Ragnarok';
                            }else{
                                $name = isset($value->name) ? $value->name : '';
                            }
                        @endphp
                        <div class="tab-pane fade tab-pane-ampas" id="{{$name}}" role="tabpanel">
                            <div class="myaccount-content">
                                <h3>{{$value->code or ''}}</h3>
                                <p class="mb-0">
                                    {{-- {!! $value->deskripsi or '' !!} --}}
                                </p>
                                @if($value->code == 'Ragnarok')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame1" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    
                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group"> --}}
                                                            {{-- <label>User ID</label> --}}
                                                            <input type="hidden" value="Ragnarok M: Eternal Love" id="nama_game">
                                                            {{-- <input type="text"  name="ppob_pelanggan" class="form-control" placeholder="User ID" min="" max="13" data-child="PPOBGame" data-nama="id_barang" data-type="game"> --}}
                                                            <input type="hidden" name="ppob_type" value="list_ppob">
                                                            <input type="hidden" name="ppob_pelanggan_next" value="eternal">
                                                            <input type="hidden" name="form_type" value="list_ppob">
                                                            <input type="hidden" name="cek_pane" value="game">
                                                            <input type="hidden" name="game_code" value="127">
                                                            <input type="hidden" name="type" value="game">
                                                            <input type="hidden" name="types" value="game">
                                                        {{-- </div>
                                                    </div> --}}
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Nominal Ragnarok M: Eternal Love</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Ragnarok')"  class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. '. $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Ragnarok M: Eternal Love']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 40px">
                                                        @if(\Auth::check())
                                                         {{-- <button type="button" class="btn btn-success pulsa ppob-pulsa pull-right" data-url="check-pulsa" data-form="dataFormPageGame1" ><i class="ion-android-refresh"></i> Cek Data</button> --}}
                                                         <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame1"><i class="ion-ios-plus"></i> Beli Sekarang</button>

                                                         
                                                         
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg14" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame14"></h5>
                                                        <h5 id="pelanggan14"></h5>
                                                        <h5 id="barang14"></h5>
                                                        {{-- <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame1"><i class="ion-ios-plus"></i> Beli Sekarang</button> --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'wave_game')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame2" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Wave Game')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Wave Game']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame2"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg13" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame13"></h5>
                                                        <h5 id="pelanggan13"></h5>
                                                        <h5 id="barang13"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'battlenet_sea')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame3" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Battlenet Sea')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Battlenet SEA']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame3"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg12" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame12"></h5>
                                                        <h5 id="pelanggan12"></h5>
                                                        <h5 id="barang12"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'steam_sea')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame4" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Steam Sea')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Steam Sea']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame4"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg11" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame11"></h5>
                                                        <h5 id="pelanggan11"></h5>
                                                        <h5 id="barang11"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'pubg')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame5" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'PUBG')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'PUBG']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame5"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg10" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame10"></h5>
                                                        <h5 id="pelanggan10"></h5>
                                                        <h5 id="barang10"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @elseif($value->name == 'megaxus')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame6" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Megaxus')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Megaxus']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame6"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg9" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame9"></h5>
                                                        <h5 id="pelanggan9"></h5>
                                                        <h5 id="barang9"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'itunes_gift_card_indonesia')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame7" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this, 'Ituns Gift Card')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'iTunes Gift Card Indonesia']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame7"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg8" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame8"></h5>
                                                        <h5 id="pelanggan8"></h5>
                                                        <h5 id="barang8"></h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'free_fire')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame8" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <input type="hidden" name="game_code" value="135">
                                                    <input type="hidden" name="type" value="game">
                                                    <input type="hidden" name="types" value="game">      
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>User ID</label>
                                                            <input type="text" name="ppob_pelanggan" class="form-control" placeholder="User ID" min="" max="13" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Free Fire')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Free Fire']], 'Choose One') !!}
                                                            </select>  
                                                            
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-12" style="padding-top: 5px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success check-pulsa pull-right" data-url="check-game" data-form="dataFormPageGame8" ><i class="ion-android-refresh"></i> Cek Data</button>
                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg7" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame7"></h5>
                                                        <h5 id="pelanggan7"></h5>
                                                        <h5 id="barang7"></h5>
                                                    </div>
                                                    @if(\Auth::check())
                                                    <div class="col-md-12 pull-right" style="margin-left: 10px">
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame8"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'wifi_id')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame9" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Wifi ID')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Wifi ID']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame9"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div> 
                                                <div class="row" id="bg6" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame6"></h5>
                                                        <h5 id="pelanggan6"></h5>
                                                        <h5 id="barang6"></h5>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'mobile_legend')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame10" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <input type="hidden" name="game_code" value="103">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>User ID</label>
                                                            <input type="text" id="ppob_pelanggan5" name="ppob_pelanggan" class="form-control" placeholder="User ID" min="10" max="10" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Server ID</label>
                                                            <input type="text" id="ppob_pelanggan_next" name="ppob_pelanggan_next" class="form-control" placeholder="Server ID" min="4" max="4" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Mobile Legend')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Mobile Legend']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success check-pulsa pull-right" data-url="check-game" data-form="dataFormPageGame10" ><i class="ion-android-refresh"></i> Cek Data</button>

                                                        @endif

                                                    </div>
                                                </div>    
                                                <div class="row" id="bg5" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame5"></h5>
                                                        <h5 id="pelanggan5"></h5>
                                                        <h5 id="pelanggan_next5"></h5>
                                                        <h5 id="barang5"></h5>
                                                    </div>
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame10"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'point_blank')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame11" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Point Blank')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Point Blank']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame11"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div> 
                                                <div class="row" id="bg4" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame4"></h5>
                                                        <h5 id="pelanggan4"></h5>
                                                        <h5 id="barang4"></h5>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'gemscool')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame12" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Gemschool')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Gemscool']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame12"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>  
                                                <div class="row" id="bg3" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame3"></h5>
                                                        <h5 id="pelanggan3"></h5>
                                                        <h5 id="barang3"></h5>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'google_play_indonesia')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame13" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <input type="hidden" name="jenis" value="google_play">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Nomor Tujuan</label>
                                                            <input type="text" id="ppob_pelanggan2" name="ppob_pelanggan" class="form-control" placeholder="Nomor Tujuan" min="12" max="13" data-child="PPOBGame" data-nama="id_barang" data-type="game">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Google Play')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Google Play Indonesia']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-12" style="padding-top: 13px;margin-bottom: 10px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend pull-right" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame13"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>   
                                                <div class="row" id="bg2" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame2"></h5>
                                                        <h5 id="pelanggan2"></h5>
                                                        <h5 id="barang2"></h5>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                 @elseif($value->name == 'garena')
                                <div class="content-ayokulakan" style="padding-top: 12px">
                                    <form id="dataFormPageGame14" action="{{ url('ppob-pulsa/store') }}" method="POST">
                                        {!! csrf_field() !!}
                                        <input type="hidden" name="type" value="game">
                                        <input type="hidden" name="types" value="game">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <input type="hidden" name="ppob_type" value="list_ppob">
                                                    <input type="hidden" name="form_type" value="list_ppob">
                                                    <input type="hidden" name="cek_pane" value="game">
                                                    <div class="col-md-5">
                                                        <div class="form-group">
                                                            {{-- <input type="hidden" value="Garena" id="nama_game"> --}}
                                                            <label for="">Pilih Voucher</label>
                                                            <select name="id_barang" onchange="myFunction(this,'Garena')" class="form-control selectpicker" required="" data-dropup-auto="false" data-size="10" >
                                                                {!! App\Models\Master\PPOBPulsa::options(function ($ppob) {
                                                                    $konvert = number_format($ppob->pulsa_price, 0, ".", ".");
                                                                    return $ppob->pulsa_nominal.' - Rp. ' . $konvert;
                                                                }, 'pulsa_code', ['filters' => ['pulsa_op' => 'Garena']], 'Choose One') !!}
                                                            </select>        
                                                        </div>    
                                                    </div>
                                                    <div class="col-md-2" style="padding-top: 23px">
                                                        @if(\Auth::check())
                                                        <button type="button" class="btn btn-success save-page save-frontend" data-title="Beli Voucher Game Sekarang ?" data-confirm="Pesan" data-batal="Batal" data-forms="dataFormPageGame14"><i class="ion-ios-plus"></i> Beli Sekarang</button>
                                                        @else
                                                        @endif

                                                    </div>
                                                </div>  
                                                <div class="row" id="bg1" style="margin-top: 10px;margin-left: 10px;margin-bottom: 50px ;background-color: #ffeee2;display: none;width: 520px">
                                                    <div class="col-md-12" style="margin-left: 10px">
                                                        <h3 >Detail Pembayaran</h3>
                                                        <h5  id="namaGame1"></h5>
                                                        <h5 id="pelanggan1"></h5>
                                                        <h5 id="barang1"></h5>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
                
            </div>
            
               
            
            
            
            
            
            
            

