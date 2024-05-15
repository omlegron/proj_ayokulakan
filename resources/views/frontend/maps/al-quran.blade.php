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
  text-align: center;
  color: white;
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
</style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
    <div class="body-content">
        <div class="container-fluid" style="margin-bottom: 50px">
            <img src="{{ asset('img/banner.jpg') }}" style="width: 100%;height: 400px;" alt="">
            <img class="centered" src="{{ asset('img/quran-banner.png') }}" alt="">
            <h3 class="centered" style="margin-top: 130px">Al-Qur'an Digital</h3>
          </div>
        
            <div class="container-fluid">
                {{-- <h3>Al-qur'an</h3> <br> --}}
                <div class="row">
                    
                    @foreach ($quran as $item)
                    <form action="baca-quran" method="POST">
                        {{  csrf_field() }}
                        <input type="hidden" value="{{ $item->number }}" name="number">
                        <div class="col-xs-12 col-sm-12 col-md-4">
                                <div class="header">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <h5 class="left">{{ $item->number }}</h5>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <h5 class="right">{{ $item->englishName }}</h5>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <h5 class="left">{{ $item->name }}</h5>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <h5 class="right">{{ count($item->ayahs) }} Ayat</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="body">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <h5 class="left">{{ $item->revelationType }}</h5>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <h5 class="right">{{ $item->englishNameTranslation }}</h5>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            <button type="submit" class="btn btn-primary">Baca</button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
    </div>
</div>
@endsection

@section('scripts')

@endsection
