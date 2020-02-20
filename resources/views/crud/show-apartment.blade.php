@extends('layouts.app')

@section('content')
<div class="container mt-2">
    <div class="row justify-content-center">
        <div class="card mb-3 col-9 p-3" >
            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
            <div class="card-body row">
                <div class="col-8">
                    <h5 class="card-title"><strong>Nome appartamento:</strong> {{$apartment -> title}}</h5>
                    <p class="card-text"><strong>Indirizzo:</strong> {{$apartment -> address}}</p>
                    <p class="card-text"><strong>Descrizione</strong> {{$apartment -> description}}</p>
                    <p class="card-text"><strong>Numero di stanze</strong> {{$apartment -> roomNum}}</p>
                    <p class="card-text"><strong>Posti letto</strong> {{$apartment -> bedNum}}</p>
                    <p class="card-text"><strong>Mq</strong> {{$apartment -> mQ}}</p>
                    <p class="card-text"><strong>Numero di bagni</strong> {{$apartment -> wcNum}}</p>
                    {{-- <p class="card-text"><strong>view</strong> {{$apartment -> view}}</p> --}}
                    <p class="card-text"><small class="text-muted">Aggiunto il: {{$apartment -> created_at}}</small></p>
                </div>
                <div class="col-3 offset-1">
                    @if (!$apartment->services->count() == 0)
                        <h5 class="card-title"><strong>Servizi</strong></h5>
                        @foreach ($apartment->services as $service)
                            <p class="card-text">{{$service -> name}} </p>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        

    </div>
    <div class="row mt-3 jutify-items-center h-50">
        
        <div class="card col-6 p-3">
            <h5 class="card-title">Contatta il proprietario</h5>

            <form action="{{route('message.store', $apartment -> id)}}" method="post">
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="email">Email:</label> 

                    @auth
                    <br>
                    <input class="form-control" type="email" name="email" value="{{ Auth::user() -> email }}">
                    @else
                    <br>
                    <input class="form-control" type="email" name="email" value="">
                    @endauth
                    
                    <br>
                    <label for="titolomsg">Titolo messaggio:</label> 
                    <input class="form-control" type="text" name="title" value="" required>
                    <br>
                    <label for="messaggio">Messaggio:</label> 
                    <textarea class="form-control" type="text" name="body" value="" required></textarea>
                    <br>
                    <button type="submit">INVIO MESSAGGIO</button>
                    

                    @if(Session::has('msg'))
                    <p class="alert mt-3 {{ Session::get('alert-class', 'alert-info') }}">
                        {{ Session::get('msg') }}
                    </p>
                    @endif

                </div> 
            </form>

        </div>
        <div class="col-6">
            <div id='map' class='map'></div>
        </div>
    </div>
</div>
<script src='https://api.tomtom.com/maps-sdk-for-web/cdn/5.x/5.47.0/maps/maps-web.min.js'></script>
{{-- <script type='text/javascript' src='../assets/js/mobile-or-tablet.js'></script> --}}
<script>
    // tt.setProductInfo('<your-product-name>', '<your-product-version>');
        var map = tt.map({
            key: 'yfpz8kRCWBBiIF0WZOIZLdtsH2DhAfBG',
            container: 'map',
            style: 'tomtom://vector/1/basic-main',
            // dragPan: !isMobileOrTablet(),
            // center: [9.13499000, 39.20660000],
            center: [{{$apartment -> longitude}}, {{$apartment -> latitude}}],
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
    createMarker('icon.colors-white.jpg', [{{$apartment -> longitude}}, {{$apartment -> latitude}}], '#c31a26', 'JPG icon');
</script>

@endsection
