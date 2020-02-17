@extends('layouts.app')
@section('content')

    <div class="container">
        
        <div class="row">
            <button class="btn-primary" > 
                <a class="btn btn-primary" href="{{route("apartment.create")}}" role="button">Inserisci un nuovo apartamento</a>
            </button>
        </div>
        
        @foreach ($apartments as $apartment)
            <div class="row">
                <div class="card mb-3 col-9 apartment">
                    <a class="m-3" href="{{route('apartmentShow', $apartment -> id)}}">
                        <img src="{{asset('images/'.$apartment -> image)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{$apartment -> title}}</h5>
                            <p class="card-text">{{$apartment -> address}}</p>
                            <p class="card-text">{{$apartment -> description}}</p>
                            <p class="card-text"><small class="text-muted">Aggiunto : {{$apartment -> created_at}}</small></p>
                        </div>
                    </a>
                </div>
                <div class="col-3">
                    <a class="btn btn-secondary" href="{{route("apartment.edit" , $apartment -> id)}}" role="button">modifica annuncio</a>
                    <a class="btn btn-primary" href="{{route("apartment.delete" , $apartment -> id)}}" role="button">cancella annuncio</a>
                    <a class="btn btn-primary" href="{{route("apartment.test" , $apartment -> id)}}" role="button">test annuncio</a>

                    @if ($apartment -> visible == 0)
                        <p class="green">Questo annuncio è nascosto</p>
                    @else
                        <p class="red">Questo annuncio è pubblico</p>
                    @endif
                </div>
        </div>
        @endforeach
            
        
    </div>
@endsection