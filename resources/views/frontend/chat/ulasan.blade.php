@extends('layouts.scaffold')

@section('css')
    <style type="text/css">
        .warnas {
            background-color:#ff823e0a;
        }
        .card{
          position:relative;
          display:-ms-flexbox;
          display:flex;
          -ms-flex-direction:column;
          flex-direction:column;
          min-width:0;
          word-wrap:break-word;
          background-color:#fff;
          background-clip:border-box;
          border:1px solid rgba(0,0,0,.125);
          border-radius:.25rem
        }
        .card-header{padding:.75rem 1.25rem;
          margin-bottom:0;
          background-color:rgba(0,0,0,.03);
          border-bottom:1px solid rgba(0,0,0,.125)
        }
        .card-body{
          -ms-flex:1 1 auto;
          flex:1 1 auto;
          padding:1.25rem;
          height: 40rem;
        }
        .justify-content-end{
          -ms-flex-pack:end!important;
          justify-content:flex-end!important
        }
        .card-footer{
          padding:.75rem 1.25rem;
          background-color:rgba(0,0,0,.03);
          border-top:1px solid rgba(0,0,0,.125)
        }
        .rows{
          display:-ms-flexbox;display:flex;
          -ms-flex-wrap:wrap;
          flex-wrap:wrap;
          margin-right:-15px;
          margin-left:-15px
        }
        .float-right{
          float:right!important
        }
        .chatbox{
          height: calc(100% - 40px);
          width: 95%;
          margin-top: 20px;
          padding: 0px;
        }
        
        .profile-pic{
            height: 40px;
            width: 40px;
        
        }
        
        .form-rounded{
            border-radius: 1rem;
        }
        
        .name{
            font-weight: 400;
            color: #000000;
        }
        
        .under-name{
            font-size: 12px;
            line-height: 15px;
            max-height: 15px;
        }
        
        .icon{
            font-size: 20px;
            padding: 5px;
        }
        .chat-pic{
            height: 30px; width: 30px;
        }
        .recive{
            background-color: lightgreen;
            border-radius: 1rem;
            padding: 10px 15px;
            display: inline-block;
        }
        .time{
            font-size: 10px;
            color: #a3a19c;
            margin-top: 5%;
            margin-left: 1%;
        }
        .sent{
            background-color: whitesmoke;
            border-radius: 1rem;
            padding: 10px 15px;
            display: inline-block;
        }
        #message{
            overflow-y: scroll;
            overflow-x: hidden;
        }
        
        .dropdown-toggle::before{
            display: none !important;
        }
        .h-100{
          height: 100%;
        }
        #emoji{
          position: absolute;
          top: -30vh;
          background: #fff;
          border-radius: 5px;
          width: 100%;
        }
        #side-1{
          padding: 0;
        }
        #side-2{
          padding: 0;
        }
        .detail-user{
          height: 70vh;
        }
        .components li .title{
          padding: 10px !important;
          font-size: 16px;
          color: #000;
          font-weight: 600;
        }
        .components li ul li{
          padding: 5px;
          margin-left: 15px;
        }
        .scroll-tabs{
          margin-bottom: 0px;
        }
        .ft0{font: bold 32px 'Arial';color: #ffc000;line-height: 37px;}
        .ft1{font: bold 32px 'Arial';color: #00b050;line-height: 37px;}
        {{-- android --}}
        @media (max-width: 575.98px) { 
          #divstart{
            display: none;
          }
          .chats-mobile{
            display: none;
          }
          #side-2{
            width: 100%;
          }
          #side-1{
            width: 100%;
          }

          #text-send #smile,
          #text-send #foice{
            padding: 2px !important;
          }

        }
    </style>
@endsection

@section('scripts')
<script type="text/javascript">

</script>
@endsection
@section('content-frontend')
<main class="outer-top"></main>
<div class="container">
  <div class="filter-tabs">
    <div class="container-fluid bg-white chatbox shadow-lg rounded">
      <div class="rows h-100">
        <div class="col-md-3">
          <div class="card detail-user">
            <div style="display: flex; padding: 10px; border-bottom: 1px solid #000;">
              <img id="imgProfile" src="{{ asset('users.png') }}" alt="" class="profile-pic">
              <div class="desc-pesan" style="padding: 5px">
                <p style="margin: 0px">{{ auth()->user()->nama }}</p>
                <p style="margin: 0px; color: #beb6b6">verived</p>
              </div>
            </div>
            <ul class="list-unstyled components" id="pesanlist">
              <li class="active">
                <a href="javascript:void(0)" id="linkpesan" class="title">Metode Pembayaran</a>
                <i style="float: right; line-height: 22px; padding: 0px 10px" class="fa fa-chevron-up" aria-hidden="true"></i>
                <ul class="list-unstyled bg-secondary " id="pesan">
                  <li class="colapse-item"><a href="#profile">OVO</a></li>
                  <li class="colapse-item"><a href="#">COD</a></li>
                  <li class="colapse-item"><a href="#">Bank Transfer</a></li>
                </ul>
              </li>
            </ul>
            <ul class="list-unstyled components" id="pesanlist">
              <li>
                <a href="javascript:void(0)" id="linkpesan" class="title">Pesan Masuk</a>
                <i style="float: right; line-height: 22px; padding: 0px 10px" class="fa fa-chevron-up" aria-hidden="true"></i>
                <ul class="list-unstyled bg-secondary " id="pesan">
                  <li class="colapse-item"><a href="{{ url('chat') }}">Chat</a></li>
                  <li class="colapse-item"><a href="{{ url('chat/diskusi') }}">Diskusi</a></li>
                  <li class="colapse-item"><a href="{{ url('chat/ulasan') }}">Ulasan</a></li>
                  <li class="colapse-item"><a href="#">Pesan Bantuan</a></li>
                  <li class="colapse-item"><a href="#">Pesan Dikomplain</a></li>
                </ul>
              </li>
            </ul>
            <ul class="list-unstyled components" id="pesanlist">
              <li>
                <a href="javascript:void(0)" id="linkpesan" class="title">Belanjaan</a>
                <i style="float: right; line-height: 22px; padding: 0px 10px" class="fa fa-chevron-up" aria-hidden="true"></i>
                <ul class="list-unstyled bg-secondary " id="pesan">
                  <li class="colapse-item"><a href="#profile">Menunggu Pembayaran</a></li>
                  <li class="colapse-item"><a href="#">Daftar Transaksi</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-9">
          <div class="more-info-tab clearfix" id="content">
            <div id="product-tabs-slider" class="scroll-tabs wow fadeInUp">
              <div class="more-info-tab clearfix ">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="home" aria-selected="true"><h3>Ulasan Saya</h3></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#bank" role="tab" aria-controls="home" aria-selected="true"><h3>Ulasan Pembeli</h3></a>
                  </li>
                </ul>
              </div>
            </div>
            <div class="tab-content">
              <div class="tab-pane in active" id="profile">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <div class="col-md-1">
                        <p class="text-white-50">Filter : </p>
                      </div>
                      <div class="col-md-4">
                        <select name="" id="" class="form-control">
                          <option value="">2 Bulan Terakhir</option>
                        </select>
                      </div>
                      <div class="col-md-2">
                        <select name="" id="" class="form-control">
                          <option value="">Semua</option>
                        </select>
                      </div>
                      <div class="col-md-5">
                        <select name="" id="" class="form-control">
                          <option value="">Nama Penjual / Produk Atau Toko</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                     <div id="divstart" class="text-center">
                      <img src="{{ asset('img/logo/favicon-16x16.png') }}" alt="" width="250">
                      {{-- <i class="fa fa-comments mt-5" style="font-size: 250px"></i> --}}
                      <p class="class="p0 ft1"">
                        <span class="ft0">Ayo</span><span class="ft1">kulakan</span>
                      </p>
                      <h2>Belum Ada Reputasi</h2>
                    </div>   
                  </div>
                </div>
              </div>
              <div class="tab-pane in" id="bank">
                <div class="card">
                  <div class="card-header">
                    <p class="text-white-50" style="float: left; margin-right:5px">Tampilkan : </p>
                    <button class="btn btn-warning">Semua</button>
                    <button class="btn btn-warning">Belum Dibaca</button>
                    <button class="btn btn-warning">Belum Dibalas</button>
                  </div>
                  <div class="card-body">
                    <div id="divstart" class="text-center">
                      <img src="{{ asset('img/logo/favicon-16x16.png') }}" alt="" width="250">
                      {{-- <i class="fa fa-comments mt-5" style="font-size: 250px"></i> --}}
                      <p class="class="p0 ft1"">
                        <span class="ft0">Ayo</span><span class="ft1">kulakan</span>
                      </p>
                      <h2>Belum Ada Diskusi Produk</h2>
                    </div>
                  </div>
                </div>
              </div>
              <div class="tab-pane in" id="ganti-pass">
                <div class="card">
                  <div class="card-header">
                    <p class="text-white-50" style="float: left; margin-right:5px">Tampilkan : </p>
                    <button class="btn btn-warning">Semua</button>
                    <button class="btn btn-warning">Belum Dibaca</button>
                    <button class="btn btn-warning">Belum Dibalas</button>
                  </div>
                  <div class="card-body">
                    <div id="divstart" class="text-center">
                      <img src="{{ asset('img/logo/favicon-16x16.png') }}" alt="" width="250">
                      {{-- <i class="fa fa-comments mt-5" style="font-size: 250px"></i> --}}
                      <p class="class="p0 ft1"">
                        <span class="ft0">Ayo</span><span class="ft1">kulakan</span>
                      </p>
                      <h2>Belum Ada Diskusi Produk</h2>
                    </div>
                  </div>
                </div>
              </div>
    
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js-chat')
  <script>
    $(document).ready(function(){
      $('#pesanlist li ').click(function () {
        $('ul', this).slideToggle("fast");
        $('i', this).toggleClass('fa-chevron-down fa-chevron-up');
      });
    });
  </script>
@endsection