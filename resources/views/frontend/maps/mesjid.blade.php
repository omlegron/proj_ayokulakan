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
<a href="{{ url('/') }}" style="font-size:30px; color:orange !important"><i class="glyphicon glyphicon-arrow-left" style="padding: 20px"></i></a>
<div class="terms-conditions-page">
    <div class="body-content">
        <div id="GoogleMap" style="width:100%;height:500px"></div>
    </div>
  </div>
  @endsection
  
  @section('scripts')
  <script>
    function initMap() {
    navigator.geolocation.getCurrentPosition(position => {
        localCoord = position.coords;
        var customStyle = [{
            featureType: "poi",
            elementType: "labels",
            stylers: [{
                visibility: "off"
            }]
        }];

        var map = new google.maps.Map(document.getElementById('GoogleMap'), {
            zoom: 17,
            center: new google.maps.LatLng(localCoord.latitude, localCoord.longitude),
            disableDefaultUI: false,
            styles: customStyle,
        });

        var me = new google.maps.InfoWindow({
            content: 'You are Here'
        });

        var myMark = new google.maps.Marker({
            position: {
                lat: localCoord.latitude,
                lng: localCoord.longitude
            },
            map: map
        });

        myMark.addListener('click', function() {
            me.open(map, myMark);
        });

        fetch(window.apiUrl)
            .then((res) => res.json())
            .then(function(data) {
                for (var i = 0; i < data.results.length; i++) {
                    var coords = data.results[i].geometry.location;
                    var latLng = new google.maps.LatLng(coords);
                    var contentString = `<div>
                        ${data.results[i].name}
                    </div>`;

                var infowindow = new google.maps.InfoWindow({
                    content: contentString
                });

                var marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    icon: window.mapIcon,
                    title: data.results[i].name
                });

                marker.addListener('click', function() {
                    infowindow.open(map, marker);
                });
            }
        });
    });
}
    $(document).ready(function(){
      navigator.geolocation.getCurrentPosition(position => {
          localCoord = position.coords;
          console.log('localCoord',localCoord)
          window.apiUrl = '{{ url("api/cari-lokasi-terdekat") }}'+`?lat=${localCoord.latitude}&lng=${localCoord.longitude}&type=mosque`;
          console.log('window.apiUrl',window.apiUrl)
          window.mapIcon = "{{ asset('img/mosque.png') }}";
      });
    })
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC01hCsQ46I133UAz8pdjjRXlZ-o5DT1pY&callback=initMap"></script>
@endsection