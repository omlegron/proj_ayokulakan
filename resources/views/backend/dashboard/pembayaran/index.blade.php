@extends('layouts.admin')
@section('content')
<div class="col-xs-12 col-sm-6 col-md-12">
    <div class="card">
        <div class="card-body">
            @include('frontend.home.partial.policy')
        </div>
    </div>
  </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Pulsa.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Pulsa</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Paket-Data.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Paket Data</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Voucher-Game.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Voucher Game</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/BPJS-Kesehatan.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">BPJS Kesehatan</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/PDAM.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">PDAM</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/PLN-Prabayar.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">PLN Prabayar</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Tiket-Kereta.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Tiket Kereta</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Tiket-Pesawat.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Tiket Pesawat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Pesan-Hotel.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Pesan Hotel</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/Tiket-Kapal.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Tiket Kapal</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/E-samsat.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">Esamsat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="card-body">
                                <div class="text-center">
                                    <img src="{{ asset('img/Icon-PPOB/TV.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                    <p class="card-text">TV</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/Icon-PPOB/Internet.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                <p class="card-text">Internet</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/Icon-PPOB/Telepone-Rumah.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                <p class="card-text">Telepon Rumah</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/Icon-PPOB/Tiket-Bus.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                <p class="card-text">Tiket BUS</p>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="text-center">
                                <img src="{{ asset('img/Icon-PPOB/rote.png') }}" alt="" class="card-img-top" style="width:50px; height:50">
                                <p class="card-text">Tour</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection