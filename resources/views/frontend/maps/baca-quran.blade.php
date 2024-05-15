@extends('layouts.scaffold')

@section('js-filters')
d.nama = $("input[name='filter[name]']").val();
@endsection

@section('rules')
<script type="text/javascript">
    formRules = {
        judul: ['empty']
    , };

</script>

@endsection

@section('css')
<style>
    .outer-top {
        margin-top: 188px;
    }
    .terms-conditions-page{
        padding-top: 0px !important;
    }

    @media only screen and (max-width: 768px) {
        .outer-top {
            margin-top: 387px;
        }
    }
    .container-fluid {
  position: relative;
  /* text-align: center; */
  /* color: white; */
}

.bottom-left {
  position: absolute;
  bottom: 8px;
  left: 16px;
}

.top-left {
  position: absolute;
  top: 8px;
  left: 16px;
}

.top-right {
  position: absolute;
  top: 8px;
  right: 16px;
}

.bottom-right {
  position: absolute;
  bottom: 8px;
  right: 16px;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
.header {
    background-color: #317542;
    padding: 10px;
    /* margin-bottom: 20px; */
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.body {
    background-color: #729c7c;
    padding: 10px;
    margin-bottom: 20px;
    border-bottom-left-radius: 10px;
    border-bottom-right-radius: 10px;
}
.left {
    text-align: left;
    margin-left: 10px;
}
.right {
    text-align: right;
    margin-right: 10px;
}
#quran {
  border: 1px solid;
  padding: 10px;
  box-shadow: 5px 10px #888888;
}
</style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
    <div class="body-content">
        <div class="container-fluid" style="margin-bottom: 50px;color: white">
            <img src="{{ asset('img/banner.jpg') }}" style="width: 100%;height: 400px;" alt="">
            <img class="centered" src="{{ asset('img/quran-banner.png') }}" alt="">
            <h3 class="centered" style="margin-top: 130px">Al-Qur'an Digital</h3>
          </div>
        
            <div class="container-fluid">
                {{-- <h3>Al-qur'an</h3> <br> --}}
                <div class="row">
                    <div id="quran">
                        <h2 style="text-align: right"><b>{{ $quranAudio->name }}</b></h2>
                        <h4 style="text-align: right">{{ $quranAudio->englishName }}</h4>
                        <h4 style="text-align: right">{{ $quranAudio->englishNameTranslation }}</h4>
                        <h4 style="text-align: right">{{ count($quranAudio->ayahs) }} Ayat</h4><br><br>
                        <div class="row">
                            @foreach ($quranAudio->ayahs as $item)
                                <div class="col-md-12" style="text-align: right">
                                    
                                    <audio controls>
                                        <source src="{{ $item->audio }}" type="audio/mpeg">
                                    </audio>

                                </div><br>
                                <div class="col-md-12" style="margin-bottom: 20px">
                                    <h4 style="text-align: right"><b>{{ $item->text }}</b></h4>
                                    
                                    {{-- <audio controls>
                                        <source src="{{ $quranAudio->ayahs }}" type="audio/mpeg">
                                    </audio> --}}

                                </div><br>
                            @endforeach
                            
                        </div>
                        
                    {{ $quranAudio->number }}
                    </div>
                    
                    
                </div>
            </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
