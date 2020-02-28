@extends('layouts.app')
@section('content')

<div class="container py-3 ">
  <div class="row  justify-content-center align-items-center">
    <form action="{{route('apartment.store')}}" method="post" enctype='multipart/form-data'  class="row p-3" style="border: 1px dotted black">
      @csrf
      @method('POST')

      {{-- form apartment registration --}}
      <div class="col-md-6 d-flex">
        <div class="col-md-12">
          <div class="form-group">
            <label for="title">Nome Appartamento:</label>
            <input class="form-control" type="text" name="title" value="" placeholder="Inserisci nome appartamento">
          </div>
          <div class="form-group">
            <label for="address">Indirizzo:</label>
            <input type="text" name="address" id="address" class="form-control input-lg" placeholder="Inserisci l'indirizzo" autocomplete="off" required/>
            <div id="addressList">
            </div>
            <div>
              {{ csrf_field() }}
            </div>
           </div>
          <div class="form-group position">
              <input type="text" name="latitude" id="latitude"/>
              <input type="text" name="longitude" id="longitude"/> 
          </div>
          <div class="form-group">
            <label for="description">Descrizione:</label>
            <textarea  class="form-control" type="text" name="description" value="" placeholder="Inserisci una descrizione dell'appartamento"></textarea>
          </div>
          <div class="form-group">
            <label for="image">Carica una foto:</label>
            <input id="image" class="form-control" type="file" name="image" value="" required>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="row">
          <div class="form-group col-md-6">
            <label for="roomNum">Numero stanze:</label>
            <input class="form-control" type="number" name="roomNum" value="1" min="0" max="20">
          </div>
          <div class="form-group col-md-6">
            <label for="bedNum">Numero letti:</label>
            <input class="form-control" type="number" name="bedNum" value="1" min="0" max="20">
          </div>
          <div class="form-group col-md-6">
            <label for="mQ">Metri quadrati:</label>
            <input class="form-control" type="number" name="mQ" value="1" min="0">
          </div>
          <div class="form-group col-md-6">
            <label for="wcNum">Bagni:</label>
            <input class="form-control" type="number" name="wcNum" value="1" min="0" max="20">
          </div>
        </div>
        <div class="row">
          <div class="form-group">
            <label for="services">Servizi:</label> <br>
              @foreach ($services as $service)
                <span class=" d-inline-block">
                  <input name="services[]" type="checkbox"  value="{{$service->id}}"> {{$service->name}}
                </span> <br>
              @endforeach
          </div> 
        </div>
      </div>
      {{-- <div class="row justify-items-center mt-5">
        <h2 class="col">Creazione appartamento</h2>
      </div>
      <div class="row"> --}}
        
        {{-- gruppo numeri --}}
        
    
        
        <div class="col-md-12 d-flex justify-items-center">
          <button type="submit" class="btn btn-primary col w-75">SALVA</button>
        </div>
      
    </form>
  </div>
  {{-- preview output --}}
  <div class="row justify-content-center align-items-center">
    <div id="map" class="col-md-6 h-100">
      <img src="https://staticmapmaker.com/img/google@2x.png" alt="" class="w-100 h-100" style="filter: grayscale(100%)">
    </div>
    <div class="col-md-6">
      <img id="blah" src="https://cdn0.iconfinder.com/data/icons/photography-11/400/camera-photo-settings-photography-setting-tool-tools-digital-reflex_169-512.png" alt="your image" class="img-fluid w-100" />
    </div>
  </div>
</div>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.47.0/maps/maps-web.min.js'></script>
{{-- <script type='text/javascript' src='../assets/js/mobile-or-tablet.js'></script> --}}
<script>
  function readURL(input) {
    // console.log('test');
    
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]);
  }
}

$("#image").change(function() {
  // alert('test');
  readURL(this);
});
  $(document).on("click", "li", function() {
      $('#map').html('');
      var lat =  $(this).data("lat");
      var lng =  $(this).data("lon");
      createMap(lat,lng);
    });
    function createMap(lat,lng){
      var map = tt.map({
            key: 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG',
            container: 'map',
            style: 'tomtom://vector/1/basic-main',
            // dragPan: !isMobileOrTablet(),
            // center: [9.13499000, 39.20660000],
            center: [lng, lat],
            zoom: 15
        });
    map.addControl(new tt.FullscreenControl());
    map.addControl(new tt.NavigationControl());

    function createMarker(icon, position, color, popupText) {
        var markerElement = document.createElement('div');
        markerElement.className = 'marker';

        var markerContentElement = document.createElement('div');
        markerContentElement.className = 'marker-content';
        markerContentElement.style.backgroundColor = color;
        markerElement.appendChild(markerContentElement);

        var iconElement = document.createElement('div');
        iconElement.className = 'marker-icon';
        iconElement.style.backgroundImage =
            'url(https://api.tomtom.com/maps-sdk-for-web/5.x/assets/images/' + icon + ')';
        markerContentElement.appendChild(iconElement);

        var popup = new tt.Popup({offset: 30}).setText(popupText);
        // add marker to map
        new tt.Marker({element: markerElement, anchor: 'bottom'})
            .setLngLat(position)
            .setPopup(popup)
            .addTo(map);
    }
    createMarker('icon.colors-white.jpg', [lng, lat], '#c31a26', 'JPG icon');
    }
</script>

@endsection