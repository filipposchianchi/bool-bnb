@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card mb-3 col-9">
            <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title">{{$apartment -> title}}</h5>
              <p class="card-text"><strong>address</strong>
                {{$apartment -> streetName}} 
                {{$apartment -> streetNumber}} 
                {{$apartment -> municipality}} 
                {{$apartment -> postalCode}} 
                {{$apartment -> countryCode}} 
                <div id='map' class='map'></div>
            </p>
              <p class="card-text"><strong>descrizione</strong> {{$apartment -> description}}</p>
              <p class="card-text"><strong>roomNum</strong> {{$apartment -> roomNum}}</p>
              <p class="card-text"><strong>bedNum</strong> {{$apartment -> bedNum}}</p>
              <p class="card-text"><strong>mQ</strong> {{$apartment -> mQ}}</p>
              <p class="card-text"><strong>wcNum</strong> {{$apartment -> wcNum}}</p>
              <p class="card-text"><strong>view</strong> {{$apartment -> view}}</p>
              <p class="card-text"><small class="text-muted">{{$apartment -> created_at}}</small></p>
            </div>
        </div>
        <div class="col-3">
            @foreach ($apartment->services as $service)
                {{$service -> name}} <br>
            @endforeach
        </div>
        <div class="col-8">
            
        </div>
    </div>
</div>
@endsection

