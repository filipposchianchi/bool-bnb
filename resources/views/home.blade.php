@extends('layouts.app')

@section('content')
<div class="container">
    <h1>michele filippo</h1>
    <h1>Apartments:</h1>
    <div class="row">
        @foreach ($apartments as $apartment)
        <div class="card mb-3 col-6 apartment">
            <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                <img src="{{$apartment -> img}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">{{$apartment -> title}}</h5>
                    <p class="card-text"><strong>Indirizzo : </strong>{{$apartment -> address}}</p>
                    <p class="card-text">{{$apartment -> description}}</p>
                    <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                </div>
            </a>
          </div>
        @endforeach
    </div>
</div>
@endsection
