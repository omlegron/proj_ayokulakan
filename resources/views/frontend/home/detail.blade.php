@extends('layouts.scaffold')

@section('css')
    <style type="text/css">
        .warnas {
            background-color:#ff823e0a;
        }
        .filters-container{
          background-color: transparent !important;
          margin-bottom: 10px;
        }
        .chat-body{
          position: fixed;
          width: 80%;
          bottom: 2%; right:0;
          z-index: 100;

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
        .prod-title{
          font-size: 25px;
          font-weight: 600;
          text-transform:capitalize;
        }
        .prod-list span{
          padding-right: 10px;
          font-size: 13px;
        }
        .prod-price p{
          font-size: 20px;
          font-weight: 600;
        }
        .detail-prod li{
          padding: 5px 5px 5px 0px;
          font-size: 12px;
          text-transform: capitalize;
        }
        .detail-lapak{
          padding: 10px;
          display: flex;
        }
        .lapak-picture img{
          height: 40px;
          width: 40px;
          border-radius: 50%;
          padding-right: 10px;
        }
        .lapak-kurir .title{
          font-size: 18px;
          font-weight: 600;

        }
        tr > td , 
        tr > th{
            border: none !important;
        }
        .profile-pic{
          height: 40px;
          width: 40px;
        }
        .detail{
          background-color: #fff;
          padding: 10px;
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
        .reciver{
          background-color: #c7d4dd;
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
          height: 78vh;
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
        #divstart{
          background-color: #fff;
          padding: 10px;
          height: 70vh;
        }
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
<div class="filters-container">
  <div class="filter-tabs">
    <div class="container-fluid bg-white chatbox shadow-lg rounded">
      <div class="row h-100">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6">
              @if($record->attachments->count() > 0)
                <div class="card">
                  <div class="card-body">
                    <img src="{{ url('storage/'.$record->attachments->sortByDesc('created_at')->first()->url) }}" alt="Ayokulakan" width="100%" height="85%">
                    <div class="row" style="padding: 10px">
                      @foreach($record->attachments as $k => $value)
                        <div class="col-md-3" style="border: 1px solid #504646; padding: 0px;">
                          <img src="{{ url('storage/'.$value->url) }}" alt="Ayokulakan" style="width: 100%; height: 100%;">
                        </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              @else
                <div class="card">
                  <div class="card-body">
                    <img src="{{ asset('img/no-images.png') }}" alt="Ayokulakan" width="100%" height="85%">
                    <div class="row" style="padding: 10px">
                      <div class="col-md-3" style="border: 1px solid #000000;">
                        <img src="{{ asset('img/no-images.png') }}" alt="Ayokulakan" style="width: 50px; height: 50px; margin-top: 10px">
                      </div>
                    </div>
                  </div>
                </div>
              @endif
            </div>
            <div class="col-md-6">
              <div class="detail">
                <h4 class="prod-title">{{ $record->nama_barang or '' }}</h4>
                <div class="prod-list">
                  <span>Terjual {{ $record->barang_terjual or '0' }}</span>
                  <span><i class="fa fa-star-o" style="color: #ffa500"></i>0 (0 Ulasan)</span>
                  <span>Diskusi (0)</span>
                </div>
                <div class="prod-price">
                  <p>Rp {{ number_format($record->harga_barang, 2, ".", ".") }}</p>
                </div>
                <div id="product-tabs-slider" class="scroll-tabs outer-top-vs wow fadeInUp">
                  <div class="more-info-tab clearfix ">
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#deskripsi" role="tab" aria-controls="home" aria-selected="true"><p style="font-weight: bold; color: green; color: green">Deskripsi</p></a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#lapak" role="tab" aria-controls="home" aria-selected="true"><p style="font-weight: bold; color: green">Info Lapak</p></a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="tab-content">
                  <div class="tab-pane in active" id="deskripsi" style="overflow-x:auto;">
                    <div class="product-tabs-slider">
                      <div class="more-info-tab clearfix ">
                        <ul class="detail-prod">
                          <li>
                            kondisi Barang: {{ $record->kondisi_barang or '' }}
                          </li>
                          <li>
                            Berat Barang: {{ $record->berat_barang or '' }} Gram
                          </li>
                          <li>
                            Stok Barang: {{ $record->stock_barang or '' }}
                          </li>
                          <li>
                            Kategori Barang: <span>{{ $record->kategoriBarang->kat_nama or '0'}}</span>
                          </li>
                          <li>
                            Share : 
                            <div class="no-padding social">
                              <ul class="link">
                                @php
                                  $share = "ayokulakan.com/sc/barang/".$record->id;
                                @endphp
                                <li class="fb pull-left"><a target="_blank" rel="nofollow" href="https://id-id.facebook.com/sharer.php?u={{$share}}" target="_blank" title="Facebook"></a></li>
                                <li class="tw pull-left"><a target="_blank" rel="nofollow" href="https://twitter.com/share?url={{$share}}hashtags=ayokulakan" title="Twitter"></a></li>
                                <li class="whatshap pull-left"><a target="_blank"  href="https://api.whatsapp.com/send?text={{url('sc/barang/'.$record->id)}}" data-action="share/whatsapp/share"></a></li>
                                <li class="instagram pull-left"><a target="_blank" rel="nofollow" href="https://www.instagram.com/ayokulakan1/" title="Instagram"></a></li>
                              </ul>
                            </div>
                          </li>
                        </ul>
                        <p>{!! $record->deskripsi_barang or '' !!}</p>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane in" id="lapak" style="overflow-x:auto;">
                    <div class="product-tabs-slider">
                      <div class="more-info-tab clearfix "><hr>
                        <div class="detail-lapak">
                          <div class="lapak-picture">
                            <img src="{{ asset('img/users.png') }}" alt="" class="chat-pic">
                          </div>
                          <div class="lapak-title">
                            <p>{{ $record->lapak->nama_lapak or '' }}</p>
                          </div>
                        </div><hr>
                        <hr>
                        <div class="lapak-kurir">
                          <p class="title">Pengiriman</p>
                          <div style="display: block">
                            <p>Dikirim Dari:
                              <span>{{ $record->lapak->kota->kota or '' }}</span>
                              <span>{{ $record->lapak->provinsi->provinsi or '' }}</span>
                            </p>
                          </div>
                        </div>
                        <hr>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12" style="margin-top: 10px;">
              <div class="card">
                <div class="card-header">
                  <p>Diskusi (0)</p>
                  <h4>{{ $record->nama_barang or '' }}</h4>
                </div>
                <div class="card-body" id="diskusi">
                  @if (Auth::check())
                    @if ($message->count() > 0)
                      @foreach ($message as $value)
                          @if ($value->user_id != auth()->user()->id)
                          <div class="rows">
                              <div class="col-2 col-sm-1 col-md-1">
                                  <img src="{{ ($value->user->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->user->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="chat-pic rounded-circle" alt="" srcset="">
                              </div>
                              <div class="col-6 col-sm-6 col-md-6">
                                  <p class="recive">{{ $value->message }}
                                  <span class="time float-right" title="">{{ $value->waktu }}</span>
                                  </p>
                              </div>
                          </div>
                          @else
                              <div class="rows justify-content-end">
                                  <div class="col-6 col-sm-6 col-md-6" style="text-align: end">
                                      <p class="reciver">{{ $value->message }}
                                          <span class="time float-right" title="">{{ $value->waktu }}</span>
                                      </p>
                                  </div>
                                  <div class="col-2 col-sm-1 col-md-1">
                                      <img src="{{ ($value->user->pictureusers->sortByDesc('created_at')->first()) ? imgExist(url('storage/'.$value->user->pictureusers->sortByDesc('created_at')->first()->url)) : asset('img/users.png') }}" class="chat-pic rounded-circle" alt="" srcset="">
                                  </div>
                              </div>
                          @endif
                      @endforeach
                    @endif
                  @endif
                </div>
                <div class="card-footer">
                  <textarea class="form-control" id="txtdiskusi" name="" placeholder="apa yang ingin anda tanyakan tentang produk ini" id="" cols="30" rows="5"></textarea>
                  <button type="button" class="btn btn-success btn-diskusi" style="margin-top: 10px">Kirim</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="detail">
            <table class="table table-borderless">
              <tr>
                  <th colspan="3">Checkout Pesanan</th>
              </tr>
              <tr>
                  <td colspan="3">
                    <div class="nice-number">
                      <input type="number" min="1" name="" value="1" class="number" id="jumlah" style="border-top: none; border-right: none;  border-left: none; !important">
                    </div>
                  </td>
              </tr>
              <tr>
                <th>
                  <p>Subtotal</p>
                </th>
                <th style="text-align: end">
                  <p>Rp {{ number_format($record->harga_barang, 2, ".", ".") }}</p>
                </th>
                <td></td>
              </tr>
              <tr>
                <td colspan="2">
                  <a href="javascript:void(0)" class="btn btn-primary ampass add-cart btn-block" data-item="{{ $record->id or '' }}" data-type="img_barang"><i class="fa fa-shopping-cart inner-right-vs"></i> Masukan Ke Keranjang</a>
                </td>
              </tr>
              <tr>
                @if (Auth::check())
                  @if (isset($record->lapak->users))
                    @if ($record->lapak->users->id != auth()->user()->id)
                      <td>
                        <a href="javascript:void(0)" class="btn btn-white btn-block ampass startchat" data-id="{{ $record->lapak->users->id }}" data-nama="{{ $record->lapak->users->nama }}" style="border: 1px solid #3531314d;"><i class="fa fa-comment"></i> Pesan</a>
                      </td>
                    @endif
                  @endif
                @endif
                <td>
                  <a href="javascript:void(0)" class="btn btn-white btn-block ampass" style="border: 1px solid #3531314d"><i class="fa fa-heart"></i> Favorite</a>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="chat-body" style="display: none">
  <div class="col-md-3 pr-0 d-none d-md-block" id="side-1">
    <div class="card h-100">
      <div class="card-header">
        <div class="rows">
          <div class="col-1 col-sm-1 col-md-1 d-md-none">
            <i class="fa fa-arrow-left icon" style="font-size: 20px; cursor: pointer;" onclick="hidechatlist()"></i>
          </div>
          <div class="col-8 col-sm-8 col-md-8">
            <img id="imgProfile" src="{{ asset('users.png') }}" alt="" class="profile-pic">
          </div>
          <div class="col-2 col-sm-2 col-md-2">
              <div class="dropleft">
                <span class="dropdown-toggle" data-toggle="dropdown" style="float: right">
                    <i class="fa fa-plus icon" style="cursor: pointer; float:right"></i>
                </span>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item" id="lnkNewchat" data-toggle="modal" data-target="#modalFriendLis" style="padding:0px 5px">Chat Baru</a>
                </div>

                <div class="modal fade" id="modalFriendLis">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="card" style="height: 98vh;">
                                <div class="card-header">
                                    Friend List
                                    <span class="close" data-dismiss="modal" style="cursor: pointer">&times;</span>
                                </div>
                                <ul class="list-group list-group-flush" id="listFriend">

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <ul class="list-group list-group-flush" id="listChat">
        <li class="list-group-item" style="background-color: #f8f8f8">
            <input type="text" placeholder="Search Nerw Chat" class="form-control form-rounded">
        </li>
          
      </ul>
    </div>
  </div>
  <div class="col-md-9" id="side-2">
    <div id="chatpanel" class="card">
      <div class="card-header">
        <div class="rows">
          <div class="col-2 col-sm-2 col-md-2 col-lg-1">
              <img src="{{ asset('users.png') }}" class="profile-pic rounded-circle" id="imgChat" alt="" srcset="">
          </div>
          <div class="col-5 col-sm-5 col-md-5 col-lg-7">
              <div class="name" id="divChatName">Any Name</div>
              <div class="under-name" id="divChatSeen">Last seen 20/12/2020</div>
          </div>
          <div class="col-4 col-sm-4 col-md-5 col-lg-3 icon">
              <i class="fa fa-search" style="margin-right: 25px"></i>
              <span class="dropdown open" style="margin-right: 25px">
                <span class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer">
                  <i class="fa fa-paperclip"></i>
                </span>
                <ul class="dropdown-menu">
                  <li>
                    <a href="javascript:void(0)" class="" onclick="choseImage()">Image
                      <input type="file" id="imageFile" onchange="sendImage(this)" accept="image/*" style="display: none" />
                    </a>
                  </li>
                  {{-- <li>
                    <a href="javascript:void(0)" class="">document</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="">Camera</a>
                  </li>
                  <li>
                    <a href="javascript:void(0)" class="">Vidio</a>
                  </li> --}}
                </ul>
              </span>
              <i class="fa fa-chevron-down" id="tutup" style="cursor: pointer"></i>
            </div>
        </div>
      </div>
      <div class="card-body" id="message">
        
      </div>
      <div class="card-footer">
        <div class="rows" style="position: relative">
          <div class="com-md-12" id="emoji" style="display: none">
            <div class="scroll-tabs outer-top-vs wow fadeInUp">
              <div class="more-info-tab clearfix ">
                <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" id="home-tab" data-toggle="tab" href="#grafik" role="tab" aria-controls="home" aria-selected="true"><h3 style="font-weight: bold; color: green; color: green">Emoji</h3></a>
                    </li>
                </ul>
              </div>
              <div class="tab-content" style="height: 10vh">
                <div class="tab-pane in active" id="smileContent">
                  
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="rows" id="text-send">
            <div onclick="showEmoji()" class="col-2 col-md-1" id="smile" style="cursor: pointer">
                <i class="fa fa-smile-o fa-2x" style="padding: 5px"></i>
            </div>
            <div class="col-8 col-md-10">
                <input id="txmessage" onkeyup="changeiconsend(this)" onfocus="hideEmoji()" type="text" class="form-control form-rounded" placeholder="kirim Pesan">
            </div>
            <div class="col-2 col-md-1" id="foice">
                <i id="audio" onmousedown="record(this)" onmouseup="stop(this)" class="fa fa-microphone fa-2x"></i>
                <i id="sendaudio" class="fa fa-paper-plane fa-2x" style="display: none"></i>
            </div>
        </div>
    </div>
  </div>
</div>
</div>
@endsection
@section('js-chat')
@if (Auth::check())
<script>
  key = '';
  friend_id = '';
  function sends(url, _token, friend_id, user_id, chat_image, chat_name ,key){
    $.ajax({
      type: 'POST',
      url: url,
      data:{
        _token: _token,
        friend_id:friend_id,
        user_id: user_id,
        key: key,
      },
      success: function(resp){
        document.getElementById('side-1').classList.add('chats-mobile');
        $('#message').html(resp);
        document.getElementById('divChatName').innerHTML =chat_name;
        document.getElementById('imgChat').src =chat_image;
        document.getElementById('divChatSeen').innerHTML = 'last sen';
        document.getElementById('txmessage').value = '';
        document.getElementById('txmessage').focus();
        document.getElementById('message').scrollTo(0, document.getElementById('message').clientHeight);
        }
    });

  }
  function loadlistchat(){
    $.ajax({
      type: 'GET',
      url: "{{ url('chat/show-friend') }}",
      data:{
        _token:"{{ csrf_token() }}"
      },
      success: function(res){
        $('#listChat').html(res);
      }
    });
  }
  function loadchat(key)
  {
    const urls = "{{ url('chat/load-chat') }}";
    const _token = "{{ csrf_token() }}";
    timer = setInterval(function () {
      $('#message').load(urls,{
          _token,
          key,
      });
    }, 3000);
    clearInterval(timer);
    $.ajax({
      type: 'POST',
      url: urls,
      data:{
        _token: _token,
        key: key,
      },
      success: function(resp){
        $('#message').html(resp);
        document.getElementById('txmessage').value = '';
        document.getElementById('txmessage').focus();
        document.getElementById('message').scrollTo(0, document.getElementById('message').clientHeight);
        }
    });
  }
  $(document).ready(function(){
    $('input[type="number"]').niceNumber({
      autoSize:true,
      autoSizeBuffer: 8,
      buttonDecrement:'-',
      buttonIncrement:"+",
      buttonPosition:'around'

    });

    $('.startchat').click(function(){
      const chat_name = $(this).data('nama');
      friend_id = $(this).data('id');
      const url = "{{ url('chat/add-friend') }}";
      const urls = "{{ url('chat/load-chat') }}";
      const _token = "{{ csrf_token() }}";
      const user_id = "{{ auth()->user()->id }}";
      const chat_image = $('.chat-pic').attr('src');
      sends(url, _token, friend_id, user_id, chat_image, chat_name, key);
      setInterval(function () {
        loadlistchat();
        $('#message').load(url,{
            _token,
            friend_id,
            user_id,
        });
      }, 3000);
      $('.chat-body').removeAttr( 'style' );
    });
    $('#tutup').click(function(){
      $('.chat-body').css("display","none");
    });
  });
  $(document).on('keypress','#txmessage',function(event){
    let keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13'){
        const message = $(this).val();
        key = $('.key').data('key');
        $.ajax({
          type: 'POST',
          url: "{{ url('chat/room/send-message') }}",
          data:{
            _token:"{{ csrf_token() }}",
            friend_id:friend_id,
            user_id:"{{ auth()->user()->id }}",
            message:message,
            id_barang:"{{ $record->id }}",
            key:key
          },
          success: function(resp){
            $('#message').html(resp);
            $('#txmessage').val('');
            $('#txmessage').focus();
            document.getElementById('message').scrollTo(0, document.getElementById('message').clientHeight);
          }
        });
    }

  });
  $(document).on('click','.btn-diskusi',function(event){
    const message = $('#txtdiskusi').val();
    $.ajax({
      type: 'POST',
      url: "{{ url('chat/room/send-diskusi') }}",
      data:{
        _token:"{{ csrf_token() }}",
        friend_id:"{{ $record->lapak->users->id }}",
        message:message,
        id_barang:"{{ $record->id }}",
      },
      success: function(resp){
        $('#diskusi').html(resp);
        $('#txtdiskusi').val('');
        $('#txtdiskusi').focus();
        document.getElementById('diskusi').scrollTo(0, document.getElementById('diskusi').clientHeight);
      }
    });

  });
</script>
@endif
@endsection