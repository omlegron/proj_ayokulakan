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

    @media  only screen and (max-width: 768px) {
        .outer-top {
            margin-top: 387px;
        }
        #my-div
        {
            width    : 370px;
            height   : 660px;
            overflow : hidden;
            position : relative;
            margin-left: -5px;
            
        }

        #my-iframe
        {
            position : absolute;
            top      : -1050px;
            left     : -5px;
            width    : 350px;
            height   : 1800px;
        }
    }
    @media  only screen and (min-width: 769px) {
        #my-div
        {
            width    : 1196px;
            height   : 460px;
            overflow : hidden;
            position : relative;
            margin-left: -150px;
        }

        #my-iframe
        {
            position : absolute;
            top      : -790px;
            left     : -5px;
            width    : 1800px;
            height   : 1400px;

        }
    }





</style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
    <div class="body-content">
        {{-- <div class="" id="map" style="width:100%;height:500px"></div> --}}
        <iframe src="https://qiblafinder.withgoogle.com/intl/id/desktop/finder" style="width: 100%;height: 500px;" frameborder="0"></iframe>
        {{-- <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div id="my-div">
                        {{-- <iframe src="https://www.al-habib.info/arah-kiblat/" id="my-iframe"></iframe> --}}
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@endsection

@section('scripts')
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script>
<script>
    function initMap(){
        
    }

    $(document).ready(function(){
        var dataOb = {};
        var flightArr = [];

        var ipData = $.getJSON('https://ipapi.co/json/', function(data) {
            flightArr.push({lat: 21.422487, lng: 39.826206},{lat: data.latitude, lng: data.longitude});
            var map = new google.maps.Map(document.getElementById('map'), {
                 zoom: 3,
                 center: {lat: -6.135200, lng: 106.813301},
                 mapTypeId: 'terrain'
            });
            var flightPath = new google.maps.Polyline({
                 path: flightArr,
                 geodesic: true,
                 strokeColor: '#FF0000',
                 strokeOpacity: 1.0,
                 strokeWeight: 2
            });
            flightPath.setMap(map);
        });
    });
</script>

@endsection
