<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>{{ config('app.longname') }}</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Ayokulakan">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-Frame-Options" content="allow">
  
  {{-- Style --}}
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/bootstrap.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/main.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/blue.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/owl.carousel.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/owl.transitions.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/animate.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/rateit.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('new_temp/css/lightbox.css') }}">
  <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>

  <link rel="stylesheet" type="text/css" href="{{ asset('ayokulakan/css/font-awesome.min.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/toastr/build/toastr.min.css') }}">


  <link rel="stylesheet" href="{{ asset('plugins/sweetalert/sweetalert2.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">

  <link rel="stylesheet" href="{{ asset('plugins/semanticui-calendar/calendar.min.css')}}">
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-lite.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
  <link rel="stylesheet" href="{{ asset('ayokulakan/css/dropify/css/dropify.css') }}">
  <style media="screen">
  	.float{
  		bottom:34px;
  		right:20px;
  		text-align:center;
  		box-shadow: 1px 1px 3px #999;
      z-index: 100;
  	}

  	.my-float{
  		margin-top:22px;
  	}

    #myBtn {
      display: none;
      bottom: 27px;
      left: 35px;
      position: fixed;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      color: white;
      cursor: pointer;
      padding: 10px;
      border-radius: 4px;
    }
    #myBtn2 {
      position: fixed;

      z-index: 99;
      border: none;
      outline: none;
      color: white;
      cursor: pointer;
      border-radius: 4px;
    }

  </style>
  <style type="text/css">
  .errors{
    background-color: #dc354547!important;
  }

  .red-text{
    color: red;
  }
.dropdown-submenu{position:relative;}
.dropdown-submenu>.dropdown-menu{top:0;left:100%;margin-top:-6px;margin-left:-1px;-webkit-border-radius:0 6px 6px 6px;-moz-border-radius:0 6px 6px 6px;border-radius:0 6px 6px 6px;}
.dropdown-submenu>a:after{display:block;content:" ";float:right;width:0;height:0;border-color:transparent;border-style:solid;border-width:5px 0 5px 5px;margin-top:5px;margin-right:-10px;}
.dropdown-submenu.pull-left{float:none;}.dropdown-submenu.pull-left>.dropdown-menu{left:-100%;margin-left:10px;-webkit-border-radius:6px 0 6px 6px;-moz-border-radius:6px 0 6px 6px;border-radius:6px 0 6px 6px;}

@media screen and (max-width: 768px) {
	.h3, h3 {
		font-size: 16px;
	}
}
</style>

<link rel="stylesheet" type="text/css" href="{{ url('/plugins/datepicker/datepicker3.css') }}">
<style>

</style>

@yield('css')
@yield('styles')
</head>

<a href="mailto:admin@ayokulakan.com" id="myBtn2" class="float btn btn-sm btn-danger"  title="Go to Questions">
  <li class="fa fa-question-circle fa-2x"></li>
</a>
<button onclick="topFunction()" id="myBtn" class="btn btn-sm btn-primary" title="Go to top" style="bottom: 34px;left: 20px;width:38px;height:33px;text-align: center;box-shadow: 1px 1px 3px #999;z-index: 100;">
  <li class="fa fa-arrow-up" style="font-size: 20px;position: relative;right: 3px;"></li>
</button>
<body class="cnt-home">
  @yield('body')

  <div v-cloak>
    @yield('additional')
  </div>

  @yield('modalss')

  {{-- Script --}}
  <script>
  window.Laravel = {!! json_encode([
    'csrfToken' => csrf_token(),
    ]) !!}
  </script>
  <script src="{{ asset('ayokulakan/js/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/owl.carousel.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/echo.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/jquery.easing-1.3.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/bootstrap-slider.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/jquery.rateit.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/lightbox.min.js') }}"></script>
  
  <script src="{{ asset('new_temp/js/scripts.js') }}"></script>
  <script src="{{ asset('new_temp/js/slick.min.js') }}"></script>
  <script src="{{ asset('new_temp/js/autoNumeric.js') }}"></script>
  
  <script src="{{ asset('plugins/jQuery/jquery.form.min.js') }}"></script>
  <script src="{{ asset('plugins/fastclick/fastclick.js') }}"></script>
  <script src="{{ asset('plugins/sweetalert/sweetalert2.js') }}"></script>
  <script src="{{ asset('semantic/semantic.js') }}"></script>
  <script src="{{ asset('plugins/daterangepicker/moment.js') }}"></script>
  <script src="{{ asset('plugins/semanticui-calendar/calendar.min.js')}}"></script>
  <script src="{{ asset('plugins/summernote/summernote-lite.js') }}"></script>
  <script src="{{ asset('plugins/toastr/build/toastr.min.js') }}"></script>
  <script src="{{ asset('plugins/bootstrap-input-spinner-master/src/bootstrap-input-spinner.js') }}"></script>
  <script src="{{ asset('js/chart.bundle.min.js') }}"></script>
  <script src="{{ asset('ayokulakan/js/dropify/js/dropify.min.js') }}"></script>

  <script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
  <script src="https://www.gstatic.com/firebasejs/7.23.0/firebase.js"></script>
  <script src="{{ asset('new_temp/js/firebase.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js" integrity="sha256-gJWdmuCRBovJMD9D/TVdo4TIK8u5Sti11764sZT1DhI=" crossorigin="anonymous"></script>
  <script type="text/javascript">
    $.fn.selectpicker.Constructor.BootstrapVersion = '3';
  </script>

  @include('layouts.scripts.frontend-darmawisata')
@yield('js')

@yield('scripts')
@if(auth()->user())
@include('frontend.chat.script.index')
    @yield('js-chat')
@endif
<script type="text/javascript">
  var mybutton = document.getElementById("myBtn2");
    console.log('mybutton',mybutton)
    
    window.onscroll = function() {
      scrollFunction()
    };
    function scrollFunction() {
      if(mybutton != null){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      } 
    }
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
  const messaging = firebase.messaging();
  function pustNotif()
  {
    messaging.requestPermission().then(function(){
      return messaging.getToken();
    }).then(function(token){
        $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': "{{ csrf_token() }}"
          }
        });

        $.ajax({
            url: '{{ route("jadwal-sholat-token") }}',
            type: 'POST',
            data: {
                token: token
            },
            dataType: 'JSON',
            success: function(response) {
              sendNotif(response.login_token);
            },
            error: function(err) {
                console.log('Token Error' + err);
            },
        });
    });
  }
  function sendNotif(token)
  {
    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}"
      }
    });

    $.ajax({
        url: '{{ route("token-send") }}',
        type: 'POST',
        data: {
        },
        dataType: 'JSON',
        success: function(response) {
          token : token
        },
        error: function(err) {
            console.log('Token Error' + err);
        },
    });
  }
  $(document).ready(function(){
    pustNotif();
    messaging.onMessage(function(payload) {
      const noteTitle = payload.notification.title;
      const noteOptions = {
          body: payload.notification.body,
          icon: payload.notification.icon,
      };
      new Notification(noteTitle, noteOptions);
    });
    $(".notifChat").html("");
    $('ul.dropdown-menu [data-toggle=dropdown]').on('click', function(event) {
			event.preventDefault();
			event.stopPropagation();
			$(this).parent().siblings().removeClass('open');
			$(this).parent().toggleClass('open');
    });
    $('.drop-akun').click(function () {
      $('.drodown-header').slideToggle("slow");
    });
    $('li.dropdown-body').hover(
      function(){
        $(this).find('.events').stop(true,true).slideToggle('slow');
      },
      function(){
        $(this).find('.events').stop(true,true).slideUp('slow');
      }
    );
  });
  $(document).on("click", function(event){
    var $trigger = $("#my-account");
    if($trigger !== event.target && !$trigger.has(event.target).length){
        $(".drodown-header").slideUp("slow");
    }            
  });
  
    // kategori
  // $(document).ready(function(){
  //   // $('#responsive').each(function(){
  //   //   $('.btn-kat').on('click', function(){
  //   //     $('#icon-kat').toggle();
  //   //   });
  //   // });
  //   // $('#close').click(function(e){
  //   //   e.preventDefault();
  //   //   $('#icon-kat').hide();
  //   // });
  // });
  $(document).on('click','#btn-kat',function(){
    console.log('')
    $('#icon-kat').show();
  });
  $(document).on('click','#close',function(e){
      e.preventDefault();
      $('#icon-kat').hide();
  });
  $(document).ready(function(){
    $('ul#lapaks-barang').each(function(){
      var $dropdown = $(this);
      $("a#links",$dropdown).on('mouseenter',function(){
          var id = $(this).attr('data-url');
          $.ajax({
            type: 'GET',
            url: "{{ url('/ajkategori') }}/" + id,
            success: function(resp){
              $('#finds-kategori').html(resp);
              
            },
          });
        });
    });
    
  });
/*===================================================================================*/
/*  pillihan menu
/*===================================================================================*/
$(document).ready(function(){
  var down = true;
  $("#nav li").on('mouseenter',function(e){
      $(this).find('ul').stop(true,false,true).toggle(1000);
  });
  $("#nav li").on('mouseleave',function(e){
    $(this).find('ul').stop(true,false,true).hide(1000);
  });

});
$(document).on('click','#serch-icon',function(){
  $('#responsive').hide();
  $('#mobile').show();
});

$(document).on('mouseenter', '.show-front.show', function(e) {
  var url = $(this).data('url');
  $.ajax({
    type: "GET",
    url:url,
    data:{ _token: "{{ csrf_token() }}"},
    success: function(res){
      $('#listorder').html(res);
      $('#cart').addClass('open');

    }
  });
  }).on('mouseleave','.dropdown-menu',function(){
  $('#cart').removeClass('open');
});

$(document).on('mouseenter', '.show-front.pesan', function(e) {
  $('#pesan').addClass('open');
  }).on('mouseleave','.dropdown-menu',function(){
  $('#pesan').removeClass('open');
});
</script>

</body>
</html>
