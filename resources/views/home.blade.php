@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="/search-apartment" method="get">
                <div class="input-group">
                    <input type="search" name="search" class="form-control">
                    <span class="input-group-prepend">
                        <button class="btn btn-primary">CERCA</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <h1>Apartments:</h1>
    </div>
    <div class="row">
        @foreach ($apartments as $apartment)
        <div class="card mb-3 col-6 apartment">
            <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                <img src="{{$apartment -> img}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$apartment -> title}}</h5>
                    <p class="card-text"><strong>address</strong>
                        {{$apartment -> countryCode}} 
                        {{$apartment -> streetNumber}} 
                        {{$apartment -> streetName}} 
                        {{$apartment -> municipality}} 
                        {{$apartment -> postalCode}} 
                       <div id='map' class='map'></div>
                   </p>
                    <p class="card-text">{{$apartment -> description}}</p>
                    <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                </div>
            </a>
          </div>
        @endforeach
    </div>
</div>
@endsection
