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

</style>
@endsection

@section('content-frontend')
<div class="terms-conditions-page">
    <div class="body-content">
        <a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
        <div id="map" style="width:100%;height:500px"></div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    var map;
      function initMap() {
        var feature = [];
        navigator.geolocation.getCurrentPosition(position => {
        localCoord = position.coords;
            map = new google.maps.Map(
            document.getElementById('map'),
            {center: new google.maps.LatLng(localCoord.latitude, localCoord.longitude), zoom: 18});

            var iconBase = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/';

            var icons = {
              info: {
                icon: "{{ asset('lok-kurir.png') }}"
              },
              me:{
                icon: iconBase + 'info-i_maps.png'
              }
            };

            feature.push({
                "position": new google.maps.LatLng(localCoord.latitude, localCoord.longitude),
                "map": map,
                "type":'me',
                "namadepan":"Posisi Saat Ini",
                "kendaraan" : "",
                "sim" : "",
                "km" : "",
                "kg" : "",
                "phoneNumber" : "",
                "data" : "false",
            });
            @if($record)
                @if($record->count() > 0)
                    @foreach($record as $k => $value)
                        feature.push({
                            "position": new google.maps.LatLng("{{ $value->lat or '' }}", "{{ $value->lng }}"),
                            "type": 'info',
                            "namadepan":"{{ $value->namadepan or '' }}",
                            "kendaraan" : "{{ $value->kendaraan }}",
                            "sim" : "{{ $value->sim }}",
                            "km" : "{{ $value->km }}",
                            "kg" : "{{ $value->kg }}",
                            "phoneNumber" : "{{ $value->phoneNumber }}",
                            "data" : "true",
                        })
                    @endforeach
                @endif
            @endif
            var contentString = '';
             if(feature.length > 0){
                for (var i = 0; i < feature.length; i++) {
                    if(feature[i].data === 'true'){
                         contentString = `<div id="content">
                            <div id="siteNotice"></div>
                            <h1 id="firstHeading" class="firstHeading">`+feature[i].namadepan+`</h1>
                            <div id="bodyContent">
                                <ul>
                                    <li>Kendaraan : `+feature[i].kendaraan+`</li>
                                    <li>Sim : `+feature[i].sim+` </li>
                                    <li>KM : `+feature[i].km+` </li>
                                    <li>KG : `+feature[i].kg+` </li>
                                    <li>No Tlp : `+feature[i].phoneNumber+` </li>
                                </ul>
                            </div>
                        </div>`;
                    }else{
                         contentString = `<div id="content">
                            <div id="siteNotice"></div>
                            <h1 id="firstHeading" class="firstHeading">`+feature[i].namadepan+`</h1>
                        </div>`;
                    }

                    const infowindow = new google.maps.InfoWindow({
                        content: contentString
                    });

                    var marker = new google.maps.Marker({
                        position: feature[i].position,
                        icon: icons[feature[i].type].icon,
                        map: map,
                        title : feature[i].namadepan
                    });

                    marker.addListener("click", () => {
                        infowindow.open(map, marker);
                    });

                }
            }
        });
    }

</script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script>
@endsection