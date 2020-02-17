@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="hero col-md-12">
        </div>
    </div>
    <div class="row justify-content-center mt-4 p-8">
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
        <div class="col-md-10 text-center">
            <h1>Appartamenti in evidenza</h1>
        </div>
        <hr>
        <div class="row flex-column apartments">

            @foreach ($apartments as $apartment)
            <div class="col-sm-12 col-md-4 apartment">
                <div class="box mx-3 card mb-3 ">
                    <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                        <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
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
              </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
