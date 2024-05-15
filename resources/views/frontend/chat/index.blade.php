@extends('layouts.scaffold')

@section('css')
    <style type="text/css">
        .warnas {
            background-color:#ff823e0a;
        }
        .filters-container{
          background-color: transparent !important;
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
        .reciver{
          background-color: #c7d4dd;
          border-radius: 1rem;
          padding: 10px 15px;
          display: inline-block;
        }
        .time{
            display: flex;
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
            cursor: pointer;
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
        <div class="col-md-6" id="side-2">
          <div id="chatpanel" class="card" style="display: none">
            <div class="card-header">
              <div class="rows">
                <div class="col-2 col-sm-2 col-md-2 col-lg-1">
                    <img src="{{ asset('users.png') }}" class="profile-pic rounded-circle" id="imgChat" alt="" srcset="">
                </div>
                <div class="col-5 col-sm-5 col-md-5 col-lg-7">
                    <div class="name" id="divChatName">Any Name</div>
                    <div class="under-name" id="divChatSeen">Last seen 20/12/2020</div>
                </div>
                <div class="col-4 col-sm-4 col-md-4 col-lg-3 icon">
                    <i class="fa fa-search" style="margin-right: 25px"></i>
                    <span class="dropdown open">
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
                  <div class="col-2 col-md-1" id="foice" style="padding: 0px; cursor: pointer">
                      <i id="send" class="fa fa-paper-plane fa-2x"></i>
                  </div>
              </div>
          </div>
        </div>
        <div id="divstart" class="text-center">
          <img src="{{ asset('img/logo/favicon-16x16.png') }}" alt="" width="250">
          {{-- <i class="fa fa-comments mt-5" style="font-size: 250px"></i> --}}
          <h2>Silahkan memilih pesan untuk memulai percakapan</h2>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js-chat')
  <script>
    // loadAllEmoji();
    // onStateChanged(); 
    function loadlistchat(){
      $.ajax({
        type: 'GET',
        url: "{{ url($pageUrl.'show-friend') }}",
        data:{
          _token:"{{ csrf_token() }}"
        },
        success: function(res){
          $('#listChat').html(res);
        }
      });
    }
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
          document.getElementById('chatpanel').removeAttribute('style');
          document.getElementById('divstart').style.display = "none";
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
    function addchat(friend_id, chat_name, chat_image, key){
      var url = "{{ url($pageUrl.'add-friend') }}";
      var _token = "{{ csrf_token() }}";
      var user_id = "{{ $user_id }}";
      sends(url, _token, friend_id, user_id, chat_image, chat_name, key);
      setInterval(function(){ 
        $('#message').load(url,{
          _token,
          friend_id,
          user_id,
          key,
        });
      }, 3000);
    }
    key = '';
    friend_id = '';
    $(document).on('click','.startchat',function(){
      key = $(this).data('key');
      const chat_name = $(this).data('nama');
      friend_id = $(this).data('id');
      const url = "{{ url($pageUrl.'add-friend') }}";
      const urls = "{{ url($pageUrl.'load-chat') }}";
      const _token = "{{ csrf_token() }}";
      const user_id = "{{ $user_id }}";
      const chat_image = $('.image-chat' + key).attr('src');
      sends(url, _token, friend_id, user_id, chat_image, chat_name, key);
      setInterval(function () {
        $('#message').load(url,{
            _token,
            friend_id, 
            user_id,
        });
      }, 3000);
    });
    $(document).on('keypress','#txmessage',function(event){
      let keycode = (event.keyCode ? event.keyCode : event.which);
      if(keycode == '13'){
          const message = $(this).val();
          const key = $('.key').data('key');
          $.ajax({
            type: 'POST',
            url: "{{ url($pageUrl.'room/send-message') }}",
            data:{
              _token:"{{ csrf_token() }}",
              friend_id:friend_id,
              user_id:{{ $user_id }},
              message:message,
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
    $(document).on('click','#send',function(){
      const message = $('#txmessage').val();
      const key = $('.key').data('key');
      if(message != ''){
        $.ajax({
          type: 'POST',
          url: "{{ url($pageUrl.'room/send-message') }}",
          data:{
            _token:"{{ csrf_token() }}",
            friend_id:friend_id,
            user_id:{{ $user_id }},
            message:message,
            key:key
          },
          success: function(resp){
            $('#message').html(resp);
            $('#txmessage').val('');
            $('#txmessage').focus();
            document.getElementById('message').scrollTo(0, document.getElementById('message').clientHeight);
          }
        });
      }else{
        alert('tidak boleh kosong');
      }
  
   });
    $(document).on('click','#lnkNewchat',function(){
      $.ajax({
        type: 'GET',
        url: "{{ url($pageUrl.'show-list') }}",
        data:{
          _token:"{{ csrf_token() }}"
        },
        success: function(res){
          $('#listFriend').html(res);
        }
      });
    });
    $(document).ready(function(){
      setInterval(function(){ 
        loadlistchat();
      }, 3000);
    });
  </script>
@endsection